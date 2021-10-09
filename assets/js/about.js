"use strict";

let editor; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function() {

    $.validator.setDefaults({
        submitHandler: function() {
            var url;
            url = base_url + "about/send";
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData(document.getElementById("commentForm")),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        html: 'Terimakasih, Pesan anda berhasil terkirim.',
                        icon: 'success',
                        timer: 5000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        buttons: false,
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error sending email');
                }
            });
        }
    });

    $("#form").validate({
        validClass: "success",
        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            phone: {
                required: true
            },
            comment: {
                required: true
            },
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
});