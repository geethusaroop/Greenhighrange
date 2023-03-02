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
	$("#unit option:first").before('<option value="">----Please Select---</option>');
	$("#unit").val("").change();
	var ctnm = $('#branch_unit').val();
	if(ctnm){$("#unit").val(ctnm).change();}
    $(".select2").select2();

	$("#animator option:first").before('<option value="">----Please Select---</option>');
	$("#animator").val("").change();
	var ctnm = $('#branch_animator').val();
	if(ctnm){$("#animator").val(ctnm).change();}
    $(".select2").select2();
    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
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

    $table = $('#classinfo_table').DataTable( {
        "fixedHeader": true,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Branch_transfer/get/",
            "type": "POST",
            "data" : function (d) {
              d.sdate = $('#sdate').val();
           }
        },
        "createdRow": function ( row, data, index ) {
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });

         //   $('td', row).eq(7).html('<center><a href="<?php echo base_url();?>index.php/Branch_transfer/edit/'+data['bt_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['bt_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },
        "columns": [
            { "data": "bt_status", "orderable": false },
            { "data": "bt_dates", "orderable": false },
            { "data": "product_name", "orderable": false },
      			{ "data": "branch_name", "orderable": false },
      			{ "data": "bt_stock", "orderable": false },
          
           // { "data": "bt_id", "orderable": false }

        ]

    } );


  });
function confirmDelete(bt_id){
    var conf = confirm("Do you want to Delete Class ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Branch_transfer/delete",
            data:{bt_id:bt_id},
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

  $('#prod_name').on('change',function(){
    var prod_id = this.value;
    $.ajax({
            url:"<?php echo base_url();?>Branch_transfer/getAvailStock",
            data:{prod_id:prod_id},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                $('#av_stk').val(options.product_stock);
                $('#av_stk').html(options.product_stock);

                $('#prod_code').val(options.product_code);
                $('#prod_code').html(options.product_code);

                $('#product_name').val(options.product_name);
                $('#product_name').html(options.product_name);

                $('#product_unit').val(options.product_unit);
                $('#product_unit').html(options.product_unit);

                $('#product_hsn').val(options.product_hsn);
                $('#product_hsn').html(options.product_hsn);

                $('#product_hsncode').val(options.product_hsncode);
                $('#product_hsncode').html(options.product_hsncode);

                $('#product_price_r1').val(options.product_price_r1);
                $('#product_price_r1').html(options.product_price_r1);

                $('#product_price_r2').val(options.product_price_r2);
                $('#product_price_r2').html(options.product_price_r2);

                $('#product_price_r3').val(options.product_price_r3);
                $('#product_price_r3').html(options.product_price_r3);

                $('#product_des').val(options.product_des);
                $('#product_des').html(options.product_des);

                $('#product_category').val(options.product_category);
                $('#product_category').html(options.product_category);

                $('#product_unit_type').val(options.product_unit_type);
                $('#product_unit_type').html(options.product_unit_type);
            }
        });
  })
</script>
