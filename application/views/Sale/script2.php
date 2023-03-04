<script>
    var k = new Date();

var n = k.toString(); 

var c=n.substr(0,34);

var d=c+"(IST)";
 $('#date').html(d);
    var slno=1;
    var test;
$(document).ready(function(){
$('#myDiv').hide();
});
$('[id]').each(function() {
    var $ids = $('[id=' + this.id + ']');
    if ($ids.length > 1) {
        $ids.not(':last').remove();
    }
});
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
		var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class="col-md-2"><b>Product</b><select name="product_id_fk[]" class="form-control product_num"  id="product_num'+counter+'" data-pms-required="true" autofocus /></select></div><div class="form-group"><div class="col-md-2"><b><font color="red">Qty</font></b><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="pquantity_'+counter+'" name="purchase_quantity[]" placeholder="Qty"></div><div class="col-md-2"><b>Unit Price</b><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control price" id="sprice_'+counter+'" name="selling_price[]" placeholder="Selling Price"></div><div class="col-md-2"><b>Discount</b><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control discount" id="discount_'+counter+'" name="discount_price[]" placeholder="Discount Price"></div><div class="col-md-2"><b>Tax</b><select class="form-control amountclass" data-pms-required="true" id="taxtype_'+counter+'" name="taxtype[]"></select></div><div class="col-md-1"><b>Total</b><span id="totalAmoun_'+counter+'"></span></label><input type="text" class="form-control totalPrice"  name="purchase_total_price[]" id="total_price_'+counter+'" ><input type="hidden" id="taxpercantage_'+counter+'" ></div></tr></table></DIV>';
		$("#product").append(htmlVal);
		var param = '';
		$('#product_name_'+counter+'').focus();
		$('#product_name_'+counter+'').click(function(){
		$("#productname_").val('');
		}); 
		
		$('#product_name_'+counter+'').change(function(){
			
		setTimeout(function(){  
		var a = $("#productname_").val();
		//alert(a);
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
			
			url: "<?php echo base_url()?>Sale/getproductname",
            type: 'POST',
            success: function(data)
            {		
            $.each(data,function (product_id,product_name) 
            {
			var opt = $('<option />');
            opt.val(product_id);
            opt.text(product_name);
            //opt.text(t_price);
			//alert(product_name)
            $('#product_num'+counter+'').append(opt);
			});
			
			var select = $('#product_num'+counter+'');
			  select.html(select.find('option').sort(function(x, y) {
				return $(x).text() > $(y).text() ? 1 : -1;
			}));
			$('#product_num'+counter+'').prepend("<option value='' selected='selected'>Select</option>");
			}
            });
            // $(document).on("change",'.product_num',function(){
            // var product_id_fk = $('#product_num'+counter+'').val();
            // //alert(product_id_fk);
            // //console.log(this.id);
            // if(product_id_fk != '')
            //     {
            //         $.ajax({
            //               url: "<?php echo base_url();?>Sale/getprice",
            //               method:"POST", //This is the form method
            //               data:{product_id_fk:product_id_fk},
            //               type: "application/json",
            //               success: function(data)
            //               {
            //                 // data = $.parseJSON(data);
            //                 // console.log('test',data);
            //                 // let product_price = data['price'].price;
            //                 // // console.log('price', price.product_price);
            //                 // // console.log('mrp_id => ', '#mrp'+counter);
            //                 // $('#sprice_'+counter+'').val(product_price);
            //                  $('#sprice_'+counter+'').val(data[i].price); 
            //              }
            //         })
            //     }
            // });
    $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>Sale/gettax",
            success: function(cities)
            { 
            
            $('#taxtype_'+counter+'').append('<option value="">Tax</option>');
            
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
$(document).on("change",'.product_num',function(){
    var p_id = $(this).val();
   // alert(p_id);
    var counterId = $(this).attr("id");
    var counter = counterId.split("_num")[1];
   
    console.log(counterId,"counterID");
    console.log(counter,"counter");
    if(p_id)    
     {
         $.ajax({
             url:"<?php echo base_url();?>Sale/get_price",
            data:{p_id:p_id},
            type:'POST',
            dataType:"json",
            success:function(data){
                for (var i=0;i<data.length;i++) {
                    $('#sprice_'+counter+'').val(data[i].price); 
                   
                }
                
             }
         });
    }
});
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
				var amount = $('#sprice_'+counter+'').val();
				var quantity = $('#pquantity_'+counter+'').val();
				var tax = $('#taxpercantage_'+counter+'').val();
				var cost = $('#pprice_'+counter+'').val(); 
                var discount = $('#discount_'+counter+'').val(); 
				if(tax !== '' && quantity !=='' && amount !=='')
				{
                     var total_amount = parseFloat(amount) * parseFloat(quantity);
                
                    if(discount > 0)
                    {
                        var discount_amount = parseFloat(total_amount) - (parseFloat(total_amount) * parseFloat(discount)) / 100;
                    }
                    else
                    {
                        var discount_amount = parseFloat(total_amount);
                    }
        
                
				var taxamount =(parseFloat(discount_amount) * parseFloat(tax))/100;
				var full_amount = parseFloat(discount_amount);
				$('#totalAmount_'+counter+'').html(parseFloat(full_amount).toFixed(2));
				$('#total_price_'+counter+'').val(parseFloat(full_amount).toFixed(2));
				var netTotal = 0;
				$( ".totalPrice" ).each(function( index ) {
				netTotal = netTotal + parseFloat($( this ).val());
				});
				$(".NetTotalAmount").css('display','block');
				$('#grand_total').html(parseFloat(netTotal).toFixed(2));
				var expensetotal = $('#expensetotal').val();
				var grandtotal = $('#grandtotal').val();
                 $('#net_total').val((netTotal).toFixed(2));
                var prodd = $('#product_num'+counter+'').val();
                let product_name = '';
                var k = $('#total_price_'+counter+'').val();
                $.ajax({
                    url: "<?php echo base_url()?>Sale/getproductname1",
                    data:{p_id:prodd},
                    type: 'POST',
                    success: function(data)
                    {
                        data = $.parseJSON(data);
                        console.log('array => ',data);
                        product_name = data['product'][0].product_name;
                        console.log('name', product_name);
                        $("#myTable > tbody").append("<tr id="+counter+"><td>"+slno+"</td><td>"+product_name+"</td><td>"+quantity+"</td><td>"+amount+"</td><td>"+k+"</td></tr>");
                        slno++;
                    }
                });
            				
				}
				else{
					total_amount = 0;
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
        var taxamount =(parseFloat(amount) * parseFloat(tax))/100;
		var full_amount = parseFloat(amount);
		var total_amount = parseFloat(full_amount) * parseFloat(quantity);
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
        var taxamount =(parseFloat(amount) * parseFloat(tax))/100;
		var full_amount = parseFloat(amount);
		var total_amount = parseFloat(full_amount) * parseFloat(quantity);
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
	
	$(document).on("change",'.product_num',function(){
		var counterId = $(this).attr("id");
		var counter = counterId.split("_num")[1];
        console.log(counterId,"counterID");
        console.log(counter,"counter");
		var product_num = $(this).val();
		var product_size = $('#product_size'+counter+'').val();
		if(product_num){
			$.ajax({
            url:"<?php echo base_url();?>sale/get_purchasedetails",
            type: 'POST',
			data:{product_num:product_num,product_size:product_size},
            dataType: 'json',
            success:function(data){
				$('#product_id'+counter+'').val(data[0]['purchase_price']);
				$('#pprice_'+counter+'').val(data[0]['landing_cost']);
			}
        });
		}
	});
$(document).on("change",'.product_num',function(){
	var shop_id = $('#shop_id_fk').val();
	var counterId = $(this).attr("id");
	var counter = counterId.split("_num")[1];
	console.log(counterId,"counterID");
	console.log(counter,"counter");
	var product_id = $(this).val();
	if(product_id){
		$.ajax({
		url:"<?php echo base_url();?>Sale/getstock",
		type: 'POST',
		data:{product_id:product_id,shop_id:shop_id},
		dataType: 'json',
		success:function(data){	
		$('#quant').html(data);
		$('#myDiv').show();
		}
		});
        console.log('product_id => ', shop_id);
	}
});
	$(document).on("change",'.quantity',function(){
		var quantity =$(this).val();
		var stock = $("#quant").html();
		quantity = parseFloat(quantity);
		stock = parseFloat(stock);
	
		 if(quantity > stock){
			 alert (" Stock Unavailable ");
			 $('.quantity').val("");
		 }	
		else{	
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
        
        "ajax": {
            "url": "<?php echo base_url();?>sale/get/",
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
			$('td', row).eq(6).html('<center><a target ="_blank"  href="<?php echo base_url();?>Sale/invoiceview/'+data['invoice_number']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            },
        "columns": [
            { "data": "sale_status", "orderable": false },
            { "data": "invoice_number", "orderable": false },
            { "data": "custname", "orderable": false },
			{ "data": "shopname", "orderable": false },
            { "data": "sale_date", "orderable": false },
            { "data": "total", "orderable": false },
            { "data": "invoice_number", "orderable": false }
         ]
        
    } );
    $('#product').keyup(function (){
	$table.ajax.reload();
	});
    
  });
  
// Auto Searching//
	$(document).on("click","#customer_name",function(){
		var param='';
		  console.log("Customer name append");
		  var $customerList=[ {'columnName':'custname','label':'Name'}];
		  $('#customer_name').rcm_autoComplete('<?php echo base_url();?>common/getCustomerList',$customerList,param,getCustomerName);
		
	});
	function getCustomerName(el,event,item){
        console.log(item);
        if(item.cust_id){
		el.val(item.custname);
		$("#customer_id").val(item.cust_id);
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

function updateStock(invoice_number){
    var conf = confirm("Do you want to update Stock ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Purchase/updateStock",
            data:{invoice_number:invoice_number},
            
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
              //  $('#'+counter+'').remove(); 
            
               
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
// $(document).ready(function(){
// $('#customer_nam').change(function(){
//   var member_id = $('#customer_nam').val();
  
//   if(member_id != '')
//   {
//    $.ajax({
//     url:"<?php echo site_url('Sale/get_memberaddress');?>",
//     method:"POST",
//     data:{member_id:member_id},
//     success:function(data)
//     {
     
//         var obj = JSON.parse(data);
//         $('#customer_addre').html(obj[0].custaddress);
//         $('#customer_phone').html(obj[0].custphone);
//     }
//    });
//   }
  
//  });
// });
$(document).on("change",'#customer_nam',function(){
        var id = $(this).val();
        if(id){
            $.ajax({
            url:"<?php echo base_url();?>Sale/get_memberaddress",
            type: 'POST',
            data:{id:id},
            dataType: 'json',
            success:function(data){
                $('#customer_addre').val(data[0]['custaddress']);
            }
            });
            
            $.ajax({
                url:"<?php echo base_url();?>Sale/get_phone",
                type: 'POST',
                data:{id:id},
                dataType: 'json',
                success:function(data){
                    $('#custphone').val(data[0]['custphone']);
                        $('#custgst').val(data[0]['custgst']);
                           $('#cust_statetype').val(data[0]['cust_statetype']);
                              $('#custstate').val(data[0]['custstate']);
                                 $('#cust_gsttype').val(data[0]['cust_gsttype']);
                   
                   
                }
            });
        }
    });
</script>
<script type="text/javascript">
    var rowCount =0;
    function addRow(tableID) {
 
        var listValues = [
            { value: '', text: 'SELECT' }, 
            { value: '1', text: 'R1' }, 
            { value: '2', text: 'R2' }, 
            { value: '3', text: 'R3' }, 
           
        ];
  
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chk[]";
        cell1.appendChild(element1);
        var cell2 = row.insertCell(1);
        cell2.innerHTML = rowCount;
      
          var cell3 = row.insertCell(2);
        var element3 = document.createElement("input");
        element3.type = "text";
        element3.name = "product_code[]";
    element3.setAttribute("size", "6");
    element3.setAttribute("class", "democlass");
    element3.id = "product_code"+rowCount;
      //  element8.required = "required";
        element3.onkeyup=function() {getdata(rowCount,this);}
        cell3.appendChild(element3);
            var cell4 = row.insertCell(3);
    var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "product_name[]";
    element4.setAttribute("size", "16");
    element4.setAttribute("class", "democlass");
      element4.required = "required";
        element4.id = "product_name"+rowCount;
        element4.setAttribute("onchange", "getproductdetails(" + rowCount + ")");
        cell4.appendChild(element4);
        var cell5 = row.insertCell(4);
    var element5 = document.createElement("input");
        element5.type = "text";
        element5.name = "hsn[]";
    element5.setAttribute("size", "16");
    element5.setAttribute("class", "democlass");
      element5.required = "required";
        element5.id = "hsn"+rowCount;
        cell5.appendChild(element5);
        

        var cell6 = row.insertCell(5);
        var element6 = document.createElement("select");
        element6.type = "select";
        element6.name = "rate_type[]";
        element6.id = "rate_type" + rowCount;
        element6.setAttribute("onchange", "getratetype(" + rowCount + ")");
        element6.setAttribute("class", "democlass");
        // element3.required = "required";
        for (var i = 0; i < listValues.length; i += 1) {
            var option = document.createElement('option');
            option.setAttribute('value', listValues[i].value);
            option.appendChild(document.createTextNode(listValues[i].text));
            element6.appendChild(option);
        }
        cell6.appendChild(element6);

    
      var cell7 = row.insertCell(6);
        var element7 = document.createElement("input");
        element7.type = "text";
        element7.name = "rate[]";
    element7.setAttribute("size", "6");
    element7.setAttribute("class", "democlass");
      //  element6.required = "required";
    element7.id = "rate"+rowCount;
        cell7.appendChild(element7);
    
    
    var cell8 = row.insertCell(7);
        var element8 = document.createElement("input");
        element8.type = "text";
        element8.name = "sale_quantity[]";
    element8.setAttribute("size", "6");
    element8.setAttribute("class", "democlass");
    element8.id = "pquantity_"+rowCount;
      //  element5.required = "required";
      element8.onkeyup = function() {
            gettotal(rowCount, this);
        }
        cell8.appendChild(element8);
    
    var cell9 = row.insertCell(8);
        var element9 = document.createElement("input");
        element9.type = "text";
        element9.name = "discount_price[]";
        element9.setAttribute("size", "6");
        element9.setAttribute("class", "democlass");
        element9.id = "discount_"+rowCount;
      //  element8.required = "required";
      element9.onkeyup=function() {gettotalgrid(rowCount,this);}
        cell9.appendChild(element9);
    
    
    var cell10 = row.insertCell(9);
        var element10 = document.createElement("input");
        element10.type = "text";
        element10.name = "tamount[]";
        element10.setAttribute("size", "6");
        element10.setAttribute("class", "democlass");
      //  element9.required = "required";
      element10.id = "tamount"+rowCount;
        cell10.appendChild(element10);
    
    var cell11 = row.insertCell(10);
        var element11 = document.createElement("input");
        element11.type = "text";
        element11.name = "taxamount[]";
        element11.setAttribute("size", "6");
    element11.setAttribute("class", "democlass");
    element11.id = "taxamount"+rowCount;
       // element10.required = "required";
        cell11.appendChild(element11);
    
    
    var cell12 = row.insertCell(11);
        var element12 = document.createElement("input");
        element12.type = "text";
        element12.name = "igst[]";
     element12.id = "igst"+rowCount;
    element12.setAttribute("size", "6");
    element12.setAttribute("class", "democlass");
       // element11.required = "required";
        cell12.appendChild(element12);

    var cell13 = row.insertCell(12);
        var element13 = document.createElement("input");
        element13.type = "text";
        element13.name = "igstamt[]";
     element13.id = "igstamt"+rowCount;
    element13.setAttribute("size", "6");
    element13.setAttribute("class", "democlass");
       // element12.required = "required";
        cell13.appendChild(element13);

          var cell14 = row.insertCell(13);
        var element14 = document.createElement("input");
        element14.type = "text";
        element14.name = "netamt[]";
        element14.id = "netamt"+rowCount;
        element14.setAttribute("size", "6");
        element14.setAttribute("class", "democlass");
      //  element13.required = "required";
        cell14.appendChild(element14);

    var cell15 = row.insertCell(14);
        var element15 = document.createElement("input");
        element15.type = "hidden";
        element15.name = "product_id_fk[]";
        element15.id = "product_num"+rowCount;
        element15.setAttribute("size", "6");
        element15.setAttribute("class", "democlass");
     //   element14.required = "required";
        cell15.appendChild(element15);

        var cell16 = row.insertCell(15);
        var element16 = document.createElement("input");
        element16.type = "hidden";
        element16.name = "cgst[]";
        element16.id = "cgst"+rowCount;
     element16.setAttribute("size", "6");
    element16.setAttribute("class", "democlass");
     //   element15.required = "required";
     cell16.appendChild(element16);

            var cell17 = row.insertCell(16);
        var element17 = document.createElement("input");
        element17.type = "hidden";
        element17.name = "cgstamt[]";
        element17.id = "cgstamt"+rowCount;
     element17.setAttribute("size", "6");
    element17.setAttribute("class", "democlass");
       // element16.required = "required";
       cell17.appendChild(element17);

        var cell18 = row.insertCell(17);
        var element18 = document.createElement("input");
        element18.type = "hidden";
        element18.name = "sgst[]";
        element18.id = "sgst"+rowCount;
      element18.setAttribute("size", "6");
        element18.setAttribute("class", "democlass");
      //  element17.required = "required";
      cell18.appendChild(element18);

         var cell19 = row.insertCell(18);
        var element19 = document.createElement("input");
        element19.type = "hidden";
        element19.name = "sgstamt[]";
        element19.id = "sgstamt"+rowCount;
         element19.setAttribute("size", "6");
   // element18.setAttribute("class", "democlass");
      //  element17.required = "required";
        cell19.appendChild(element19);

        var cell20 = row.insertCell(19);
        var element20 = document.createElement("input");
        element20.type = "hidden";
        element20.name = "prod_branch_id[]";
        element20.id = "prod_branch_id"+rowCount;
        element20.setAttribute("size", "6");
   // element18.setAttribute("class", "democlass");
      //  element17.required = "required";
        cell20.appendChild(element20);


        var options = {
        // url: "<?php echo base_url() ?>Sale/getproduct_names",
        url: function(phrase) {
            return "<?php echo base_url() ?>Sale/getproduct_names?phrase=" + phrase + "&format=json";
        },
        getValue: "name",
        list: {
            match: {
                enabled: true
            }
        }
    };
    $("#product_name"+rowCount).easyAutocomplete(options);

    function getproductdetails(rowCount)
    { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . 'index.php/Sale/getProductDetails1'; ?>',
                      data: {
                          p_name: $("#product_name"+row).val()
                      },
                      success: function(data) {
                          d = JSON.parse(data);
                          console.log(d);
                          $('#product_code'+row).html(d.prod_cod);
                          $('#product_code'+row).val(d.prod_cod);
                          $('#product_num'+row).html(d.prod_id);
                          $('#product_num'+row).val(d.prod_id);
                          $('#hsn'+row).html(d.hsncode);
                          $('#hsn'+row).val(d.hsncode);

                          $('#igst'+row).html(d.igst);
                          $('#igst'+row).val(d.igst);

                          $('#cgst'+row).html(d.igst);
                          $('#cgst'+row).val(d.igst);

                          $('#sgst'+row).html(d.igst);
                          $('#sgst'+row).val(d.igst);

                          $('#prod_branch_id'+row).html(d.prod_id_branch);
                          $('#prod_branch_id'+row).val(d.prod_id_branch);
                          
                          $('#quant').html(d.stock);
                          $('#myDiv').show();
                      },
                      error: function() {
                      }
                  });
    }

    function getratetype(row)
    { //alert($("#product_num"+row).val());
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . 'index.php/Sale/getProductDetails2'; ?>',
                      data: {
                        product_num: $("#prod_branch_id_"+row).val(),rate_type: $("#rate_type"+row).val()
                      },
                      success: function(data) {
                          d = JSON.parse(data);
                          console.log(d);
                          $('#rate'+row).html(d.rate);
                          $('#rate'+row).val(d.rate);

                        
                      },
                      error: function() {
                      }
                  });
    }

     }
     function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                
                }
                
            }
            recalculate();
        } catch (e) {
            alert(e);
        }
    }
    function recalculate()
    {
        var total = 0;
        var total1 = 0;
        var total2 = 0;
        var total3 = 0;
        var table = document.getElementById('dataTable');
        var rowCount1 = table.rows.length;
        var rowCount=rowCount1-1;
        for (var i = 1; i <= rowCount; i++) {
            var price = parseFloat(document.getElementById("netamt" + i).value);
            var tamount = parseFloat(document.getElementById("tamount" + i).value);
            var pquantity = parseFloat(document.getElementById("pquantity_" + i).value);
            total += isNaN(price) ? 0 : price;
            total1 += isNaN(tamount) ? 0 : tamount;
            total2 += isNaN(pquantity) ? 0 : pquantity;
        }

        var sale_old_balance = parseFloat(document.getElementById("sale_old_balance").value);
        var discount_price = parseFloat(document.getElementById("discount_prices").value);
     /*    var total_amt=total+sale_old_balance;
       var nettotal=total_amt-discount_price; */

       var total_amt=total;
       var nettotal=total_amt-discount_price;
      
        document.getElementById("net_total").value = isNaN(total_amt) ? "0.00" : total_amt.toFixed(2);
        document.getElementById("qty_total").value = isNaN(total2) ? "0.00" : total2.toFixed(2);
        document.getElementById("net").innerHTML=isNaN(nettotal) ? "0.00" : nettotal.toFixed(2);
      
       /*  document.getElementById("net_total").value = isNaN(total) ? "0.00" : total.toFixed(2);
        document.getElementById("qty_total").value = isNaN(total2) ? "0.00" : total2.toFixed(2);
      //  document.getElementById("pamount").value = isNaN(total) ? "0.00" : total.toFixed(2);
    //   document.getElementById("total_amt").value = isNaN(total) ? "0.00" : total.toFixed(2);
        document.getElementById("net").innerHTML=isNaN(total) ? "0.00" : total.toFixed(2);   */
    }
  

