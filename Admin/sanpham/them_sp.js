$(document).ready(function() {
    $("#form_themsp").validate({
        rules: {
            txttensp: {
                required: true,
            },
            txtmausp: {
                required: true,
            },
            txtslnhap: {
                required: true,
            },
            txtkichthuoc: {
                required: true,
            },
            txtgianhap: {
                required: true,
            },
            txtgiaban: {
                required: true,

            },
        },
        messages: {
            txttensp: {
                required: "Vui lòng nhập tên sản phẩm !",
            },
            txtmausp: {
                required: "Vui lòng nhập màu sản phẩm !",
            },
            txtslnhap: {
                required: "Vui lòng nhập số lượng nhập của sản phẩm !",
            },
            txtkichthuoc: {
                required: "Vui lòng nhập kích thước sản phẩm !",
            },
            txtgianhap: {
                required: "Vui lòng nhập giá nhập sản phẩm !",
            },
            txtgiaban: {
                required: "Vui lòng nhập giá bán !",
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