<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Merchandise</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">HOME</a></li>
                        <li class="breadcrumb-item active"><a href="<?=base_url('admin/merchandise')?>">MERCHANDISE</a></li>
                        <li class="breadcrumb-item active">TAMBAH MERCHANDISE</li>
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
                                Form Tambah Merchandise
                            </h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" action ="<?=base_url('admin/merchandise/tambah_merch')?>" method="POST">
                            <div class="card-body">
                                <?=$this->session->flashdata('message'); $this->session->unset_userdata('message');?>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nama Merchandise</label>
                                    <div class="col-sm-10">
                                        <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="text" class="form-control" id="merchandise" placeholder="Nama Merchandise" name="merchandise" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori Merchandise</label>
                                    <div class="col-sm-4">
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value=''>- Pilih -</option>
                                        <?php foreach($kategori as $ktgr){ ?>
                                        <option value="<?php echo $ktgr['id_kategori_merch']; ?>"><?php echo $ktgr['nama_kategori_merch']; ?> </option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                    <div class="input-group flex-nowrap col-sm-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                        </div>
                                        <input type="number" name="harga" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="diskon" class="col-sm-2 col-form-label">Diskon</label>
                                    <div class="input-group flex-nowrap col-sm-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                        </div>
                                        <input type="number" name="diskon" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="textarea" name="deskripsi"></textarea> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-4">
                                    <input type="file" name="foto" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                    <input type="hidden" class="custom-file-input" value="<?=$merch->foto?>" name="foto_">
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
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