function gettotal(idx,bal)
{
            
    var qty = parseFloat(document.getElementById("pquantity_"+idx).value);
        var prate = parseFloat(document.getElementById("rate"+idx).value);
   
        var total_amount = parseFloat(prate) * parseFloat(qty);
      
        var discount_amount = parseFloat(total_amount);
       
        var total = parseFloat(discount_amount);
      //  var idx = 1;
        document.getElementById("tamount"+idx).value = isNaN(discount_amount) ? "0.00" : discount_amount.toFixed(2);
        document.getElementById("taxamount"+idx).value = isNaN(discount_amount) ? "0.00" : discount_amount.toFixed(2);
      
        document.getElementById("netamt"+idx).value = isNaN(total) ? "0.00" : total.toFixed(2);
        totalamt(idx);
            
}

function gettotalgrid(idx,bal)
{//alert(idx);
            
            var qty = parseFloat(document.getElementById("pquantity_"+idx).value);
            
            var prate = parseFloat(document.getElementById("rate"+idx).value);
            
            //var kol = (((84/ 28)* brith * width* bal.value) / 12 ) ;
             var total_amount = parseFloat(prate) * parseFloat(qty);
            var cgst1 = parseFloat(document.getElementById("cgst"+idx).value);
            var cgst =cgst1/100;
             var sgst1 = parseFloat(document.getElementById("sgst"+idx).value);
            var sgst =sgst1/100;
              var igst1 = parseFloat(document.getElementById("igst"+idx).value);
            var igst =igst1/100;
            var discount=bal.value;
            if(discount >0)
            {
                var discount_amount = parseFloat(total_amount) - ((parseFloat(total_amount) * parseFloat(discount)) / 100);
            }
             else
             {
                var discount_amount = parseFloat(total_amount);
             }
              var cgstamt=discount_amount * cgst;
             var sgstamt=discount_amount * sgst;
               var igstamt=discount_amount * igst;
                 var total= parseFloat(discount_amount) + parseFloat(igstamt);
      //  alert(total);
            document.getElementById("tamount"+idx).value= isNaN(discount_amount)?"0.00":discount_amount.toFixed(2);
              document.getElementById("taxamount"+idx).value= isNaN(discount_amount)?"0.00":discount_amount.toFixed(2);
               document.getElementById("cgstamt"+idx).value= isNaN(cgstamt)?"0.00":cgstamt.toFixed(2);
              document.getElementById("sgstamt"+idx).value= isNaN(sgstamt)?"0.00":sgstamt.toFixed(2);
              document.getElementById("igstamt"+idx).value= isNaN(igstamt)?"0.00":igstamt.toFixed(2);
                document.getElementById("netamt"+idx).value= isNaN(total)?"0.00":total.toFixed(2);
            totalamt(idx);
            
}

