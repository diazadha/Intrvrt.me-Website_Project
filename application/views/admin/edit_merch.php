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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">HOME</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url('admin/merchandise') ?>">MERCHANDISE</a></li>
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
                        <?= $this->session->flashdata('message');
                        $this->session->unset_userdata('message'); ?>
                        <div class="row">
                            <div class="card-body">
                                <div class="col-12">
                                    <form method="post" action="<?php echo base_url() . 'admin/merchandise/update_gambar/' ?>" enctype="multipart/form-data">
                                        <label type="hidden" for="basic-url" class="form-label ml-3"><b>Foto Produk</b></label>
                                        <div class="card bg-dark ml-3">
                                            <div class="text-center">
                                                <img src="<?php echo base_url('assets/uploads/foto_merchandise/') . $merch->foto ?>" alt="" class="rounded mx-auto d-block" style="width:340px;height:340px;">
                                            </div>
                                            <div type="button" class="card-footer bg-transparent border-success text-center" data-toggle="modal" data-target="#edit_foto">
                                                Edit Foto Produk <i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="edit_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <font color="red">File Picker</font>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="fw-bold">
                                                            <font color="black">Pilih file foto Merchandise yang akan diganti</font>
                                                        </p>
                                                        <input type="file" name="foto" class="form-control">
                                                        <input type="hidden" name="id_merch" class="form-control" value="<?= $merch->id_merch ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>

                            <div class="col-8">
                                <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('admin/merchandise/edit_merch') ?>" method="POST">
                                    <?= $this->session->flashdata('message');
                                    $this->session->unset_userdata('message'); ?>
                                    <div class="form-group mt-4">
                                        <label class="ml-2">Nama Merchandise</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="merchandise" placeholder="Nama Merchandise" name="merchandise" value="<?= $merch->nama_merch ?>" required>
                                            <input type="hidden" name="id_merch" class="form-control" value="<?= $merch->id_merch ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="ml-2">Kategori Merchandise</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="kategori" id="kategori">
                                                <option value='<?php echo $merch->kategori ?>'><?php echo $merch->nama_kategori_merch ?></option>
                                                <?php foreach ($kategori as $ktgr) { ?>
                                                    <option value="<?php echo $ktgr['id_kategori_merch']; ?>"><?php echo $ktgr['nama_kategori_merch']; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="ml-2">Harga</label>
                                        <div class="input-group flex-nowrap col-sm-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                            </div>
                                            <input type="number" value="<?= $merch->harga ?>" name="harga" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="ml-2">Diskon</label>
                                        <div class="input-group flex-nowrap col-sm-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                            </div>
                                            <input type="number" value="<?= $merch->diskon ?>" name="diskon" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 ml-4">Deskripsi</label>
                            <div class="col-sm-11 ml-3">
                                <textarea class="textarea" name="deskripsi"><?= $merch->deskripsi ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card-body -->

                    <!-- </div> -->
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>