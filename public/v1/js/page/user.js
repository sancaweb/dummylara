jQuery(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"').attr("content")
        }
    });

    var tableUser = $("#tbl-user").DataTable({
        order: [
            [0, 'DESC']
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/usertable",
            dataType: "json",
            type: "POST"
        },
        columns: [{
                data: "no"
            },
            {
                data: "foto"
            },
            {
                data: "name"
            },
            {
                data: "username"
            },
            {
                data: "email"
            },
            {
                data: "created_at"
            },
            {
                data: "action"
            },
        ],
        columnDefs: [{
            orderable: false,
            targets: [0, 1, -1]
        }]
    });

    $("#tbl-user_filter input").unbind();
    $("#tbl-user_filter input").bind("keyup", function (e) {
        if (e.keyCode == 13) {
            tableUser.search(this.value).draw();
        }
    });

    function refreshTable() {
        // tableUser.search("").draw();
        tableUser.ajax.reload();
    }
    /** ./end datatable */


    function readURL(input, review) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + review).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    function formReset() {
        $('#formUser')[0].reset();
        $('#imgReview').attr('src', base_url + '/images/no-image.png');
        $("#formUser").attr("action", base_url + "/user");
        $('[name="_method"]').remove();
        $(".titleForm").html('<i class="fas fa-user-plus"></i>&nbsp; Add User');
        closeCard();
    }

    function closeCard() {
        var elementLink = document.getElementById("linkCardCollapse");
        elementLink.classList.add("collapsed");

        var elementCard = document.getElementById("cardFormUser");
        elementCard.classList.remove("show");
    }

    function openCard() {
        var elementLink = document.getElementById("linkCardCollapse");
        elementLink.classList.remove("collapsed");

        var elementCard = document.getElementById("cardFormUser");
        elementCard.classList.add("show");
    }


    $('#foto').on("change", function () {
        var review = 'imgReview';
        readURL(this, review);
    });

    $("#formUser").on("submit", function (e) {
        e.preventDefault();
        swal.fire({
            imageUrl: base_url + "/images/loading.gif",
            imageHeight: 300,
            showConfirmButton: false,
            title: "Loading ...",
            allowOutsideClick: false
        });
        var formData = new FormData($("#formUser")[0]);
        var url = $("#formUser").attr("action");
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
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000,
                    allowOutsideClick: false
                }).then(function () {
                    refreshTable();
                    formReset();

                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                if (jqXHR.responseJSON.exception) {
                    var message = jqXHR.responseJSON.message;
                    Swal.fire({
                        icon: "error",
                        title: "Error Submit data. <br>Copy error dan hubungi Programmer!",
                        html: '<div class="alert alert-danger text-left" role="alert">' +
                            '<p><strong>' + jqXHR.responseJSON.exception + '</strong></p>' +
                            '<p>' + message + '</p>' +
                            '</div>',
                        allowOutsideClick: false
                    });
                } else {
                    var errors = jqXHR.responseJSON.errors;
                    var li = '';
                    $.each(errors, function (key, value) {

                        li += "<li>" + value + "</li>"
                    });
                    Swal.fire({
                        icon: "error",
                        title: "Error Saving Data",
                        html: '<div class="alert alert-danger text-left" role="alert">' +
                            '<ul>' + li + '</ul>' +
                            '</div>',
                        footer: "Pastikan data yang anda masukkan sudah benar!",
                        allowOutsideClick: false
                    });
                }

            }
        });
    });

    $("#tbl-user").on("click", ".btn-edit", function () {
        swal.fire({
            imageUrl: base_url + "/images/loading.gif",
            imageHeight: 300,
            showConfirmButton: false,
            title: "Loading ...",
            allowOutsideClick: false
        });

        var idUser = $(this).data("id");
        var urlEdit = base_url + '/user/' + idUser + '/edit';
        // var urlEdit = base_url + '/user/70/edit';
        $.ajax({
            url: urlEdit,
            type: "get",
            success: function (data) {
                if (data.data) {
                    var data = data.data;
                    var dataUser = data.dataUser;
                    $("#formUser").attr("action", data.action);
                    $('[name="name"]').val(dataUser.name);
                    $('[name="username"]').val(dataUser.username);
                    $('[name="email"]').val(dataUser.email);
                    $('<input name="_method" value="patch">').attr("type", "hidden").appendTo("#formUser");
                    $('#imgReview').attr('src', base_url + dataUser.foto);

                    $(".titleForm").html('<i class="fas fa-edit"></i>&nbsp; Edit User');
                    Swal.close();

                    openCard();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2000,
                        allowOutsideClick: false
                    });
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                var status = jqXHR.status;
                if (status == 404) {
                    Swal.fire({
                        icon: "error",
                        title: "Error get data User",
                        html: '<div class="alert alert-danger text-left" role="alert">' +
                            '<p>Data tidak ditemukan</p>' +
                            '</div>',
                        allowOutsideClick: false
                    });
                } else {

                    var error = jqXHR.responseJSON;
                    Swal.fire({
                        icon: "error",
                        title: "Error get data User",
                        html: '<div class="alert alert-danger text-left" role="alert">' +
                            '<ul>' + error.message + '</ul>' +
                            '</div>',
                        allowOutsideClick: false
                    });
                }
            }
        });

    });

    $('#tbl-user').on("click", ".btn-delete", function () {
        formReset();
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda yakin ingin menghapus data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                swal.fire({
                    imageUrl: base_url + "/images/loading.gif",
                    imageHeight: 300,
                    showConfirmButton: false,
                    title: "Loading ...",
                    allowOutsideClick: false
                });

                var idUser = $(this).data('id');
                var urlDelete = base_url + '/user/' + idUser + '/delete';
                $.ajax({
                    url: urlDelete,
                    type: "DELETE",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        }).then(function () {
                            refreshTable();
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        var error = jqXHR.responseJSON;
                        Swal.fire({
                            icon: "error",
                            title: error.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        });

                    }
                });

            }
        });
    });


    /** ================ TRASHED ============ */
    var tableUserTrash = $("#tbl-userTrash").DataTable({
        order: [
            [0, 'DESC']
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/usertrashtable",
            dataType: "json",
            type: "POST"
        },
        columns: [{
                data: "no"
            },
            {
                data: "foto"
            },
            {
                data: "name"
            },
            {
                data: "username"
            },
            {
                data: "email"
            },
            {
                data: "created_at"
            },
            {
                data: "action"
            },
        ],
        columnDefs: [{
            orderable: false,
            targets: [0, 1, -1]
        }]
    });

    $("#tbl-userTrash_filter input").unbind();
    $("#tbl-userTrash_filter input").bind("keyup", function (e) {
        if (e.keyCode == 13) {
            tableUserTrash.search(this.value).draw();
        }
    });

    function refreshTableTrash() {
        // tableUserTrash.search("").draw();
        tableUserTrash.ajax.reload();
    } // ./end datatable trash


    $('#tbl-userTrash').on("click", ".btn-restore", function () {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda yakin ingin Me-Restore data User ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                swal.fire({
                    imageUrl: base_url + "/images/loading.gif",
                    imageHeight: 300,
                    showConfirmButton: false,
                    title: "Loading ...",
                    allowOutsideClick: false
                });

                var idUser = $(this).data('id');
                var urlDelete = base_url + '/usertrash/' + idUser + '/restore';
                $.ajax({
                    url: urlDelete,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        }).then(function () {
                            refreshTableTrash();
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        var error = jqXHR.responseJSON;
                        Swal.fire({
                            icon: "error",
                            title: error.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        });

                    }
                });

            }
        });
    });
    //./end restore


    $('#tbl-userTrash').on("click", ".btn-destroy", function () {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda yakin ingin menghapus Permanent ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                swal.fire({
                    imageUrl: base_url + "/images/loading.gif",
                    imageHeight: 300,
                    showConfirmButton: false,
                    title: "Loading ...",
                    allowOutsideClick: false
                });

                var idUser = $(this).data('id');
                var urlDelete = base_url + '/usertrash/' + idUser + '/destroy';
                $.ajax({
                    url: urlDelete,
                    type: "DELETE",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        }).then(function () {
                            refreshTableTrash();
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        var error = jqXHR.responseJSON;
                        Swal.fire({
                            icon: "error",
                            title: error.message,
                            showConfirmButton: false,
                            timer: 2000,
                            allowOutsideClick: false
                        });

                    }
                });

            }
        });
    });


});
