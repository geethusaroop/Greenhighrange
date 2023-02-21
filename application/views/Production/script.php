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
      "url": "<?php echo base_url();?>Production/get/",
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
      $('td', row).eq(4).css( "text-align", "center" );
      $('td', row).eq(5).css( "font-weight", "bold" );
    

      if(data['product_unit_type']==1)
      {
        $('td', row).eq(1).html('MASALA UNIT');
      }
      else if(data['product_unit_type']==2)
      {
        $('td', row).eq(1).html('SPICES UNIT');
      }
      else if(data['product_unit_type']==3)
      {
        $('td', row).eq(1).html('OIL UNIT');
      }
      else if(data['product_unit_type']==4)
      {
        $('td', row).eq(1).html('PICKLE UNIT');
      }

      else if(data['product_unit_type']==5)
      {
        $('td', row).eq(1).html('MISCELLANEOUS ITEMS');
      }


     $('td', row).eq(4).html('<center><a href="<?php echo base_url();?>index.php/Production/edit/'+data['product_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['product_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    },
    "columns": [
      { "data": "product_status", "orderable": false },
      { "data": "product_unit_type", "orderable": false },
      { "data": "product_name", "orderable": false },
       { "data": "product_hsncode", "orderable": false },
      { "data": "product_status", "orderable": false }
    ]
  } );
});
function confirmDelete(product_id){
  var conf = confirm("Do you want to Delete Class ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>Production/delete",
      data:{product_id:product_id},
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
$(document).on('change','#product_hsn',function(){
  var id = $(this).val();
  if(id)
  {
    $.ajax({
            url:"<?php echo base_url()?>Production/gethsncode",
            type: 'POST',
            data: {id:id},
            dataType: 'json',
            success:
            function(data)
            {
         $('#product_hsncode').val(data['hsncode']);
      },
    });
    }
  });
</script>
