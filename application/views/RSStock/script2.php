<script>
var k = new Date();
var n = k.toString();
var c=n.substr(0,34);
var d=c+"(IST)";
$('#date').html(d);
var response = $("#response").val();
if(response){
  console.log(response,'response');
  var options = $.parseJSON(response);
  noty(options);
}
$(function () {
  var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
  //Datemask dd/mm/yyyy
  $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
  //Date picker
  $('#date').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
  $table = $('#classinfo_table').DataTable( {
    "processing": true,
    "serverSide": true,
    "bDestroy" : true,
    "ajax": {
      "url": "<?php echo base_url();?>RSStock/get/",
      "type": "POST",
      "data" : function (d) {
        d.item_name = $('#item_names').val();
        d.sdate = $('#sdate').val();
      }
    },
    "createdRow": function ( row, data, index ) {
      //            $('td',row).eq(0).html(index+1);
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      $('td', row).eq(1).css( "font-weight", "bold");

      $('td', row).eq(5).css( "font-weight", "bold" );

      $('td', row).eq(5).css( "color", "red" );

      $('td', row).eq(3).css( "text-align", "right" );
      $('td', row).eq(4).css( "text-align", "right" );
      $('td', row).eq(5).css( "text-align", "right" );
      $('td', row).eq(6).css( "text-align", "right" );
      $('td', row).eq(7).css( "text-align", "right" );

      $('td', row).eq(8).css( "text-align", "right" );

    },
    "columns": [
      { "data": "routsale_status", "orderable": false },
      { "data": "product_name", "orderable": false },
       { "data": "product_code", "orderable": false },
      { "data": "routsale_stock", "orderable": false },
      { "data": "routsale_sale_count", "orderable": false },
      { "data": "product_stock", "orderable": false },
      { "data": "product_price_r1", "orderable": false },
      { "data": "product_price_r2", "orderable": false },
      { "data": "product_price_r3", "orderable": false },
    ]
  } );
});

$('#search').click(function () {
    $table.ajax.reload();
});


</script>
