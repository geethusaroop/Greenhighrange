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
            "url": "<?php echo base_url();?>Sale/getreturn/",
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
            $('td', row).eq(8).html('<center><a target ="_blank"  href="<?php echo base_url();?>Sale/Returninvoice/'+data['sreturn_invoice_number']+'/'+data['sreturn_member_id_fk']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
            },
        "columns": [
            { "data": "sreturn_status", "orderable": false },
            {
                    "data": "sreturn_dates",
                    "orderable": false
                },
                {
                    "data": "sreturn_invoice_number",
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
                    "data": "taxamount",
                    "orderable": false
                },
                {
                    "data": "igstamt",
                    "orderable": false
                },
                {
                    "data": "total",
                    "orderable": false
                },
                
                {
                    "data": "sreturn_invoice_number",
                    "orderable": false
                },
              
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
                url: "<?php echo base_url(); ?>Sale/delete",
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
//     url:"<?php echo site_url('Sale/get_memberaddress');?>",
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
            url:"<?php echo base_url();?>Sale/get_memberaddress",
            type: 'POST',
            data:{id:id},
            dataType: 'json',
            success:function(data){
                $('#customer_addre').val(data[0]['member_address']);
            }
            });
            $.ajax({
                url:"<?php echo base_url();?>Sale/get_phone",
                type: 'POST',
                data:{id:id},
                dataType: 'json',
                success:function(data){
                    $('#custphone').val(data[0]['member_pnumber']);
                }
            });
            $.ajax({
                url:"<?php echo base_url();?>Sale/getOldBalance",
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
</script>
