<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Event</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">HOME</a></li>
                        <li class="breadcrumb-item active"><a href="<?=base_url('admin/Event')?>">EVENT</a></li>
                        <li class="breadcrumb-item active">TAMBAH EVENT</li>
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
                                Form Tambah Event
                            </h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" action ="<?=base_url('admin/Event/tambah_event')?>" method="POST">
                            <?=$this->session->flashdata('message'); $this->session->unset_userdata('message');?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Event</label>
                                            <div class="input-group col-9">
                                                <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                                <input type="text" class="form-control" id="nama_event" placeholder="Nama Event" name="nama_event" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Stock</label>
                                            <div class="input-group flex-nowrap col-9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">Qty</span>
                                                </div>
                                                <input type="number" name="stock" min="0" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Event</label>
                                            <div class="ml-2 mt-2">
                                                <input type="radio" name="rad" id="rad1" value="1" class="rad"/>
                                                <label>Gratis</label>
                                            </div>
                                            <div class="ml-2 mt-2">
                                                <input type="radio" name="rad" id="rad2" value="2" class="rad"/>
                                                <label>Bayar</label>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="form2" style="display:none">
                                            <label class="col-sm-3 col-form-label">Harga Tiket</label>
                                            <div class="input-group flex-nowrap col-9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">IDR</span>
                                                </div>
                                                <input type="number" name="harga" min="0" value="0" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="form3" style="display:none">
                                            <label class="col-sm-3 col-form-label">Diskon</label>
                                            <div class="input-group flex-nowrap col-9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="addon-wrapping">%</span>
                                                </div>
                                                <input type="number" name="diskon" min="0" max="100" value="0" placeholder="max 100" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <hr>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 ml-4 col-form-label">Kategori Event</label>
                                            <div class="input-group col-8">
                                            <select class="form-control" name="kategori" id="kategori">
                                                <option value=''>- Pilih -</option>
                                                <?php foreach($kategori as $ktgr){ ?>
                                                <option value="<?php echo $ktgr['id_kategori']; ?>"><?php echo $ktgr['nama_kategori']; ?> </option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 ml-4 col-form-label">Tanggal Aktif</label>
                                            <div class="input-group flex-nowrap col-8">
                                                <input type="datetime-local" name="tgl_aktif" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 ml-4 col-form-label">Tanggal Berakhir</label>
                                            <div class="input-group flex-nowrap col-8">
                                                <input type="datetime-local" name="tgl_berakhir" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 ml-4 col-form-label">Tanggal Acara</label>
                                            <div class="input-group flex-nowrap col-8">
                                                <input type="datetime-local" name="tgl_acara" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 ml-4 col-form-label">Link Event</label>
                                            <div class="input-group flex-nowrap col-8">
                                                <input type="text" class="form-control" placeholder="Link Event" name="linkevent">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="mt-4">Deskripsi</label>
                                    <div>
                                        <textarea class="textarea" name="deskripsi"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="hidden" name="id" value="">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto[]" max="3" onchange="preview_image(event)" multiple>
                                        <label class="custom-file-label" for="foto">Max 3 Foto</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-2">
                                            <div style="display:none" id="row-display">
                                                <hr>
                                                <label for="output_image">Preview Foto 1</label><br>
                                                <img id="output_image" class="img-thumbnail" width="200" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-2">
                                            <div style="display:none" id="row-display2">
                                                <hr>
                                                <label for="output_image2">Preview Foto 2</label><br>
                                                <img id="output_image2" class="img-thumbnail" width="200" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-2">
                                            <div style="display:none" id="row-display3">
                                                <hr>
                                                <label for="output_image3">Preview Foto 3</label><br>
                                                <img id="output_image3" class="img-thumbnail" width="200" />
                                            </div>
                                        </div>
                                    </div>
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(":radio.rad").click(function(){
            $("#form1, #form2, #form3").hide()
            if($(this).val() == "1"){
                $("#form1").show();
            }else{
                $("#form2").show();
                $("#form3").show();
            }
        });
    });
</script>