<div class="main-wrap">
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
        <button class="off-canvas-close"><i class="ti-close"></i></button>
    </aside>
    <main class="position-relative">
        <div class="cart-page">
            <div class="container">
                <div class="text-center">
                    <h3>Keranjang Event</h3>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-8 col-md-8 mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Kamu punya <?= count($keranjang_event) ?> item event</span>
                        </div>
                        <?php $no = 1;
                        $grand_total = 0;
                        foreach ($keranjang_event as $e) : ?>
                            <?php if ($e['stock'] == 0) {
                                redirect('home/hapus_keranjang_event/' . $e['id']);
                            } ?>
                            <div class="bg-white border align-items-center items mt-3 p-2 rounded">
                                <div class="row align-items-center">
                                    <div class="col-md-2 col-3 text-center mb-2">
                                        <?php if ($e['status'] == 1) : ?>
                                            <input type="checkbox" checked onclick="uncheck_status_event(<?= $e['id']; ?>)">
                                            <?php $diskon = $e['harga_tiket'] * ($e['diskon'] / 100);
                                            $harga_diskon = $e['harga_tiket'] - $diskon;
                                            $total_harga =  $harga_diskon * $e['qty'];
                                            $total_harga_row =  $harga_diskon * $e['qty'];
                                            ?>
                                        <?php else : ?>
                                            <input type="checkbox" onclick="check_status_event(<?= $e['id']; ?>)">
                                            <?php $diskon = $e['harga_tiket'] * ($e['diskon'] / 100);
                                            $harga_diskon = $e['harga_tiket'] - $diskon;
                                            $total_harga_row = $harga_diskon * $e['qty'];
                                            $total_harga = 0; ?>
                                        <?php endif; ?>
                                            <input type="hidden" id="harga_<?= $e['id']; ?>" value="<?= $harga_diskon ?>">
                                            <input type="hidden" id="status_<?= $e['id']; ?>" value="<?= $e['status'] ?>">
                                            <img class="ml-1 rounded" src="<?= base_url('assets/uploads/foto_event/') . $e['foto']; ?>" width="60">
                                    </div>
                                    <div class="col-md-4 col-9 mb-2">
                                        <a href="<?= base_url('home/event_detail/' . $e['id_event']) ?>" class="font-weight-bold d-block">
                                            <?= substr($e['nama_event'], 0, 28); ?>
                                        </a><span class="spec">Rp. <?= number_format($harga_diskon, 0, ',', '.') ?></span>
                                    </div>
                                    <div class="col-md-3 col-4 text-center mb-2">
                                        <center>
                                            <button class="btn-sm" onclick="kurang_qty(<?= $e['id']; ?>)" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-minus"></i></button>
                                            <input class="text-center" type="text" readonly id="qty_<?= $e['id']; ?>" value="<?= $e['qty']; ?>" min="1" style="width: 20%;  border: 1px solid #FF656A; border-radius: 5px">
                                            <button class="btn-sm" onclick="tambah_qty(<?= $e['id']; ?>)" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-plus"></i></button>
                                        </center>
                                    </div>
                                    <div class="col-md-2 col-4 font-weight-bold text-right mb-2" id="total_harga_<?= $e['id']; ?>">Rp. <?= number_format($total_harga_row, 0, ',', '.') ?></div>
                                    <div class="col-md-1 col-4 text-center mb-2">
                                        <a href="<?= base_url('home/hapus_keranjang_event/') . $e['id']; ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php $grand_total = $grand_total + $total_harga;
                        endforeach; ?>
                        <?php if (empty($keranjang_event)) : ?>
                            <div class="card">
                                <div class="card-body">
                                    Keranjang belanjaan kamu masih kosong nih, Yuk cari event menarik di <a href="<?= base_url('home/event') ?>"><u>sini</u></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 col-md-4 mb-3">
                        <div class="card bg-white">
                            <div class="card-body">
                                <div class="card-text">
                                    <h4><small class="font-weight-bold">Ringkasan Pesanan:</small></h4>
                                </div>
                                <div class="card-text d-flex">
                                    <label class="mr-auto">Total Biaya :</label>
                                    <label><span id="grand_total">Rp. <?= number_format($grand_total, 0, ',', '.'); ?> </span></label>
                                    <input type="hidden" id="grand" name="grand" value="<?= $grand_total ?>">
                                </div>
                            </div>
                            <?php if (!empty($keranjang_event)) : ?>
                                <?php if (count($keranjang_event) != $nullcheck) : ?>
                                    <div class="card-footer">
                                        <center>
                                            <div class="cart-btn">
                                                <a href="<?= base_url('checkout/event') ?>" class="btn btn-sm btn-warning">Checkout</a>
                                            </div>
                                        </center>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($nullcheck == count($keranjang_event)) : ?>
                                <div class="card-footer">
                                    <div class="alert alert-danger">Pilih item event dengan memberi centang.</div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    function uncheck_status_event(id) {
        $.ajax({
            url: '<?= base_url('home/uncheck_status_event'); ?>',
            data: {
                id: id,
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                location.reload();
            }
        });
    }

    function check_status_event(id) {
        $.ajax({
            url: '<?= base_url('home/check_status_event'); ?>',
            data: {
                id: id,
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                location.reload();
            }
        });
    }

    function tambah_qty(id_keranjang) {
        if ($('#status_' + id_keranjang).val() == 0) {
            let qty = $('#qty_' + id_keranjang).val();
            let qty_new = parseInt(qty) + 1;
            $('#qty_' + id_keranjang).val(qty_new);

            $.ajax({
                url: '<?= base_url('home/updatekeranjang_event'); ?>',
                data: {
                    id_keranjang: id_keranjang,
                    qty: qty_new
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let harga_before = $('#harga_' + id_keranjang).val();
                    let new_harga = parseInt(harga_before) * data.qty;
                    $('#total_harga_' + id_keranjang).html('Rp. ' + new_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                }
            });
        } else {
            let qty = $('#qty_' + id_keranjang).val();
            let qty_new = parseInt(qty) + 1;
            $('#qty_' + id_keranjang).val(qty_new);

            $.ajax({
                url: '<?= base_url('home/updatekeranjang_event'); ?>',
                data: {
                    id_keranjang: id_keranjang,
                    qty: qty_new
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let harga_before = $('#harga_' + id_keranjang).val();
                    let new_harga = parseInt(harga_before) * data.qty;
                    $('#total_harga_' + id_keranjang).html('Rp. ' + new_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

                    let grand_total_before = $('#grand').val();
                    let new_grand = parseInt(grand_total_before) + parseInt($('#harga_' + id_keranjang).val());

                    $('#grand_total').html('Rp. ' + new_grand.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $('#grand').val(new_grand);
                }
            });
        }

    }

    function kurang_qty(id_keranjang) {
        if ($('#qty_' + id_keranjang).val() - 1 < 1) {
            alert('Minimal quantity yang dapat dibeli adalah 1');
        } else if ($('#status_' + id_keranjang).val() == 0) {
            let qty = $('#qty_' + id_keranjang).val();
            let qty_new = parseInt(qty) - 1;
            $('#qty_' + id_keranjang).val(qty_new);

            $.ajax({
                url: '<?= base_url('home/updatekeranjang_event'); ?>',
                data: {
                    id_keranjang: id_keranjang,
                    qty: qty_new
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let harga_before = $('#harga_' + id_keranjang).val();
                    let new_harga = parseInt(harga_before) * data.qty;
                    $('#total_harga_' + id_keranjang).html('Rp. ' + new_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                }
            });
        } else {
            let qty = $('#qty_' + id_keranjang).val();
            let qty_new = parseInt(qty) - 1;
            $('#qty_' + id_keranjang).val(qty_new);

            $.ajax({
                url: '<?= base_url('home/updatekeranjang_event'); ?>',
                data: {
                    id_keranjang: id_keranjang,
                    qty: qty_new
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let harga_before = $('#harga_' + id_keranjang).val();
                    let new_harga = parseInt(harga_before) * data.qty;
                    $('#total_harga_' + id_keranjang).html('Rp. ' + new_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

                    let grand_total_before = $('#grand').val();
                    let new_grand = parseInt(grand_total_before) - parseInt($('#harga_' + id_keranjang).val());

                    $('#grand_total').html('Rp. ' + new_grand.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $('#grand').val(new_grand);
                }
            });
        }

    }
</script>