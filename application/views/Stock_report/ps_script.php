<script>
  var response = $("#response").val();
  if (response) {
    console.log(response, 'response');
    var options = $.parseJSON(response);
    noty(options);
  }
  $(function() {
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {
      "placeholder": "dd/mm/yyyy"
    });
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

    $table = $('#supplier_wise_report').DataTable({

      "footerCallback": function(tfoot, data, start, end, display) {
            var api = this.api();
            var intVal = function(i) {
              return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            var json = api.ajax.json();
            console.log(json);
            //var total= $( api.column(5).footer() ).html(json.records_total[0].tqty);
            //var total= $( api.column(5).footer() ).html(json.records_total[0].tqty);


            pageTotal = api
              .column(5, {
                page: 'current'
              })
              .data()
              .reduce(function(a, b) {
                return intVal(a) + intVal(b);
              }, 0);

            // Update footer

            $(api.column(5).footer()).html('<center><b>' + pageTotal + ' (' + json.records_sum[0].pqty + ')</b></center>')


          },

      "searching": false,
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      "paging": true,
      "ordering": false,
      "info": false,
    /*   aLengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "ALL"]
    ], */
    //iDisplayLength: -1,
      dom: 'lBfrtip',
      buttons: [{
          title: 'Physical Stock Report',
          extend: 'copy',
          footer: 'true',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6,]
          }
        },
        {
          title: 'Physical Stock Report',
          extend: 'excel',
          footer: 'true',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6,]
          }
        },
        {
          title: 'Physical Stock Report',
          extend: 'pdf',
          footer: 'true',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6,]
          }
        },
        {
          title: 'Physical Stock Report',
          extend: 'print',
          footer: 'true',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6,]
          }
        },
        // {
        // extend: 'csv',
        // exportOptions: {
        // columns: [ 0,1,2,3,4,5 ]
        // }
        // },
      ],

        

      "ajax": {
        "url": "<?php echo base_url(); ?>Stock_Reports/getPS/",
        "type": "POST",
        "data": function(d) {
          d.start_date = $("#pmsDateStart").val();
          d.end_date = $("#pmsDateEnd").val();
          d.product_name = $("#product_name").val();
          d.product_id = $("#pbar1").val();
          //alert(d.product_name);
        }
      },
      "createdRow": function(row, data, index) {
        // console.log(data);
        $table.column(0).nodes().each(function(node, index, dt) {
          $table.cell(node).data(index + 1);
        });
        $('td', row).eq(3).css('text-align', 'center');
        $('td', row).eq(4).css('text-align', 'center');
        $('td', row).eq(5).css('text-align', 'center');
        $('td', row).eq(6).css('text-align', 'center');
      },

      "columns": [{
          "data": "product_status",
          "orderable": false
        },
        {
          "data": "product_name",
          "orderable": false
        },
        {
          "data": "product_barcode",
          "orderable": false
        },
        {
          "data": "open_stock",
          "orderable": false
        },
      /*   {
          "data": "min_stock",
          "orderable": false
        }, */
        {
          "data": "product_quantity",
          "orderable": false
        },
        {
          "data": "product_price",
          "orderable": false
        },
        {
          "data": "selling_price",
          "orderable": false
        },
      ]

    });


  });

  $('#search').click(function() {
    $table.ajax.reload();
  });

  $(document).ready(function() {
    $('.select').select2();
  });

  // $('#product_id').on('change',function(){
  //   var prod_name = this.value;
  //   $.ajax({
  //     url:"<?php echo base_url(); ?>Stock_Reports/getprodbarcodes",
  //     data:{prod_name:prod_name},
  //     method:"POST",
  //     datatype:"json",
  //     success:function(data){
  //       var options = $.parseJSON(data);
  //       console.log(options);

  // }

  // });
  // })

  $('#product_name').change(function() {
    var reg = $(this).val();
    //alert(reg);

    $.ajax({
      url: "<?php echo base_url(); ?>Sale/fetch_list",
      method: "POST",
      data: {
        reg: reg
      },
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '';
        html += '<option value="">--Select Barcode--</option>';
        html += '<option value="">Barcode - Price - Stock</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value=' + data[i].product_barcodes + '>' + data[i].product_barcodes + ' - ' + data[i].selling_price + ' - ' + data[i].product_quantity + '</option>';
        }
        $('#pbar1').html(html);

      }
    });
    return false;
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