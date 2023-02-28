<script>
//     var k = new Date();
// var n = k.toString();
// var c=n.substr(0,34);
// var d=c+"(IST)";
//
//  $('#date').html(d);
//     var slno=1;
//     var test;
// $(document).ready(function(){
// $('#myDiv').hide();
// });
// $('[id]').each(function() {
//     var $ids = $('[id=' + this.id + ']');
//     if ($ids.length > 1) {
//         $ids.not(':last').remove();
//     }
// });
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
      //console.log(response,'response');
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
        var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class="col-md-1"><b>Code</b><select name="product_code[]" class="form-control product_code" data-id='+counter+' id="product_code'+counter+'" /></select></div><div class="col-md-2"><b>Product</b><select name="product_id_fk[]" class="form-control product_num" data-id='+counter+' id="product_num'+counter+'" data-pms-required="true" autofocus /></select></div><div class="form-group"><div class="col-md-2"><b><font>HSN/SAC</font></b><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control hsn" id="phsn_'+counter+'" name="hsn[]" placeholder="HSN/SAC"></div><div class="col-md-1"><b><font color="red">Qty</font></b><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="pquantity_'+counter+'" name="purchase_quantity[]" placeholder="Qty"></div><div class="col-md-1"><b>Unit Price</b><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control price" id="sprice_'+counter+'" name="selling_price[]" placeholder="Selling Price"></div><div class="col-md-1"><b>Discount</b><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control discount" id="discount_'+counter+'" name="discount_price[]" placeholder="Discount Price"></div><div class="col-md-2"><b>Tax</b><select class="form-control amountclass" data-pms-required="true" id="taxtype_'+counter+'" name="taxtype[]"></select></div><div class="col-md-1">Total<span id="totalAmoun_'+counter+'"></span></label><input type="text" class="form-control totalPrice"  name="purchase_total_price[]" id="total_price_'+counter+'" ><input type="hidden" id="taxpercantage_'+counter+'" ></div></tr></table></DIV>';
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
            url: "<?php echo base_url()?>MBTSale/getproductname",
            type: 'POST',
            success: function(data)
            {
            $.each(data,function (item_id,item_name)
            {
            var opt = $('<option />');
            opt.val(item_id);
            opt.text(item_name);
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
    $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>MBTSale/gettax",
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
            $.ajax({
              url: '<?php echo base_url(); ?>Purchaseitem/getsalesproductcode',
              type: 'post',
              data: {},
              success: function(response){
                var data = JSON.parse(response);
                var select=document.getElementById('product_code'+counter+'');
                data.forEach((item) => {
                  $(select).append('<option value="'+item.item_id+'">'+item.product_code+'</option>');
                });
              }
            });
    });
counter++;
}
// ##################################################################
$(document).on("change", '.product_code', function() {
  var counter_value=this.getAttribute('data-id');
  $('#product_num'+counter_value+' option[value='+this.value+']').prop('selected', true);
});
$(document).on("change", '.product_num', function() {
  var counter_value=this.getAttribute('data-id');
  $('#product_code'+counter_value+' option[value='+this.value+']').prop('selected', true);
});
// #################################################################
$(document).on("change",'.product_num',function(){
    var p_id = $(this).val();
    //alert(p_id);
    var counterId = $(this).attr("id");
    var counter = counterId.split("_num")[1];
    //console.log(counterId,"counterID");
    //console.log(counter,"counter");
    if(p_id)
     {
         $.ajax({
             url:"<?php echo base_url();?>MBTSale/get_price",
            data:{p_id:p_id},
            type:'POST',
            dataType:"json",
            success:function(data){
                for (var i=0;i<data.length;i++) {
                    $('#sprice_'+counter+'').val(data[i].item_price);
                }
             }
         });
    }
});
$(document).on("change",'.amountclass',function(){
    var taxtype = $(this).val();
    var counterId = $(this).attr("id");
    var counter = counterId.split("_")[1];
    //console.log(counterId,"counterID");
    //console.log(counter,"counter");
    if(taxtype)
        {
            $.ajax({
            url:"<?php echo base_url()?>Purchaseitem/tax_amount",
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
                $('#net_total').val(parseFloat(netTotal).toFixed(2));
                var expensetotal = $('#expensetotal').val();
                var grandtotal = $('#grandtotal').val();
                // var net_balance = parseFloat($('#old_bal').val()) + parseFloat(grandtotal);
                // $('#net_bal').val(net_balance);
                 $('#net_total').val((netTotal).toFixed(2));
                var prodd = $('#product_num'+counter+'').val();
                let product_name = '';
                var k = $('#total_price_'+counter+'').val();
                $.ajax({
                    url: "<?php echo base_url()?>MBTSale/getproductname1",
                    data:{p_id:prodd},
                    type: 'POST',
                    success: function(data)
                    {
                        data = $.parseJSON(data);
                        //console.log('array => ',data);
                        product_name = data['product'][0].item_name;
                        //console.log('name', product_name);
                        $("#myTable > tbody").append("<tr id="+counter+"><td>"+slno+"</td><td>"+product_name+"</td><td>"+quantity+"</td><td>"+amount+"</td><td>"+k+"</td></tr>");
                        slno++;
                    }
                });
                //net_total old_bal_
                var calculated = parseFloat($('#net_total').val()) + parseFloat($('#old_bal_').val())
                $('#net_bal').html(calculated);
                $('#net_balance').html(calculated);
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
        //console.log(counterId,"counterID");
        //console.log(counter,"counter");
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
        $('#net_total').val(parseFloat(netTotal).toFixed(2));
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
        //console.log(counterId,"counterID");
        //console.log(counter,"counter");
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
        $('#net_total').val(parseFloat(netTotal).toFixed(2));
        var expensetotal = $('#expensetotal').val();
        var grandtotal = $('#grandtotal').val();
        $('#net_total').val((netTotal).toFixed(2));
        var net_balances = $('#net_balance').val();
        }
        else{
            Rowtotal = 0;
        }
    });
    $(document).on("change",'.product_num',function(){
    })
    // $(document).on("change",'.product_num',function(){
    //     var counterId = $(this).attr("id");
    //     var counter = counterId.split("_num")[1];
    //     console.log(counterId,"counterID");
    //     console.log(counter,"counter");
    //     var product_num = $(this).val();
    //     var product_size = $('#product_size'+counter+'').val();
    //     if(product_num){
    //         $.ajax({
    //         url:"<?php echo base_url();?>mbtsale/get_purchasedetails",
    //         type: 'POST',
    //         data:{product_num:product_num,product_size:product_size},
    //         dataType: 'json',
    //         success:function(data){
    //             $('#product_id'+counter+'').val(data[0]['purchase_price']);
    //             $('#pprice_'+counter+'').val(data[0]['landing_cost']);
    //         }
    //     });
    //     }
    // });
    $(document).on('change','#net_total',function(){
        var grand_total = 0;
        var grand_total = $('#grand_total').val();
        var net_balance = 0;
        var net_balance = $('#old_bal').val()
        var net_total = parseFloat(grand_total) + parseFloat(net_total);
        $('#net_bal').html(net_total);
        $('#net_balance').val(net_total);
    })
$(document).on("change",'.product_num',function(){
    var shop_id = $('#shop_id_fk').val();
    var counterId = $(this).attr("id");
    var counter = counterId.split("_num")[1];
    //console.log(counterId,"counterID");
    //console.log(counter,"counter");
    var product_id = $(this).val();
    if(product_id){
        $.ajax({
        url:"<?php echo base_url();?>MBTSale/getstock",
        type: 'POST',
        data:{product_id:product_id,shop_id:shop_id},
        dataType: 'json',
        success:function(data){
        $('#quant').html(data);
        $('#myDiv').show();
        }
        });
        //console.log('product_id => ', shop_id);
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
           //console.log(el);
           //console.log(el.next());
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
            "url": "<?php echo base_url();?>MBTSale/get/",
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
            $('td', row).eq(9).html('<center><a target ="_blank"  href="<?php echo base_url();?>MBTSale/invoiceview/'+data['invoice_number']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
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
                    "data": "branch_name",
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
               /*  {
                    "data": "sale_old_balance",
                    "orderable": false
                }, */
                {
                    "data": "discount",
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
               /*  {
                    "data": "sale_new_balance",
                    "orderable": false
                }, */
                {
                    "data": "sale_id",
                    "orderable": false
                },
              /*   {
                    "data": null,
                    render: function(data, type, row) {
                        return "<div data-id=" + data['auto_invoice'] + " onclick='test(this)' class='text-center'><i class='fa fa-trash-o iconFontSize-medium'></i></div>";
                    }
                } */
         ]
    } );
    $('#product').keyup(function (){
    $table.ajax.reload();
    });
  });


  function test(data) {
        var invoice_id = data.getAttribute('data-id');
       // alert(invoice_id);
        var conf = confirm("Do you want to Delete All Item from This Sale ?");
        if (conf) {
            $.ajax({
                url: "<?php echo base_url(); ?>MBTSale/delete",
                data: {
                    invoice_id: invoice_id
                },
                method: "POST",
                datatype: "json",
                success: function(data) {
                    var options = $.parseJSON(data);console.log(options);
                    noty(options);
                    $table.ajax.reload();
                }
            })
        }
    }


// Auto Searching//
    $(document).on("click","#customer_name",function(){
        var param='';
          //console.log("Customer name append");
          var $customerList=[ {'columnName':'custname','label':'Name'}];
          $('#customer_name').rcm_autoComplete('<?php echo base_url();?>common/getCustomerList',$customerList,param,getCustomerName);
    });
    function getCustomerName(el,event,item){
        //console.log(item);
        if(item.cust_id){
        el.val(item.custname);
        $("#customer_id").val(item.cust_id);
        }
    }
$(document).on("click","#Product_name",function(){
    var param='';
      ///console.log("customer name append");
      var $productName=[ {'columnName':'product_name','label':'Product'}];
      $('#Product_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productName,param,getProductNameEdit);
  });
   function getProductNameEdit(el,event,item){
        //console.log(item);
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
//   //alert(member_id);
//   if(member_id != '')
//   {
//    $.ajax({
//     url:"<?php echo site_url('MBTSale/get_memberaddress');?>",
//     method:"POST",
//     data:{member_id:member_id},
//     success:function(data)
//     {
//         var obj = JSON.parse(data);
//         $('#customer_addre').html(obj[0].custaddress);
//         $('#customer_phon').html(obj[0].custphone);
//     }
//    });
//   }
//  });
// });
$(document).on("change",'#customer_name',function(){
        var id = $(this).val();
        if(id){
            $.ajax({
            url:"<?php echo base_url();?>MBTSale/get_memberaddress",
            type: 'POST',
            data:{id:id},
            dataType: 'json',
            success:function(data){
                $('#customer_addre').val(data[0]['member_address']);
            }
            });
            $.ajax({
                url:"<?php echo base_url();?>MBTSale/get_phone",
                type: 'POST',
                data:{id:id},
                dataType: 'json',
                success:function(data){
                    $('#custphone').val(data[0]['member_pnumber']);
                }
            });
            $.ajax({
                url:"<?php echo base_url();?>MBTSale/getOldBalance",
                type: 'POST',
                data:{id:id},
                dataType: 'json',
                success:function(data){
                    //console.log(data[0].old_balance);
                    $('#old_bal').html(data[0]['old_balance']);
                    $('#old_bal_').val(data[0]['old_balance']);
                    $('#net_bal').html(data[0]['old_balance']);
                    $('#net_balance').val(data[0]['old_balance']);
                }
            });
        }
    });


    function getcustomer()
    {
        var mem_type=$('#member_types_all').val();
        if(mem_type==1)
        {
            $('#member').toggle();
            $('#other').hide();
        }
        else if(mem_type==2)
        {
            $('#member').toggle();
            $('#other').hide();
        }
        else if(mem_type==3)
        {
            $('#member').toggle();
            $('#other').hide();
        }
        else if(mem_type==4)
        {
            $('#other').toggle();
            $('#member').hide();
        }
    }

    $('#member_types_all').on('change',function(){
      $('#custname').empty();
        var mem_id = this.value;
        //alert(mem_id);
        $.ajax({
                url:"<?php echo base_url();?>MBTSale/getMemberList",
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
</script>
