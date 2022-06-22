// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable( { 
    "ordering": false, 
    "pageLength": 50,
  });
});

$(document).ready(function() {
  $('#dataTableOrdering').DataTable( { "pageLength": 50});
});
