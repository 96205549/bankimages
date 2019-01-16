$(function () {

    // preventing page from redirecting
    $("html").on("dragover", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $("h1").text("Drag here");
    });

    $("html").on("drop", function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Drag enter
    $('.upload-area').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Drop");
    });

    // Drag over
    $('.upload-area').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Drop");
    });

    // Drop
    $('.upload-area').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();

        $("h1").text("Upload");

        var file = e.originalEvent.dataTransfer.files;
        var fd = new FormData();

        fd.append('file', file[0]);

        uploadData(fd);
    });

    // Open file selector on div click
    $("#uploadfile").click(function () {
        $("#file").click();
    });

    // file selected
    $("#file").change(function () {
        var fd = new FormData();

        var files = $('#file')[0].files[0];

        fd.append('file', files);
//       alert(fd);
        uploadData(fd);
    });
});

// Sending AJAX request and upload file
function uploadData(formdata) {

    /*$.ajax({
     url: 'http://localhost/afriqueStokn/contributor/postimage',
     //        url: 'upload.php',
     type: 'post',
     data: formdata,
     contentType: false,
     processData: false,
     dataType: 'json',
     success: function(response){
     alert(response);
     addThumbnail(response);
     }
     });*/
    $.ajax({
        url: 'http://localhost/afriqueStokn/contributor/postimage',
//        url: 'upload.php',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json'
    }).done(function (response) {
//        alert(response);
        addThumbnail(response);
    }).always(function (resultat, status) {
        console.log(resultat);
        console.log(status);
//        alert("completed");
    })
            ;

}

// Added thumbnail
function addThumbnail(data) {
    $("#uploadfile h2").remove();
//    $("#uploadfile").empty();
    
    var len = $("#uploadfile div.thumbnail").length;

    var num = Number(len);
    num = num + 1;
//     alert("yes");
    var name = data.name;
    var size = convertSize(data.size);
    var src = data.src;
//    alert(src);

    // Creating an thumbnail
    $("#uploadfile").append('<div id="thumbnail_' + num + '" class="thumbnail"></div>');
    $("#thumbnail_" + num).append('<img src="' + src + '" width="100%" height="78%">');
    $("#thumbnail_" + num).append('<span class="size">' + size + '<span>');

}

// Bytes conversion
function convertSize(size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0)
        return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}


// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
//  alert(this.src);
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
