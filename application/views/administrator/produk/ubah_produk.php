<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- PERBAIKAN: Ganti 'admin' menjadi 'administrator' -->
                        <li class="breadcrumb-item"><a href="<?= base_url('administrator') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Produk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Ubah Data Produk</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
    
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?= set_value('nama_produk', $produk['nama']) ?>">
                                    <small class="text-danger"><?= form_error('nama_produk') ?></small>
                                </div>

                                <div class="mb-3">
                                    <label for="kategori_produk" class="form-label">Kategori Produk</label>
                                    <select class="form-select" name="kategori_produk" id="kategori_produk">
                                        <option value="">--pilih kategori--</option>
                                        <?php foreach ($list_kategori as $kategori) : ?>
                                            <option value="<?= $kategori['id_kategori'] ?>" <?= ($kategori['id_kategori'] == $produk['categori_id']) ? 'selected' : '' ?>>
                                                <?= $kategori['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('kategori_produk') ?></small>
                                </div>

                                <div class="mb-3">
                                    <label for="harga_produk" class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="harga_produk" id="harga_produk" class="form-control" value="<?= set_value('harga_produk', $produk['harga']) ?>">
                                    </div>
                                    <small class="text-danger"><?= form_error('harga_produk') ?></small>
                                </div>

                                <div class="mb-3">
                                    <label for="stok_produk" class="form-label">Stok Produk</label>
                                    <input type="number" class="form-control" name="stok_produk" id="stok_produk" value="<?= set_value('stok_produk', $produk['stok']) ?>">
                                    <small class="text-danger"><?= form_error('stok_produk') ?></small>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar_produk" class="form-label">Tambah Gambar Produk (Opsional)</label>
                                    <input class="form-control" type="file" name="gambar_produk[]" id="gambar_produk" multiple>
                                    <small class="text-muted">Pilih file untuk menambah gambar baru. Gambar lama akan tetap ada.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Gambar Saat Ini:</label>
                                    <?php 
                                    $list_gambar = $gambar_model->get_by_produk_id($produk['id_produk']);
                                    ?>
                                    
                                    <?php if (!empty($list_gambar)) : ?>
                                        <div class="row">
                                            <?php foreach ($list_gambar as $gambar) : ?>
                                                <div class="col-lg-3 col-md-4 col-6 mb-3">
                                                    <div class="card h-100">
                                                        <img src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>" 
                                                             class="card-img-top" 
                                                             style="height: 150px; object-fit: cover;" 
                                                             alt="Gambar Produk">
                                                        <div class="card-body p-2 text-center">
                                                            <a href="<?= base_url('administrator/produk/hapus_gambar/' . $gambar['id_gambar'] . '/' . $produk['id_produk']) ?>" 
                                                               class="btn btn-sm btn-danger"
                                                               onclick="return confirm('Yakin ingin menghapus gambar ini?')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-muted fst-italic">Belum ada gambar untuk produk ini.</p>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi_produk" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="5" class="form-control"><?= set_value('deskripsi_produk', $produk['deskripsi']) ?></textarea>
                                    <small class="text-danger"><?= form_error('deskripsi_produk') ?></small>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="<?= base_url('administrator/produk') ?>" class="btn btn-secondary me-md-2">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->