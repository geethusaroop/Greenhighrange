<script>
	var k = new Date();
var n = k.toString(); 
var c=n.substr(0,34);
var d=c+"(IST)";
 $('#date').html(d);
$(document).on('click','#save',function(){
	//alert('hai');
	var Outs = $('#loss').text();
	var Outs = parseFloat(Outs);
	if(Outs)
	{
		//alert(Outs);
		$.ajax({
			// alert(Outs);
            url:"<?php echo base_url();?>Ledger/update",
            data:{Outs:Outs},
            method:"POST",
            datatype:"json",
            success:function(data){
				if(data)
				{
					
					var options1 = {
					'title': 'Success',
					'style': 'notice',
					'message': 'Saved Successfully....!',
					'icon': 'success',
					};
					var n1 = new notify(options1);
					n1.show();
					setTimeout(function(){  
					n1.hide();
				   }, 3000);
				   location.reload();
				}
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
 $(function () {
	
    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#start_date').datepicker({
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
	
	 $table = $('#enquiry_table').DataTable( {
		"processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>GLedger/get",
            "type": "POST",
            "data" : function (d) {
				d.ledgerbuk_head = $('#ledgerbuk_head').val();
				d.start_date = $('#start_date').val();
				d.end_date = $('#end_date').val();
				//alert(d.start_date);
				
				//alert(d.ledgerbuk_head);
           }
        },
        "createdRow": function ( row, data, index ) {
			
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			
		},
        "columns": [
            { "data": "ledgerbuk_status", "orderable": true },
			//{ "data": "bill_num", "orderable": true },
            { "data": "date", "orderable": false },
            { "data": "ledgerbuk_head", "orderable": false },
            { "data": "credit", "orderable": false },
			{ "data": "debit", "orderable": false }
        ]
        
    } );
    
});
$(document).on('click','#search',function(){
		$table.ajax.reload();
		var start_date = $('#start_date').val();
		//alert(start_date);
		if(start_date){
		$.ajax({
            url:"<?php echo base_url();?>GLedger/get_opening",
			data:{start_date:start_date},
            type:'POST',
			dataType:"json",
            success:function(data){
				//alert("hai");
				$('#opening').html(data['closing_amount']);
				//$('#profit').html(data['closing_amount']);
				setTimeout(function(){  
					n1.hide();
				   }, 3000);
            }
            
        });
		$.ajax({
            url:"<?php echo base_url();?>GLedger/get_sum_",
			data:{start_date:start_date},
            type:'POST',
			dataType:"json",
            success:function(data){
				 var opening = $('#opening').text();
				var credit = data[0]['credit_sum'] ;
				var debit = data[0]['debit_sum'];
				var credit_to = parseFloat(credit) + parseFloat(opening);
				var outstanding = parseFloat(credit_to) - parseFloat(debit);
				if(outstanding < 0)
				{
				    $('#profit').html(outstanding);
				    
				}
				else
				{
				    $('#loss').html(outstanding);
				}
				var loss = $('#loss').text();
				var profit = $('#profit').text();
				var credit_total = parseFloat(credit_to) - parseFloat(profit);
				var debit_total = parseFloat(debit) + parseFloat(loss);
				$('#credit_total').html(credit_total);
				$('#debit_total').html(debit_total);
            }
        });
		}
	});
$(document).ready(function(){
	$.ajax({
            url:"<?php echo base_url();?>GLedger/get_sum",
            type:'POST',
			dataType:"json",
            success:function(data){
			    var opening = $('#opening').text();
				var credit = data[0]['credit_sum'] ;
				var debit = data[0]['debit_sum'];
				var credit_to = parseFloat(credit) + parseFloat(opening);
				var outstanding = parseFloat(credit_to) - parseFloat(debit);
				if(outstanding < 0)
				{
				    $('#profit').html(outstanding);
				    
				}
				else
				{
				    $('#loss').html(outstanding);
				}
				var loss = $('#loss').text();
				var profit = $('#profit').text();
				var credit_total = parseFloat(credit_to) - parseFloat(profit);
				var debit_total = parseFloat(debit) + parseFloat(loss);
				$('#credit_total').html(credit_total);
				$('#debit_total').html(debit_total);
				
            }
        });
})
	function send()
{document.theform.submit()}
  
</script>
