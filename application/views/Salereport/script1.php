<script>
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
      }  
  $(function () {
	$("#productnum option:first").before('<option value="">--Please Select--</option>');
	$("#productnum").val("").change();
    $(".select2").select2();
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

    $table = $('#sale_details_table').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "paging":   false,
        "ordering": false,
        "info":     false,
		  dom: 'lBfrtip',
			buttons: [
				{
					title:'Sale Report',
					extend: 'copy',
					exportOptions: {
						columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13 ]
					}
				},
				{
					title:'Sale Report',
					extend: 'excel',
					exportOptions: {
						columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13 ]
					}
				},
				{
					title:'Sale Report',
					extend: 'pdf',
					exportOptions: {
						columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13 ]
					}
				},
				{
					title:'Sale Report',
					extend: 'print',
					exportOptions: {
						columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13 ]
					}
				},
				// {
					// extend: 'csv',
					// exportOptions: {
						// columns: [ 0,1,2,3,4,5,6,7,8,9,10,11 ]
					// }
				// },
			],
        
        "ajax": {
            "url": "<?php echo base_url();?>Salereport/get/",
            "type": "POST",
            "data" : function (d) {
                    d.invoice_no = $("#purchase_invoice_no").val();
					d.product_num1 = $("#product").val();
					d.start_date = $("#pmsDateStart").val();
                    d.end_date = $("#pmsDateEnd").val();
				}
        },
        "createdRow": function ( row, data, index ) {
          
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			$('td', row).eq(8).html('<span>Rs. '+parseFloat(data['rate']).toFixed(2)+'</span>');
			$('td', row).eq(9).html('<span>'+data['taxper']+' %</span>');
			$('td', row).eq(10).html('<span>Rs. '+parseFloat(data['sgst']).toFixed(2)+'</span>');
			$('td', row).eq(11).html('<span>'+data['taxper']+' %</span>');
			$('td', row).eq(12).html('<span>Rs. '+parseFloat(data['sgst']).toFixed(2)+'</span>');
			$('td', row).eq(13).html('<span>Rs. '+data['total']+'</span>');
			$('td', row).eq(14).html('<center><a target ="_blank"  href="<?php echo base_url();?>Sale/invoiceview/'+data['invoice_number']+'/'+data['sale_date']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            
			},

        "columns": [
            { "data": "sale_status", "orderable": false },
            { "data": "invoice_number", "orderable": false },
            { "data": "sale_date", "orderable": false },
            { "data": "shopname", "orderable": false },
           
			{ "data": "product_name", "orderable": false },
			 { "data": "product_price", "orderable": false },
			{ "data": "emp_name", "orderable": false },
			{ "data": "sale_quantity", "orderable": false },
			{ "data": "rate", "orderable": false },
			{ "data": "taxper", "orderable": false },
			{ "data": "sgst", "orderable": false },
			{ "data": "taxper", "orderable": false },
			{ "data": "sgst", "orderable": false },
            { "data": "total", "orderable": false },
            { "data": "invoice_number", "orderable": false }
         ]
        
    } );
    $('#product').keyup(function (){
	$table.ajax.reload();
	});
    
  });
	
	$('#search').click(function () {
        
        $table.ajax.reload();
    });
</script>