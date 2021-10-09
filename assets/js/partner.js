"use strict";

let editor; // use a global for the submit and return data rendering in the examples

function preview_image(event) {
    document.getElementById("row-display").style.display = "block";
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

jQuery(document).ready(function() {
    var save_method;
    $("#table").dataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "pageLength": 25,
        "ajax": { "url": base_url + "admin/partner/partner_", "type": "POST" },
        "columnDefs": [{
            "targets": [-1, -2],
            "orderable": false,
            "className": "text-center",
        }]
    });

    $(document).on('click', '.add', function() {
        save_method = 'add';
        document.getElementById("row-display").style.display = "none";
        $('#form')[0].reset();
        $('#modal-default').modal('show');
        $('.modal-title').text('Tambah Partner');
    });

    $(document).on('click', '.edit', function() {
        save_method = 'update';
        $('#form')[0].reset();
        document.getElementById("row-display").style.display = "block";
        document.getElementById("output_image").src = $(this).data('foto');
        $('#modal-default').modal('show');
        $('.update').text('Update');
        $('.modal-title').text('Update Data partner');
        $('[name="id"]').val($(this).data('id'));
        $('[name="nama"]').val($(this).data('nama'));
        $('[name="foto_"]').val($(this).data('foto'));
        $('[name="status"]').val($(this).data('status'));
    });


    $.validator.setDefaults({
        submitHandler: function() {
            var url;
            if (save_method == 'add') {
                url = base_url + "admin/partner/create_partner";
            } else {
                url = base_url + "admin/partner/update_partner";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData(document.getElementById("form")),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#table').DataTable().ajax.reload();
                    $('#modal-default').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        }
    });

    $("#form").validate({
        validClass: "success",
        rules: {
            nama: {
                required: true
            },
            status: {
                required: true
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

    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        var judul = $(this).data('nama');
        Swal.fire({
            title: 'Anda Yakin?',
            html: "Kategori " + judul + " <br><br><b>Akan di Hapus!<b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#9AD268',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: base_url + "admin/partner/delete_partner/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        $('#table').DataTable().ajax.reload();
                        Swal.fire({
                            title: data.title,
                            html: judul + '<br>' + data.status,
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
});