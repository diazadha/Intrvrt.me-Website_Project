"use strict";

jQuery(document).ready(function() {
    $('.textarea').summernote({
        height: 400,
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            },
            onMediaDelete: function(target) {
                deleteImage(target[0].src);
            }
        }
    });
});

function preview_image(event) {
    document.getElementById("row-display").style.display = "block";
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function uploadImage(image) {
    alert(image);
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        url: base_url + "admin/blog/upload_image",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('.textarea').summernote("insertImage", url);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deleteImage(src) {
    $.ajax({
        data: { src: src },
        type: "POST",
        url: base_url + "admin/blog/delete_image",
        cache: false,
        success: function(response) {
            console.log(response);
        }
    });
}