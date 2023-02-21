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
  var param = '';
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
  $(function () {

    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#start_date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
	$('#end_date').datepicker({
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

    $table = $('#Vendor_table').DataTable( {
        "fixedHeader": true, 
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>HSNcode/get",
            "type": "POST",
            "data" : function (d) {

           }
        },
        "createdRow": function ( row, data, index ) {

			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
      $('td', row).eq(4).html(''+data['hsn_igst']+' %');
       $('td', row).eq(5).html(''+data['hsn_sgst']+' %');
        $('td', row).eq(6).html(''+data['hsn_cgst']+' %');
         $('td', row).eq(7).html(''+data['hsn_cess']+' %');
          $('td', row).eq(8).html(''+data['hsn_comcess']+' %');
           $('td', row).eq(9).html(''+data['hsn_flood_cess']+' %');

			$('td', row).eq(10).html('<center><a href="<?php echo base_url();?>HSNcode/edit/'+data['hsn_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['hsn_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },

        "columns": [
            { "data": "hsn_status", "orderable": true },
            { "data": "hsncode", "orderable": false },
           // { "data": "unique_hsncode", "orderable": false },
            { "data": "description", "orderable": false },
			{ "data": "goods_service", "orderable": false },
          { "data": "hsn_igst", "orderable": false },
            { "data": "hsn_sgst", "orderable": false },
             { "data": "hsn_cgst", "orderable": false },
			{ "data": "hsn_cess", "orderable": false },
        { "data": "hsn_comcess", "orderable": false },
          { "data": "hsn_flood_cess", "orderable": false },
			{ "data": "hsn_id", "orderable": false }
        ]

    } );


  });
 function confirmDelete(hsn_id){
    var conf = confirm("Do you want to Delete HSNcode Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>HSNcode/delete",
            data:{hsn_id:hsn_id},
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
</script>
