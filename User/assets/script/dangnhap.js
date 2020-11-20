$(document).ready(function() {
    $("#Form_dangnhap").validate({
        rules: {
            txtsodienthoai: {
                required: true,
                rangelength: [10, 10],
                digits: true,
            },
            txtmatkhau: {
                required: true,
                rangelength: [8, 25]
            },
        },
        messages: {
            txtsodienthoai: {
                required: "Vui lòng số điện thoại !",
                rangelength: "Số điện thoại không hợp lệ !",
                digits: "Số điện thoại không hợp lệ !",
            },
            txtmatkhau: {
                required: "Vui lòng nhập mật khẩu !",
                rangelength: "Mật khẩu không hợp lệ !",
            },
        },
        errorElement: "em",
        errorPlacement: function(error, element) {
            // Thêm class `invalid-feedback` cho field đang có lỗi
            error.addClass("invalid-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }
        },
        success: function(label, element) {},
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });
});