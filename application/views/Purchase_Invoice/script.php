<script>

$(document).ready(function() {
$("form").submit(function(e){
var c = 0;
$('.table-bordered').each(function(){
    c++;
});

    var total = $('#tax_total').val();
    var diff = $('#checkvalue').val();
    var total = parseFloat(total);
    var diff = parseFloat(diff);
    if(c==0)
    {

        e.preventDefault(e);

        var options1 = {
        'title': 'Error',
        'style': 'error',
        'message': 'Please Enter Products....!',
        'icon': 'warning',
        };
        var n1 = new notify(options1);

        n1.show();
        setTimeout(function(){  
        n1.hide();
       }, 3000);
    }
   else
    {

    }

});
});

var counter = 0;
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
      }

function addMore() {
	$("<DIV>").load("", function() {
		$(this).attr('data-validation','required');
		$(this).attr('data-validation','nameFields');
		$(this).attr('data-validation','digitsOnly');
		$(this).attr('data-validation','date');
		$(this).attr('data-validation','usPhone');
		$(this).attr('data-validation','email');
		$(this).attr('data-validation','dropDown');
		var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class="col-sm-2"><input type="text" data-pms-required="true" data-validation="required" autofocus name="product_name[]" id="product_name_'+counter+'" class="form-control product_name" placeholder="product name"/><input type="hidden"  name="product_id_fk[]" id="product_id_'+counter+'" class="form-control"/></div><div class="col-sm-2"><input type="text" data-pms-required="true" disabled data-validation="required" name="product_category[]" id="product_category_'+counter+'" class="form-control" placeholder="Category"/><input type="hidden"  name="category_id_fk[]" id="category_id_'+counter+'" class="form-control"/></div><div class="form-group"><div class="col-sm-2"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="pquantity_'+counter+'" name="purchase_quantity[]" placeholder="Qty"></div><div class="col-sm-2"><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control price" id="pprice_'+counter+'" name="purchase_price[]" placeholder="Purchase Price"></div><div class="col-sm-2"><select class="form-control amountclass" id="taxtype_'+counter+'" name="taxtype[]"></select></div><div class=""><label>Total Amount :</label><label><span id="totalAmount_'+counter+'"></span></label><input type="hidden" class="totalPrice"  name="purchase_total_price[]" id="total_price_'+counter+'" ><input type="hidden" id="taxpercantage_'+counter+'" ></div></div></tr></table></DIV>';
		$("#product").append(htmlVal);
		var param = '';
		var $productList=[ {'columnName':'product_name','label':'Product'}];
		$('#product_name_'+counter+'').rcm_autoComplete('<?php echo base_url();?>common/getProductList',$productList,param,getProductName);
		$('#product_name_'+counter+'').focus();
		$('#product_name_'+counter+'').click(function(){
		$("#productname_").val('');
		}); 
		
		$('#product_name_'+counter+'').change(function(){
		setTimeout(function(){  
		var a = $("#productname_").val();
		if(a ==='')
        { 
         $('#product_name_'+counter+'').val('');
         var options1 = {
         'title': 'Error',
         'style': 'error',
         'message': 'Product Not Exist....!',
         'icon': 'warning',
         };
		var n1 = new notify(options1);  
		if(a === '') {
		 n1.show();
		}

       }
		}, 1000);
		});
    
    $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>Purchase/gettax",
            success: function(cities)
            { 
            
            $('#taxtype_'+counter+'').append('<option value="">---Please Select---</option>');
            
            $.each(cities,function(id,city)
            {
            var opt = $('<option />');
            opt.val(id);
            opt.text(city);
            $('#taxtype_'+counter+'').append(opt);
            });
        
            }
            });
	});	
