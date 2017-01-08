$(document).ready(function () {
    $(document).on('submit', '.form-add-cat', function (ev) {
        ev.preventDefault();
        var myData = $(this).serialize();
        Ajax_Add_Cat(myData);
        $(this).trigger("reset");
        //$("#table-data-cat").load(location.href + " #table-data-cat");
        location.reload();
    });

    $(document).on('submit', '.form-edit-cat', function (ev) {
        ev.preventDefault();
        var myData = $(this).serialize();
        Ajax_Edit_Cat(myData);
        $(this).trigger("reset");
        //$("#table-data-cat").load(location.href + " #table-data-cat");
        location.reload();
    });

    function Ajax_Add_Cat(myData) {
        $.ajax({
            url: base_url + "admin/Products/ProcessAddCategory",
            type: 'POST',
            data: myData,
            success: function (result) {
                if (result) {
                    $('#modalAdd .modal-body .my-input-form').hide();
                    $('.addnew-error').addClass('alert alert-success').html("Thêm mới thành công!");
                    $('#modalAdd .modal-header').hide();
                    $('#modalAdd .modal-footer').hide();
                    setTimeout(function () {
                        $("#modalAdd").modal('hide');
                    }, 1000);

                } else {
                    $('.addnew-error').addClass('alert alert-danger').html("Không có dữ liệu trả về, xin thử lại sau!");
                }
            },
            error: function () {
                $('.addnew-error').addClass('alert alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
            }
        });
    }

    $('.open-add-cat-modal').click(function () {
        $('#modalAdd').modal('toggle');
        $('#modalAdd .modal-body .my-input-form').show();
        $('#modalAdd .modal-header').show();
        $('#modalAdd .modal-footer').show();
        $('#form-category').attr("class", "");
        $('#form-category').addClass("form-add-cat");
        $('.addnew-error').removeClass('alert alert-danger');
        $('.addnew-error').html("");
        $('#cat_parent option').removeAttr("selected");
    });

    $('.btn-close-modal-add-cat').click(function () {
        $('#form-add-cat').trigger("reset");
        $('#modalAdd').modal('toggle');
        $('#cat_parent option').prop('selected', 'selected');
        $('#hidden-id').html("");
        return false;
    });

    $('.btn-edit-cat').click(function () {
        var cat_id = $(this).attr('data-id');
        $('#modalAdd').modal('toggle');
        $('#form-category').attr("class", "");
        $('#form-category').addClass("form-edit-cat");
        $('.addnew-error').html('');
        Ajax_Get_Cat_ID(cat_id);
        return false;
    });

    function Ajax_Edit_Cat(myData) {
        $.ajax({
            url: base_url + "admin/Products/ProcessEditCategory",
            type: 'POST',
            data: myData,
            success: function (result) {
                if (result) {
                    $('#modalAdd .modal-body .my-input-form').hide();
                    $('.addnew-error').addClass('alert alert-success').html("Sửa đổi thành công!");
                    $('#modalAdd .modal-header').hide();
                    $('#modalAdd .modal-footer').hide();
                    setTimeout(function () {
                        $("#modalAdd").modal('hide');
                    }, 1000);
                } else {
                    $('.addnew-error').addClass('alert alert-danger').html("Không có dữ liệu trả về, xin thử lại sau!");
                }
            },
            error: function () {
                $('.addnew-error').addClass('alert alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
            }
        });
    }

    function Ajax_Get_Cat_ID(cat_id) {
        $.ajax({
            url: base_url + "admin/Products/ProcessGetIDCategory",
            type: 'POST',
            data: "cat_id=" + cat_id,
            success: function (result) {
                if (result) {
                    var data = JSON.parse(result);
                    $('#cat_name').val(data.cat_name);
                    $('#cat_img').val(data.cat_img);
                    $('#cat_slug').val(data.cat_slug);
                    $('#cat_font_awesome').val(data.cat_font_awesome);
                    $('#cat_keyword').val(data.cat_keyword);
                    $('#cat_description').val(data.cat_description);
                    var list_parent = ".list-cat-id-" + data.cat_parent;
                    $(list_parent).prop('selected', 'selected');
                    var c_id = "<input type='hidden' id='cat_id' name='cat_id' value='" + data.cat_id + "'/>";
                    $('#hidden-id').append(c_id);
                } else {
                    $('.addnew-error').addClass('alert alert-danger').html("Không có dữ liệu trả về, xin thử lại sau!");
                }
            },
            error: function () {
                $('.addnew-error').addClass('alert alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
            }
        });
    }

    function Ajax_Del_Cat(cat_id) {
        $.ajax({
            url: base_url + "admin/Products/ProcessDelCategory",
            type: 'POST',
            data: "cat_id=" + cat_id,
            success: function (result) {
                if (result) {
                    location.reload();
                } else {
                    alert("Khong co ket qua tra ve");
                }
            },
            error: function () {
                alert("Có lỗi trong lúc thực hiện, xin thử lại sau!");
            }
        });
    }

    $('.btn-delete-cat').click(function (e) {
        var cat_id = $(this).attr('data-id');
        e.preventDefault();
        $.confirm({
            message: 'Bạn có chắc chắn muốn xóa?',
            onOk: function () {
                Ajax_Del_Cat(cat_id);
            }
        });
    });

    

});
