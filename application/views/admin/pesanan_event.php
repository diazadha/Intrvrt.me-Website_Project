<div class="content-wrapper"> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pesanan Event</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">HOME</a></li>
              <li class="breadcrumb-item active">PESANAN EVENT</li>
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
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#BelumBayar" role="tab" aria-controls="#BelumBayar" aria-selected="true">Belum Bayar (<?= $countbelum ?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#SudahBayar" role="tab" aria-controls="#VerifikasiPembayaran" aria-selected="false">Sudah Bayar (<?= $countsudah ?>)</a>
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
                                            <th>Pemesan</th>
                                            <th>Event</th>
                                            <th>Tagihan</th>
                                            <th width="5%">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($belumbayar as $b): ?>
                                        <tr>
                                            <td width="5%"><?= $b->id?></td>
                                            <td><?= $b->tgl_pesan ?> </td>
                                            <td><?= $b->pemesan ?></td>
                                            <td>
                                              <?php 
                                              $field=""; 
                                              foreach($this->PesananModel->get_event($b->id)->result() as $e){
                                                $field.= $e->nama_event.',';
                                              }
                                              echo rtrim($field, ',');
                                              ?>
                                            </td>
                                            <td>Rp <?= number_format($b->expected_amount) ?></td>
                                            <td><a class='btn btn-info btn-sm' href='<?php echo base_url('admin/pesanan/detail_event/').$e->id ?>'><span class='fas fa-info-circle'></span></a></td>
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
                                            <th>Pemesan</th>
                                            <th>Event</th>
                                            <th>Tagihan</th>
                                            <th  width="5%">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($sudahbayar as $b): ?>
                                        <tr>
                                            <td  width="5%"><?= $b->id?></td>
                                            <td><?= $b->tgl_pesan ?> </td>
                                            <td><?= $b->pemesan ?></td>
                                            <td>
                                              <?php 
                                              $field=""; 
                                              foreach($this->PesananModel->get_event($b->id)->result() as $e){
                                                $field.= $e->nama_event.',';
                                              }
                                              echo rtrim($field, ',');
                                              ?>
                                            </td>
                                            <td>Rp <?= number_format($b->expected_amount) ?></td>
                                            <td><a class='btn btn-info btn-sm' href='<?php echo base_url('admin/pesanan/detail_event/').$e->id ?>'><span class='fas fa-info-circle'></span></a></td>
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