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
            columns: [ 1, 2]
           
          }
        },
        ],
        "ajax": {
            "url": "<?php echo base_url();?>BVoucherhead/get",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			$('td', row).eq(3).html('<center><a href="<?php echo base_url();?>BVoucherhead/edit/'+data['vouch_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['vouch_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },
        "columns": [
            { "data": "vouch_status", "orderable": true },
            { "data": "vouch_head", "orderable": false },
      			{ "data": "vouch_desc", "orderable": false },
      			{ "data": "vouch_id", "orderable": false }
        ]
        
    } );    
  });
 function confirmDelete(vouch_id){
    var conf = confirm("Do you want to Delete BVoucherhead Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>BVoucherhead/delete",
            data:{vouch_id:vouch_id},
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