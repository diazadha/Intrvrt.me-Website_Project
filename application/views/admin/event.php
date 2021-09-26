<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Event</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard') ?>">HOME</a></li>
                        <li class="breadcrumb-item active">Event</li>
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
                                Event
                            </h3>
                            <div class="card-tools">
                                <a class="btn btn-primary btn-sm" href="<?=base_url('admin/Event/tambah')?>">Tambah Event</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Kategori</th>
                                        <th width="15%">Harga Tiket</th>
                                        <th width="15%">Tanggal Aktif</th>
                                        <th width="15%">Tanggal Berakhir</th>
                                        <th width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tiket as $t) : ?>
                                        <tr>
                                            <td> <?= $t['nama_event']; ?> </td>
                                            <td> <?= $t['nama_kategori']; ?> </td>
                                            <td> Rp <?=number_format($t['harga_tiket'], 0,',','.'); ?> </td>
                                            <td> <?= $t['tgl_aktif']; ?> </td>
                                            <td> <?= $t['tgl_berakhir']; ?> </td>
                                            <td>
                                                <center>
                                                    <a class="btn btn-info btn-sm" href="<?=base_url("admin/Event/edit/").$t['id_event']; ?>">Edit</a>
                                                    <button type="button" onclick="hapus('<?= $t['id_event'] ?>', '<?= $t['nama_event']; ?>')" class="ml-1 btn btn-danger btn-sm" style=" color: white;">Hapus</button>
                                                </center>
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
    </section>
</div>
<script>
    function edit(id_event) {
        console.log(id_event);
        $('#header').html('Edit Event');
        $('#tambah').html('Ubah');
        $('.modal-content form').attr('action', '<?= base_url('admin/Event/') ?>update_kategori');

        $.ajax({
            url: '<?= base_url('admin/Event/') ?>getubah',
            data: {
                id_event: id_event
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#kategori').val(data.nama_event);
                $('#status').val(data.status);
                $('#id_event').val(data.id_event);
            }
        })
    }

    function hapus(id_event, nama_event) {
        console.log(id_event);
        console.log(nama_event);
        Swal.fire({
            title: 'Anda Yakin?',
            html: "Kategori " + nama_event + " <br><br><b>Akan di Hapus!<b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#9AD268',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: '<?= base_url('admin/Event/') ?>delete_event',
                    data: {
                        id_event: id_event
                    },
                    method: 'post',
                    dataType: "JSON",
                    success: function(data) {
                        // $('#example1').DataTable().ajax.reload();
                        Swal.fire({
                            title: data.title,
                            html: nama_event + '<br>' + data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                        setTimeout(function() {
                            window.location.href = "<?= base_url('admin/Event'); ?>";
                        }, 3000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error');
                    }
                });
            }
        });
    }
</script>