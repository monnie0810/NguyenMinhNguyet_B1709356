$(document).ready(function() {
    $("#Form_themth").validate({
        rules: {
            txttenth: {
                required: true,
            },
        },
        messages: {
            txttenlsp: {
                required: "Vui lòng nhập tên thương hiệu !",
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
    $("#Form_suath").validate({
        rules: {
            txttenth_sua: {
                required: true,
            },
        },
        messages: {
            txttenth_sua: {
                required: "Vui lòng nhập tên thương hiệu !",
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