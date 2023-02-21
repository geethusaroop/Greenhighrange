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
  $("#unit option:first").before('<option value="">----Please Select---</option>');
  $("#unit").val("").change();
  var ctnm = $('#branch_unit').val();
  if(ctnm){$("#unit").val(ctnm).change();}
  $(".select2").select2();
  $("#animator option:first").before('<option value="">----Please Select---</option>');
  $("#animator").val("").change();
  var ctnm = $('#branch_animator').val();
  if(ctnm){$("#animator").val(ctnm).change();}
  $(".select2").select2();
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
  $table = $('#direct_table').DataTable( {
    "fixedHeader": true,
    "processing": true,
    "serverSide": true,
    "bDestroy" : true,
    "ajax": {
      "url": "<?php echo base_url();?>Direct_details/get/",
      "type": "POST",
      "data" : function (d) {
      }
    },
    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      $('td', row).eq(2).css('font-weight','bold');
      $('td', row).eq(13).html('<center><a href="<?php echo base_url();?>index.php/Direct_details/edit/'+data['d_details_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['d_details_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    },
    "columns": [
      { "data": "d_details_status", "orderable": false },
      { "data": "d_details_name", "orderable": false },
       { "data": "d_details_designation", "orderable": false },
      {"data": "d_details_photo","render": function(data, type, row) {
        return '<img src="<?php echo base_url() ?>upload/director/'+data+'" style="height:50px;width:50px;" />';
        }
      },
      {"data": "d_details_signature","render": function(data, type, row) {
        return '<img src="<?php echo base_url() ?>upload/director/'+data+'" style="height:50px;width:50px;" />';
        }
      },
      { "data": "d_details_father_name", "orderable": false },
      { "data": "date_of_birth", "orderable": false },
      { "data": "d_details_address", "orderable": false },
      { "data": "d_details_email", "orderable": false },
      { "data": "d_details_phone", "orderable": false },
      { "data": "d_details_pan", "orderable": false },
      { "data": "d_details_aadhaar", "orderable": false },
      { "data": "d_details_din", "orderable": false },
      { "data": "d_details_id", "orderable": false }
    ]
  } );
});
function confirmDelete(d_details_id){
  var conf = confirm("Do you want to Delete Direct Details ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>Direct_details/delete",
      data:{d_details_id:d_details_id},
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
</script>