counter++;	
}
$(document).on("change",'.amountclass',function(){
    var taxtype = $(this).val();
    var counterId = $(this).attr("id");
	var counter = counterId.split("_")[1];
    console.log(counterId,"counterID");
    console.log(counter,"counter");
    if(taxtype)
        {
            $.ajax({
            url:"<?php echo base_url()?>Purchase/tax_amount",
            type: 'POST',
            data: {value:taxtype},
            dataType: 'json',
            success:
            function(data)
            {
				$('#taxpercantage_'+counter+'').val(data['taxamount']);
				var amount = $('#pprice_'+counter+'').val();
				var quantity = $('#pquantity_'+counter+'').val();
				var tax = $('#taxpercantage_'+counter+'').val();
				if(tax !== '' && quantity !=='' && amount !=='')
				{
				amount = parseFloat(quantity) * parseFloat(amount); 
				var amount_divide = parseFloat(amount)/100;
				var percantage = parseFloat(amount_divide) * parseFloat(tax);  
				var Rowtotal = parseFloat(percantage) + parseFloat(amount);
				$('#totalAmount_'+counter+'').html(parseFloat(Rowtotal).toFixed(2));
				$('#total_price_'+counter+'').val(parseFloat(Rowtotal).toFixed(2));
				var netTotal = 0;
				$( ".totalPrice" ).each(function( index ) {
				netTotal = netTotal + parseFloat($( this ).val());
				});
				$(".NetTotalAmount").css('display','block');
				$('#grand_total').html(parseFloat(netTotal).toFixed(2));
				var expensetotal = $('#expensetotal').val();
				var grandtotal = $('#grandtotal').val();
				$('#net_total').val((netTotal).toFixed(2));
				}
				else{
					Rowtotal = 0;
				}
            },
            error:function(e){
            console.log("error");
            }
            });
        }
});
$(document).on("change",'.quantity',function(){
        var counterId = $(this).attr("id");
		var counter = counterId.split("_")[1];
        console.log(counterId,"counterID");
        console.log(counter,"counter");
        var amount = $('#pprice_'+counter+'').val();
        var quantity = $('#pquantity_'+counter+'').val();
        var tax = $('#taxpercantage_'+counter+'').val();
        if(tax !== '' && quantity !=='' && amount !==''){
        amount = parseFloat(quantity) * parseFloat(amount);
        var amount_divide = parseFloat(amount)/100;
        var percantage = parseFloat(amount_divide) * parseFloat(tax);  
        var Rowtotal = parseFloat(percantage) + parseFloat(amount);
        $('#totalAmount_'+counter+'').html(parseFloat(Rowtotal).toFixed(2));
        $('#total_price_'+counter+'').val(parseFloat(Rowtotal).toFixed(2));
        var netTotal = 0;
		$( ".totalPrice" ).each(function( index ) {
		netTotal = netTotal + parseFloat($( this ).val());
		});
        $(".NetTotalAmount").css('display','block');
        $('#grand_total').html(parseFloat(netTotal).toFixed(2));
        var expensetotal = $('#expensetotal').val();
        var grandtotal = $('#grandtotal').val();
        $('#net_total').val((netTotal).toFixed(2));
        }
        else{
            Rowtotal = 0;
        }
    });
