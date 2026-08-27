<?= view('layout/header', ['title' => $title, 'active' => $active]) ?>

<div class="card border-0 shadow-sm">
    <div class="card-header card-header-dark">Buat Invoice Baru</div>
    <div class="card-body">
        <form action="<?= site_url('invoice') ?>" method="post" id="invoiceForm">
            <?= csrf_field() ?>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">No. Invoice</label>
                    <input type="text" class="form-control" value="<?= esc($noInvoice) ?>" disabled>
                    <div class="form-text">Dibuat otomatis saat disimpan.</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal', date('Y-m-d')) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sumber Data</label>
                    <select name="sumber" id="sumber" class="form-select" required>
                        <option value="manual">Manual (isi item sendiri)</option>
                        <option value="offline">Dari Penjualan Offline</option>
                        <option value="shopee">Dari Penjualan Shopee</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-3" id="sumberOfflineWrap" style="display:none;">
                <div class="col-12">
                    <label class="form-label">Pilih Transaksi Offline</label>
                    <select name="sumber_id" id="sumber_offline_id" class="form-select">
                        <option value="">-- Pilih Transaksi --</option>
                        <?php foreach ($offlineRows as $r) : ?>
                            <option value="<?= $r['id'] ?>"
                                data-nama="<?= esc($r['nama_pembeli'], 'attr') ?>"
                                data-produk="<?= esc($r['nama_produk'], 'attr') ?>"
                                data-qty="<?= esc($r['qty'], 'attr') ?>"
                                data-total="<?= esc(number_format($r['calc']['total_bayar'], 0, ',', '.'), 'attr') ?>">
                                <?= esc($r['no_nota']) ?> — <?= esc($r['nama_pembeli']) ?> (<?= esc($r['nama_produk']) ?>, <?= esc($r['tanggal']) ?>)
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-3" id="sumberShopeeWrap" style="display:none;">
                <div class="col-12">
                    <label class="form-label">Pilih Transaksi Shopee</label>
                    <select name="sumber_id" id="sumber_shopee_id" class="form-select">
                        <option value="">-- Pilih Transaksi --</option>
                        <?php foreach ($shopeeRows as $r) : ?>
                            <option value="<?= $r['id'] ?>"
                                data-produk="<?= esc($r['nama_produk'], 'attr') ?>"
                                data-qty="<?= esc($r['qty'], 'attr') ?>">
                                <?= esc($r['no_pesanan']) ?> — <?= esc($r['nama_produk']) ?> (<?= esc($r['tanggal']) ?>)
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="form-text">Shopee tidak menyimpan nama pembeli — isi nama pembeli secara manual di bawah.</div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" value="<?= old('nama_pembeli') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Alamat (opsional)</label>
                    <input type="text" name="alamat_pembeli" class="form-control" value="<?= old('alamat_pembeli') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Telepon (opsional)</label>
                    <input type="text" name="telepon_pembeli" class="form-control" value="<?= old('telepon_pembeli') ?>">
                </div>
            </div>

            <div id="manualItemsWrap">
                <label class="form-label">Item Invoice</label>
                <div id="manualItemsRows"></div>
                <button type="button" class="btn btn-sm btn-outline-primary" id="btnAddRow">
                    <i class="fa-solid fa-plus"></i> Tambah Baris
                </button>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Invoice</button>
                <a href="<?= site_url('invoice') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<template id="rowTemplate">
    <div class="row g-2 mb-2 align-items-center manual-row">
        <div class="col-12 col-sm-5">
            <input type="text" name="item_nama[]" class="form-control form-control-sm" placeholder="Nama barang">
        </div>
        <div class="col-4 col-sm-2">
            <input type="number" name="item_qty[]" class="form-control form-control-sm" placeholder="Qty" value="1">
        </div>
        <div class="col-5 col-sm-3">
            <input type="number" step="0.01" name="item_harga[]" class="form-control form-control-sm" placeholder="Harga satuan">
        </div>
        <div class="col-3 col-sm-2">
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
</template>

<script>
    var sumberSelect = document.getElementById('sumber');
    var offlineWrap = document.getElementById('sumberOfflineWrap');
    var shopeeWrap = document.getElementById('sumberShopeeWrap');
    var manualWrap = document.getElementById('manualItemsWrap');
    var namaPembeli = document.getElementById('nama_pembeli');
    var offlineSelect = document.getElementById('sumber_offline_id');
    var shopeeSelect = document.getElementById('sumber_shopee_id');
    var rowsContainer = document.getElementById('manualItemsRows');
    var rowTemplate = document.getElementById('rowTemplate');

    function addRow() {
        rowsContainer.appendChild(rowTemplate.content.cloneNode(true));
    }

    function clearManualNames() {
        document.querySelectorAll('#manualItemsRows input[name="item_nama[]"]').forEach(function (el) { el.name = 'item_nama_disabled[]'; });
        document.querySelectorAll('#manualItemsRows input[name="item_qty[]"]').forEach(function (el) { el.name = 'item_qty_disabled[]'; });
        document.querySelectorAll('#manualItemsRows input[name="item_harga[]"]').forEach(function (el) { el.name = 'item_harga_disabled[]'; });
    }

    function restoreManualNames() {
        document.querySelectorAll('#manualItemsRows input[name="item_nama_disabled[]"]').forEach(function (el) { el.name = 'item_nama[]'; });
        document.querySelectorAll('#manualItemsRows input[name="item_qty_disabled[]"]').forEach(function (el) { el.name = 'item_qty[]'; });
        document.querySelectorAll('#manualItemsRows input[name="item_harga_disabled[]"]').forEach(function (el) { el.name = 'item_harga[]'; });
    }

    function toggleSumber() {
        offlineWrap.style.display = 'none';
        shopeeWrap.style.display = 'none';
        manualWrap.style.display = 'none';
        offlineSelect.disabled = true;
        shopeeSelect.disabled = true;

        if (sumberSelect.value === 'offline') {
            offlineWrap.style.display = '';
            offlineSelect.disabled = false;
            clearManualNames();
        } else if (sumberSelect.value === 'shopee') {
            shopeeWrap.style.display = '';
            shopeeSelect.disabled = false;
            clearManualNames();
        } else {
            manualWrap.style.display = '';
            restoreManualNames();
        }
    }

    sumberSelect.addEventListener('change', toggleSumber);
    offlineSelect.addEventListener('change', function () {
        var opt = this.options[this.selectedIndex];
        if (opt.getAttribute('data-nama')) {
            namaPembeli.value = opt.getAttribute('data-nama');
        }
    });

    document.getElementById('btnAddRow').addEventListener('click', addRow);
    rowsContainer.addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-row')) {
            e.target.closest('.manual-row').remove();
        }
    });

    addRow();
    toggleSumber();
</script>

<?= view('layout/footer') ?>
