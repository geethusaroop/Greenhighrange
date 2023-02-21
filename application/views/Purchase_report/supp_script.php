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
        "paging":   true,
        "ordering": true,
        "info":     true,
         dom: 'lBfrtip',
			buttons: [
				{
					title:'Purchase Report',
					extend: 'copy',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,]
					}
				},
				{
					title:'Purchase Report',
					extend: 'excel',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,]
					}
				},
				{
					title:'Purchase Report',
					extend: 'pdf',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,]
					}
				},
				{
					title:'Purchase Report',
					extend: 'print',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,]
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
                        .column(4, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(4).footer()).html('<center>' + pageTotal + ' (' + json.records_total[0].tqty + ')</center>')


                  pageTotal3 = api
                        .column(5, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(5).footer()).html('<center><i class="fa fa-inr"></i>'+' ' + pageTotal3 + ' (' + parseFloat(json.records_total[0].tprice).toFixed(2) + ')</center>')


              }, 

        "ajax": {
            "url": "<?php echo base_url();?>Purchase_Report/get/",
            "type": "POST",
            "data" : function (d) {
                    d.vendor_id = $("#vendor_id").val();
					d.start_date = $("#pmsDateStart").val();
                    d.end_date = $("#pmsDateEnd").val();
					//alert(d.product_num);
				}
        },
        "createdRow": function ( row, data, index ) {
          
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(4).css('text-align','center');
            $('td', row).eq(5).css('text-align','center');
			$('td', row).eq(6).html('<center><a target ="_blank"  href="<?php echo base_url();?>Mara_purchase/invoice/'+data['auto_invoice']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            },

        "columns": [
            { "data": "purchase_status", "orderable": false },
            { "data": "invoice_number", "orderable": false },
            { "data": "vendorname", "orderable": false },
            { "data": "purchase_dates", "orderable": false },
            { "data": "prcount", "orderable": false },
            { "data": "total", "orderable": false },
            { "data": "invoice_number", "orderable": false }
         ]
        
    } );
    
  });
	
	$('#search').click(function () {
        $table.ajax.reload();
    });

    $( document ).ready(function() {
        $('.select').select2();
    });

    function printDiv() {    
    let printContents, popupWin;
        printContents = document.getElementById('divName').innerHTML;
        popupWin = window.open('', '_blank', 'height=100%,width=100%');
        popupWin.document.open();
        popupWin.document.write(`
        <style>
        @media print {

          #printinvoice {
            display: none;
          }

          p.ex1 {
            display: none;
          }
        }

        
        </style>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>KSSS</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" media='all'>
        </head>
        <body onload="window.print();window.close()">${printContents}</body>
          </html>`
        );
        popupWin.document.close();
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