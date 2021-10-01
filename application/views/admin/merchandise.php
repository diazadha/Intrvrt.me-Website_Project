<div class="content-wrapper"> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Merchandise</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">HOME</a></li>
              <li class="breadcrumb-item active">MERCHANDISE</li>
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
                        Merchandise
                    </h3>
                    <div class="card-tools">
                        <a class="btn btn-primary btn-sm" href="<?=base_url('admin/merchandise/tambah')?>">Tambah Mechandise</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <?=$this->session->flashdata('message'); $this->session->unset_userdata('message');?>
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Merchandise</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th width="15%">Diskon</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
