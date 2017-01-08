$(document).ready(function () {
    $('.logout-btn').click(function (e) {
        var url = $(this).attr('href');
        e.preventDefault();
        $.confirm({
            message: 'Bạn có chắc chắn muốn thoát?',
            title: 'Xác nhận đăng xuất',
            onOk: function () {
                window.location.replace(url);
            }
        });
        
        return false;
    });
});