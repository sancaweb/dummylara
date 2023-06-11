// $(function () {
//     'use strict'

$(function () {
    'user strict'

    $('#inputFoto').on("change", function () {
        var review = 'imageReview';
        var linkFoto = 'linkFoto';
        readURL(this, review, linkFoto);
    });

    function readURL(input, review, linkFoto) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + review).attr('src', e.target.result);
                $('#' + linkFoto).attr('href', e.target.result);

            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }


    $("#formProfile").on("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            imageUrl: base_url + "/images/loading.gif",
            imageHeight: 300,
            showConfirmButton: false,
            title: "Loading ...",
            allowOutsideClick: false
        });
        var formData = new FormData($("#formProfile")[0]);
        var url = $("#formProfile").attr("action");
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {

                Swal.fire({
                    icon: "success",
                    title: data.meta.message,
                    showConfirmButton: false,
                    timer: 2000,
                    allowOutsideClick: false
                }).then(function () {
                    var dataUser = data.data.user;
                    location.reload();

                    // var self = data.data.self;

                    // if (self == true) {
                    //     $('#userImageSide').attr('src', base_url + '/storage/' + dataUser.foto);
                    //     $('#userNameSide').html(dataUser.name);
                    // }

                    // refreshTable();

                    // closeForm();

                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.responseJSON.data.errorValidator) {
                    var errors = jqXHR.responseJSON.data.errorValidator;
                    var message = jqXHR.responseJSON.message;
                    var li = '';
                    $.each(errors, function (key, value) {

                        li += "<li>" + value + "</li>"
                    });

                    Swal.fire({
                        icon: "error",
                        title: message,
                        html: '<div class="alert alert-danger text-left" role="alert">' +
                            '<ul>' + li + '</ul>' +
                            '</div>',
                        footer: "Pastikan data yang anda masukkan sudah benar!",
                        allowOutsideClick: false,
                        showConfirmButton: true,
                    });

                } else {
                    var message = jqXHR.responseJSON.meta.message;
                    var data = jqXHR.responseJSON.data;

                    Swal.fire({
                        icon: "error",
                        title: message + " <br>Copy error dan hubungi Programmer!",
                        html: '<div class="alert alert-danger text-left" role="alert">' +
                            '<p>Error Message: <strong>' + message + '</strong></p>' +
                            '<p>Error: ' + data.error + '</p>' +
                            '</div>',
                        allowOutsideClick: false,
                        showConfirmButton: true,
                    });
                }

            }
        });
    });
});
