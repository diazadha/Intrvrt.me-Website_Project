<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profil Perusahaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">HOME</a></li>
              <li class="breadcrumb-item active">SETTING</li>
              <li class="breadcrumb-item active">PROFIL PERUSAHAAN</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                        Profil Perusahaan
                    </h3>
                  </div>
                  <form class="form-horizontal" enctype="multipart/form-data" action ="<?=base_url('admin/profil/update_perusahaan')?>" method="POST">
                      <div class="card-body">
                          <?=$this->session->flashdata('message'); $this->session->unset_userdata('message');?>
                          <div class="form-group row">
                              <label for="name" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?=$profil->nama?>">
                                  <input type="hidden" id="id" name="id" value="<?=$profil->id?>">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Tentang</label>
                              <div class="col-sm-10">
                              <textarea class="textarea" name="tentang"><?=$profil->tentang?></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Visi</label>
                              <div class="col-sm-10">
                              <textarea class="textarea" name="visi"><?=$profil->visi?></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Misi</label>
                              <div class="col-sm-10">
                              <textarea class="textarea" name="misi"><?=$profil->misi?></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
                              <div class="col-sm-10">
                              <textarea  name="alamat" class="form-control"><?=$profil->alamat?></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="<?=$profil->email?>">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Telp/Hp/WhatsApp</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="nomor_kontak" value="<?=$profil->nomor_kontak?>">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Logo</label>
                              <div class="col-sm-10">
                                  <input type="file" name="logo" accept="image/*" onchange="preview_image(event)">
                                  <input type="hidden" class="custom-file-input" value="<?=$profil->logo?>" name="logo_">
                                  <hr>
                                  <label for="output">Preview Foto Logo</label><br>
                                  <img id="output" src="<?=$profil->logo?>" class="img-thumbnail" width="200"/>
                                  <div style="display:none" id="row-display">
                                    <hr>
                                    <label for="output">Preview Update Foto Logo</label><br>
                                    <img id="output_image" class="img-thumbnail" width="200"/>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                          <button type="submit" class="btn btn-info">Simpan</button>
                      </div>
                      <!-- /.card-footer -->
                  </form>
              </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>