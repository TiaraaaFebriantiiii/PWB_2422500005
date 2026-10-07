<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
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
                        <div class="card-body">
                            <p class="card-text">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="nama_produk" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" aria-describedbyby="Nama produk">
                                        <small class="text-danger"><?= form_error('nama_produk') ?></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_produk" class="form-label">Kategori Produk</label>
                                        <select class="form-select" name="kategori_produk" id="kategori_produk" form-control>
                                            <option value="">--pilih kategori--</option>
                                            <?php foreach ($list_kategori as $kategori) : ?>
                                                <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <small class="text-danger"><?= form_error('kategori_produk') ?></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_produk" class="form-label">Harga</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                            <input type="number" name="harga_produk" id="harga_produk" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stok_produk" class="form-label">Stok Produk</label>
                                        <input type="number" class="form-control" name="stok_produk" id="stok_produk" aria-describedbyby="Stok produk">
                                        <small class="text-danger"><?= form_error('stok_produk') ?></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar_produk" class="form-label">Gambar Produk</label>
                                        <input type="file" class="form-control" name="gambar_produk[]" id="gambar_produk" multiple>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_produk" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambah Button</button>
                                    <a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">Kembali</a>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->