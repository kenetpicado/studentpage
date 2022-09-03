$(document).ready(function() {
    $('#dataTable').DataTable({
        ordering: false,
        responsive: true,
        pageLength: 50,
        lengthChange: false,
        language: {
            search: "Buscar:",
            zeroRecords: "No hay registros",
            info: "_TOTAL_ resultados",
            infoEmpty: "",
            infoFiltered: "",
            paginate: {
                first: "««",
                previous: "«",
                next: "»",
                last: "»»"
            },
        }
    });
});