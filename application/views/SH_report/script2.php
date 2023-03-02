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
	
	 $table = $('#receipt_list').DataTable( {
		"processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>SH_report/get",
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
            { "data": "incent_status", "orderable": true },
            { "data": "incent_date", "orderable": false },
            { "data": "member_name", "orderable": false },
            { "data": "incent_amount", "orderable": false },
            { "data": "incent_id", "orderable": false },
        ]
        
    } );
    
});

</script>
