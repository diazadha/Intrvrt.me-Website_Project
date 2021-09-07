"use strict";

let editor; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function() {
    var save_method;
    $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "pageLength": 25,
        "ajax": { "url": base_url + "admin/merchandise/merchandise_", "type": "POST" },
        "columnDefs": [{
            "targets": [-1, -4],
            "orderable": false,
            "className": "text-center",
        }]
    })

    $('#table').on('click', '.edit', function() {
        save_method = 'update';
        $('#modal-default').modal('show');
        $('[name="id"]').val($(this).data('id'));
        $('[name="merchandise"]').val($(this).data('merchandise'));
        $('[name="kategori"]').val($(this).data('kategori'));
        $('[name="harga"]').val($(this).data('harga'));
        $('[name="diskon"]').val($(this).data('diskon'));
        $('[name="deskripsi"]').val($(this).data('deskripsi'));
        $('.btn-name').text('Update');
        $('.modal-title').text('Edit Merchandise');
    })

    $('#table').on('click ', '.delete ', function() {
        var id = $(this).data('id');
        var nama = $(this).data('merchandise');
        Swal.fire({
            title: 'Anda Yakin?',
            html: "Merchandise " + nama + " <br><br><b>Akan di Hapus!<b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#9AD268',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: base_url + "admin/merchandise/merchandise_delete/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        $('#table').DataTable().ajax.reload();
                        Swal.fire({
                            title: data.title,
                            html: nama + '<br>' + data.status,
                            icon: data.icon,
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            buttons: false,
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error');
                    }
                });
            }
        });
    });

    $('.add').click(function() {
        save_method = 'add';
        $('.btn-name').text('Simpan');
        $('.modal-title').text('Tambah Merchandise');
    })

    $.validator.setDefaults({
        submitHandler: function() {
            var url;
            if (save_method == 'add') {
                url = base_url + "admin/merchandise/merchandise_add";
            } else {
                url = base_url + "admin/merchandise/merchandise_update";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status == true) {
                        $('#table').DataTable().ajax.reload();
                        $('#modal-default').modal('hide');
                    } else {
                        alert('error!');
                    }
                }
            });
        }
    });
    
    $('#form').validate({
        rules: {
            merchandise: {
                required: true
            },
            kategori: {
                required: true
            },
            harga: {
                required: true
            },
            diskon: {
                required: true
            },
            deskripsi: {
                required: true
            }
        },
        messages: {
            merchandise: {
                required: "Masukkan nama marchandise"
            },
            kategori: {
                required: "Pilih kategori"
            },
            harga: {
                required: "Masukan harga"
            },
            diskon: {
                required: "Masukan diskon"
            },
            deskripsi: {
                required: "Masukan deskripsi"
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
})