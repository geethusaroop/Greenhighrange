<script>
  var k = new Date();
var n = k.toString(); 
var c=n.substr(0,34);
var d=c+"(IST)";
 $('#date').html(d);
$(document).on('click','#add_tray',function(){
	$('#myModal').modal();
});
$(document).on('click','#addtray',function(){
	var cust_id = $('#cust_id').val();
	var no_trays = $('#no_trays').val();
	var tray_size = $('#tray_size').val();
	if(tray_size)
	{
		 $.ajax({
            url:"<?php echo base_url();?>Customer/addTray",
            data:{cust_id:cust_id,no_trays:no_trays,tray_size:tray_size},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                $table.ajax.reload();
            }
        });
	}
});
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
  $(function () {
	$("#route_id option:first").before('<option value="">----Please Select---</option>');
	$("#route_id").val("").change();
	var ctnm = $('#route_id_fk').val();
	if(ctnm){$("#route_id").val(ctnm).change();}
	
	$("#emp_id option:first").before('<option value="">----Please Select---</option>');
	$("#emp_id").val("").change();
	
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#emp_doj').datepicker({
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
    $table = $('#customer_table').DataTable( {
        "fixedHeader": true, 
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Employee/get",
            "type": "POST",
            "data" : function (d) {
              console.log(d);
            
           }
        },
        "createdRow": function ( row, data, index ) {
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
         if(data['emp_img']=='Not uploaded')
              {
                $('td',row).eq(1).html('Not uploaded');
              }
              else
              {
              $('td',row).eq(1).html('<img src="<?php echo base_url();?>/employee_image/'+data['emp_img']+'" width="80px"/>');
              }
			        $('td', row).eq(13).html('<center><a href="<?php echo base_url();?>Employee/edit/'+data['emp_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['emp_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
              $('td', row).eq(12).html('<center><img src="<?php echo base_url();?>employee_image/'+data['emp_govt_id']+'" width="40px;" height="40px;" /></center>');
		},
        "columns": [
            { "data": "emp_status", "orderable": true },
            { "data": "emp_img", "orderable": false },
            { "data": "emp_eid", "orderable": false },
            { "data": "emp_name", "orderable": false },
            {
              "data": "emp_blood_grp",
              "render": function(data, type, row) {
                if(data == 1){
                  return 'A+';
                }
                else if(data == 2){
                  return 'A-';
                }
                else if(data == 3){
                  return 'B+';
                }
                else if(data == 4){
                  return 'B-';
                }
                else if(data == 5){
                  return 'O+';
                }
                else if(data == 6){
                  return 'O-';
                }
                else if(data == 7){
                  return 'AB+';
                }
                else if(data == 8){
                  return 'AB-';
                }
              }
            },
            { "data": "emp_designation", "orderable": false },
            { "data": "emp_address", "orderable": false },
            { "data": "emp_phone", "orderable": false },
            { "data": "emp_phone2", "orderable": false },
      			{ "data": "emp_email", "orderable": false },
      			{ "data": "emp_doj", "orderable": false },
            { "data": "emp_sal", "orderable": false },
            { "data": "emp_id", "orderable": false },
            { "data": "emp_id", "orderable": false }
        ]
        
    } );
    
  });
 function confirmDelete(emp_id){
    var conf = confirm("Do you want to Delete Employee Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Employee/delete",
            data:{emp_id:emp_id},
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
/************************** Open Modal **************************/
	$(document).on('click','#setpvlg',function(){
		$('#set_pvlg').modal();
	});
/************************** Modal OK on click *******************/
	function setpvlg(){
		
	  var emp_id = $('#emp_id').val();
	  var username = $('#username').val();
	  var password = $('#password').val();
	  var user_type = $('#user_type').val();
	  if(emp_id!='' && username!='' && password!='' && user_type!='')
	  {
		  
		$.ajax({
            url:"<?php echo base_url();?>Employee/setPrivalage",
            data:{emp_id:emp_id,username:username,password:password,user_type:user_type},
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