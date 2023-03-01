<script>
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  
  $(function () {
	$("#staff_id option:first").before('<option value="">----Please Select----</option>');
	$("#staff_id").val("").change();
	
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      $("#vouch_date").datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
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
        "fixedHeader": true,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
         dom: 'lBfrtip',
        buttons: [
              {
          extend: 'print',
          exportOptions: {
           
          }
        },
        ],
        "ajax": {
            "url": "<?php echo base_url();?>BReceipthead/get",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			$('td', row).eq(3).html('<center><a href="<?php echo base_url();?>BReceipthead/edit/'+data['receipt_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['receipt_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },
        "columns": [
            { "data": "receipt_status", "orderable": true },
            { "data": "receipt_head", "orderable": false },
      			{ "data": "receipt_desc", "orderable": false },
      			{ "data": "receipt_id", "orderable": false }
        ]
        
    } );    
  });
 function confirmDelete(receipt_id){
    var conf = confirm("Do you want to Delete Receipthead Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>BReceipthead/delete",
            data:{receipt_id:receipt_id},
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