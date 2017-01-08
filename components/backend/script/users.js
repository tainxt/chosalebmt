function imgError(image) {
    image.onerror = "";
    image.src = base_url + "components/default/images/no-image.gif";
    return true;
}

$(document).ready(function () {

    $(".btn-edit").click(function (e) {
        //e.preventDefault(); 
        pageurl = $(this).attr('href');
        $("#myModal").modal();
        //to change the browser URL to 'pageurl'
        if (pageurl != window.location) {
            window.history.pushState({path: pageurl}, '', pageurl);
        }

        var u_id = $(this).attr('uid');
        $('#myModal .modal-title').html("Sửa đổi thông tin thành viên");

        getUserInfo(u_id);

        return false;
    });

    $("#addnew-btn").click(function (e) {
        //e.preventDefault(); 
        pageurl = $(this).attr('href');
        $("#modal_add").modal();
        $('#modal_add .modal-body').show();
        $('#modal_add .modal-body .info-form-adnew').show();
        $('#modal_add .modal-footer').show();
        //to change the browser URL to 'pageurl'
        if (pageurl != window.location) {
            window.history.pushState({path: pageurl}, '', pageurl);
        }

        return false;
    });

    $('#view_detail').click(function () {
        pageurl = $(this).attr('href');
        $("#myModal").modal();
        if (pageurl != window.location) {
            window.history.pushState({path: pageurl}, '', pageurl);
        }
        var u_id = $('#u_id').val();

        return false;
    });

    $('.close_Modal').click(function () {
        $("#myModal").modal('hide');
        $("#modal_add").modal('hide');
        history.back();
    });

    var addNewUser = $('#form-addnew');
    addNewUser.on('submit', function (ev) {
        ev.preventDefault();
        var r_id = $('#r_id option:selected').val();
        var u_fullname = $('#u_fullname').val();
        var u_username = $('#u_username').val();
        var u_password = $('#u_password').val();
        var u_email = $('#u_email').val();
        if (u_fullname != "" && u_username != "" && u_password != "" && u_email != "") {
            $('#modal_add .modal-body').hide();
            $('#modal_add .modal-footer').hide();
            $('#modal_add .modal-body .loading-process-img').removeClass("hidden");
            addUser(r_id, u_fullname, u_username, u_password, u_email);
        }
    });

});

/* the below code is to override back button to get the ajax content without reload*/
$(window).bind('popstate', function () {
    $.ajax({url: location.pathname + '?rel=tab', success: function (data) {
            $('#content').html(data);
        }});
});

// Confirm Password HTML5
var password = document.getElementById("u_password"),
        confirm_password = document.getElementById("u_password_confirm");

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Mật khẩu xác nhận không khớp!");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


function addUser(r_id, u_fullname, u_username, u_password, u_email) {

    var myData = "r_id=" + r_id + "&u_fullname=" + u_fullname + "&u_username=" + u_username + "&u_password=" + u_password + "&u_email=" + u_email;
    $.ajax({
        url: base_url + "admin/Users/ProcessAdd",
        type: 'POST',
        data: myData,
        success: function (result) {
            if (result) {
                $('#modal_add .modal-body .info-form-adnew').hide();
                $('#modal_add .modal-body').show();
                $('.addnew-error').addClass('alert alert-success').html("Thêm mới thành công!");
                setTimeout(function () {
                    $("#modal_add").modal('hide');
                }, 2000);
                pageurl = $('#btn-addnew').attr('oldurl');
                if (pageurl != window.location) {
                    window.history.pushState({path: pageurl}, '', pageurl);
                }
            } else {
                $('#modal_add .modal-body').show();
                $('#modal_add .modal-footer').show();
                $('.addnew-error').addClass('alert alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
            }
        },
        error: function () {
            $('#modal_add .modal-body').show();
            $('#modal_add .modal-footer').show();
            $('.addnew-error').addClass('alert alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
        }
    });

}

function getUserInfo(u_id) {
    $.ajax({
        url: base_url + "admin/Users/Find/",
        type: 'POST',
        data: "u_id=" + u_id,
        success: function (result) {
            if (result) {
                var json = $.parseJSON(result);
                $('#edit_fullname').val(json.u_fullname);
                $('#edit_point').val(json.u_point);
                $("#edit_select_role option[value='" + json.r_id + "']").attr("selected", "selected");
                $("#edit_select_status option[value='" + json.u_status + "']").attr("selected", "selected");
            } else {
                alert("Error");
            }
        },
        error: function () {
            alert("Try Again");
        }
    });
}

function updateUser(u_id, r_id, u_fullname, u_point, u_status){
    var myData = "u_id=" + u_id + "&r_id=" + r_id + "&u_fullname=" + u_fullname + "&u_point=" + u_point + "&u_status=" + u_status;
    $.ajax({
        url: base_url + "admin/Users/ProcessEdit",
        type: 'POST',
        data: myData,
        success: function (result) {
            if (result) {
                $('#myModal .modal-body .info-form-update').hide();
                $('#myModal .modal-body').show();
                $('.addnew-error').addClass('alert alert-success').html("Cập nhật thành công!");
                setTimeout(function () {
                    $("#myModal").modal('hide');
                }, 2000);
                pageurl = $('#btn-addnew').attr('oldurl');
                if (pageurl != window.location) {
                    window.history.pushState({path: pageurl}, '', pageurl);
                }
            } else {
                $('#myModal .modal-body').show();
                $('#myModal .modal-footer').show();
                $('.update-error').addClass('alert alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
            }
        },
        error: function () {
            $('#myModal .modal-body').show();
            $('#myModal .modal-footer').show();
            $('.update-error').addClass('alert alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
        }
    });
}


    