function totalamt(idx) { //alert(idx);
        var total = 0;
        var total1 = 0;
        var total2 = 0;
        var total3 = 0;
        var table = document.getElementById('dataTable');
        var rowCount1 = table.rows.length;
        var rowCount =rowCount1-1;
       // alert(rowCount);
        for (var i = 1; i <= rowCount; i++) {
            var price = parseFloat(document.getElementById("netamt" + i).value);
            var tamount = parseFloat(document.getElementById("tamount" + i).value);
            var pquantity = parseFloat(document.getElementById("pquantity_" + i).value);
            total += isNaN(price) ? 0 : price;
            total1 += isNaN(tamount) ? 0 : tamount;
            total2 += isNaN(pquantity) ? 0 : pquantity;
        }
        var sale_old_balance = parseFloat(document.getElementById("sale_old_balance").value);
        var discount_price = parseFloat(document.getElementById("discount_prices").value);
      //  var total_amt=total+sale_old_balance;
       // var nettotal=total-discount_price;
     //  var nettotal=total_amt-discount_price;

        var total_amt=total;
       var nettotal=total_amt-discount_price;

       var gross_total=total+sale_old_balance;
      
        document.getElementById("net_total").value = isNaN(total_amt) ? "0.00" : total_amt.toFixed(2);
        document.getElementById("gross_total").value = isNaN(gross_total) ? "0.00" : gross_total.toFixed(2);
        document.getElementById("qty_total").value = isNaN(total2) ? "0.00" : total2.toFixed(2);
      //  document.getElementById("pamount").value = isNaN(total) ? "0.00" : total.toFixed(2);
      //  document.getElementById("total_amt").value = isNaN(nettotal) ? "0.00" : nettotal.toFixed(2);//balance
        document.getElementById("net").innerHTML=isNaN(nettotal) ? "0.00" : nettotal.toFixed(2);
    }

