<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Event</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">HOME</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url('admin/event') ?>">EVENT</a></li>
                        <li class="breadcrumb-item active">EDIT EVENT</li>
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
                                Form Edit Event
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
                                    <form method="post" action="<?php echo base_url() . 'admin/event/update_gambar/'.$mp['id'] ?>" enctype="multipart/form-data">
                                        <label type="hidden" for="basic-url" class="form-label"><b>Foto <?= $i; ?></b></label>
                                        <div class="card bg-dark">
                                            <div class="text-center">
                                                <img src="<?php echo base_url('assets/uploads/foto_event/') . $mp['foto'] ?>" alt="" class="rounded mx-auto d-block" style="width:120px;height:120px;">
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
                                                            <font color="black">Pilih file foto event yang akan diganti</font>
                                                        </p>
                                                        <input type="file" name="foto" class="form-control">
                                                        <input type="hidden" name="id_event" class="form-control" value="<?= $event->id_event ?>">
                                                        <input type="hidden" name="group" class="form-control" value="<?= $event->foto ?>">
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
                    <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('admin/event/edit_event') ?>" method="POST">
                        <label class="ml-3">Pilih Foto Utama</label>
                        <div class="row ml-4 mb-4">
                            <?php 
                                $j = 1;
                                foreach($multiple_foto as $mp) : 
                                if($event->foto_utama == $mp['id']){?>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="<?= $mp['id'] ?>" type="radio" name="foto_utama" id="flexRadioDefault<?=$j?>" checked>
                                            <label class="form-check-label" for="flexRadioDefault<?=$j?>">Foto <?= $j ?></label>
                                        </div>
                                    </div>
                            <?php
                                }else {?>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" value="<?= $mp['id'] ?>" type="radio" name="foto_utama" id="flexRadioDefault<?=$j?>" >
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
                                    <?= $this->session->flashdata('message');$this->session->unset_userdata('message'); ?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 ml-3 col-form-label">Nama Event</label>
                                        <div class="input-group col-9">
                                            <input type="text" class="form-control" id="event" placeholder="Nama event" name="nama_event" value="<?= $event->nama_event ?>" required>
                                            <input type="hidden" name="id_event" class="form-control" value="<?= $event->id_event ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 ml-3 col-form-label">Stock</label>
                                        <div class="input-group flex-nowrap col-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Qty</span>
                                            </div>
                                            <input type="number" name="stock" value="<?= $event->stock ?>" min="0" class="form-control" aria-label="stock" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 ml-3 col-form-label">Harga Tiket</label>
                                        <div class="input-group flex-nowrap col-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                            </div>
                                            <input type="number" value="<?= $event->harga_tiket ?>" name="harga_tiket" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 ml-3 col-form-label">Diskon</label>
                                        <div class="input-group flex-nowrap col-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="addon-wrapping">%</span>
                                            </div>
                                            <input type="number" value="<?= $event->diskon ?>" name="diskon" max="100" min="0" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-6"> 
                                <div class="form-group row">
                                    <label class="col-sm-3 ml-4 col-form-label">Kategori Event</label>
                                    <div class="input-group col-8">
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option value='<?php echo $event->kategori ?>'><?php echo $event->nama_kategori ?></option>
                                            <?php foreach ($kategori as $ktgr) { ?>
                                                <option value="<?php echo $ktgr['id_kategori']; ?>"><?php echo $ktgr['nama_kategori']; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 ml-4 col-form-label">Tanggal Aktif</label>
                                    <div class="input-group flex-nowrap col-8">
                                        <input type="datetime-local" name="tgl_aktif" value="<?= date('Y-m-d\TH:i',strtotime($event->tgl_aktif)) ?>" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 ml-4 col-form-label">Tanggal Berakhir</label>
                                    <div class="input-group flex-nowrap col-8">
                                        <input type="datetime-local" name="tgl_berakhir" value="<?= date('Y-m-d\TH:i',strtotime($event->tgl_berakhir)) ?>" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 ml-4 col-form-label">Tanggal Acara</label>
                                    <div class="input-group flex-nowrap col-8">
                                        <input type="datetime-local" name="tgl_acara" value="<?= date('Y-m-d\TH:i',strtotime($event->tgl_acara)) ?>" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-sm-2 ml-3 col-form-label">Link Event</label>
                                    <div class="input-group col-9">
                                        <input type="text" name="linkevent" value="<?= $event->linkevent ?>" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 ml-2">Deskripsi</label>
                            <div class="col-sm-12 ml-1">
                                <textarea class="textarea" name="deskripsi_event"><?= $event->deskripsi_event ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="group" class="form-control" value="<?= $event->foto ?>">
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