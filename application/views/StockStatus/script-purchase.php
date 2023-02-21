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
					title:'Item Purchase Report',
					extend: 'copy',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,]
					}
				},
				{
					title:'Item Purchase Report',
					extend: 'excel',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,]
					}
				},
				{
					title:'Item Purchase Report',
					extend: 'pdf',
          footer: 'true',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,]
					}
				},
				{
					title:'Item Purchase Report',
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
                        .column(3, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(3).footer()).html('<center>' + pageTotal + ' (' + json.records_total[0].tqty + ')</center>')


              pageTotal1 = api
                        .column(4, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                
                  $(api.column(4).footer()).html('<center>' + pageTotal1 + ' (' + json.records_total[0].pprice + ')</center>')
        

          


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
            "url": "<?php echo base_url();?>Purchase_Report/getitemPurchase/",
            "type": "POST",
            "data" : function (d) {
                    d.product_id = $("#product_id").val();
					d.start_date = $("#pmsDateStart").val();
                    d.end_date = $("#pmsDateEnd").val();
					//alert(d.product_num);
				}
        },
        "createdRow": function ( row, data, index ) {
          
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(3).css('text-align','center');
            $('td', row).eq(4).css('text-align','center');
            $('td', row).eq(5).css('text-align','center');
		//	$('td', row).eq(4).html('<center><a target ="_blank"  href="<?php echo base_url();?>Mara_purchase/invoice/'+data['auto_invoice']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            },

        "columns": [
            { "data": "purchase_status", "orderable": false },
            { "data": "invoice_number", "orderable": false },
            { "data": "product_name", "orderable": false },
            { "data": "purchase_quantity", "orderable": false },
            { "data": "purchase_price", "orderable": false },
            { "data": "total_price", "orderable": false },
            { "data": "purchase_date", "orderable": false },
           // { "data": "invoice_number", "orderable": false }
         ]
        
    } );
    
  });
	
	$('#search').click(function () {
        $table.ajax.reload();
    });

    $( document ).ready(function() {
        $('.select').select2();
    });



function printDiv(divName) {
 // $(".adrs").css("font-size","10px");
    var printContents = document.getElementById('divName').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    $("#printinvoice").css("display","none");
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