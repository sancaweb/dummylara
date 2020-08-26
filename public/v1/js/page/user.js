jQuery(document).ready(function ($) {
    console.log('urlnya: ' + base_url);
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
            url: base_url + "/ajaxuser",
            dataType: "json",
            type: "POST"
        },
        columns: [{
                data: "no"
            },
            {
                data: "name"
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
        tableUser.search("").draw();
        tableUser.ajax.reload();
    }


});