function getdiscamount() {
       // var total_amt1 = parseFloat(document.getElementById("total_amt1").value);
       var total_amt1 = parseFloat(document.getElementById("net_total").value);
        var discount_price = parseFloat(document.getElementById("discount_prices").value);
        var total = parseFloat(total_amt1) - parseFloat(discount_price);
      //  document.getElementById("total_amt").value = isNaN(total) ? "0.00" : total.toFixed(2);
        document.getElementById("net").innerHTML=isNaN(total) ? "0.00" : total.toFixed(2);
    }

    function getsharediscamount() {
        var sharedisc1 = parseFloat(document.getElementById("sale_shareholder_discount").value);
        var sharedisc =sharedisc1/100;
       var total_amt1 = parseFloat(document.getElementById("net_total").value);
        var discount_price = parseFloat(document.getElementById("discount_prices").value);
        var total = parseFloat(total_amt1) -(parseFloat(discount_price)+parseFloat(sharedisc)) ;
       // document.getElementById("total_amt").value = isNaN(total) ? "0.00" : total.toFixed(2);
        document.getElementById("net").innerHTML=isNaN(total) ? "0.00" : total.toFixed(2);
    }

    function getamount() {
        var total_amt = document.getElementById("net").innerHTML;
        var paid_amt = parseFloat(document.getElementById("pamount").value);
        if (total_amt > paid_amt) {
            var total = parseFloat(total_amt) - parseFloat(paid_amt);
        } else if (total_amt < paid_amt) {
            var total = parseFloat(paid_amt) - parseFloat(total_amt);
        }
        document.getElementById("total_amt").value = isNaN(total) ? "0.00" : total.toFixed(2);
    }

