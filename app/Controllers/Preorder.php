<?php

namespace App\Controllers;

use App\Libraries\UploadHelper;
use App\Models\PreorderModel;

class Preorder extends BaseController
{
    protected PreorderModel $model;

    public function __construct()
    {
        $this->model = new PreorderModel();
    }

    public function index()
    {
        $q      = trim((string) $this->request->getGet('q'));
        $status = $this->request->getGet('status');

        $builder = $this->model->orderBy('tanggal_po', 'DESC');
        if ($q !== '') {
            $builder = $builder->like('nama_barang', $q);
        }
        if ($status && in_array($status, PreorderModel::STATUS_LIST, true)) {
            $builder = $builder->where('status', $status);
        }

        return view('preorder/index', [
            'title'         => 'Preorder',
            'active'        => 'preorder',
            'rows'          => $builder->paginate(12),
            'pager'         => $this->model->pager,
            'q'             => $q,
            'status'        => $status,
            'statusFilter'  => PreorderModel::STATUS_LIST,
        ]);
    }

    public function new()
    {
        return view('preorder/form', [
            'title'  => 'Tambah Preorder',
            'active' => 'preorder',
            'row'    => null,
            'statusList' => PreorderModel::STATUS_LIST,
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->buildRules())) {
            return redirect()->to('/preorder/new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('gambar');
        if (! UploadHelper::isGenuineImage($file)) {
            return redirect()->to('/preorder/new')->withInput()->with('error', 'File gambar bukan gambar yang valid (JPG/PNG/WEBP).');
        }

        $data = $this->collectPost();
        $data['gambar'] = UploadHelper::store($file, 'preorder');

        $this->model->insert($data);

        return redirect()->to('/preorder')->with('success', 'Preorder berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/preorder')->with('error', 'Data tidak ditemukan.');
        }

        return view('preorder/form', [
            'title'      => 'Edit Preorder',
            'active'     => 'preorder',
            'row'        => $row,
            'statusList' => PreorderModel::STATUS_LIST,
        ]);
    }

    public function update($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/preorder')->with('error', 'Data tidak ditemukan.');
        }

        if (! $this->validate($this->buildRules($row))) {
            return redirect()->to("/preorder/{$id}/edit")->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('gambar');
        if ($file !== null && $file->isValid() && ! UploadHelper::isGenuineImage($file)) {
            return redirect()->to("/preorder/{$id}/edit")->withInput()->with('error', 'File gambar bukan gambar yang valid (JPG/PNG/WEBP).');
        }

        $data = $this->collectPost();

        $newFile = UploadHelper::store($file, 'preorder');
        if ($newFile) {
            UploadHelper::delete($row['gambar']);
            $data['gambar'] = $newFile;
        }

        $this->model->update($id, $data);

        return redirect()->to('/preorder')->with('success', 'Preorder berhasil diperbarui.');
    }

    public function delete($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/preorder')->with('error', 'Data tidak ditemukan.');
        }

        UploadHelper::delete($row['gambar']);
        $this->model->delete($id);

        return redirect()->to('/preorder')->with('success', 'Preorder berhasil dihapus.');
    }

    private function collectPost(): array
    {
        return [
            'nama_barang'   => $this->request->getPost('nama_barang'),
            'qty'           => $this->request->getPost('qty'),
            'tanggal_po'    => $this->request->getPost('tanggal_po'),
            'estimasi_tiba' => $this->request->getPost('estimasi_tiba') ?: null,
            'status'        => $this->request->getPost('status'),
            'catatan'       => $this->request->getPost('catatan'),
        ];
    }

    private function buildRules(?array $existing = null): array
    {
        $rules = $this->model->getValidationRules();

        $rules['gambar'] = ! empty($existing['gambar'])
            ? 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]'
            : 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]';

        return $rules;
    }
}
