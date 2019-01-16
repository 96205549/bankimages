/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="fa fa-tag"></i>' +
    '</button>'; 
$("#avatar-2").fileinput({
    overwriteInitial: true,
    maxFileSize: 100000,
    showClose: false,
    showCaption: false,
    showBrowse: false,
    browseOnZoneClick: true,
    removeLabel: '',
    removeIcon: '<i class="fa fa-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src=".../../../public/adm/images/avatar_img.png" alt="Your Avatar"><h6 class="text-muted">Click to select</h6>',
    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});