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
                        <?=$this->session->flashdata('message'); $this->session->unset_userdata('message');?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-4">Nama Merchandise</label>
                                        <div class="col mb-2">
                                            <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                            <input type="text" class="form-control" id="merchandise" placeholder="Nama Merchandise" name="merchandise" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-sm-2">Kategori</label>
   
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option value=''>- Pilih -</option>
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
                                            <input type="number" name="harga" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
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
                                            <input type="number" name="diskon" max="100" min="0" class="form-control" aria-label="stok" aria-describedby="addon-wrapping" required>
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
                                            <input type="number" name="stock" min="0" class="form-control" aria-label="stock" aria-describedby="addon-wrapping" required>
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
                                            <input type="number" name="berat" min="0" class="form-control" aria-label="stock" aria-describedby="addon-wrapping" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col">Pengiriman Merchandise</label>
                                        <div class="input-group flex-nowrap">
                                            <select class="form-control" name="is_deliver">
                                            <option value='0'>Tidak Menggunakan Kurir</option>
                                            <option value="1">Menggunakan Kurir</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-12">
                                    <textarea class="textarea" name="deskripsi"></textarea> 
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="hidden" name="id" value="">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto[]" max="5" onchange="preview_image(event)" multiple>
                                        <label class="custom-file-label" for="foto">Max Foto 5</label>
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

                                        <div class="col-2">
                                            <div style="display:none" id="row-display4">
                                                <hr>
                                                <label for="output_image4">Preview Foto 4</label><br>
                                                <img id="output_image4" class="img-thumbnail" width="200" />
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div style="display:none" id="row-display5">
                                                <hr>
                                                <label for="output_image5">Preview Foto 5</label><br>
                                                <img id="output_image5" class="img-thumbnail" width="200" />
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass('selected').html(fileName);
    });
</script>