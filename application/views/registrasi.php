<div class="container">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card mb-4 mx-auto" style="width: 24rem;">
        <div class="card-body login-card-body">
          <div class="login-logo mb-4 text-center">
            <a href="<?=base_url();?>"><b>INTRVRT</b>.ME</a>
          </div>

            <form action="<?=base_url('dashboard1');?>" method="post">
            <div class="input-group mb-4">
                <input type="nama" class="form-control" placeholder="Nama Lengkap">
                <div class="input-group-append">
                </div>
            </div>
            <div class="input-group mb-4">
                <input type="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-4">
                <input type="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-4">
                <input type="password" class="form-control" placeholder="Konfirmasi Password">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
           
            <label class="ml-2 mb-3">Jenis Kelamin</label><br>
            <div class="form-check form-check-inline ml-2 mb-4">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline mb-4">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
            </div>

            <div class="input-group mb-4">
                <input type="date" class="form-control" name="tanggal">
            </div>

            <div class="mb-4">
                <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
            </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
  </div>
</div>