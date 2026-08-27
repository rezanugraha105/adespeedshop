<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;

class Auth extends BaseController
{
    /** Max failed login attempts allowed per IP within the time window. */
    private const MAX_ATTEMPTS = 5;
    /** Window (seconds) the attempt limit applies to. */
    private const WINDOW_SECONDS = 300;

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function attempt()
    {
        $throttler = Services::throttler();
        // md5() keeps the cache key free of reserved characters regardless
        // of IP format (IPv6 addresses contain ":", which the cache driver
        // rejects as a key character).
        $throttleKey = 'login-' . md5($this->request->getIPAddress());

        // check() consumes a token even on failure, so a fresh IP always has
        // MAX_ATTEMPTS tries per WINDOW_SECONDS before being blocked.
        if ($throttler->check($throttleKey, self::MAX_ATTEMPTS, self::WINDOW_SECONDS) === false) {
            return redirect()->to('/login')->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam beberapa menit.');
        }

        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/login')->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->where('username', $username)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->to('/login')->withInput()->with('error', 'Username atau password salah.');
        }

        // Regenerate the session ID on privilege change to prevent session
        // fixation (an attacker priming a victim's browser with a known
        // session ID before they log in).
        session()->regenerate(true);

        session()->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'name'      => $user['name'],
            'logged_in' => true,
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('message', 'Anda telah logout.');
    }
}
