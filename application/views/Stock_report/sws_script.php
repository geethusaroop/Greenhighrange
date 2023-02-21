<script>
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
      }  
  $(function () {
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

    $table = $('#supplier_wise_report').DataTable( {
        "searching": true,
        "processing": true,
        "serverSide": false,
         "bProcessing": true,
        "bServerSide": true, 
        "bDestroy" : true,
        "paging":   true,
        "ordering": true,
        "info":     true,
         dom: 'lBfrtip',
			buttons: [
					{
						title:'Supplier Wise Stock Report',
						extend: 'copy',
            footer: 'true',
						exportOptions: {
							columns: [ 0,1,2,3,4,5,6,7,8,9,10]
						}
					},
					{
						title:'Supplier Wise Stock Report',
						extend: 'excel',
            footer: 'true',
						exportOptions: {
							columns: [ 0,1,2,3,4,5,6,7,8,9,10]
						}
					},
					{
						title:'Supplier Wise Stock Report',
						extend: 'pdf',
            footer: 'true',
						exportOptions: {
							columns: [ 0,1,2,3,4,5,6,7,8,9,10]
						}
					},
					{
						title:'Supplier Wise Stock Report',
						extend: 'print',
            footer: 'true',
						exportOptions: {
							columns: [ 0,1,2,3,4,5,6,7,8,9,10]
						}
					},
					// {
						// extend: 'csv',
						// exportOptions: {
							// columns: [ 0,1,2,3,4,5 ]
						// }
					// },
			],

     /*  footerCallback: function (row, data, start, end, display) {
           // var api = this.api();
           var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            
                //if (api.column(5).data().length){
               var total = api
               .column(5)
               .data()
               .reduce( function (a, b) {
               return intVal(a) + intVal(b);
               } ) //}
 
            // Total over this page
            pageTotal = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Update footer
         
          $(api.column(5).footer()).html('<center>' + pageTotal + ' ( Rs' + total + ' total)</center>');
        }, */

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
                
                  $(api.column(5).footer()).html('<center>' + pageTotal + ' (' + json.records_total[0].tqty + ')</center>')

                  pageTotal1 = api
                        .column(6, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(6).footer()).html('<center>' + pageTotal1 + ' (' + json.records_total[0].ptqty + ')</center>')

                  pageTotal2 = api
                        .column(7, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(7).footer()).html('<center><i class="fa fa-inr"></i>'+' ' + pageTotal2 + ' (' + parseFloat(json.records_total[0].price).toFixed(2) + ')</center>')


                  pageTotal3 = api
                        .column(8, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(8).footer()).html('<center><i class="fa fa-inr"></i>'+' ' + pageTotal3 + ' (' + parseFloat(json.records_total[0].tprice).toFixed(2) + ')</center>')


              }, 
              

        "ajax": {
            "url": "<?php echo base_url();?>Stock_Reports/getSws/",
            "type": "POST",
            "data" : function (d) {
                    d.start_date = $("#pmsDateStart").val();
                 //   d.end_date = $("#pmsDateEnd").val();
                    d.vendor_id = $("#vendor_id").val();
				}
        },
        "createdRow": function ( row, data, index ) {
            // console.log(data);
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(5).css('text-align','center');
            $('td', row).eq(6).css('text-align','center');
            $('td', row).eq(7).css('text-align','center');
            $('td', row).eq(8).css('text-align','center');
            $('td', row).eq(9).css('text-align','center');
           // $('#pqty').html(data['tqty']);
			},

        "columns": [
            { "data": "purchase_status", "orderable": false },
            { "data": "invoice_number", "orderable": false },
            { "data": "purchase_date", "orderable": false },
            { "data": "product_name", "orderable": false },
            { "data": "product_barcode", "orderable": false },
            { "data": "purchase_quantity", "orderable": false },
			      { "data": "product_quantity", "orderable": false },
            { "data": "purchase_price", "orderable": false },
            { "data": "totals", "orderable": false },
            { "data": "purchase_selling_price", "orderable": false },
            { "data": "vendorname", "orderable": false },
         ]

        
    } );
    
    
  });
	
	$('#search').click(function () {
        $table.ajax.reload();
    });

$(document).ready(function() {
    $('.select').select2();
});

</script>
<script>
       function printDiv(divName) {
 // $(".adrs").css("font-size","10px");
    var printContents = document.getElementById('divName').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  //$(".adrs").css("font-size","13px");
   // $(".adrs").css("padding","0px");
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