switch(window.location.origin){
    case 'http://vietnamtravellog.matocreative.vn':
        var HOSTNAMEADMIN = 'http://vietnamtravellog.matocreative.vn/admin';
        break;
    default:
        var HOSTNAMEADMIN = 'http://localhost/ci/admin';
        
}
function logout() {
    if (confirm("Bạn muốn đăng xuất")) {
        window.location.href = HOSTNAMEADMIN + '/auth/logout';
    }
    
}

$('.btn-remove').click(function(event){
    event.preventDefault();
    var id = $(this).data('id');
    var url = $(this).data('url');
    var name = $(this).data('name');
    if (confirm(`Chắc chắn xóa ${name}?`)) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id
            },
            success: function(response){
                if ( response.status == 200 && response.isExisted == true ) {
                    $( '.remove-' + id ).fadeOut();
                }
                if ( response.status == 200 && response.isExisted == false ) {
                    alert(response.message);
                }
            },
            error: function(jqXHR, exception){
                if((jqXHR.status == 404 || jqXHR.status == 400) && jqXHR.responseJSON.message != 'undefined'){
                    alert(jqXHR.responseJSON.message);
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
    
});

var default_value = '';

$('#region_id').change(function(){
    var region_id = $(this).val();
    default_value = $(this).val();
    var url = $(this).data('url');
    if (default_value != '') {
        $.ajax({
            method: "get",
            url: url,
            data: {
                region_id : region_id
            },
            success: function(response){
                var html = '';
                response.province.forEach(function(item, index){
                    html += '<option value="' + item.id + '">' + item.title_vi + '</option>';
                });

                $('#province_id').html(html);
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
    }else{
        $('#province_id').html('<option value="" selected="selected">Chọn vùng miền trước</option>');
    }
});

//Remove image
$('.remove-image').click(function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var image = $(this).data('image');
    var key = $(this).data('key');
    if (confirm("Chắc chắn xóa ảnh này?")) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id, image : image
            },
            success: function(response){
                if ( response.status == 200 && response.isExisted == true ) {
                    $( '.remove-image-' + key ).fadeOut();
                }
                if ( response.status == 200 && response.isExisted == false ) {
                    alert('Không thể xóa, do ảnh đang được chọn làm avatar');
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
});

// change avatar
$('.common-image').on('click', '.active-avatar', function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var image = $(this).data('image');
    var avatar = $( '.common-avatar #avatar' ).data('image');
    var avatar_path = $( '.common-avatar #avatar' ).attr('src');
    var selector = $(this)
    if (confirm("Chắc chắn chọn ảnh này làm avatar?")) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id, image : image
            },
            success: function(response){
                if ( response.status == 200 && response.isExisted == true ) {
                    $( '.common-avatar #avatar' ).attr('src', response.image_path);
                    $( '.common-avatar #avatar' ).data('image', image);
                    selector.prev('img').attr('src', avatar_path);
                    selector.data('image', avatar);
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
});
//Remove image  region
$('.remove-image-region').click(function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var image = $(this).data('image');
    var key = $(this).data('key');
    if (confirm("Chắc chắn xóa ảnh này?")) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id, image : image
            },
            success: function(response){
                if ( response.status == 200 && response.isExisted == true ) {
                    $( '.remove-image-' + key ).fadeOut();
                }
                if ( response.status == 200 && response.isExisted == false ) {
                    alert('Không thể xóa, do ảnh đang được chọn làm avatar');
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
});

// change avatar region
$('.common-image-region').on('click', '.active-avatar', function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var name = $(this).data('name');
    var image = $(this).data('image');
    var avatar = $( '.common-avatar-region #avatar' ).data('image');
    var avatar_path = $( '.common-avatar-region #avatar' ).attr('src');
    var selector = $(this)
    if (confirm("Chắc chắn chọn ảnh này làm avatar?")) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id, image : image, name : name
            },
            success: function(response){
                if ( response.status == 200 && response.isExisted == true ) {
                    $( "[data-name='"+name+"']" ).css('color', 'black');
                    $( "#" +name+ " .active-avatar[data-image='"+image+"']" ).css('color', 'green');
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
});
// active
$('.btn-active').click(function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var name = $(this).data('name');
    if($(this).data('is_active') == '1'){
        alert(`Không thể duyệt ${name} nữa. Vì ${name} hiện đã được duyệt`);
        return false;
    }
    if (confirm(`Chắc chắn duyệt ${name}?`)) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id
            },
            success: function(response){
                alert(`Duyệt ${name} thành công`);
                if (response.status == 200 && response.isExisted) {
                    $('.is-active-' + id).html('<span class="label label-success">Đã duyệt</span>');
                    $(`.remove-${id} [class*=active]`).data('is_active','1');
                }
            },
            error: function(jqXHR, exception){
                if((jqXHR.status == 404 || jqXHR.status == 400) && jqXHR.responseJSON.message != 'undefined'){
                    if(jqXHR.responseJSON.reponse.error_permission == 'error'){
                        alert(jqXHR.responseJSON.message);
                    }else{
                        alert(`Duyệt ${name} thất bại`);
                    }
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
});

// deactive
$('.btn-deactive').click(function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var name = $(this).data('name');
    if($(this).data('is_active') == '0'){
        alert(`${name} hiện chưa được duyệt nên bạn không thể hủy duyệt`);
        return false;
    }
    if (confirm(`Chắc chắn tắt ${name}?`)) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id
            },
            success: function(response){
                if (response.status == 200 && response.isExisted) {
                    $('.is-active-' + id).html('<span class="label label-warning">Chờ duyệt</span>');
                    $(`.remove-${id} [class*=active]`).data('is_active','0');
                    alert(`Tắt ${name} thành công`);
                }
                if (response.status == 200 && response.isExisted == false) {
                    alert(`Tắt ${name} thành công`);
                }
            },
            error: function(jqXHR, exception){
                if((jqXHR.status == 404 || jqXHR.status == 400) && jqXHR.responseJSON.message != 'undefined'){
                    alert(`Tắt ${name} thất bại`);
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
});


// active user
$('.btn-active-user').click(function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    if (confirm(`Chắc chắn kích hoạt tài khoản ?`)) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id
            },
            success: function(response){
                if (response.status == 200 && response.isExisted) {
                    $('.is-active-' + id).html('<span class="label label-success">Đã kích hoạt</span>');
                    $(`.remove-${id} [class*=active]`).data('is_active','1');
                }
            },
            error: function(jqXHR, exception){
                if((jqXHR.status == 404 || jqXHR.status == 400) && jqXHR.responseJSON.message != 'undefined'){
                    if(jqXHR.responseJSON.reponse.error_permission == 'error'){
                        alert(jqXHR.responseJSON.message);
                    }else{
                        alert(`Kích hoạt tài khoản thất bại`);
                    }
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
});

// deactive user
$('.btn-deactive-user').click(function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    if (confirm(`Chắc chắn khóa tài khoản ?`)) {
        $.ajax({
            method: "get",
            url: url,
            data: {
                id : id
            },
            success: function(response){
                if (response.status == 200 && response.isExisted) {
                    $('.is-active-' + id).html('<span class="label label-warning">Đang khóa</span>');
                    $(`.remove-${id} [class*=active]`).data('is_active','0');
                }
                if (response.status == 200 && response.isExisted == false) {
                    alert(`Tắt ${name} thành công`);
                }
            },
            error: function(jqXHR, exception){
                if((jqXHR.status == 404 || jqXHR.status == 400) && jqXHR.responseJSON.message != 'undefined'){
                    alert(`Tắt ${name} thất bại`);
                }else{
                    console.log(errorHandle(jqXHR, exception));
                }
            }
        });
    }
});

// $('#is_top').change(function(){
//     var url = $(this).data('url');
//     if (confirm("Chọn bài viết này lên TOP?")) {
//         $.ajax({
//             method: "get",
//             url: url,
//             success: function(response){
//                 console.log(response);
//             },
//             error: function(jqXHR, exception){
//                 if(jqXHR.status == 404 && jqXHR.responseJSON.message != 'undefined'){
//                     alert(jqXHR.responseJSON.message);
//                     location.reload();
//                 }else{
//                     console.log(errorHandle(jqXHR, exception));
//                 }
//             }
//         });
//     }
// });

$('#update').click(function(){
    // var name = $(this).hasClass('is_category') ? 'Danh mục' : 'bài viết' ;
    var name = 'bài viết';
    if(confirm(`Chắc chắn thay đổi nếu thay đổi ${name} sẽ ở trạng thái trờ duyệt?`)){
        return true;
    }
    return false;
});


//old code
$(window).scroll(function () {
    //if you hard code, then use console
    //.log to determine when you want the
    //nav bar to stick.
    'use strict';
    if ($(window).scrollTop() > 150) {
        $('.nav_side').addClass('nav_side_fix');
    }
    if ($(window).scrollTop() < 150) {
        $('.nav_side').removeClass('nav_side_fix');
    }
});
// end old code