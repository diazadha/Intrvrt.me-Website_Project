"use strict";

let editor; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function() {
    $('.textarea').summernote({
        height: 350 //set editable area's height
    });
})

function preview_image(event) {
    document.getElementById("row-display").style.display = "block";
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}