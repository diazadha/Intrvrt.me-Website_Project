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
                Edit Konten Blog
              </h3>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('admin/blog/update_') ?>" method="POST">
              <div class="card-body">
                <?= $this->session->flashdata('message');
                $this->session->unset_userdata('message'); ?>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $konten->judul ?>">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $konten->id_blog ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Isi</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" name="isi"><?= htmlspecialchars_decode($konten->isi_konten) ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select class="select2" multiple="multiple" name="kategori[]" data-placeholder="Pilih kategori" style="width: 100%;">
                      <?php
                      $id = explode(',', $konten->kategori);
                      foreach ($kategori as $k) : ?>
                        <option value="<?= $k->id_kategori ?>" <?= (array_search($k->id_kategori, $id) != '') ? 'selected' : '' ?>><?= $k->nama_kategori ?></option>
                      <?php $no++;
                      endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Penulis</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="sumber" name="sumber" value="<?= $konten->sumber ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Foto Header</label>
                  <div class="col-sm-10">
                    <input type="file" name="foto" accept="image/*" onchange="preview_image(event)">
                    <input type="hidden" class="custom-file-input" value="<?= $konten->foto ?>" name="foto_">
                    <hr>
                    <label for="output">Preview Foto Header</label><br>
                    <img id="output" src="<?= $konten->foto ?>" class="img-thumbnail" width="200" />
                    <div style="display:none" id="row-display">
                      <hr>
                      <label for="output">Preview Update Foto Header</label><br>
                      <img id="output_image" class="img-thumbnail" width="200" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="<?= base_url('admin/blog/index') ?>" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-info">Simpan Draft</button>
                <button type="submit" class="btn btn-primary">Terbitkan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>