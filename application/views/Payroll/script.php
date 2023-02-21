<script>
  var k = new Date();
var n = k.toString(); 
var c=n.substr(0,34);
var d=c+"(IST)";
 $('#date').html(d);
// Print//
  $("#print").on("click", function () {
       var divContents = $("#invcont").html();
       var printWindow = window.open('', '', 'height=600,width=800');
       printWindow.document.write('<html><head><title></title>');
       printWindow.document.write('</head><body >');
       printWindow.document.write(divContents);
       printWindow.document.write('</body></html>');
       printWindow.document.close();
       printWindow.print();
   });
   
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  $('#search').click(function () {
        
        $table.ajax.reload();
    });
  $(function () {
		
	$("#payroll_empname option:first").before('<option value="">----Please Select----</option>');
	$("#payroll_empname").val("").change();
	var ctnm = $('#names').val();
	if(ctnm){$("#payroll_empname").val(ctnm).change();}
    $(".select2").select2();
		
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
	$('#leave_from').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    $('#leave_to').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });	
	$('#payroll_salarydate').datepicker({
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
	
    $table = $('#product_table').DataTable( {
        "fixedHeader": true, 
        "searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
            buttons: [
              {
                extend: 'excel',
                exportOptions: 
                {
                  columns: [ 0,1,2,3,4,5,6,7]
                }
              },
              {
                extend: 'print',
                exportOptions: {
                  columns: [ 0,1,2,3,4,5,6,7]
                }
              },
            ],
        "ajax": {
            "url": "<?php echo base_url();?>Payroll/get/",
            "type": "POST",
            "data" : function (d) {
              d.month = $('#month').val();
			}
        },
        "createdRow": function ( row, data, index ) {
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			//$('td', row).eq(10).html('<center><a target ="_blank"  href="<?php echo base_url();?>Payroll/payslip/'+data['payroll_id']+'"><i class="fa  fa-file iconFontSize-medium" id="payslip"></i></a></center>');
			$('td', row).eq(8).html('<center><a target ="_blank"  href="<?php echo base_url();?>Payroll/payslip/'+data['payroll_id']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
       $('td', row).eq(9).html('<center><a href="<?php echo base_url();?>Payroll/edit/'+data['payroll_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['payroll_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
           
        },
        "columns": [
				{ "data": "payroll_status", "orderable": false },
      			{ "data": "payroll_salarydate", "orderable": false },
      			{ "data": "emp_name", "orderable": false },
      			{ "data": "payroll_basicsalary", "orderable": false },
      			{ "data": "payroll_leaveded", "orderable": false },
      			{ "data": "advance_pay", "orderable": false },
            { "data": "overtime_pay", "orderable": false },
            { "data": "payroll_salary", "orderable": false },
      			{ "data": "payroll_id", "orderable": false },
            { "data": "payroll_id", "orderable": false }
			
        ]
        
    });	
});
$(document).on('change','#payroll_empname',function(){
	var emp_id = $(this).val();
	if(emp_id)	
	{
		$.ajax({
            url:"<?php echo base_url();?>Payroll/get_values",
            data:{emp_id:emp_id},
            type:'POST',
            dataType:"json",
            success:function(data){
                $('#basic_sal').val(data['emp_sal']);  
				var s = data['emp_sal'];
				var epf= (12*s)/100;
				$('#epf_sal').val(epf); 
            }
		});
	}
});
$(document).on('change','#payroll_salmonth',function(){
	var month = $(this).val();
	var year = new Date().getFullYear();
	var emp_id = $('#payroll_empname').val();
	if(month)
	{
		$.ajax({
            url:"<?php echo base_url();?>Payroll/get_leaves",
            data:{month:month,year:year,emp_id:emp_id},
            type:'POST',
            dataType:"JSON",
            success:function(data){
				$('#days').html(data[0]['total_days']);
				var basic_sal = $('#basic_sal').val();
				var total_days = Math.round(((new Date(year, month))-(new Date(year, month-1)))/86400000);
				var d = new Date();
				//var sat = new Array();   //Declaring array for inserting Saturdays
				var friday = new Array();   //Declaring array for inserting Sundays
				for(var i=1;i<=total_days;i++){    //looping through days in month
					var newDate = new Date(d.getFullYear(),d.getMonth(),i)
					// if(newDate.getDay()==0){   //if Sunday
						 // sun.push(i);
					// }
					if(newDate.getDay()==5){   //if Saturday
						 friday.push(i);
					}
				}
				//var arr3 = $.merge( sat, sun );
				var off_days = friday.length;
				var wrking_days = total_days - off_days;
				var sal_per = parseFloat(basic_sal) / parseFloat(wrking_days);
				var deduct_amt = parseInt(sal_per) * data[0]['total_days'];
				$('#leave_ded').val(deduct_amt);
            }
		});
		$.ajax({
            url:"<?php echo base_url();?>Payroll/get_overtime",
            data:{month:month,year:year,emp_id:emp_id},
            type:'POST',
            dataType:"JSON",
            success:function(data){
				if(data[0]['total_amount']){
					$('#overtime').val(data[0]['total_amount']);
				}
				else{
					$('#overtime').val('0');
				}
            }
		});
		$.ajax({
            url:"<?php echo base_url();?>Payroll/get_advance",
            data:{month:month,year:year,emp_id:emp_id},
            type:'POST',
            dataType:"JSON",
            success:function(data){				
				if(data[0]['adv_amount']){
					$('#advance').val(data[0]['adv_amount']);
				}
				else{
					$('#advance').val('0');
				}
            }
		});
		
	}
	
});
$(document).on('click','#total_sal',function(){
  var basicpay = $('#basic_sal').val();
  var epf = $('#epf_sal').val();
  var overtime = $('#overtime').val();
  var advance = $('#advance').val();
  var leaveamt = $('#leave_ded').val();
  var hra = $('#payroll_hra').val();
  var ta = $('#payroll_ta').val();
  var esi = $('#payroll_esi').val();
  var gross_total = (parseFloat(basicpay) + parseFloat(overtime)) - (parseFloat(advance) + parseFloat(leaveamt) + parseFloat(epf) + parseFloat(hra) + parseFloat(ta) - parseFloat(esi));
  $('#total_sal').val(gross_total);
});
 function confirmDelete(payroll_id){
    var conf = confirm("Do you want to Delete Payroll Details ?");
    alert(payroll_id);
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Payroll/delete",
            data:{payroll_id:payroll_id},
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