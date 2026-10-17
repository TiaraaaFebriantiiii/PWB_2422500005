<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Data Produk</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                
                                <!-- Nama Produk -->
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" 
                                           value="<?= set_value('nama_produk', $produk['nama']) ?>" required>
                                    <small class="text-danger"><?= form_error('nama_produk') ?></small>
                                </div>

                                <!-- Kategori Produk -->
                                <div class="form-group">
                                    <label for="kategori_produk">Kategori Produk</label>
                                    <select class="form-control" name="kategori_produk" id="kategori_produk" required>
                                        <option value="">--pilih kategori--</option>
                                        <?php foreach ($list_kategori as $kategori) : ?>
                                            <option value="<?= $kategori['id_kategori'] ?>" 
                                                <?= ($kategori['id_kategori'] == $produk['categori_id']) ? 'selected' : '' ?>>
                                                <?= $kategori['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('kategori_produk') ?></small>
                                </div>

                                <!-- Harga -->
                                <div class="form-group">
                                    <label for="harga_produk">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" name="harga_produk" id="harga_produk" 
                                               value="<?= set_value('harga_produk', $produk['harga']) ?>" required>
                                    </div>
                                    <small class="text-danger"><?= form_error('harga_produk') ?></small>
                                </div>

                                <!-- Stok -->
                                <div class="form-group">
                                    <label for="stok_produk">Stok Produk</label>
                                    <input type="number" class="form-control" name="stok_produk" id="stok_produk" 
                                           value="<?= set_value('stok_produk', $produk['stok']) ?>" required>
                                    <small class="text-danger"><?= form_error('stok_produk') ?></small>
                                </div>

                                <!-- Upload Gambar Baru -->
                                <div class="form-group">
                                    <label for="gambar_produk">Tambah Gambar Produk (Opsional)</label>
                                    <input type="file" class="form-control-file" name="gambar_produk[]" id="gambar_produk" multiple accept="image/*">
                                    <small class="text-muted">Pilih file untuk menambah gambar baru. Gambar lama akan tetap ada.</small>
                                    
                                    <!-- Area Preview Gambar Baru -->
                                    <div id="preview_gambar_baru" class="row mt-3"></div>
                                </div>

                                <!-- Tampilan Gambar yang Sudah Ada -->
                                <div class="form-group">
                                    <label class="font-weight-bold">Gambar Saat Ini:</label>
                                    <?php 
                                    $list_gambar = $gambar_model->get_by_produk_id($produk['id_produk']);
                                    ?>
                                    
                                    <?php if (!empty($list_gambar)) : ?>
                                        <div class="row">
                                            <?php foreach ($list_gambar as $gambar) : ?>
                                                <div class="col-md-3 col-sm-6 mb-3">
                                                    <div class="card">
                                                        <img src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>" 
                                                             class="card-img-top" 
                                                             style="height: 150px; object-fit: cover;" 
                                                             alt="Gambar Produk">
                                                        <div class="card-body text-center p-2">
                                                            <div class="btn-group" style="width: 100%;">
                                                                <button type="button" 
                                                                        class="btn btn-warning btn-sm"
                                                                        style="flex: 1;"
                                                                        onclick="openEditModal(<?= $gambar['id_gambar'] ?>, '<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>')">
                                                                    <i class="fas fa-edit"></i> Ubah
                                                                </button>
                                                                <a href="<?= base_url('administrator/produk/hapus_gambar/' . $gambar['id_gambar'] . '/' . $produk['id_produk']) ?>" 
                                                                   class="btn btn-danger btn-sm"
                                                                   style="flex: 1;"
                                                                   onclick="return confirm('Yakin ingin menghapus gambar ini?')">
                                                                    <i class="fas fa-trash"></i> Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-muted"><em>Belum ada gambar untuk produk ini.</em></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Deskripsi -->
                                <div class="form-group">
                                    <label for="deskripsi_produk">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" 
                                              rows="5"><?= set_value('deskripsi_produk', $produk['deskripsi']) ?></textarea>
                                    <small class="text-danger"><?= form_error('deskripsi_produk') ?></small>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="<?= base_url('administrator/produk') ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<!-- Modal Bootstrap untuk Ubah Gambar -->
<div class="modal fade" id="modalEditGambar" tabindex="-1" role="dialog" aria-labelledby="modalEditGambarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="modalEditGambarLabel"><i class="fas fa-edit"></i> Ubah Gambar Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditGambar" enctype="multipart/form-data">
                    <input type="hidden" name="id_gambar" id="edit_id_gambar">
                    <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                    
                    <div class="form-group">
                        <label class="font-weight-bold">Gambar Saat Ini:</label>
                        <div class="text-center mb-3">
                            <img id="current_image" src="" alt="Current" 
                                 style="max-width: 100%; height: 200px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_gambar_file">Pilih Gambar Baru:</label>
                        <input type="file" class="form-control-file" name="edit_gambar" id="edit_gambar_file" accept="image/*" required>
                        <small class="text-muted">Format: JPG, JPEG, PNG, GIF (Maks. 5MB)</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">Preview Gambar Baru:</label>
                        <div class="text-center">
                            <img id="preview_image" src="" alt="Preview" 
                                 style="max-width: 100%; height: 200px; object-fit: cover; display: none; border: 1px solid #28a745; border-radius: 5px;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitEditGambar()">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Preview dan Modal Edit Gambar -->
<script>
$(document).ready(function() {
    // ============================================
    // PREVIEW GAMBAR BARU (Saat pilih file di "Tambah Gambar Produk")
    // ============================================
    $('#gambar_produk').on('change', function() {
        $('#preview_gambar_baru').html('');
        
        var files = this.files;
        if (files && files.length > 0) {
            for (var i = 0; i < files.length; i++) {
                (function(index) {
                    var file = files[index];
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        var html = '<div class="col-md-3 col-sm-6 mb-3" id="preview_box_' + index + '">';
                        html += '<div class="card">';
                        html += '<img src="' + e.target.result + '" class="card-img-top" style="height: 150px; object-fit: cover;">';
                        html += '<div class="card-body text-center p-2">';
                        html += '<div class="btn-group" style="width: 100%;">';
                        html += '<button type="button" class="btn btn-warning btn-sm" style="flex: 1;" onclick="alert(\'Silakan hapus preview ini dan pilih ulang file yang benar\')"><i class="fas fa-edit"></i> Ubah</button>';
                        html += '<button type="button" class="btn btn-danger btn-sm" style="flex: 1;" onclick="$(\'#preview_box_' + index + '\').remove();"><i class="fas fa-trash"></i> Hapus</button>';
                        html += '</div></div></div></div>';
                        
                        $('#preview_gambar_baru').append(html);
                    };
                    
                    reader.readAsDataURL(file);
                })(i);
            }
        }
    });
});

// ============================================
// MODAL EDIT GAMBAR
// ============================================
function openEditModal(id_gambar, image_url) {
    document.getElementById('edit_id_gambar').value = id_gambar;
    document.getElementById('current_image').src = image_url;
    document.getElementById('preview_image').style.display = 'none';
    document.getElementById('edit_gambar_file').value = '';
    
    $('#modalEditGambar').modal('show');
}

// Preview gambar baru di modal
document.getElementById('edit_gambar_file').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview_image').src = event.target.result;
            document.getElementById('preview_image').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

// Submit form edit gambar via AJAX
function submitEditGambar() {
    var formData = new FormData(document.getElementById('formEditGambar'));
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url("administrator/produk/edit_gambar") ?>', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Gambar berhasil diubah!');
                location.reload();
            } else {
                alert('Gagal: ' + response.message);
            }
        } else {
            alert('Terjadi kesalahan server');
        }
    };
    xhr.send(formData);
}
</script>