$(document).on("change",'.price',function(){
        var counterId = $(this).attr("id");
		var counter = counterId.split("_")[1];
        console.log(counterId,"counterID");
        console.log(counter,"counter");
        var amount = $('#pprice_'+counter+'').val();
        var quantity = $('#pquantity_'+counter+'').val();
        var tax = $('#taxpercantage_'+counter+'').val();
        if(tax !== '' && quantity !=='' && amount !==''){
        amount = parseFloat(quantity) * parseFloat(amount);
        var amount_divide = parseFloat(amount)/100;
        var percantage = parseFloat(amount_divide) * parseFloat(tax);  
        var Rowtotal = parseFloat(percantage) + parseFloat(amount);
        $('#totalAmount_'+counter+'').html(parseFloat(Rowtotal).toFixed(2));
        $('#total_price_'+counter+'').val(parseFloat(Rowtotal).toFixed(2));
        var netTotal = 0;
		$( ".totalPrice" ).each(function( index ) {
		netTotal = netTotal + parseFloat($( this ).val());
		});
        $(".NetTotalAmount").css('display','block');
        $('#grand_total').html(parseFloat(netTotal).toFixed(2));
        var expensetotal = $('#expensetotal').val();
        var grandtotal = $('#grandtotal').val();
        $('#net_total').val((netTotal).toFixed(2));
        }
        else{
            Rowtotal = 0;
        }
            
    });
	var $productList=[ {'columnName':'product_name','label':'Product'}];
	var param = '';
	$('#product_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productList,param,getProduct);
	function getProduct(el,event,item){
		   console.log(el);
		   console.log(el.next());
		   if(item.product_id){
			el.val(item.product_name);
			$('#product_id').val(item.product_id);
			}
	}  
  $(function () {
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

    $table = $('#product_details_table').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				{
                                    extend: 'copy',
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [ 0,1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                {
                                    extend: 'csv',
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/purchase/get/",
            "type": "POST",
            "data" : function (d) {
                    d.purchase_invoice_no = $("#purchase_invoice_no").val();
                    d.product_id = $("#product_id").val();
                    d.vendor_name = $("#vendor_name").val();
                    d.purchase_invoice_number = $("#purchase_invoice_number").val();
                    d.start_date = $("#pmsDateStart").val();
                    d.end_date = $("#pmsDateEnd").val();

           }
        },
        "createdRow": function ( row, data, index ) {
          
            var totalPrice = data['pur_totalPrice'];
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td',row).eq(8).html(parseFloat(totalPrice).toFixed(2));
            $('td', row).eq(10).html('<center><a target ="_blank" href="<?php echo base_url();?>index.php/purchase/view/'+data['purchase_invoice_no']+'/'+data['vendor_id']+'"><i class="fa fa-eye" ></i></a> &nbsp;&nbsp;&nbsp; <a target ="_blank"  href="<?php echo base_url();?>index.php/purchase/invoice/'+data['purchase_invoice_no']+'/'+data['vendor_id']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            $('td', row).eq(11).html('<center><a href="<?php echo base_url();?>index.php/purchase/edit/'+data['purchase_invoice_no']+'/'+data['vendor_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['purchase_invoice_no']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
          
        },

        "columns": [
            { "data": "purchase_id", "orderable": false },
            { "data": "purchase_invoice_no", "orderable": false },
            { "data": "purchase_invoice_number", "orderable": false },
            { "data": "vendor_name", "orderable": false },
            { "data": "vendor_phone", "orderable": false },
            { "data": "vender_mail", "orderable": false },
            { "data": "purchase_date", "orderable": false },
            { "data": "purchase_count", "orderable": false },
            { "data": "pur_totalPrice", "orderable": false },
            { "data": "purchase_remarks", "orderable": false },
            { "data": "purchase_invoice_no", "orderable": false },
            { "data": "purchase_invoice_no", "orderable": false }
         ]
        
    } );
    
    
  });
  // $(document).on('click','#print', function(){
	 //  window.print();
  // });
// Auto Searching//

	$(document).on("click","#vendor_name",function(){
		var param='';
		  console.log("vendor name append");
		  var $vendorList=[ {'columnName':'vendorname','label':'Name'}];
		  $('#vendor_name').rcm_autoComplete('<?php echo base_url();?>common/getVendorList',$vendorList,param,getVendorName);
		
	});
	function getVendorName(el,event,item){
        console.log(item);
        if(item.vendor_id){
		el.val(item.vendorname);
		$("#vendor_id").val(item.vendor_id);
		$("#vendor_phone").val(item.vendor_phone);
		$("#vendorgst").val(item.vendorgst);
        }
    }
	
$(document).on("click","#Product_name",function(){
    var param='';
      console.log("customer name append");
      var $productName=[ {'columnName':'product_name','label':'Product'}];
      $('#Product_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productName,param,getProductNameEdit);
    
  });
  
   function getProductNameEdit(el,event,item){
        console.log(item);
        if(item.product_id){
            el.val(item.product_name);
            $("#Category_name").val(item.category_name);
            $("#Size_name").val(item.size_name);
            $("#Color_name").val(item.color_name);
            $("#Product_id").val(item.product_id);  
        }
    }
function GenBarcode(purchase_id){
    var conf = confirm("Do you want to GenerateBarcode ?");
    
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/purchase/generateBarcode",
            data:{purchase_invoice_no:purchase_invoice_no},
            
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
function confirmDelete(purchase_invoice_no){
    var conf = confirm("Do you want to Delete Purchase Details ?");
    
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/purchase/delete",
            data:{purchase_invoice_no:purchase_invoice_no},
            
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
	
	$('#search').click(function () {
        
        $table.ajax.reload();
    });
	
	function getProductName(el,event,item){
       
       console.log(el);
       console.log(el.next());
       
        if(item.product_id){
            el.val(item.product_name);
            var productId = el.next().attr("id");
            var lastChar = productId.split("_")[2];
            $("#"+el.next().attr("id")).val(item.product_id);
            $("#amount_"+lastChar).val(item.product_id);
            $("#product_category_"+lastChar).val(item.category_name);
            $("#category_id_"+lastChar).val(item.category_id_fk);
            $("#productname_").val(item.product_name);
            var check = $("#product_id_"+lastChar).val();
                        for(var i=1;i<=counter;i++)
                        {
                            if(i==lastChar)
                            {
                            }else{
                                if($('#product_id_'+i+'').val() == check)
                                { 
                                    
                                    $("#product_id_"+lastChar).val('');
                                    $("#product_name_"+lastChar).val('');
                                    $("#amount_"+lastChar).val('');
                                    $("#product_category_"+lastChar).val('');
                                    $("#category_id_"+lastChar).val('');
                                    $("#size_"+lastChar).val('');
                                    $("#size_id_fk_"+lastChar).val('');
                                    $("#color_"+lastChar).val('');
                                    $("#color_id_"+lastChar);
                                    
                                    var options1 = {
                                        'title': 'Error',
                                        'style': 'error',
                                        'message': 'Product Already Exist....!',
                                        'icon': 'warning',
                                        };
                                 var n1 = new notify(options1);  
                                 var n1Val = $("#product_name_"+lastChar).val();
                                 if(n1Val === '') {
                                    n1.show();
                                    setTimeout(function(){  
                                    n1.hide();
                                    }, 2000);
                                    $("#product_id_"+lastChar).val('');
                                  }
                                  
                                }
                            }
                        }
			}
                        
    }
	$(document).on("blur",".amountclass",function(){
        var quantity = $("#quantity").val();
        var amount = $("#amount").val();
        if(quantity != '' && amount !=''){
            totalamount = parseFloat(quantity) * parseFloat(amount);
        }
        else{
            totalamount = 0;
        }
        $("#totalAmount").html(parseFloat(totalamount).toFixed(2));
        $("#total_price").val(parseFloat(totalamount).toFixed(2));
    })
	
	$(document).ready(function() {
    $('.select1').toggle();
    $(document).click(function(e) {
  $('.select1').attr('size',0);
});
});
$(document).on('change','#include_tax', function(){
    var includeTax = $("#include_tax").val();
    if(includeTax =='1'){
        $('#taxClass').show();
    }
    else {
       $('#taxClass').hide();
       //$('taxClass').val(2);
   }
    });
function deleteRow() {
	$('DIV.product-item').each(function(index, item){
		jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
				$(item).remove();
            }
        });
	});
}
function printDiv(divName) {
    var printContents = document.getElementById('divName').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
$(document).on('click','#update', function(){
    var conf = confirm("Do you want to Edit details?");
    //alert(conf);
    var vendor_id = $("#vendor_id").val();
    var customer_name = $("#Customer_name").val();
    var vendor_address = $("#vendor_address").val();
    var vender_mail = $("#vender_mail").val();
    var vendor_phone = $("#vendor_phone").val();
    var vendor_tin = $("#vendor_tin").val();
    var vendor_pin = $("#vendor_pin").val();
    var date = $("#date").val();
    var purchase_remarks = $("#purchase_remarks").val();
    var include_bill = $("#include_bill").val();
    var invoice_no = $("#invoice_no").val();
    var purchase_invoice_number = $("#vendor_invoice").val();
    
    if(conf == true){
        $.ajax({
            url:"<?php echo base_url();?>index.php/purchase/edit_vendor",
            data:{
                vendor_id:vendor_id,
                customer_name:customer_name,
                vendor_address:vendor_address,
                vender_mail:vender_mail,
                vendor_phone:vendor_phone,
                vendor_tin:vendor_tin,
                vendor_pin:vendor_pin,
                date:date,
                include_bill:include_bill,
                purchase_invoice_number:purchase_invoice_number,
                purchase_remarks:purchase_remarks,
                invoice_no:invoice_no
                
            },
            
            method:"POST",
            datatype:"json",
            success:function(data){
               var options = $.parseJSON(data);
              noty(options);
               location.reload();
            },
            error:function(e){
            console.log("error");
        }
        });

    }
    else{
    //location.reload();
    }
    
    
    });
    //var i=0;
    function confirmUpdate(id){
    var conf = confirm("Do you want to Edit details?");
    if(conf){
        $('#EditPurchase').modal();
        $.ajax({
        url:"<?php echo base_url();?>index.php/purchase/editRow",
        type: 'POST',
       data:{purchase_id:id},
        dataType: 'json',
        success:
        function(data)
        {

               document.getElementById('Purchase_id').value=data[0]['purchase_id'];
               document.getElementById('Product_name').value=data[0]['product_name'];
               document.getElementById('Product_id').value=data[0]['product_id'];
               document.getElementById('old_product_id').value=data[0]['product_id'];
               document.getElementById('Category_name').value=data[0]['category_name'];
               document.getElementById('Size_name').value=data[0]['size_name'];
               $("#rowtotal").val(data[0]['purchase_total_price']);
               $("#grand").val(data[0]['purchase_grandd_total']);
               $("#grandtotal").val(data[0]['purchase_grandd_total']);
               $('#tax_type').val(data[0]['tax_id_fk']).change();
               document.getElementById('Color_name').value=data[0]['color_name'];
               document.getElementById('Purchase_qty').value=data[0]['product_purchase_quantity'];
               document.getElementById('Sale_qty').value=data[0]['purchase_return_qty'];
               document.getElementById('Purchase_rte').value=data[0]['purchase_price'];
               document.getElementById('Sale_price').value=data[0]['sale_price'];
               document.getElementById('Total_purchase').value=data[0]['purchase_total_price'];
               $("#PurchaseTotal").html(data[0]['purchase_total_price']);
               //document.getElementById('Description').value=data[0]['purchase_remarks'];
               
        },
        error:function(e){
        console.log("error");
        }
      
      });
      
       
    }
}
$(document).on("change",'#tax_type',function(){
    var taxtype = $(this).val();
    if(taxtype)
        {
            $.ajax({
            url:"<?php echo base_url()?>Purchase/tax_amount",
            type: 'POST',
            data: {value:taxtype},
            dataType: 'json',
            success:
            function(data)
            {
                $('#taxpercantage').val(data['tax_amount']);
                var amount = $('#Purchase_rte').val();
                var quantity = $('#Purchase_qty').val();
                var tax = $('#taxpercantage').val();
                var rowtot = $('#rowtotal').val();
                var grand = $('#grand').val();
                if(tax !== '' && quantity !=='' && amount !==''){
                amount = parseFloat(quantity) * parseFloat(amount); 
                var amount_divide = parseFloat(amount)/100;
                var percantage = parseFloat(amount_divide) * parseFloat(tax);  
                var Rowtotal = parseFloat(percantage) + parseFloat(amount);
                grand = parseFloat(grand) - parseFloat(rowtot);
                grand = parseFloat(grand) + parseFloat(Rowtotal);
                $('#grandtotal').val(grand);
                $('#PurchaseTotal').html(Rowtotal);
                $('#Total_purchase').val(Rowtotal);
                }
            },
            error:function(e){
            console.log("error");
            }
            });
        }
});
$(document).on('change','#Purchase_qty', function(){
        var  Purchase_qty= $("#Purchase_qty").val();
        var  Purchase_rte= $("#Purchase_rte").val();
        var total = Purchase_qty * Purchase_rte;
        $("#Total_purchase").val(parseFloat(total).toFixed(2));
        
        var amount = $('#Purchase_rte').val();
        var quantity = $('#Purchase_qty').val();
        var tax = $('#taxpercantage').val();
        var rowtot = $('#rowtotal').val();
        var grand = $('#grand').val();
        if(tax !== '' && quantity !=='' && amount !==''){
        amount = parseFloat(quantity) * parseFloat(amount); 
        var amount_divide = parseFloat(amount)/100;
        var percantage = parseFloat(amount_divide) * parseFloat(tax);  
        var Rowtotal = parseFloat(percantage) + parseFloat(amount);
        grand = parseFloat(grand) - parseFloat(rowtot);
        grand = parseFloat(grand) + parseFloat(Rowtotal);
        $('#grandtotal').val(grand);
        $('#PurchaseTotal').html(Rowtotal);
        $('#Total_purchase').val(Rowtotal);
        }
});
$(document).on('change','#Purchase_rte', function(){
        var  Purchase_qty= $("#Purchase_qty").val();
        var  Purchase_rte= $("#Purchase_rte").val();
        var total = Purchase_qty * Purchase_rte;
        $("#Total_purchase").val(parseFloat(total).toFixed(2));
        
        var amount = $('#Purchase_rte').val();
        var quantity = $('#Purchase_qty').val();
        var tax = $('#taxpercantage').val();
        var rowtot = $('#rowtotal').val();
        var grand = $('#grand').val();
        if(tax !== '' && quantity !=='' && amount !==''){
        amount = parseFloat(quantity) * parseFloat(amount); 
        var amount_divide = parseFloat(amount)/100;
        var percantage = parseFloat(amount_divide) * parseFloat(tax);  
        var Rowtotal = parseFloat(percantage) + parseFloat(amount);
        grand = parseFloat(grand) - parseFloat(rowtot);
        grand = parseFloat(grand) + parseFloat(Rowtotal);
        $('#grandtotal').val(grand);
        $('#PurchaseTotal').html(Rowtotal);
        $('#Total_purchase').val(Rowtotal);
        }
        
});
$(document).on('change','#Purchase_qty', function(){
    var Product_id = $('#Product_id').val();
    var old_product_id = $("#old_product_id").val(); 
    var  Purchase_qty= $("#Purchase_qty").val();
        var Quantity = parseFloat(Purchase_qty);
            var sale_qty = $('#Sale_qty').val();
            var sale_Qty = parseFloat(sale_qty);
           if(Quantity <= sale_Qty){
               alert('The Quantity Should Be above '+sale_qty);
               $("#Purchase_qty").val('');
        }
    });
$(document).on('blur','#Product_name', function(){
var Product_id = $('#Product_id').val();
var old_product_id = $("#old_product_id").val(); 
var  Purchase_qty= $("#Purchase_qty").val();
    var Quantity = parseFloat(Purchase_qty);
        var sale_qty = $('#Sale_qty').val();
        var sale_Qty = parseFloat(sale_qty);
        if(old_product_id != Product_id) {
       if(Quantity == sale_Qty){
           alert('The Quantity Should Be above '+sale_qty);
           $("#Purchase_qty").val('');
    }
}
});
        

function AddPurchase(){
  var Purchase_id = $('#Purchase_id').val();
  var Product_id = $('#Product_id').val();
  var Purchase_qty =$("#Purchase_qty").val();
  var Purchase_rte = $("#Purchase_rte").val();
  var Sale_rate = $("#Sale_price").val();
  var Total_purchase = $("#Total_purchase").val();
  var Tax_class = $("#tax_type").val();
  var grandtotal = $("#grandtotal").val();
  var invoice_no = $("#invoice_no").val();
  
  if(!/^[0-9]+$/.test(Purchase_qty) || !/^[.0-9]+$/.test(Purchase_rte) || !/^[.0-9]+$/.test(Sale_rate)){ 
//     $('#EditSale').modal('hide');

  }
  else if(Purchase_qty ==='' || Purchase_rte ==='' || Sale_rate ==='')
  {
     
  }
  //alert(Sale_rate);
 // alert(Total_purchase);
 else{
    $('#EditPurchase').modal('hide');
  if(Purchase_id)
  {
      $.ajax({
        url:"<?php echo base_url();?>index.php/Purchase/editUpdate",
        
            data:{purchase_id:Purchase_id,
                  product_id:Product_id,
                  product_purchase_quantity:Purchase_qty,
                  purchase_price:Purchase_rte,
                  sale_price:Sale_rate,
                  purchase_total_price:Total_purchase,
                  tax_id_fk:Tax_class,
                  grandtotal:grandtotal,
                  invoice_no:invoice_no
              },
                      
            method:"POST",
            datatype:"json",
            success:function(data){
                
				var options = {
				'title': 'Success...',
				'style': 'success',
				'message': 'product Edited Successfully....!',
				'icon': 'Success',
				};
				var n = new notify(options);
				n.show();
				setTimeout(function(){  
				location.reload();
			   }, 2000);
            },
        error:function(e){
        console.log("error");
        }

      });
  }
  }
}
        
 function comfirmDeleteRow(id){
    
    var conf = confirm("Do you want to Delete Details?");
    //alert(id);
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/purchase/delete_id",
            data:{purchase_id:id},
            
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
               location.reload();
            }
        });

    }
   // var i++;
	}
      
function send()
{document.theform.submit()}

</script>