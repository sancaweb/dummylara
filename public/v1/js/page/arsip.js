jQuery(document).ready(function ($) {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"').attr("content")
        }
    });

    $('#bidang').select2({
        theme: 'bootstrap4',
        placeholder: "Nama Bidang",
        tags: true,
        selectionCssClass: "form-control-lg",
        // dropdownCssClass: "form-control-lg"
        // containerCssClass: "form-control-lg"
    });

});