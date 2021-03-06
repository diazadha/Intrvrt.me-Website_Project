<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Merchandise</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">HOME</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url('admin/merchandise') ?>">MERCHANDISE</a></li>
                        <li class="breadcrumb-item active">EDIT MERCHANDISE</li>
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
                                Form Edit Merchandise
                            </h3>
                        </div>
                        <?= $this->session->flashdata('message');
                        $this->session->unset_userdata('message'); ?>
                        <div class="row">
                            <?php 
                            $i = 1;
                            foreach($multiple_foto as $mp) : ?>
                                <!-- <?php var_dump($mp); ?> -->
                            <div class="card-body">
                                <div>
                                    <form method="post" action="<?php echo base_url() . 'admin/merchandise/update_gambar/'.$mp['id'] ?>" enctype="multipart/form-data">
                                        <label type="hidden" for="basic-url" class="form-label"><b>Foto <?= $i; ?></b></label>
                                        <div class="card bg-dark">
                                            <div class="text-center">
                                                <img src="<?php echo base_url('assets/uploads/foto_merchandise/') . $mp['foto'] ?>" alt="" class="rounded mx-auto d-block" style="width:120px;height:120px;">
                                            </div>
                                            <div type="button" class="card-footer bg-transparent border-success text-center" data-toggle="modal" data-target="#edit_foto<?=$mp['id']?>">
                                                Edit Foto <?= $i++; ?> <i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="edit_foto<?=$mp['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <input type="hidden" name="group" class="form-control" value="<?= $merch->foto ?>">
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
                            <?php endforeach; ?>
                        </div>
                    <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('admin/merchandise/edit_merch') ?>" method="POST">
                        <label class="ml-3">Pilih Foto Utama</label>
                        <div class="row ml-4 mb-4">
                            <?php 
                                $j = 1;
                                foreach($multiple_foto as $mp) : 
                                if($merch->foto_utama == $mp['id']){?>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="<?= $mp['id'] ?>" type="radio" name="main_foto" id="flexRadioDefault<?=$j?>" checked>
                                            <label class="form-check-label" for="flexRadioDefault<?=$j?>">Foto <?= $j ?></label>
                                        </div>
                                    </div>
                            <?php
                                }else {?>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="<?= $mp['id'] ?>" type="radio" name="main_foto" id="flexRadioDefault<?=$j?>" >
                                            <input type="hidden" name="id_foto" class="form-control" value="<?= $mp['id'] ?>">
                                            <label class="form-check-label" for="flexRadioDefault<?=$j?>">Foto <?= $j ?></label>
                                        </div>
                                    </div>
                            <?php
                                }
                                $j++;
                                endforeach; ?>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="col-4">Nama Merchandise</label>
                                    <div class="col mb-2">
                                        <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="text" class="form-control" id="merchandise" value="<?= $merch->nama_merch?>" placeholder="Nama Merchandise" name="merchandise" required>
                                        <input type="hidden" name="id_merch" class="form-control" value="<?= $merch->id_merch ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kategori</label>

                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value='<?= $merch->kategori ?>'>- Pilih -</option>
                                        <?php foreach($kategori as $ktgr){ ?>
                                        <option value="<?php echo $ktgr['id_kategori_merch']; ?>"><?php echo $ktgr['nama_kategori_merch']; ?> </option>
                                        <?php } ?>
                                    </select>

                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-4">Harga</label>
                                        <div class="input-group flex-nowrap col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                            </div>
                                            <input type="number" name="harga" value="<?= $merch->harga?>" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-sm-2">Diskon</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">%</span>
                                            </div>
                                            <input type="number" name="diskon"  value="<?= $merch->diskon?>" max="100" min="0" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="col-sm-4">Stock</label>
                                        <div class="input-group flex-nowrap col mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Qty</span>
                                            </div>
                                            <input type="number" name="stock" value="<?= $merch->stock?>" min="0" class="form-control" aria-label="stock" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="col-sm-4">Berat</label>
                                        <div class="input-group flex-nowrap col mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Gr</span>
                                            </div>
                                            <input type="number" name="berat" value="<?= $merch->berat?>" min="0" class="form-control" aria-label="stock" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col">Pengiriman Merchandise</label>
                                        <div class="input-group flex-nowrap">
                                                <select class="form-control" name="is_deliver">
                                            <?php if ($merch->is_deliver == "0"){?>
                                                    <option value='0' selected>Tidak Menggunakan Kurir</option>
                                                    <option value="1">Menggunakan Kurir</option>
                                            <?php }else {?>
                                                    <option value='0'>Tidak Menggunakan Kurir</option>
                                                    <option value="1"selected>Menggunakan Kurir</option>
                                            <?php } ?>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-4">Link Ebook (optional)</label>
                                        <div class="col mb-2">
                                            <input type="text" class="form-control" value="<?= $merch->linkebook?>" placeholder="link e-book" name="linkebook">
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 ml-2">Deskripsi</label>
                            <div class="col-sm-12 ml-1">
                                <textarea class="textarea" name="deskripsi"><?= $merch->deskripsi ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="group" class="form-control" value="<?= $merch->foto ?>">
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