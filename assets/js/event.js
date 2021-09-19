"use strict";

let editor; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function() {
    $('.textarea').summernote({
        height: 350 //set editable area's height
    });
})