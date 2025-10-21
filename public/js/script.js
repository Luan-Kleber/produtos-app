$(document).ready(function () {
    $("#tabela-produtos").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json", // HTTPS!
        },
        paging: true,
        searching: true,
        ordering: true,
        lengthMenu: [5, 10, 25, 50],
        pageLength: 5,
        responsive: true,
    });
});
