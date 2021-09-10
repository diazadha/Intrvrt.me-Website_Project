<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kategori Tiket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">HOME</a></li>
                        <li class="breadcrumb-item active">MERCHANDISE</li>
                        <li class="breadcrumb-item active">KATEGORI</li>
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
                                Kategori Tiket
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="add btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" onclick="tambah()">
                                    Tambah Kategori
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th width="10%">Status</th>
                                        <th width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tiket_kategori as $t) : ?>
                                        <tr>
                                            <td> <?= $t['nama_kategori']; ?> </td>
                                            <?php if ($t['status'] == 1) : ?>
                                                <td style="text-align: center;"><span class="badge badge-success">On</span></td>
                                            <?php else : ?>
                                                <td style="text-align: center;"><span class="badge badge-danger">Off</span></td>
                                            <?php endif; ?>
                                            <td>
                                                <center>
                                                    <button type="button" onclick="edit(<?= $t['id_kategori']; ?>)" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" style="color: white;">Edit</button>
                                                    <button type="button" onclick="hapus('<?= $t['id_kategori'] ?>', '<?= $t['nama_kategori']; ?>')" class="ml-1 btn btn-danger btn-sm" style=" color: white;">Hapus</button>
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="header">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/Event/tambah_kategori'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori">Nama Kategori</label>
                        <input type="hidden" class="form-control" id="id_kategori" name="id_kategori">
                        <input type="text" class="form-control" id="kategori" name="nama_kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option></option>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-name" id="tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function edit(id_kategori) {
        console.log(id_kategori);
        $('#header').html('Edit Kategori');
        $('#tambah').html('Ubah');
        $('.modal-content form').attr('action', '<?= base_url('admin/Event/') ?>update_kategori');

        $.ajax({
            url: '<?= base_url('admin/Event/') ?>getubah',
            data: {
                id_kategori: id_kategori
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#kategori').val(data.nama_kategori);
                $('#status').val(data.status);
                $('#id_kategori').val(data.id_kategori);
            }
        })
    }

    function tambah() {
        $('#header').html('Tambah Kategori');
        $('#tambah').html('Simpan');
        $('.modal-content form').attr('action', '<?= base_url('admin/Event/') ?>tambah_kategori');
        $('#kategori').val('');
        $('#status').val('');
    }

    function hapus(id_kategori, nama_kategori) {
        console.log(id_kategori);
        console.log(nama_kategori);
        Swal.fire({
            title: 'Anda Yakin?',
            html: "Kategori " + nama_kategori + " <br><br><b>Akan di Hapus!<b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#9AD268',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: '<?= base_url('admin/Event/') ?>delete_kategori',
                    data: {
                        id_kategori: id_kategori
                    },
                    method: 'post',
                    dataType: "JSON",
                    success: function(data) {
                        // $('#example1').DataTable().ajax.reload();
                        Swal.fire({
                            title: data.title,
                            html: nama_kategori + '<br>' + data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                        setTimeout(function() {
                            window.location.href = "<?= base_url('admin/Event/kategori'); ?>";
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