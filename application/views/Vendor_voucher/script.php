<script>
  var k = new Date();
var n = k.toString(); 
var c=n.substr(0,34);
var d=c+"(IST)";
 $('#date').html(d);
$(document).on('change','#vouch_name',function(){
	var vouch_id = $(this).val();
	if(vouch_id)	
	{
		$.ajax({
            url:"<?php echo base_url();?>Voucher/get_vouchhead",
            data:{vouch_id:vouch_id},
            type:'POST',
            dataType:"json",
            success:function(data){
				$('#vouchid').val(data[0]['voucherId']);
				$('#finyear').val(data[0]['fin_year']);
            }
		});
	}
});
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  
  $(function () {
	
	$("#vouch_name option:first").before('<option value="">----Please Select----</option>');
	$("#vouch_name").val("").change();
	var ctnm = $('#vouch_id_fk').val();
	if(ctnm){$("#vouch_name").val(ctnm).change();}
	
	//Put our input DOM element into a jQuery Object
	var $jqDate = jQuery('input[name="voucher_date"]');

	//Bind keyup/keydown to the input
	$jqDate.bind('keyup','keydown', function(e){

	//To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
	if(e.which !== 8) {	
		var numChars = $jqDate.val().length;
		if(numChars === 2 || numChars === 5){
			var thisVal = $jqDate.val();
			thisVal += '/';
			$jqDate.val(thisVal);
		}
	}
	});
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      $("#date").datepicker({
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

    
      $('#search').click(function () {
        
        $table.ajax.reload();
    });


    $table = $('#receipt_list').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Vendor_voucher/get",
            "type": "POST",
            "data" : function (d) {
              d.cat_type = $('#cat_type').val();
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(6).html('<center><a href="<?php echo base_url();?>Vendor_voucher/receipt/'+data['voucher_id']+'"><i class="fa fa-file iconFontSize-medium" ></i></a></center>');

			$('td', row).eq(7).html('<center><a href="<?php echo base_url();?>Vendor_voucher/edit/'+data['voucher_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['voucher_id']+','+data['vendor_id']+','+data['voucher_amount']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },

        "columns": [
                    { "data": "voucher_status", "orderable": true },
                    { "data": "voucher_group", "orderable": false },
                    { "data": "vendorname", "orderable": false },
                    { "data": "voucher_date", "orderable": false },
                    { "data": "voucher_amount", "orderable": false },
                  
                    { "data": "narration", "orderable": false },
                    { "data": "voucher_id", "orderable": false },
                    { "data": "voucher_id", "orderable": false }
        ]
        
    } );    
  });

 function confirmDelete(voucher_id,vendor_id,voucher_amount){
    var conf = confirm("Do you want to Delete Voucher Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Vendor_voucher/delete",
            data:{voucher_id:voucher_id,vendor_id:vendor_id,voucher_amount:voucher_amount},
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