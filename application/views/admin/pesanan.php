<div class="content-wrapper"> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pesanan Merchandise</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">HOME</a></li>
              <li class="breadcrumb-item active">PESANAN MERCHANDISE</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4 card card-outline card-primary">
        <div class="card-header py-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#BelumBayar" role="tab" aria-controls="#BelumBayar" aria-selected="true">Belum Bayar (<?= $jumlah1 ?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#SudahBayar" role="tab" aria-controls="#VerifikasiPembayaran" aria-selected="false">Sudah Bayar ( <?= $jumlah2 ?> )</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Selesai" role="tab" aria-controls="#Selesai" aria-selected="false">Selesai ( <?= $jumlah3 ?> )</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="BelumBayar" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table1">
                                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tgl Pemesanan</th>
                                            <th>Pengiriman</th>
                                            <th>Tagihan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($pesanan1 as $p1): ?>
                                        <tr>
                                            <td><?php echo $p1['id_pesanan'] ?></td>
                                            <td><?php echo $p1['tgl_pesan'] ?> </td>
                                            <td>
                                                <b><?php echo $p1['expedisi'] ?></b><br>
                                                Paket : <?php echo $p1['paket'] ?><br>
                                                Estimasi : <?php echo $p1['estimasi'] ?><br>
                                                Ongkir : Rp. <?php echo number_format($p1['ongkir'], 0,',','.') ?><br>
                                                email penerima : <?= $p1['email_penerima']; ?> 
                                            </td>
                                            <td>Rp. <?php echo number_format($p1['total_bayar'], 0,',','.') ?> </td>
                                            <td>
                                                <a class='btn btn-info btn-sm' href='<?php echo base_url('admin/pesanan/detail_m/').$p1['id_pesanan'] ?>'><span class='fas fa-info-circle'></span></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="SudahBayar" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card shadow mb-4"> 
                        <div class="card-body">
                            <div class="example2">
                                <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tgl Pemesanan</th>
                                            <th>Pengiriman</th>
                                            <th>Tagihan</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pesanan2 as $p2): ?>
                                        <tr>
                                            <td><?php echo $p2['id_pesanan'] ?></td>
                                            <td><?php echo $p2['tgl_pesan'] ?> </td>
                                            <td>
                                                <b><?php echo $p2['expedisi'] ?></b><br>
                                                Paket : <?php echo $p2['paket'] ?><br>
                                                Estimasi : <?php echo $p2['estimasi'] ?><br>
                                                Ongkir : Rp. <?php echo number_format($p2['ongkir'], 0,',','.') ?><br>
                                                email penerima : <?= $p2['email_penerima']; ?> 
                                            </td>
                                            <td>Rp. <?php echo number_format($p2['total_bayar'], 0,',','.') ?> </td>
                                            <td>
                                                <a class='btn btn-info btn-sm' href='<?php echo base_url('admin/pesanan/detail_m/').$p2['id_pesanan'] ?>'><span class='fas fa-info-circle'></span></a>
                                                <button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#Dikirim<?= $p2['id_pesanan'] ?>'>Dikirim</button>
                                            </td>
                                        </tr>
                                            <!-- Modal -->
                                        <div class='modal fade' id='Dikirim<?= $p2['id_pesanan'] ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLongTitle'>Update Status Pengiriman </b></h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>
                                                </div>
                                                <div class='modal-body'>
                                                Apakah Anda yakin update status pengiriman ID Pesanan <b>#<?= $p2['id_pesanan'] ?> </b>?
                                                </div>
                                                <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                                                <a class='btn btn-danger' href='<?= base_url('admin/pesanan/dikirim_m/').$p2['id_pesanan'] ?>'>Update</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="Selesai" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="example3">
                                <table class="table table-bordered" id="example3" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tgl Pemesanan</th>
                                            <th>Pengiriman</th>
                                            <th>Tagihan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pesanan3 as $p3): ?>
                                            <tr>
                                                <td><?php echo $p3['id_pesanan'] ?></td>
                                                <td><?php echo $p3['tgl_pesan'] ?> </td>
                                                <td>
                                                    <b><?php echo $p3['expedisi'] ?></b><br>
                                                    Paket : <?php echo $p3['paket'] ?><br>
                                                    Estimasi : <?php echo $p3['estimasi'] ?><br>
                                                    Ongkir : Rp. <?php echo number_format($p3['ongkir'], 0,',','.') ?><br>
                                                    email penerima : <?= $p3['email_penerima']; ?> 
                                                </td>
                                                <td>Rp. <?php echo number_format($p3['total_bayar'], 0,',','.') ?> </td>
                                                <td>
                                                    <a class='btn btn-info btn-sm' href='<?php echo base_url('admin/pesanan1/detail/').$p3['id_pesanan'] ?>'><span class='fas fa-info-circle'></span></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
      </div>
    </section>
</div>