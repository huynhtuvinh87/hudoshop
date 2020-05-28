/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/upload.js":
/*!********************************!*\
  !*** ./resources/js/upload.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Upload Image
Author: huynhtuvinh87@gmail.com
*/
var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
$("body").on("change", "#upload-image", function () {
  var uploadImage = document.getElementById("upload-image"); //check and retuns the length of uploded file.

  if (uploadImage.files.length === 0) {
    return;
  } //Is Used for validate a valid file.


  var uploadFile = document.getElementById("upload-image").files[0];

  if (!filterType.test(uploadFile.type)) {
    alert("Please select a valid image.");
    return;
  }

  var fileReader = new FileReader();

  fileReader.onload = function (event, p) {
    var image = new Image();

    image.onload = function () {
      var canvas = document.createElement("canvas");
      var context = canvas.getContext("2d");
      canvas.width = 200;
      canvas.height = 200;
      context.drawImage(image, 0, 0, image.width, image.height, 0, 0, canvas.width, canvas.height);
      $(".image-pev").html('<img class="img-rounded" src="' + canvas.toDataURL() + '"/>');
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
    processData: false,
    // tell jQuery not to process the data
    contentType: false,
    // tell jQuery not to set contentType
    success: function success(data) {
      $(".image-pev").append('<input type="hidden" name="image" value="' + data.result + '">');
      localStorage.setItem("article_image", data.result);
    }
  });
});
$(document).ready(function () {
  var options = {
    filebrowserImageBrowseUrl: "/laravel-filemanager?type=Images",
    filebrowserImageUploadUrl: "/laravel-filemanager/upload?type=Images&_token=",
    filebrowserBrowseUrl: "/laravel-filemanager?type=Files",
    filebrowserUploadUrl: "/laravel-filemanager/upload?type=Files&_token="
  };
  CKEDITOR.replace("my-editor", options);
});
$("body").on("click", ".change-upload", function () {
  var options = {
    filebrowserImageBrowseUrl: "/laravel-filemanager?type=Images",
    filebrowserImageUploadUrl: "/laravel-filemanager/upload?type=Images&_token=",
    filebrowserBrowseUrl: "/laravel-filemanager?type=Files",
    filebrowserUploadUrl: "/laravel-filemanager/upload?type=Files&_token="
  };
  var route_prefix = "/laravel-filemanager";
  localStorage.setItem("target_input", $(this).data("input"));
  localStorage.setItem("target_preview", $(this).data("preview"));
  window.open(route_prefix + "?type=Images", "FileManager", "width=1200,height=800");

  window.SetUrl = function (url, file_path) {
    var array = url.split("/");
    var file_name = array[parseInt(array.length) - 1];
    var data = array[0] + "/";

    for (i = 1; i < parseInt(array.length) - 1; i++) {
      data = data + array[i] + "/";
    }

    data = data + "thumbs/" + file_name;
    var target_preview = $(".upload-" + localStorage.getItem("target_preview") + " img");
    target_preview.attr("src", data).trigger("change");

    if (localStorage.getItem("target_preview") === "thumb") {
      $(".upload-" + localStorage.getItem("target_preview") + " span.image").html('<input type="hidden" name="image" value="' + data + '">');
    } else {
      $(".upload-" + localStorage.getItem("target_preview") + " span.image").html('<input type="hidden" name="images[]" value="' + data + '">');
    }

    $(".upload-" + localStorage.getItem("target_preview") + " span.delete").html('<a class="delete-image btn btn-danger btn-sm" data-id="' + localStorage.getItem("target_preview") + '">Delete</a>');
  };

  return false;
});
$("body").on("click", ".delete-image", function () {
  var id = $(this).data("id");
  $(".upload-" + id + " .select-image img").attr("src", "/images/image_default.png");
  $(".upload-" + id + " input").remove();
  $(".upload-" + id + " .delete-image").remove();
});

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/upload.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/projects/hudoshop/resources/js/upload.js */"./resources/js/upload.js");


/***/ })

/******/ });