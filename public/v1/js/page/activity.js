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

    $('#tbl-activity').on('click', '.btn-detail', function () {

        swal.fire({
            imageUrl: base_url + "/images/loading.gif",
            imageHeight: 300,
            showConfirmButton: false,
            title: "Loading ...",
            allowOutsideClick: false
        });

        var idAct = $(this).data('id');
        var urlDetail = base_url + ""
    });

});
