<?php

namespace App\Controllers;

use App\Models\MutasiKasModel;

class Mutasi extends BaseController
{
    protected MutasiKasModel $model;

    public function __construct()
    {
        $this->model = new MutasiKasModel();
    }

    public function index()
    {
        $filter = $this->request->getGet('jenis');

        // Compute the summary with a separate model instance so its
        // unfiltered findAll() can't be affected by the WHERE clause
        // applied below for the (possibly filtered) paginated listing.
        $summary = (new MutasiKasModel())->summary();

        $builder = $this->model->orderBy('tanggal', 'DESC')->orderBy('id', 'DESC');
        if ($filter && in_array($filter, MutasiKasModel::JENIS_LIST, true)) {
            $builder = $builder->where('jenis', $filter);
        }

        return view('mutasi/index', [
            'title'     => 'Mutasi Kas',
            'active'    => 'mutasi',
            'rows'      => $builder->paginate(15),
            'pager'     => $this->model->pager,
            'summary'   => $summary,
            'filter'    => $filter,
            'jenisList' => MutasiKasModel::JENIS_LIST,
        ]);
    }

    public function new()
    {
        return view('mutasi/form', [
            'title'     => 'Tambah Mutasi Kas',
            'active'    => 'mutasi',
            'row'       => null,
            'jenisList' => MutasiKasModel::JENIS_LIST,
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->model->getValidationRules())) {
            return redirect()->to('/mutasi/new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert($this->collectPost());

        return redirect()->to('/mutasi')->with('success', 'Mutasi kas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/mutasi')->with('error', 'Data tidak ditemukan.');
        }

        return view('mutasi/form', [
            'title'     => 'Edit Mutasi Kas',
            'active'    => 'mutasi',
            'row'       => $row,
            'jenisList' => MutasiKasModel::JENIS_LIST,
        ]);
    }

    public function update($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/mutasi')->with('error', 'Data tidak ditemukan.');
        }

        if (! $this->validate($this->model->getValidationRules())) {
            return redirect()->to("/mutasi/{$id}/edit")->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $this->collectPost());

        return redirect()->to('/mutasi')->with('success', 'Mutasi kas berhasil diperbarui.');
    }

    public function lunas($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/mutasi')->with('error', 'Data tidak ditemukan.');
        }

        $this->model->update($id, ['status' => 'Lunas']);

        return redirect()->to('/mutasi')->with('success', 'Status berhasil diperbarui menjadi Lunas.');
    }

    public function delete($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/mutasi')->with('error', 'Data tidak ditemukan.');
        }

        $this->model->delete($id);

        return redirect()->to('/mutasi')->with('success', 'Data mutasi kas berhasil dihapus.');
    }

    private function collectPost(): array
    {
        return [
            'tanggal'             => $this->request->getPost('tanggal'),
            'jenis'               => $this->request->getPost('jenis'),
            'keterangan'          => $this->request->getPost('keterangan'),
            'pihak'               => $this->request->getPost('pihak'),
            'nominal'             => $this->request->getPost('nominal'),
            'status'              => $this->request->getPost('status') ?: 'Lunas',
            'tanggal_jatuh_tempo' => $this->request->getPost('tanggal_jatuh_tempo') ?: null,
            'catatan'             => $this->request->getPost('catatan'),
        ];
    }
}
