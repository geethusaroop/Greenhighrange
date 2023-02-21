<script>  
  $(function () {
	var product_id=$('#product_name').val();
	if(product_id){
		 $('#product_id_fk').val(product_id).change();
	 }
	var vendor_name=$('#vendor_name').val();
	 if(vendor_name){
		 $('#vendor_id_fk').val(vendor_name).change();
	 }
	var tax_id=$('#tax_id').val();
	 if(tax_id){
		 $('#tax_id_fk').val(tax_id);
	 }
	 
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
        
 });    
 
function confirmDelete(purchase_id){
	alert(purchase_id);
	var conf = confirm("Do you want to Delete Purchase ?");
	if(conf){
		$.ajax({
			url:"<?php echo base_url();?>Purchase/delete",
			data:{purchase_id:purchase_id},
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
	
// function addMore() {
	// $("<DIV>").load("", function() {
		// $(this).attr('data-validation','required');
		// $(this).attr('data-validation','nameFields');
		// $(this).attr('data-validation','digitsOnly');
		// $(this).attr('data-validation','date');
		// $(this).attr('data-validation','usPhone');
		// $(this).attr('data-validation','email');
		// $(this).attr('data-validation','dropDown');
		// var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class="col-sm-2"><select name="product_id_fk[]" class="form-control product_num"  id="product_num'+counter+'" autofocus /></select></div><div class="form-group"><div class="col-sm-1"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="mrp'+counter+'" name="mrp[]" placeholder="MRP"></div><div class="form-group"><div class="col-sm-2"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="pquantity_'+counter+'" name="purchase_quantity[]" placeholder="Qty"></div><div class="col-sm-2"><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control price" id="pprice_'+counter+'" name="purchase_price[]" placeholder="Landing Cost"></div><div class="col-sm-2"><select class="form-control amountclass" id="taxtype_'+counter+'" name="taxtype[]"></select></div><div class="col-sm-2"><label>Total Amount :</label><label><span id="totalAmount_'+counter+'"></span></label><input type="hidden" class="totalPrice"  name="purchase_total_price[]" id="total_price_'+counter+'" ><input type="hidden" id="taxpercantage_'+counter+'" ></div></div></tr></table></DIV>';
		// $("#product").append(htmlVal);
		// var param = '';
		// $('#product_num_'+counter+'').focus();
		// $('#product_num_'+counter+'').click(function(){
		// $("#product_num").val('');
		// }); 
		
		// $('#product_num_'+counter+'').change(function(){
		// setTimeout(function(){  
		// var a = $("#productnum_").val();
		// if(a ==='')
        // { 
         // $('#product_num_'+counter+'').val('');
         // var options1 = {
         // 'title': 'Error',
         // 'style': 'error',
         // 'message': 'Product Not Exist....!',
         // 'icon': 'warning',
         // };
		// var n1 = new notify(options1);  
		// if(a === '') {
		 // n1.show();
		// }

       // }
		// }, 1000);
		// });
		
		// $.ajax({
            // type: "POST",
            // url: "<?php echo base_url()?>Purchase/getproductnum",
            // success: function(cities)
            // { 
            
            // $('#product_num'+counter+'').append('<option value="">--Product Number--</option>');
            
            // $.each(cities,function(id,city)
            // {
            // var opt = $('<option />');
            // opt.val(id);
            // opt.text(city);
            // $('#product_num'+counter+'').append(opt);
            // });
        
            // }
            // });
    
    // $.ajax({
            // type: "POST",
            // url: "<?php echo base_url()?>Purchase/gettax",
            // success: function(cities)
            // { 
            
            // $('#taxtype_'+counter+'').append('<option value="">---Select Tax---</option>');
            
            // $.each(cities,function(id,city)
            // {
            // var opt = $('<option />');
            // opt.val(id);
            // opt.text(city);
            // $('#taxtype_'+counter+'').append(opt);
            // });
        
            // }
            // });
	// });	
// counter++;	
// }

     

</script>