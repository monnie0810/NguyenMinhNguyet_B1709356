$(document).ready(function() {
    $("#form_dangky").validate({
        rules: {
            txtHoTen: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            txtEmail: {
                required: true,
                email: true,
            },
            txtsodienthoai: {
                required: true,
                rangelength: [10, 10],
                digits: true,
            },
            txtdiachi: {
                required: true,
            },
            txtmatkhau: {
                required: true,
                minlength: 8,
                maxlength: 25
            },
            txtnhaplaimatkhau: {
                required: true,
                equalTo: "#txtmatkhau",

            }
        },
        messages: {
            txtHoTen: {
                required: "Vui lòng nhập Họ tên !",
                minlength: "Họ tên phải chứa tối thiểu 3 ký tự !",
                maxlength: "Họ tên chứa tối đa 50 ký tự !",
            },
            txtEmail: {
                required: "Vui lòng nhập email !",
                email: "Email không hợp lệ !",
            },
            txtsodienthoai: {
                required: "Vui lòng số điện thoại !",
                rangelength: "Số điện thoại không hợp lệ !",
                digits: "Số điện thoại không hợp lệ !",
            },
            txtdiachi: {
                required: "Vui lòng nhập nhập địa chỉ !",
            },
            txtmatkhau: {
                required: "Vui lòng nhập mật khẩu !",
                minlength: "Mật khẩu quá ngắn !",
                maxlength: "Mật khẩu quá dài !",
            },
            txtnhaplaimatkhau: {
                required: "Vui lòng nhập mật khẩu !",
                equalTo: "Mật khẩu không khớp !",
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