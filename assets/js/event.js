"use strict";

let editor; // use a global for the submit and return data rendering in the examples

jQuery(document).ready(function () {
	$(".textarea").summernote({
		height: 350, //set editable area's height
	});
});

function preview_image(event) {
	document.getElementById("row-display").style.display = "block";
	var reader = new FileReader();
	reader.onload = function () {
		var output = document.getElementById("output_image");
		output.src = reader.result;
	};
	reader.readAsDataURL(event.target.files[0]);

	document.getElementById("row-display2").style.display = "block";
	var reader2 = new FileReader();
	reader2.onload = function () {
		var output = document.getElementById("output_image2");
		output.src = reader2.result;
	};
	reader2.readAsDataURL(event.target.files[1]);

	document.getElementById("row-display3").style.display = "block";
	var reader3 = new FileReader();
	reader3.onload = function () {
		var output = document.getElementById("output_image3");
		output.src = reader3.result;
	};
	reader3.readAsDataURL(event.target.files[2]);
}
