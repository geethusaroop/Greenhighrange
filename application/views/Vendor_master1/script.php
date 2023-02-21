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
var param = '';
var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
$(function () {
  var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
  //Datemask dd/mm/yyyy
  $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
  //Date picker
  $('#start_date').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });
  $('#end_date').datepicker({
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
  $table = $('#Vendor_table').DataTable( {
    "processing": true,
    "serverSide": true,
    "bDestroy" : true,
    "ajax": {
      "url": "<?php echo base_url();?>Vendor_master/get",
      "type": "POST",
      "data" : function (d) {
      }
    },
    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      $('td', row).eq(6).html('<center><button type="button" class="btn btn-primary" data-id='+data['vendor_id']+' id="eye" onclick="showItemRelated(this)"><i class="fa fa-eye iconFontSize-medium" ></i></button></center>');
      $('td', row).eq(7).html('<center><a href="<?php echo base_url();?>Vendor_master/edit/'+data['vendor_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['vendor_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    },
    "columns": [
      { "data": "vendorstatus", "orderable": true },
      { "data": "vendorname", "orderable": false },
      { "data": "vendoraddress", "orderable": false },
      { "data": "vendorphone", "orderable": false },
      { "data": "vendoremail", "orderable": false },
      { "data": "vendorgst", "orderable": false },
      { "data": "vendor_oldbal", "orderable": false },
      { "data": "vendor_id", "orderable": false }
    ]
  } );
});
function confirmDelete(vendor_id){
  var conf = confirm("Do you want to Delete Vendor Details ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>Vendor_master/delete",
      data:{vendor_id:vendor_id},
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

function showItemRelated(data){
  var vendor_id=data.getAttribute('data-id');
  $.ajax({
    url:"<?php echo base_url();?>Vendor_master/getVendorRelateditems",
    data:{vendor_id:vendor_id},
    method:"POST",
    datatype:"json",
    success:function(d){
      var data=JSON.parse(d)
      if(data==0){
        alert('Not purchased any item from this vendor yet!')
      }
      else{
        var x = "";
        var arrayLength = data.length;
        for (var i = 0; i < arrayLength; i++) {
          x += data[i].product_name+' || ';
        }
        alert(x);
      }
    }
  });
}

$('#selectProduct').change(function(){
  var item_id=this.value;

  $.ajax({
    url:"<?php echo base_url();?>Vendor_master/getItemBasedVendors",
    data:{item_id:item_id},
    method:"POST",
    datatype:"json",
    success:function(d){
      var data=JSON.parse(d)
      var text='';
      console.log(data);
      for (var i=0; i<data.length;i++){
          console.log(data[i].vendorname);
          text +=data[i].vendorname;
          text += "\n";
      }
      if(text==''){
        alert("No vendors found on this item");
      }else{
        alert(text);
      }
    }
  })
})

// function getVendors(data){
//   console.log(data.value);
// }

</script>
