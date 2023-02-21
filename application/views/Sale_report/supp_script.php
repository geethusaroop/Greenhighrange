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
					title:'Supplier wise Sale Report',
					extend: 'copy',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,6,7,8,9 ]
					}
				},
				{
					title:'Supplier wise Sale Report',
					extend: 'excel',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,6,7,8,9 ]
					}
				},
				{
					title:'Supplier wise Sale Report',
					extend: 'pdf',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,6,7,8,9 ]
					}
				},
				{
					title:'Supplier wise Sale Report',
					extend: 'print',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,6,7,8,9 ]
					}
				},
			],

      "footerCallback": function( tfoot, data, start, end, display ) {
          var api = this.api();
          var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            var json = api.ajax.json();
            console.log(json);
 //var total= $( api.column(5).footer() ).html(json.records_total[0].tqty);
 //var total= $( api.column(5).footer() ).html(json.records_total[0].tqty);
        

          pageTotal = api
                        .column(5, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(5).footer()).html('<center><i class="fa fa-inr"></i>' + pageTotal + ' (' + json.records_total[0].price + ')</center>')


                  pageTotal3 = api
                        .column(6, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(6).footer()).html('<center><i class="fa fa-inr"></i>'+' ' + pageTotal3 + ' (' + parseFloat(json.records_total[0].pprice).toFixed(2) + ')</center>')



                  pageTotal4 = api
                        .column(7, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(7).footer()).html('<center>'+' ' + pageTotal4 + ' (' + json.records_total[0].qty + ')</center>')


                  pageTotal5 = api
                        .column(8, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(8).footer()).html('<center><i class="fa fa-inr"></i>'+' ' + parseFloat(pageTotal5).toFixed(2) + ' (' + parseFloat((json.records_total[0].qty)*json.records_total[0].pprice).toFixed(2) + ')</center>')


                  
                  pageTotal6 = api
                        .column(9, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(9).footer()).html('<center><i class="fa fa-inr"></i>'+' ' + pageTotal6 + ' (' + parseFloat(json.records_total[0].snet).toFixed(2) + ')</center>')


             

              }, 
        
        "ajax": {
            "url": "<?php echo base_url();?>Sale_Report/getsupplierSaleRport/",
            "type": "POST",
            "data" : function (d) {
                    d.vendor_id = $("#vendor_id").val();
					d.start_date = $("#pmsDateStart").val();
                    d.end_date = $("#pmsDateEnd").val();
				}
        },
        "createdRow": function ( row, data, index ) {
          
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(5).css('text-align','center');
            $('td', row).eq(6).css('text-align','center');
            $('td', row).eq(7).css('text-align','center');
            $('td', row).eq(8).css('text-align','center');
            $('td', row).eq(9).css('text-align','center');
            $('td', row).eq(8).html('<span>'+parseFloat(data['ptotal']).toFixed(2)+'</span>');
		//	$('td', row).eq(8).html('<span>Rs. '+parseFloat(data['rate']).toFixed(2)+'</span>');
		//	$('td', row).eq(9).html('<span>'+data['sale_sgst']+' %</span>');
		//	$('td', row).eq(10).html('<span>Rs. '+parseFloat(data['sale_sgstamt']).toFixed(2)+'</span>');
		//	$('td', row).eq(11).html('<span>'+data['sale_cgst']+' %</span>');
		//	$('td', row).eq(12).html('<span>Rs. '+parseFloat(data['sale_cgstamt']).toFixed(2)+'</span>');
		//	$('td', row).eq(13).html('<span>Rs. '+data['total']+'</span>');
		//	$('td', row).eq(12).html('<center><a target ="_blank"  href="<?php echo base_url();?>Sale/invoiceview/'+data['invoice_number']+'/'+data['sale_date']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            
			},

        "columns": [
            { "data": "sale_status", "orderable": false },
            { "data": "invoice_number", "orderable": false },
            { "data": "sale_date", "orderable": false },
            { "data": "customer_name", "orderable": false },
			{ "data": "product_name", "orderable": false },
			 { "data": "selling_price", "orderable": false },
       { "data": "purchase_price", "orderable": false },
			{ "data": "sale_quantity", "orderable": false },
		/* 	{ "data": "sale_sgst", "orderable": false },
			{ "data": "sale_sgstamt", "orderable": false },
			{ "data": "sale_cgst", "orderable": false },
			{ "data": "sale_cgstamt", "orderable": false }, */
      { "data": "ptotal", "orderable": false },
        { "data": "sale_netamt", "orderable": false },
        //    { "data": "invoice_number", "orderable": false }
         ]
        
    } );
    $('#product').keyup(function (){
	$table.ajax.reload();
	});
    
  });
	
	$('#search').click(function () {
        
        $table.ajax.reload();
    });

    function printDiv(divName) {
    var printContents = document.getElementById('divName').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

  $(document).ready(function() {
	$(".dataExport").click(function() {
		var exportType = $(this).data('type');		
		$('#dataTable1').tableExport({
			type : exportType,			
			escape : 'false',
		ignoreColumn: []
		});		
	});
});
</script>