function getcustomer()
    {
        var mem_type=$('#member_types_all').val();
        if(mem_type==1 || mem_type==2 || mem_type==3)
        {
            $('#member').show();
            $('#other').hide();
        }
      /*   else if(mem_type==2)
        {
            $('#member').toggle();
            $('#other').hide();
        }
        else if(mem_type==3)
        {
            $('#member').toggle();
            $('#other').hide();
        } */
        else if(mem_type==4)
        {
            $('#other').toggle();
            $('#member').hide();
        }
    }

    $('#member_types_all').on('change',function(){
      $('#custname').empty();
      $('#sale_old_balance').val(0);
        var mem_id = this.value;
        //alert(mem_id);
        $.ajax({
                url:"<?php echo base_url();?>Sale/getMemberList",
                type: 'POST',
                data:{mem_id:mem_id},
                dataType: 'json',
                success:function(response){
                    //console.log(response);
                    var dataset = response;
                    var select=document.getElementById("custname");
                    $(select).append('<option value="">SELECT</option>');
                    dataset.forEach((item) => {
                    $(select).append('<option value="'+item.member_id+'">'+item.member_name+'</option>');
                    });
                }
            });
    })

    $('#custname').on('change',function(){
      
        var mem_id = this.value;
        $.ajax({
                url: "<?php echo base_url(); ?>Sale/get_old_bal",
                type: 'POST',
                data: {
                    vid: mem_id
                },
                dataType: 'json',
                success: function(data) {
                    $('#sale_old_balance').html(Number(data[0]['member_old_balance'])+Number(data[0]['member_sale_balance']));
                    $('#sale_old_balance').val(Number(data[0]['member_old_balance'])+Number(data[0]['member_sale_balance']));
                   
                }
            });
    })

    var options = {
        // url: "<?php echo base_url() ?>Sale/getproduct_names",
        url: function(phrase) {
            return "<?php echo base_url() ?>Sale/getproduct_names?phrase=" + phrase + "&format=json";
        },
        getValue: "name",
        list: {
            match: {
                enabled: true
            }
        }
    };
    $("#product_name1").easyAutocomplete(options);

    function getproductdetails(row)
    { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . 'index.php/Sale/getProductDetails1'; ?>',
                      data: {
                          p_name: $("#product_name"+row).val()
                      },
                      success: function(data) {
                          d = JSON.parse(data);
                          console.log(d);
                          $('#product_code'+row).html(d.prod_cod);
                          $('#product_code'+row).val(d.prod_cod);
                          $('#product_num'+row).html(d.prod_id);
                          $('#product_num'+row).val(d.prod_id);
                          $('#hsn'+row).html(d.hsncode);
                          $('#hsn'+row).val(d.hsncode);

                          $('#igst'+row).html(d.igst);
                          $('#igst'+row).val(d.igst);

                          $('#cgst'+row).html(d.igst);
                          $('#cgst'+row).val(d.igst);

                          $('#sgst'+row).html(d.igst);
                          $('#sgst'+row).val(d.igst);

                          $('#prod_branch_id'+row).html(d.prod_id_branch);
                          $('#prod_branch_id'+row).val(d.prod_id_branch);
                          
                          $('#quant').html(d.stock);
                          $('#myDiv').show();
                      },
                      error: function() {
                      }
                  });
    }

    function getratetype(row)
    { //alert($("#product_num"+row).val());
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . 'index.php/Sale/getProductDetails2'; ?>',
                      data: {
                        product_num: $("#product_num"+row).val(),rate_type: $("#rate_type"+row).val()
                      },
                      success: function(data) {
                          d = JSON.parse(data);
                          console.log(d);
                          $('#rate'+row).html(d.rate);
                          $('#rate'+row).val(d.rate);

                        
                      },
                      error: function() {
                      }
                  });
    }

  </script>
