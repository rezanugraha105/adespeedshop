<?php

namespace App\Controllers;

class Files extends BaseController
{
    private const ALLOWED_SUBFOLDERS = ['offline', 'shopee', 'preorder'];
    private const MIME_MAP = [
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'webp' => 'image/webp',
    ];

    /**
     * Streams a previously uploaded proof/photo file. Only reachable while
     * logged in (see the 'auth' filter group in Routes.php) — uploads live
     * under writable/uploads/, outside the public webroot, specifically so
     * they cannot be viewed by guessing/finding the URL.
     */
    public function show(string $subfolder, string $filename)
    {
        if (! in_array($subfolder, self::ALLOWED_SUBFOLDERS, true)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // basename() strips any directory components to block path traversal
        // (e.g. "../../.env") regardless of what was in the URL segment.
        $safeName = basename($filename);
        $extension = strtolower(pathinfo($safeName, PATHINFO_EXTENSION));

        if (! isset(self::MIME_MAP[$extension])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/' . $subfolder . '/' . $safeName;

        if (! is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setContentType(self::MIME_MAP[$extension])
            ->setHeader('Cache-Control', 'private, max-age=86400')
            ->setBody(file_get_contents($path));
    }
}
