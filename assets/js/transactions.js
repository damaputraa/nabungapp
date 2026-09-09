$(document).ready(function() {
    $('#table-transactions').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
        },
        "order": [[0, "desc"]]
    });
});
