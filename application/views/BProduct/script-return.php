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
      "url": "<?php echo base_url();?>BProduct/get_return/",
      "type": "POST",
      "data" : function (d) {
        d.item_name = $('#item_names').val();
      }
    },
    "createdRow": function ( row, data, index ) {
      //            $('td',row).eq(0).html(index+1);
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      $('td', row).eq(1).css( "font-weight", "bold");
      $('td', row).eq(2).css( "font-weight", "bold");
      $('td', row).eq(3).css( "font-weight", "bold" );
     // $('td', row).eq(2).css( "text-align", "center" );
      $('td', row).eq(4).css( "font-weight", "bold" );
      $('td', row).eq(4).css( "text-align", "left" );
      $('td', row).eq(5).css( "font-weight", "bold" );
      $('td', row).eq(5).css( "text-align", "center" );
      $('td', row).eq(6).css( "font-weight", "bold" );
    
     $('td', row).eq(5).html('<center><a href="<?php echo base_url();?>index.php/BProduct/edit_return/'+data['return_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['return_id']+','+data['return_product_id_fk']+','+data['return_bproduct_id_fk']+','+data['return_stock']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    },
    "columns": [
      { "data": "return_status", "orderable": false },
      { "data": "return_date", "orderable": false },
      { "data": "product_name", "orderable": false },
      { "data": "product_code", "orderable": false },
       { "data": "return_stock", "orderable": false },
      { "data": "return_id", "orderable": false }
    ]
  } );
});
function confirmDelete(return_id,return_product_id_fk,return_bproduct_id_fk,return_stock){
  var conf = confirm("Do you want to Delete Class ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>BProduct/delete_return",
      data:{return_id:return_id,return_product_id_fk:return_product_id_fk,return_bproduct_id_fk:return_bproduct_id_fk,return_stock},
      method:"POST",
      datatype:"json",
      success:function(data){
        var options = $.parseJSON(data);
        noty(options);
        $table.ajax.reload();
      }
    });
  }
}
$('#search').click(function () {
    $table.ajax.reload();
});
$('#prod_name').on('change',function(){
    var prod_id = this.value;
    $.ajax({
            url:"<?php echo base_url();?>BProduct/getAvailStock",
            data:{prod_id:prod_id},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                $('#av_stk').val(options.product_stock);
                $('#av_stk').html(options.product_stock);

                $('#bproduct_id_fk').val(options.bproduct_id_fk);
                $('#bproduct_id_fk').html(options.bproduct_id_fk);
            }
        });
  })
</script>
