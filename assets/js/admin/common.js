switch(window.location.origin){
    case 'http://dulich.vn':
        var HOSTNAME = 'http://dulich.vn/';
        break;
    default:
        var HOSTNAME = 'http://localhost/dulich/';
}

function goBack() {
  window.history.back()
}

$('.delete-checkbox input[type="checkbox"]').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue'
});

//Enable check and uncheck all functionality
$(".checkbox-toggle").click(function () {
    var clicks = $(this).data('clicks');
    if (clicks) {
        //Uncheck all checkboxes
        $(".delete-checkbox input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
    } else {
        //Check all checkboxes
        $(".delete-checkbox input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
    }
    $(this).data("clicks", !clicks);
});

//delete all
$('.btn-delete-all').click(function(){
    url = $(this).data('url');
    var ids = [];
    $('.is-delete-all').each(function(){
        if( $(this).is(':checked') ){
            ids.push($(this).val())
        }
    });
    if ( ids.length > 0 ) {
        if(confirm('Chắc chắn xóa các mục đã chọn?')){
        $.ajax({
            method: "get",
            url: url,
            data: {
                ids : ids
            },
            success: function(response){
                if ( response.status == 200 && response.isExisted == true ) {
                    $.each(ids, function(index, id){
                        $( '.remove-' + id ).fadeOut();
                    })
                    
                }
            },
            error: function(jqXHR, exception){
                if(jqXHR.status == 404 && jqXHR.responseJSON.message != 'undefined'){
                    alert(jqXHR.responseJSON.message);
                    location.reload();
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
    }
});

function to_slug(str,space="-"){
    str = str.toLowerCase();

    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');

    str = str.replace(/([^0-9a-z-\s])/g, '');

    str = str.replace(/(\s+)/g, space);

    str = str.replace(/^-+/g, '');

    str = str.replace(/-+$/g, '');

    // return
    return str;
}

$(document).ready(function(){
    "use strict";

    tinymce.init({
        selector: ".tinymce-area",
        theme: "modern",
        block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3',
        height: 300,
        relative_urls: false,
        remove_script_host: false,
        forced_root_block : false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: "Bold text", inline: "b"},
            {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
            {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
            {title: "Example 1", inline: "span", classes: "example1"},
            {title: "Example 2", inline: "span", classes: "example2"},
            {title: "Table styles"},
            {title: "Table row 1", selector: "tr", classes: "tablerow1"}
        ],
        external_filemanager_path: HOSTNAME + "filemanager/",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": HOSTNAME + "filemanager/plugin.min.js"}
    });

    $('#title_vi').change(function(){
        $('#slug').val(to_slug($('#title_vi').val()));
    });
});

//old code
function errorHandle(jqXHR, exception){
    if (jqXHR.status === 0) {
        return ('Not connected.\nPlease verify your network connection.');
    } else if (jqXHR.status == 404) {
        return ('The requested page not found.');
    }  else if (jqXHR.status == 401) {
        return ('Sorry!! You session has expired. Please login to continue access.');
    } else if (jqXHR.status == 500) {
        return ('Internal Server Error.');
    } else if (exception === 'parsererror') {
        return ('Requested JSON parse failed.');
    } else if (exception === 'timeout') {
        return ('Time out error.');
    } else if (exception === 'abort') {
        return ('Ajax request aborted.');
    }
    return ('Unknown error occurred. Please try again.');
}
function remove(controller, id){
    var url = HOSTNAMEADMIN + '/' + controller + '/remove';
    if(confirm('Chắc chắn xóa?')){
        $.ajax({
            method: "post",
            url: url,
            data: {
                id : id, csrf_sitecom_token : document.getElementById('csrf').value
            },
            success: function(response){
                document.getElementById('csrf').value = response.reponse.csrf_hash;
                if(response.status == 200 && response.isExisted == true){
                    console.log(response);
                    console.log(response.message);
                    if(response.message != 'undefined'){
                        alert(response.message);
                    }
                    $('.remove_' + id).fadeOut();
                }
                if(response.status == 200 && response.isExisted == false){
                    alert('Danh mục này có chứa bài viết. Vui lòng xóa bài viết trước sau đó thực hiện lại thao tác');
                }
            },
            error: function(jqXHR, exception){
                if(jqXHR.status == 404 && jqXHR.responseJSON.message != 'undefined'){
                    alert(jqXHR.responseJSON.message);
                    location.reload();
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
}
function active(controller, id, question) {
    var url = HOSTNAMEADMIN + '/' + controller + '/active';
    if(confirm(question)){
        $.ajax({
            method: "post",
            url: url,
            data: {
                id : id, csrf_sitecom_token : document.getElementById('csrf').value
            },
            success: function(response){
                document.getElementById('csrf').value = response.reponse.csrf_hash;
                if(response.status == 200){
                    switch(controller){
                        case 'post_category' :
                            alert('Bật danh mục thành công');
                            break;
                        case 'product' :
                            alert('Bật thực đơn thành công');
                            break;
                        case 'post' :
                            alert('Bật bài viết thành công');
                            break;
                        case 'product_category' :
                            alert('Bật danh mục thành công');
                            break;
                    }
                    location.reload();
                }
                console.log(response);
            },
            error: function(jqXHR, exception){
                if(jqXHR.status == 404 &&  jqXHR.responseJSON.message != 'undefined '){
                    alert(jqXHR.responseJSON.message);
                    location.reload();
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
}

function deactive(controller, id, question) {
    var url = HOSTNAMEADMIN + '/' + controller + '/deactive';
    if(confirm(question)){
        $.ajax({
            method: "post",
            url: url,
            data: {
                id : id, csrf_sitecom_token : document.getElementById('csrf').value
            },
            success: function(response){
                document.getElementById('csrf').value = response.reponse.csrf_hash;
                if(response.status == 200){
                    if(controller == 'post' || controller == 'product'){
                        if(response.reponse.id != undefined){
                            if(confirm(response.message)){
                                location.href = HOSTNAMEADMIN + '/menu/edit/' + response.reponse.id;
                            }
                        }else{
                            alert(response.message);
                            location.reload();
                        }
                    }else{
                        if(response.reponse.id != undefined){
                            if(confirm(response.message)){
                                location.href = HOSTNAMEADMIN + '/menu/edit/' + response.reponse.id;
                            }
                        }else{
                            alert('Tắt bài viết thành công');
                            location.reload();
                        }
                    }
                }
            },
            error: function(jqXHR, exception){
                if(jqXHR.responseJSON.message != 'undefined'){
                    alert(jqXHR.responseJSON.message);
                    location.reload();
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
}

$(function () {
    $('#reservation').mouseup(function() {
        $('#reservation').daterangepicker({
           format: 'DD/MM/YYYY',
        });
        $(".ranges").css("display","none");
        $(".calendar").mouseover(function(){
           $("#reservation").val($("input[name=daterangepicker_start]").val()+" - "+$("input[name=daterangepicker_end]").val());
           $(".second.right tbody .available").mousedown(function(){
               $(".daterangepicker.dropdown-menu.show-calendar.opensleft").css("display","none");
           });
        });
    });
});