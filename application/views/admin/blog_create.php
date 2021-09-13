<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Konten Blog</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">HOME</a></li>
              <li class="breadcrumb-item active">SETTING</li>
              <li class="breadcrumb-item active">KONTEN BLOG</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                        Buat Konten Blog
                    </h3>
                  </div>
                  <form class="form-horizontal" enctype="multipart/form-data" action ="<?=base_url('admin/blog/create_')?>" method="POST">
                      <div class="card-body">
                          <?=$this->session->flashdata('message'); $this->session->unset_userdata('message');?>
                          <div class="form-group row">
                              <label for="name" class="col-sm-2 col-form-label">Judul</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="judul" name="judul" >
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Isi</label>
                              <div class="col-sm-10">
                              <textarea class="textarea" name="isi"></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Kategori</label>
                              <div class="col-sm-10">
                                <select class="select2" multiple="multiple" name="kategori[]" data-placeholder="Select a State" style="width: 100%;">
                                    <?php foreach($kategori as $k):?>
                                        <option value="<?=$k->id_kategori?>"><?=$k->nama_kategori?></option>
                                    <?php endforeach;?>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Foto Header</label>
                              <div class="col-sm-10">
                                  <input type="file" name="foto">
                                  <input type="hidden" class="custom-file-input" name="foto_">
                              </div>
                          </div>
                      </div>
                      <div class="card-footer">
                          <button href="<?=base_url('admin/blog')?>" class="btn btn-default">Batal</button>
                          <button type="submit" class="btn btn-primary">Terbitkan</button>
                          <button type="submit" class="btn btn-info" name="draft" value="draft">Simpan Draft</button>
                      </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
    </section>
</div>