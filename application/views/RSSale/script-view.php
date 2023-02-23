<script>

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

    $('#search').click(function () {
        $table.ajax.reload();
    });

    $table = $('#sale_details_table').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>RSSale/getview/",
            "type": "POST",
            "data" : function (d) {
                    d.product_num = $("#product").val();
                    d.start_date = $("#pmsDateStart").val();
                    d.end_date = $("#pmsDateEnd").val();
                    //alert(d.start_date);
           }
        },
        "createdRow": function ( row, data, index ) {
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
             $('td', row).eq(2).css('color','red');
            $('td', row).eq(12).html('<center><a target ="_blank"  href="<?php echo base_url();?>RSSale/invoiceview/'+data['invoice_number']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            },
        "columns": [
            { "data": "sale_status", "orderable": false },
            {
                    "data": "sale_dates",
                    "orderable": false
                },
                {
                    "data": "invoice_number",
                    "orderable": false
                },
                {
                    "data": "member_name",
                    "orderable": false
                },
               
                {
                    "data": "qty",
                    "orderable": false
                },
                {
                    "data": "total",
                    "orderable": false
                },
                {
                    "data": "sale_old_balance",
                    "orderable": false
                },
                {
                    "data": "discount",
                    "orderable": false
                },
                {
                    "data": "sale_shareholder_discount",
                    "orderable": false
                },
                {
                    "data": "tprice",
                    "orderable": false
                },
                {
                    "data": "sale_paid_amount",
                    "orderable": false
                },
                {
                    "data": "sale_new_balance",
                    "orderable": false
                },
                {
                    "data": "sale_id",
                    "orderable": false
                },
              
         ]
    } );
    $('#product').keyup(function (){
    $table.ajax.reload();
    });
  });



</script>
