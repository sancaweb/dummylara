jQuery(document).ready(function ($) {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    var tableActivity = $("#tbl-activity").DataTable({
        order: [
            [0, 'DESC']
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/activity/data",
            dataType: "json",
            type: "POST",
            data: function (data) {
                var userAct = $('#userAct').val();
                var logNameAct = $('#logNameAct').val();

                data.userAct = userAct;
                data.logNameAct = logNameAct;
            }
        },

        columns: [{
                data: "no"
            },
            {
                data: "user"
            },
            {
                data: "logName"
            },
            {
                data: "description"
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
                targets: [0, 3, 4]
            },
            {
                className: "text-center",
                targets: [0, 1, 2, 3, 4, 5]
            }
        ]
    });

    $("#tbl-activity_filter input").unbind();
    $("#tbl-activity_filter input").bind("keyup", function (e) {
        if (e.keyCode == 13) {
            tableActivity.search(this.value).draw();
        }
    });

    function refreshTable() {
        tableActivity.search("").draw();
        tableActivity.ajax.reload();
    }
    /** ./end datatable */

    let btnReload = document.getElementById("btn-reload");
    if (btnReload) {
        btnReload.addEventListener('click', function () {
            refreshTable();
        });
    }

    $('#btn-resetFilter').on('click', function () {
        $('#userAct').val("");
        $('#logNameAct').val("");
        tableActivity.draw();
    });

    $('#btn-filter').on('click', function () {
        tableActivity.search("").draw();

    });

    $('#tbl-activity').on('click', '.btn-detail', function () {

        swal.fire({
            imageUrl: base_url + "/images/loading.gif",
            imageHeight: 300,
            showConfirmButton: false,
            title: "Loading ...",
            allowOutsideClick: false
        });

        var idAct = $(this).data('id');
        var urlDetail = base_url + "/activity/" + idAct + "/show";

        $.ajax({
            url: urlDetail,
            type: "get",
            success: function (data) {
                var dataAct = data.data;
                $('#txt_user').val(dataAct.user);
                $('#txt_logName').val(dataAct.log_name);
                $('#txt_desc').val(dataAct.description);
                $('#txt_data').val(dataAct.properties);
                $('#txt_created').val(dataAct.created_at);



                Swal.close();
                $("#detailAct").modal({
                    show: true,
                    backdrop: "static",
                    keyboard: false // to prevent closing with Esc button (if you want this too)
                });
            },
            error: function (XHR) {
                console.log(XHR);
            }

        });
    });

});
