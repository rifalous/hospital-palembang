var previewNode = document.querySelector(".template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var uploadPicture = new Dropzone('.drag-drop', { 
  url: SITE_URL + '/media/upload',
  thumbnailWidth: 400,
  thumbnailHeight: 400,
  parallelUploads: 1,
  maxFiles: 1,
  previewTemplate: previewTemplate,
  previewsContainer: ".preview",
  clickable: "#browse-file",
  acceptedFiles: '.jpg',
  params: { _token:  $('meta[name="csrf-token"]').attr('content')},

});

uploadPicture.on("addedfile", function(file) {

  if (file.type != 'image/jpeg'){
    show_notification('Kesalahan', 'error', 'Format tidak di dukung');
    uploadPicture.removeFile(file);
  }

  else if (file.size >= 1000000){
    show_notification('Kesalahan', 'error', 'Berkas terlalu besar');
    uploadPicture.removeFile(file);
  }
  else{
    $('.drag-drop').hide();
    //on_upload();
    console.log(file);
  }

});

uploadPicture.on("removedfile", function(file) {
  const name = $('[name="new_pic"]').val();
  if (name != '') {
    on_remove(name);
  }
  $('.drag-drop').show();
  $('.drag-drop').css('border', '3px dashed #e1e1e1');
});

uploadPicture.on('maxfilesexceeded', function(file){
    uploadPicture.removeAllFiles();
    uploadPicture.addFile(file);
});

uploadPicture.on('success', function(file, response) {
  $('[name="new_pic"]').val(response);
  $('.progress-wrapper').hide();
});

uploadPicture.on('error', function(xhr, status, error) {
    if (error != undefined) {
      show_notification('Error', 'error', error.statusText);
      uploadPicture.removeAllFiles();
    }
});

// uploadPicture.on('sending', function(file, xhr, formData) {
//   if ($('[name="old_pic"]').val() != '') {
//     formData.append('old_pic', $('[name="old_pic"]').val());
//   }
//   // formData.append('old_pic', $('[name="old_pic"]').val());
// });

$('.drag-drop').on('dragover', function(){
    $(this).css('border', '3px dashed #5b90bf');
});

$('.drag-drop').on('dragleave', function(){
    $(this).css('border', '3px dashed #e1e1e1');
});

function on_remove(filename) {
  var res = $.ajax({
    url: SITE_URL + '/media/remove/'+filename,
    type: 'get',
    dataType: 'json',
    async: false
  });

  return res.responseJSON;

}

$(window).on("beforeunload", function() {
    return "Are you sure? You didn't finish the form!";
});

$(document).ready(function() {

    $("#form-participant").on("submit", function(e) {
          $(window).off("beforeunload");
          return true;
      });

    $(window).unload(function(e){
      // if ($('[name="old_pic"]').val() != '') {
      //   remove = on_remove($('[name="old_pic"]').val());
      //   console.log(remove);
      // }
      // console.log(form);
    });
    
});

$('#remove-picture').click(function(){
  $('.drag-drop').show();
  $('.preview-edit').hide();
});