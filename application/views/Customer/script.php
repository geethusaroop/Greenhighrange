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
    $('#date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
	$('#wdate').datepicker({
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
    $table = $('#customer_table').DataTable({
        "fixedHeader": true,
		"processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Customer/get",
            "type": "POST",
            "data" : function (d) {

           }
        },
        "createdRow": function ( row, data, index ) {

			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			$('td', row).eq(9).html('<center><a href="<?php echo base_url();?>Customer/edit/'+data['cust_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['cust_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
		},
        "columns": [
            { "data": "custstatus", "orderable": true },
            { "data": "custname", "orderable": false },
			//{ "data": "shopname", "orderable": false },
            { "data": "custaddress", "orderable": false },
            { "data": "custphone", "orderable": false },
			{ "data": "custemail", "orderable": false },
            { "data": "custpan", "orderable": false },
			{ "data": "custgst", "orderable": false },
            { "data": "custplace", "orderable": false },
            { "data": "cust_date", "orderable": false },
			{ "data": "cust_id", "orderable": false }
        ]

    });
  });
 function confirmDelete(cust_id){
    var conf = confirm("Do you want to Delete Customer Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Customer/delete",
            data:{cust_id:cust_id},
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
