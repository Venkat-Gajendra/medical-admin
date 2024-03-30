$(document).ready(function() {
  var TableData = function() {
    //function to initiate DataTable
    var runDataTable_example1 = function() {
      var oTable = $('#sample_1').dataTable({
        "aoColumnDefs": [{
          "aTargets": [0]
        }],
        "oLanguage": {
          "sLengthMenu": "Show _MENU_ Rows",
          "sSearch": "",
          "oPaginate": {
            "sPrevious": "",
            "sNext": ""
          }
        },
        "aaSorting": [[1, 'asc']],
        "aLengthMenu": [
          [5, 10, 15, 20, -1],
          [5, 10, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "iDisplayLength": 10,
      });
      $('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
      // modify table search input
      $('#sample_1_wrapper .dataTables_length select').addClass("m-wrap small");
      // modify table per page dropdown
      $('#sample_1_wrapper .dataTables_length select').select2();
      // initialzie select2 dropdown
    };

    var runDataTable_example2 = function() {
      var oTable = $('#sample_2').dataTable({
        "aoColumnDefs": [{
          "aTargets": [0]
        }],
        "oLanguage": {
          "sLengthMenu": "Show _MENU_ Rows",
          "sSearch": "",
          "oPaginate": {
            "sPrevious": "",
            "sNext": ""
          }
        },
        "aaSorting": [[1, 'asc']],
        "aLengthMenu": [
          [5, 10, 15, 20, -1],
          [5, 10, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "iDisplayLength": 10,
      });
      $('#sample_2_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
      // modify table search input
      $('#sample_2_wrapper .dataTables_length select').addClass("m-wrap small");
      // modify table per page dropdown
      $('#sample_2_wrapper .dataTables_length select').select2();
      // initialzie select2 dropdown

      // Add a class to the table rows that can be edited
      $('#sample_2 tbody tr').not(':first').addClass('editable');

      // Create a function to make a table cell editable
      var createEditableCell = function(oTable, nRow, iCol) {
        var aData = oTable.fnGetData(nRow);
        var jqTds = $('>td', nRow);
        jqTds[iCol].innerHTML = '<input type="text" class="form-control" value="' + aData[iCol] + '">';
        jqTds[iCol].innerHTML += '<a class="save-row" href="">Save</a>';
        jqTds[iCol].innerHTML += '<a class="cancel-row" href="">Cancel</a>';
      };

      // Add a click event listener to the add-row button
      $('body').on('click', '.add-row', function(e) {
        e.preventDefault();
        if ($(this).data('last-row')) {
          var nRow = $(this).data('last-row');
        } else {
          var nRow = oTable.fnAddData(['', '', '', '', '']);
        }
        oTable.fnUpdate('<a class="edit-row" href="">Edit</a>', nRow, 0, false);
        $(this).data('last-row', nRow);
        $('td', nRow).not(':first').addClass('editable');
      });

      // Add a click event listener to the cancel-row link
      $('#sample_2').on('click', '.cancel-row', function(e) {
        e.preventDefault();
        var nRow = $(this).parents('tr')[0];
        var iCol = $(this).index();
        oTable.fnUpdate(oTable.fnGetData(nRow)[iCol], nRow, iCol, false);
        $(nRow).removeClass('editable');
      });

      // Add a click event listener to the delete-row link
      $('#sample_2').on('click', '.delete-row', function(e) {
        e.preventDefault();
        var nRow = $(this).parents('tr')[0];
        bootbox.confirm("Are you sure to delete this row?", function(result) {
          if (result) {
            $.blockUI({
              message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.mockjax({
              url: '/tabledata/delete/webservice',
              dataType: 'json',
              responseTime: 1000,
              responseText: {
                say: 'ok'
              }
            });
            $.ajax({
              url: '/tabledata/delete/webservice',
              dataType: 'json',
              success: function(json) {
                $.unblockUI
