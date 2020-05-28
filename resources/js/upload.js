/*
Upload Image
Author: huynhtuvinh87@gmail.com
*/

var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
$("body").on("change", "#upload-image", function() {
    var uploadImage = document.getElementById("upload-image");

    //check and retuns the length of uploded file.
    if (uploadImage.files.length === 0) {
        return;
    }
    //Is Used for validate a valid file.
    var uploadFile = document.getElementById("upload-image").files[0];
    if (!filterType.test(uploadFile.type)) {
        alert("Please select a valid image.");
        return;
    }
    var fileReader = new FileReader();

    fileReader.onload = function(event, p) {
        var image = new Image();
        image.onload = function() {
            var canvas = document.createElement("canvas");
            var context = canvas.getContext("2d");
            canvas.width = 200;
            canvas.height = 200;
            context.drawImage(
                image,
                0,
                0,
                image.width,
                image.height,
                0,
                0,
                canvas.width,
                canvas.height
            );
            $(".image-pev").html(
                '<img class="img-rounded" src="' + canvas.toDataURL() + '"/>'
            );
        };
        image.src = event.target.result;
    };

    fileReader.readAsDataURL(uploadFile);
    var formData = new FormData();
    formData.append("file", uploadFile);
    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

    $.ajax({
        url: "/admin/ajax/upload",
        type: "POST",
        data: formData,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        success: function(data) {
            $(".image-pev").append(
                '<input type="hidden" name="image" value="' + data.result + '">'
            );
            localStorage.setItem("article_image", data.result);
        }
    });
});
$(document).ready(function() {
    var options = {
        filebrowserImageBrowseUrl: "/laravel-filemanager?type=Images",
        filebrowserImageUploadUrl: "/laravel-filemanager/upload?type=Images&_token=",
        filebrowserBrowseUrl: "/laravel-filemanager?type=Files",
        filebrowserUploadUrl: "/laravel-filemanager/upload?type=Files&_token="
    };
    CKEDITOR.replace("my-editor", options);


});

$("body").on("click", ".change-upload", function() {
    var options = {
        filebrowserImageBrowseUrl: "/laravel-filemanager?type=Images",
        filebrowserImageUploadUrl: "/laravel-filemanager/upload?type=Images&_token=",
        filebrowserBrowseUrl: "/laravel-filemanager?type=Files",
        filebrowserUploadUrl: "/laravel-filemanager/upload?type=Files&_token="
    };

    var route_prefix = "/laravel-filemanager";
    localStorage.setItem("target_input", $(this).data("input"));
    localStorage.setItem("target_preview", $(this).data("preview"));
    window.open(
        route_prefix + "?type=Images",
        "FileManager",
        "width=1200,height=800"
    );
    window.SetUrl = function(url, file_path) {
        var array = url.split("/");
        var file_name = array[parseInt(array.length) - 1];
        var data = array[0] + "/";
        for (i = 1; i < parseInt(array.length) - 1; i++) {
            data = data + array[i] + "/";
        }
        data = data + "thumbs/" + file_name;
        var target_preview = $(
            ".upload-" + localStorage.getItem("target_preview") + " img"
        );
        target_preview.attr("src", data).trigger("change");
        if (localStorage.getItem("target_preview") === "thumb") {
            $(
                ".upload-" +
                localStorage.getItem("target_preview") +
                " span.image"
            ).html('<input type="hidden" name="image" value="' + data + '">');
        } else {
            $(
                ".upload-" +
                localStorage.getItem("target_preview") +
                " span.image"
            ).html(
                '<input type="hidden" name="images[]" value="' + data + '">'
            );
        }

        $(
            ".upload-" +
            localStorage.getItem("target_preview") +
            " span.delete"
        ).html(
            '<a class="delete-image btn btn-danger btn-sm" data-id="' +
            localStorage.getItem("target_preview") +
            '">Delete</a>'
        );
    };
    return false;
});

$("body").on("click", ".delete-image", function() {
    var id = $(this).data("id");
    $(".upload-" + id + " .select-image img").attr(
        "src",
        "/images/image_default.png"
    );
    $(".upload-" + id + " input").remove();
    $(".upload-" + id + " .delete-image").remove();
});