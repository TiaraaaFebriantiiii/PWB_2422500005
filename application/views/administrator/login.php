<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <!-- PERBAIKAN 1: Ganti href agar tidak error 404 -->
        <a href="<?= base_url('admin/login') ?>"><b>Tiara</b> Pet Shop</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <!-- VALIDASI & FLASHDATA (Sudah Benar) -->
            <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message') ?>
            <?php endif; ?>

            <!-- PERBAIKAN 2: Tambahkan action form secara eksplisit -->
            <form action="<?= base_url('admin/login') ?>" method="post">
                <div class="input-group mb-3">
                    <input class="form-control" id="inputUsername" name="inputUsername" type="text" placeholder="Username" required />
                    <small class="text-danger"><em><?= form_error('inputUsername') ?></em></small>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span> <!-- Diubah jadi icon user agar lebih sesuai -->
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Password" required />
                    <small class="text-danger"><em><?= form_error('inputPassword') ?></em></small>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"> <!-- PERBAIKAN 3: Ubah col-4 jadi col-12 agar tombol full width -->
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
</body>
</html>