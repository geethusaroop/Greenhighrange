<script>
    var k = new Date();
    var n = k.toString();
    var c = n.substr(0, 34);
    var d = c + "(IST)";
    $('#date').html(d);
    var slno = 1;
    var test;
    $(document).ready(function() {
        $('#myDiv').hide();
    });
    $('[id]').each(function() {
        var $ids = $('[id=' + this.id + ']');
        if ($ids.length > 1) {
            $ids.not(':last').remove();
        }
    });
    $(document).ready(function() {
        $("form").submit(function(e) {
            var c = 0;
            $('.table-bordered').each(function() {
                c++;
            });
            var total = $('#tax_total').val();
            var diff = $('#checkvalue').val();
            var total = parseFloat(total);
            var diff = parseFloat(diff);
            if (c == 0) {
                e.preventDefault(e);
                var options1 = {
                    'title': 'Error',
                    'style': 'error',
                    'message': 'Please Enter Products....!',
                    'icon': 'warning',
                };
                var n1 = new notify(options1);
                n1.show();
                setTimeout(function() {
                    n1.hide();
                }, 3000);
            } else {}
        });
    });
    var counter = 0;
    var response = $("#response").val();
    if (response) {
        console.log(response, 'response');
        var options = $.parseJSON(response);
        noty(options);
    }

    function addMore() {
        $("<DIV>").load("", function() {
            $(this).attr('data-validation', 'required');
            $(this).attr('data-validation', 'nameFields');
            $(this).attr('data-validation', 'digitsOnly');
            $(this).attr('data-validation', 'date');
            $(this).attr('data-validation', 'usPhone');
            $(this).attr('data-validation', 'email');
            $(this).attr('data-validation', 'dropDown');
            var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class="col-md-2"><b>Product</b><select name="product_id_fk[]" class="form-control product_num"  id="product_num' + counter + '" data-pms-required="true" autofocus /></select></div><div class="form-group"><div class="col-md-2"><b><font color="red">Qty</font></b><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="pquantity_' + counter + '" name="purchase_quantity[]" placeholder="Qty"></div><div class="col-md-2"><b>Unit Price</b><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control price" id="sprice_' + counter + '" name="selling_price[]" placeholder="Selling Price"></div><div class="col-md-2"><b>Discount</b><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control discount" id="discount_' + counter + '" name="discount_price[]" placeholder="Discount Price"></div><div class="col-md-2"><b>Tax</b><select class="form-control amountclass" data-pms-required="true" id="taxtype_' + counter + '" name="taxtype[]"></select></div><div class="col-md-1"><b>Total</b><span id="totalAmoun_' + counter + '"></span></label><input type="text" class="form-control totalPrice"  name="purchase_total_price[]" id="total_price_' + counter + '" ><input type="hidden" id="taxpercantage_' + counter + '" ></div></tr></table></DIV>';
            $("#product").append(htmlVal);
            var param = '';
            $('#product_name_' + counter + '').focus();
            $('#product_name_' + counter + '').click(function() {
                $("#productname_").val('');
            });
            $('#product_name_' + counter + '').change(function() {
                setTimeout(function() {
                    var a = $("#productname_").val();
                    //alert(a);
                    if (a === '') {
                        $('#product_name_' + counter + '').val('');
                        var options1 = {
                            'title': 'Error',
                            'style': 'error',
                            'message': 'Product Not Exist....!',
                            'icon': 'warning',
                        };
                        var n1 = new notify(options1);
                        if (a === '') {
                            n1.show();
                        }
                    }
                }, 900);
            });
            $.ajax({
                url: "<?php echo base_url() ?>Sale/getproductname",
                type: 'POST',
                success: function(data) {
                    $.each(data, function(product_id, product_name) {
                        var opt = $('<option />');
                        opt.val(product_id);
                        opt.text(product_name);
                        //opt.text(t_price);
                        //alert(product_name)
                        $('#product_num' + counter + '').append(opt);
                    });
                    var select = $('#product_num' + counter + '');
                    select.html(select.find('option').sort(function(x, y) {
                        return $(x).text() > $(y).text() ? 1 : -1;
                    }));
                    $('#product_num' + counter + '').prepend("<option value='' selected='selected'>Select</option>");
                }
            });

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>Sale/gettax",
                success: function(cities) {
                    $('#taxtype_' + counter + '').append('<option value="">Tax</option>');
                    $.each(cities, function(id, city) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(city);
                        $('#taxtype_' + counter + '').append(opt);
                    });
                }
            });
        });
        counter++;
    }
    $(document).on("change", '.product_num', function() {
        var p_id = $(this).val();
        // alert(p_id);
        var counterId = $(this).attr("id");
        var counter = counterId.split("_num")[1];
        console.log(counterId, "counterID");
        console.log(counter, "counter");
        if (p_id) {
            $.ajax({
                url: "<?php echo base_url(); ?>Sale/get_price",
                data: {
                    p_id: p_id
                },
                type: 'POST',
                dataType: "json",
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#sprice_' + counter + '').val(data[i].price);
                    }
                }
            });
        }
    });
    $(document).on("change", '.amountclass', function() {
        var taxtype = $(this).val();
        var counterId = $(this).attr("id");
        var counter = counterId.split("_")[1];
        console.log(counterId, "counterID");
        console.log(counter, "counter");
        if (taxtype) {
            $.ajax({
                url: "<?php echo base_url() ?>Purchase/tax_amount",
                type: 'POST',
                data: {
                    value: taxtype
                },
                dataType: 'json',
                success: function(data) {
                    $('#taxpercantage_' + counter + '').val(data['taxamount']);
                    var amount = $('#sprice_' + counter + '').val();
                    var quantity = $('#pquantity_' + counter + '').val();
                    var tax = $('#taxpercantage_' + counter + '').val();
                    var cost = $('#pprice_' + counter + '').val();
                    var discount = $('#discount_' + counter + '').val();
                    if (tax !== '' && quantity !== '' && amount !== '') {
                        var total_amount = parseFloat(amount) * parseFloat(quantity);
                        if (discount > 0) {
                            var discount_amount = parseFloat(total_amount) - (parseFloat(total_amount) * parseFloat(discount)) / 90;
                        } else {
                            var discount_amount = parseFloat(total_amount);
                        }
                        var taxamount = (parseFloat(discount_amount) * parseFloat(tax)) / 90;
                        var full_amount = parseFloat(discount_amount);
                        $('#totalAmount_' + counter + '').html(parseFloat(full_amount).toFixed(2));
                        $('#total_price_' + counter + '').val(parseFloat(full_amount).toFixed(2));
                        var netTotal = 0;
                        $(".totalPrice").each(function(index) {
                            netTotal = netTotal + parseFloat($(this).val());
                        });
                        $(".NetTotalAmount").css('display', 'block');
                        $('#grand_total').html(parseFloat(netTotal).toFixed(2));
                        var expensetotal = $('#expensetotal').val();
                        var grandtotal = $('#grandtotal').val();
                        $('#net_total').val((netTotal).toFixed(2));
                        var prodd = $('#product_num' + counter + '').val();
                        let product_name = '';
                        var k = $('#total_price_' + counter + '').val();
                        $.ajax({
                            url: "<?php echo base_url() ?>Sale/getproductname1",
                            data: {
                                p_id: prodd
                            },
                            type: 'POST',
                            success: function(data) {
                                data = $.parseJSON(data);
                                console.log('array => ', data);
                                product_name = data['product'][0].product_name;
                                console.log('name', product_name);
                                $("#myTable > tbody").append("<tr id=" + counter + "><td>" + slno + "</td><td>" + product_name + "</td><td>" + quantity + "</td><td>" + amount + "</td><td>" + k + "</td></tr>");
                                slno++;
                            }
                        });
                    } else {
                        total_amount = 0;
                    }
                },
                error: function(e) {
                    console.log("error");
                }
            });
        }
    });
    $(document).on("change", '.quantity', function() {
        var counterId = $(this).attr("id");
        var counter = counterId.split("_")[1];
        console.log(counterId, "counterID");
        console.log(counter, "counter");
        var amount = $('#pprice_' + counter + '').val();
        var quantity = $('#pquantity_' + counter + '').val();
        var tax = $('#taxpercantage_' + counter + '').val();
        if (tax !== '' && quantity !== '' && amount !== '') {
            var taxamount = (parseFloat(amount) * parseFloat(tax)) / 90;
            var full_amount = parseFloat(amount);
            var total_amount = parseFloat(full_amount) * parseFloat(quantity);
            $('#totalAmount_' + counter + '').html(parseFloat(Rowtotal).toFixed(2));
            $('#total_price_' + counter + '').val(parseFloat(Rowtotal).toFixed(2));
            var netTotal = 0;
            $(".totalPrice").each(function(index) {
                netTotal = netTotal + parseFloat($(this).val());
            });
            $(".NetTotalAmount").css('display', 'block');
            $('#grand_total').html(parseFloat(netTotal).toFixed(2));
            var expensetotal = $('#expensetotal').val();
            var grandtotal = $('#grandtotal').val();
            $('#net_total').val((netTotal).toFixed(2));
        } else {
            Rowtotal = 0;
        }
    });
    $(document).on("change", '.price', function() {
        var counterId = $(this).attr("id");
        var counter = counterId.split("_")[1];
        console.log(counterId, "counterID");
        console.log(counter, "counter");
        var amount = $('#pprice_' + counter + '').val();
        var quantity = $('#pquantity_' + counter + '').val();
        var tax = $('#taxpercantage_' + counter + '').val();
        if (tax !== '' && quantity !== '' && amount !== '') {
            var taxamount = (parseFloat(amount) * parseFloat(tax)) / 90;
            var full_amount = parseFloat(amount);
            var total_amount = parseFloat(full_amount) * parseFloat(quantity);
            $('#totalAmount_' + counter + '').html(parseFloat(Rowtotal).toFixed(2));
            $('#total_price_' + counter + '').val(parseFloat(Rowtotal).toFixed(2));
            var netTotal = 0;
            $(".totalPrice").each(function(index) {
                netTotal = netTotal + parseFloat($(this).val());
            });
            $(".NetTotalAmount").css('display', 'block');
            $('#grand_total').html(parseFloat(netTotal).toFixed(2));
            var expensetotal = $('#expensetotal').val();
            var grandtotal = $('#grandtotal').val();
            $('#net_total').val((netTotal).toFixed(2));
        } else {
            Rowtotal = 0;
        }
    });
    $(document).on("change", '.product_num', function() {
        var counterId = $(this).attr("id");
        var counter = counterId.split("_num")[1];
        console.log(counterId, "counterID");
        console.log(counter, "counter");
        var product_num = $(this).val();
        var product_size = $('#product_size' + counter + '').val();
        if (product_num) {
            $.ajax({
                url: "<?php echo base_url(); ?>sale/get_purchasedetails",
                type: 'POST',
                data: {
                    product_num: product_num,
                    product_size: product_size
                },
                dataType: 'json',
                success: function(data) {
                    $('#product_id' + counter + '').val(data[0]['purchase_price']);
                    $('#pprice_' + counter + '').val(data[0]['landing_cost']);
                }
            });
        }
    });
    $(document).on("change", '.product_num', function() {
        var shop_id = $('#shop_id_fk').val();
        var counterId = $(this).attr("id");
        var counter = counterId.split("_num")[1];
        console.log(counterId, "counterID");
        console.log(counter, "counter");
        var product_id = $(this).val();
        if (product_id) {
            $.ajax({
                url: "<?php echo base_url(); ?>Sale/getstock",
                type: 'POST',
                data: {
                    product_id: product_id,
                    shop_id: shop_id
                },
                dataType: 'json',
                success: function(data) {
                    $('#quant').html(data);
                    $('#myDiv').show();
                }
            });
            console.log('product_id => ', shop_id);
        }
    });
    $(document).on("change", '.quantity', function() {
        var quantity = $(this).val();
        var stock = $("#quant").html();
        quantity = parseFloat(quantity);
        stock = parseFloat(stock);
        if (quantity > stock) {
            alert(" Stock Unavailable ");
            $('.quantity').val("");
        } else {}
    });
    var $productList = [{
        'columnName': 'product_name',
        'label': 'Product'
    }];
    var param = '';

    $(function() {
        $("#vendor_id_fk option:first").before('<option value="">----Please Select---</option>');
        $("#vendor_id_fk").val("").change();
        var ctnm = $('#vendor_name').val();
        if (ctnm) {
            $("#vendor_id_fk").val(ctnm).change();
        }
        $(".select2").select2();
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {
            "placeholder": "dd/mm/yyyy"
        });
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


        $table = $('#purchase_details_table').DataTable({
            "searching": false,
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "aLengthMenu": [
                [100, 200, 400],
                [100, 200, 400]
            ],
            "iDisplayLength": 100,

            "ajax": {
                "url": "<?php echo base_url(); ?>Purchase_Return/get/",
                "type": "POST",
                "data": function(d) {
                    d.invoice_number = $('#invoice_number').val();
                    d.startDate = $('#pmsDateStart').val();
                    d.endDate = $('#pmsDateEnd').val();
                }
            },
            "createdRow": function(row, data, index) {

                $table.column(0).nodes().each(function(node, index, dt) {
                    $table.cell(node).data(index + 1);
                });
                
                $('td', row).eq(8).html('<center><a target ="_blank"  href="<?php echo base_url(); ?>Purchase_Return/invoice/' + data['m_pur_invo'] + '"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
                $('td', row).eq(9).html('<center><a href="<?php echo base_url(); ?>Purchase_Return/edit/' + data['m_pur_id'] + '"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete(' + data['m_pur_id'] + ')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
            },

            "columns": [
                { "data": "m_pur_status","orderable": false },
                { "data": "m_pur_invo","orderable": false },
                { "data": "vendorname","orderable": false },
                { "data": "qty","orderable": false },
                { "data": "total","orderable": false },
                { "data": "m_pur_discount","orderable": false },
                { "data": "m_pur_total","orderable": false },
                { "data": "m_pur_date","orderable": false },
                { "data": "m_pur_date","orderable": false },
                { "data": "m_pur_id","orderable": false },
            ]

        });
    });

    function test(data) {
        var invoice_id = data.getAttribute('data-id');
        var conf = confirm("Do you want to Delete All Item from This Sale ?");
        if (conf) {
            $.ajax({
                url: "<?php echo base_url(); ?>Sale/delete",
                data: {
                    invoice_number: invoice_id
                },
                method: "POST",
                datatype: "json",
                success: function(data) {
                    var options = $.parseJSON(data);
                    noty(options);
                    $table.ajax.reload();
                }
            })
        }
    }

    function confirmDelete(m_pur_id) {
        alert('yes');
        var conf = confirm("Do you want to Delete All Item from This Sale ?");
        if (conf) {
            $.ajax({
                url: "<?php echo base_url(); ?>Purchase_Return/delete",
                data: {
                    m_pur_id: m_pur_id
                },
                method: "POST",
                datatype: "json",
                success: function(data) {
                    var options = $.parseJSON(data);
                    noty(options);
                    $table.ajax.reload();
                }
            });
        }
    }
    // Auto Searching//
    $(document).on("click", "#customer_name", function() {
        var param = '';
        console.log("Customer name append");
        var $customerList = [{
            'columnName': 'custname',
            'label': 'Name'
        }];
        $('#customer_name').rcm_autoComplete('<?php echo base_url(); ?>common/getCustomerList', $customerList, param, getCustomerName);
    });

    function getCustomerName(el, event, item) {
        console.log(item);
        if (item.cust_id) {
            el.val(item.custname);
            $("#customer_id").val(item.cust_id);
        }
    }
    $(document).on("click", "#Product_name", function() {
        var param = '';
        console.log("customer name append");
        var $productName = [{
            'columnName': 'product_name',
            'label': 'Product'
        }];
        $('#Product_name').rcm_autoComplete('<?php echo base_url(); ?>index.php/common/getProductList', $productName, param, getProductNameEdit);
    });

    function getProductNameEdit(el, event, item) {
        console.log(item);
        if (item.product_id) {
            el.val(item.product_name);
            $("#Category_name").val(item.category_name);
            $("#Size_name").val(item.size_name);
            $("#Color_name").val(item.color_name);
            $("#Product_id").val(item.product_id);
        }
    }

    function GenBarcode(purchase_id) {
        var conf = confirm("Do you want to GenerateBarcode ?");
        if (conf) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/purchase/generateBarcode",
                data: {
                    purchase_invoice_no: purchase_invoice_no
                },
                method: "POST",
                datatype: "json",
                success: function(data) {
                    var options = $.parseJSON(data);
                    noty(options);
                    $table.ajax.reload();
                }
            });
        }
    }

    function updateStock(invoice_number) {
        var conf = confirm("Do you want to update Stock ?");
        if (conf) {
            $.ajax({
                url: "<?php echo base_url(); ?>Purchase/updateStock",
                data: {
                    invoice_number: invoice_number
                },
                method: "POST",
                datatype: "json",
                success: function(data) {
                    var options = $.parseJSON(data);
                    noty(options);
                    $table.ajax.reload();
                }
            });
        }
    }
    $('#search').click(function() {
        $table.ajax.reload();
    });
    $(document).on("blur", ".amountclass", function() {
        var quantity = $("#quantity").val();
        var amount = $("#amount").val();
        if (quantity != '' && amount != '') {
            totalamount = parseFloat(quantity) * parseFloat(amount);
        } else {
            totalamount = 0;
        }
        $("#totalAmount").html(parseFloat(totalamount).toFixed(2));
        $("#total_price").val(parseFloat(totalamount).toFixed(2));
    })
    $(document).ready(function() {
        $('.select1').toggle();
        $(document).click(function(e) {
            $('.select1').attr('size', 0);
        });
    });
    $(document).on('change', '#include_tax', function() {
        var includeTax = $("#include_tax").val();
        if (includeTax == '1') {
            $('#taxClass').show();
        } else {
            $('#taxClass').hide();
            //$('taxClass').val(2);
        }
    });

    function deleteRow() {
        $('DIV.product-item').each(function(index, item) {
            jQuery(':checkbox', this).each(function() {
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
    $(document).on('click', '#update', function() {
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
        if (conf == true) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/purchase/edit_vendor",
                data: {
                    vendor_id: vendor_id,
                    customer_name: customer_name,
                    vendor_address: vendor_address,
                    vender_mail: vender_mail,
                    vendor_phone: vendor_phone,
                    vendor_tin: vendor_tin,
                    vendor_pin: vendor_pin,
                    date: date,
                    include_bill: include_bill,
                    purchase_invoice_number: purchase_invoice_number,
                    purchase_remarks: purchase_remarks,
                    invoice_no: invoice_no
                },
                method: "POST",
                datatype: "json",
                success: function(data) {
                    var options = $.parseJSON(data);
                    noty(options);
                    location.reload();
                },
                error: function(e) {
                    console.log("error");
                }
            });
        } else {
            //location.reload();
        }
    });
    //var i=0;
    function confirmUpdate(id) {
        var conf = confirm("Do you want to Edit details?");
        if (conf) {
            $('#EditPurchase').modal();
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/purchase/editRow",
                type: 'POST',
                data: {
                    purchase_id: id
                },
                dataType: 'json',
                success: function(data) {
                    document.getElementById('Purchase_id').value = data[0]['purchase_id'];
                    document.getElementById('Product_name').value = data[0]['product_name'];
                    document.getElementById('Product_id').value = data[0]['product_id'];
                    document.getElementById('old_product_id').value = data[0]['product_id'];
                    document.getElementById('Category_name').value = data[0]['category_name'];
                    document.getElementById('Size_name').value = data[0]['size_name'];
                    $("#rowtotal").val(data[0]['purchase_total_price']);
                    $("#grand").val(data[0]['purchase_grandd_total']);
                    $("#grandtotal").val(data[0]['purchase_grandd_total']);
                    $('#tax_type').val(data[0]['tax_id_fk']).change();
                    document.getElementById('Color_name').value = data[0]['color_name'];
                    document.getElementById('Purchase_qty').value = data[0]['product_purchase_quantity'];
                    document.getElementById('Sale_qty').value = data[0]['purchase_return_qty'];
                    document.getElementById('Purchase_rte').value = data[0]['purchase_price'];
                    document.getElementById('Sale_price').value = data[0]['sale_price'];
                    document.getElementById('Total_purchase').value = data[0]['purchase_total_price'];
                    $("#PurchaseTotal").html(data[0]['purchase_total_price']);
                },
                error: function(e) {
                    console.log("error");
                }
            });
        }
    }
    $(document).on("change", '#tax_type', function() {
        var taxtype = $(this).val();
        if (taxtype) {
            $.ajax({
                url: "<?php echo base_url() ?>Purchase/tax_amount",
                type: 'POST',
                data: {
                    value: taxtype
                },
                dataType: 'json',
                success: function(data) {
                    $('#taxpercantage').val(data['tax_amount']);
                    var amount = $('#Purchase_rte').val();
                    var quantity = $('#Purchase_qty').val();
                    var tax = $('#taxpercantage').val();
                    var rowtot = $('#rowtotal').val();
                    var grand = $('#grand').val();
                    if (tax !== '' && quantity !== '' && amount !== '') {
                        amount = parseFloat(quantity) * parseFloat(amount);
                        var amount_divide = parseFloat(amount) / 90;
                        var percantage = parseFloat(amount_divide) * parseFloat(tax);
                        var Rowtotal = parseFloat(percantage) + parseFloat(amount);
                        grand = parseFloat(grand) - parseFloat(rowtot);
                        grand = parseFloat(grand) + parseFloat(Rowtotal);
                        $('#grandtotal').val(grand);
                        $('#PurchaseTotal').html(Rowtotal);
                        $('#Total_purchase').val(Rowtotal);
                    }
                },
                error: function(e) {
                    console.log("error");
                }
            });
        }
    });
    $(document).on('change', '#Purchase_qty', function() {
        var Purchase_qty = $("#Purchase_qty").val();
        var Purchase_rte = $("#Purchase_rte").val();
        var total = Purchase_qty * Purchase_rte;
        $("#Total_purchase").val(parseFloat(total).toFixed(2));
        var amount = $('#Purchase_rte').val();
        var quantity = $('#Purchase_qty').val();
        var tax = $('#taxpercantage').val();
        var rowtot = $('#rowtotal').val();
        var grand = $('#grand').val();
        if (tax !== '' && quantity !== '' && amount !== '') {
            amount = parseFloat(quantity) * parseFloat(amount);
            var amount_divide = parseFloat(amount) / 90;
            var percantage = parseFloat(amount_divide) * parseFloat(tax);
            var Rowtotal = parseFloat(percantage) + parseFloat(amount);
            grand = parseFloat(grand) - parseFloat(rowtot);
            grand = parseFloat(grand) + parseFloat(Rowtotal);
            $('#grandtotal').val(grand);
            $('#PurchaseTotal').html(Rowtotal);
            $('#Total_purchase').val(Rowtotal);
        }
    });
    $(document).on('change', '#Purchase_rte', function() {
        var Purchase_qty = $("#Purchase_qty").val();
        var Purchase_rte = $("#Purchase_rte").val();
        var total = Purchase_qty * Purchase_rte;
        $("#Total_purchase").val(parseFloat(total).toFixed(2));
        var amount = $('#Purchase_rte').val();
        var quantity = $('#Purchase_qty').val();
        var tax = $('#taxpercantage').val();
        var rowtot = $('#rowtotal').val();
        var grand = $('#grand').val();
        if (tax !== '' && quantity !== '' && amount !== '') {
            amount = parseFloat(quantity) * parseFloat(amount);
            var amount_divide = parseFloat(amount) / 90;
            var percantage = parseFloat(amount_divide) * parseFloat(tax);
            var Rowtotal = parseFloat(percantage) + parseFloat(amount);
            grand = parseFloat(grand) - parseFloat(rowtot);
            grand = parseFloat(grand) + parseFloat(Rowtotal);
            $('#grandtotal').val(grand);
            $('#PurchaseTotal').html(Rowtotal);
            $('#Total_purchase').val(Rowtotal);
        }
    });
    $(document).on('change', '#Purchase_qty', function() {
        var Product_id = $('#Product_id').val();
        var old_product_id = $("#old_product_id").val();
        var Purchase_qty = $("#Purchase_qty").val();
        var Quantity = parseFloat(Purchase_qty);
        var sale_qty = $('#Sale_qty').val();
        var sale_Qty = parseFloat(sale_qty);
        if (Quantity <= sale_Qty) {
            alert('The Quantity Should Be above ' + sale_qty);
            $("#Purchase_qty").val('');
        }
    });
    $(document).on('blur', '#Product_name', function() {
        var Product_id = $('#Product_id').val();
        var old_product_id = $("#old_product_id").val();
        var Purchase_qty = $("#Purchase_qty").val();
        var Quantity = parseFloat(Purchase_qty);
        var sale_qty = $('#Sale_qty').val();
        var sale_Qty = parseFloat(sale_qty);
        if (old_product_id != Product_id) {
            if (Quantity == sale_Qty) {
                alert('The Quantity Should Be above ' + sale_qty);
                $("#Purchase_qty").val('');
            }
        }
    });

    function AddPurchase() {
        var Purchase_id = $('#Purchase_id').val();
        var Product_id = $('#Product_id').val();
        var Purchase_qty = $("#Purchase_qty").val();
        var Purchase_rte = $("#Purchase_rte").val();
        var Sale_rate = $("#Sale_price").val();
        var Total_purchase = $("#Total_purchase").val();
        var Tax_class = $("#tax_type").val();
        var grandtotal = $("#grandtotal").val();
        var invoice_no = $("#invoice_no").val();
        if (!/^[0-8]+$/.test(Purchase_qty) || !/^[.0-8]+$/.test(Purchase_rte) || !/^[.0-8]+$/.test(Sale_rate)) {
            //     $('#EditSale').modal('hide');
        } else if (Purchase_qty === '' || Purchase_rte === '' || Sale_rate === '') {} else {
            $('#EditPurchase').modal('hide');
            if (Purchase_id) {
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/Purchase/editUpdate",
                    data: {
                        purchase_id: Purchase_id,
                        product_id: Product_id,
                        product_purchase_quantity: Purchase_qty,
                        purchase_price: Purchase_rte,
                        sale_price: Sale_rate,
                        purchase_total_price: Total_purchase,
                        tax_id_fk: Tax_class,
                        grandtotal: grandtotal,
                        invoice_no: invoice_no
                    },
                    method: "POST",
                    datatype: "json",
                    success: function(data) {
                        var options = {
                            'title': 'Success...',
                            'style': 'success',
                            'message': 'product Edited Successfully....!',
                            'icon': 'Success',
                        };
                        var n = new notify(options);
                        n.show();
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function(e) {
                        console.log("error");
                    }
                });
            }
        }
    }

    function comfirmDeleteRow(id) {
        var conf = confirm("Do you want to Delete Details?");
        if (conf) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/purchase/delete_id",
                data: {
                    purchase_id: id
                },
                method: "POST",
                datatype: "json",
                success: function(data) {
                    var options = $.parseJSON(data);
                    noty(options);
                    location.reload();
                }
            });
        }
    }

    function send() {
        document.theform.submit()
    }
    $(document).on("change", '#customer_nam', function() {
        var id = $(this).val();
        if (id) {
            $.ajax({
                url: "<?php echo base_url(); ?>Sale/get_memberaddress",
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#customer_addre').val(data[0]['custaddress']);
                }
            });
            $.ajax({
                url: "<?php echo base_url(); ?>Sale/get_phone",
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
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
    var rowCount = 0;

    function addRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chk[]";
        cell1.appendChild(element1);
        var cell2 = row.insertCell(1);
        cell2.setAttribute("class", "democlass1");
        cell2.innerHTML = rowCount;

        var cell3 = row.insertCell(2);
        var element3 = document.createElement("input");
        element3.type = "text";
        element3.name = "product_code[]";
        element3.setAttribute("size", "6");
        element3.setAttribute("class", "democlass");
        element3.id = "product_code" + rowCount;
        element3.required = "required";
      //  element3.onchange = function() {getdata(rowCount, this) };
        element3.onkeyup=function() {getdata(rowCount,this);}
        cell3.appendChild(element3);

        var cell4 = row.insertCell(3);
        var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "product_name[]";
        element4.setAttribute("class", "democlass");
        element4.id = "product_name" + rowCount;
        cell4.appendChild(element4);

        var cell5 = row.insertCell(4);
        var element5 = document.createElement("select");
        element5.type = "select";
        element5.name = "pbar[]";
        element5.setAttribute("class", "democlass2");
        element5.id = "pbar" + rowCount;
        element5.setAttribute("onchange", "getbarcode(" + rowCount + ")");
        cell5.appendChild(element5);

        var cell6 = row.insertCell(5);
        var element6 = document.createElement("input");
        element6.type = "text";
        element6.name = "rate[]";
        element6.setAttribute("size", "6");
        element6.setAttribute("class", "democlass");
        element6.id = "rate" + rowCount;
        cell6.appendChild(element6);

        var cell7 = row.insertCell(6);
        var element7 = document.createElement("input");
        element7.type = "text";
        element7.name = "sale_quantity[]";
        element7.setAttribute("size", "6");
        element7.setAttribute("class", "democlass");
        element7.id = "pquantity_" + rowCount;
        element7.onkeyup = function() {
            gettotalgrid(rowCount, this);
        }
        cell7.appendChild(element7);

        var cell8 = row.insertCell(7);
        var element8 = document.createElement("input");
        element8.type = "text";
        element8.name = "tamount[]";
        element8.setAttribute("size", "6");
        element8.setAttribute("class", "democlass");
        element8.id = "tamount" + rowCount;
        cell8.appendChild(element8);
        var cell9 = row.insertCell(8);
        var element9 = document.createElement("input");
        element9.type = "text";
        element9.name = "taxamount[]";
        element9.setAttribute("size", "6");
        element9.setAttribute("class", "democlass");
        element9.id = "taxamount" + rowCount;
        cell9.appendChild(element9);

        var cell10 = row.insertCell(9);
        var element10 = document.createElement("input");
        element10.type = "text";
        element10.name = "netamt[]";
        element10.id = "netamt" + rowCount;
        element10.setAttribute("size", "6");
        element10.setAttribute("class", "democlass");;
        cell10.appendChild(element10);


        var cell11 = row.insertCell(10);
        var element11 = document.createElement("input");
        element11.type = "text";
        element11.name = "pdate[]";
        element11.id = "pdate" + rowCount;
        element11.setAttribute("size", "6");
        element11.setAttribute("class", "democlass");;
        cell11.appendChild(element11);


        var cell12 = row.insertCell(11);
        var element12 = document.createElement("input");
        element12.type = "hidden";
        element12.name = "product_id_fk[]";
        element12.id = "product_num" + rowCount;
        element12.setAttribute("size", "6");
        cell12.appendChild(element12);
        var options = {
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
        $("#product_name" + rowCount).easyAutocomplete(options);
        $('#product_name' + rowCount).change(function() {
            var reg = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>Purchase_Return/fetch_list",
                method: "POST",
                data: {
                    reg: reg
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    $('#pbar' + rowCount).show();
                    var html = '';
                    html += '<option value="">--Select Barcode--</option>';
                    html += '<option value="">Barcode - Price - Stock</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].pbarcodes + '>' + data[i].pbarcodes + ' - ' + data[i].purchase_price + ' - ' + data[i].product_quantity + '</option>';
                    }
                    $('#pbar' + rowCount).html(html);
                }
            });
            return false;
        });
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    var netamt = parseFloat($('#netamt' + i).val());
                    var pquantity = parseFloat($('#pquantity_' + i).val());
                    var pamount = parseFloat($('#pamount').val());
                    var qty_total = parseFloat($('#qty_total').val());
                    var net_total = parseFloat($('#net_total').val());
                    var saleamt = pamount - netamt;
                    var qty = qty_total - pquantity;
                    var nettot = net_total - netamt;
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                    document.getElementById("pamount").value = isNaN(saleamt) ? "0.00" : saleamt.toFixed(2);
                    document.getElementById("qty_total").value = qty;
                    document.getElementById("net_total").value = isNaN(nettot) ? "0.00" : nettot.toFixed(2);
                }
            }
        } catch (e) {
            alert(e);
        }
    }

    function getpebars(row) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchase_Return/getProductDetails2'; ?>',
            data: {
                p_name: $("#pbars").val()
            },
            success: function(data) {
                d = JSON.parse(data);
                console.log(d);
                $('#product_code' + row).html(d.barcode);
                $('#product_code' + row).val(d.barcode);
                $('#rate'+row).html(d.price);
                        $('#rate'+row).val(d.price);
                        $('#product_num'+row).html(d.prod_id);
                        $('#product_num'+row).val(d.prod_id);
                        $('#quant').html(d.stock);
                        $('#myDiv').show();
                        $('#pbars'+row).hide();
            },
            error: function() {}
        });
        // }
    }
    $(document).ready(function() {
        $('#product_code1').keyup(function() {
            msg = 'p_id=' + $(this).val();
            var pid = $(this).val();
            if (pid) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . 'index.php/Sale/getstock1'; ?>',
                    data: {
                        p_id: $("#product_code1").val()
                    },
                    success: function(data) {
                        $('#quant').html(data);
                        $('#myDiv').show();
                    },
                    error: function() {}
                });
            }
        });
    });
    $(document).ready(function() {
        $('#product_code1').keyup(function() {
            msg = 'p_id=' + $(this).val();
            var pid = $(this).val();
            
            if (pid) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . 'index.php/Sale/getpid'; ?>',
                    data: {
                        p_id: $("#product_code1").val()
                    },
                    success: function(data) {
                        $('#product_num1').html(data)
                        $("#product_num1").val(data);
                    },
                    error: function() {}
                });
            }
        });
    });
    $(document).ready(function() {
        $('#product_code1').keyup(function() {
            msg = 'p_id=' + $(this).val();
            var pid = $(this).val();
           // let length = pid.length;
         //   alert(length);
         if (this.value.length < 9 ) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . 'index.php/Sale/getpname'; ?>',
                    data: {
                        p_id: $("#product_code1").val()
                    },
                    success: function(data) {
                        $('#product_name1').html(data)
                        $("#product_name1").val(data);
                    },
                    error: function() {}
                });
            }
        });
    });
    $(document).ready(function() {
        $('#product_code1').keyup(function() {
            msg = 'p_id=' + $(this).val();
            var pid = $(this).val();
            if (pid) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . 'index.php/Purchase_Return/getrate'; ?>',
                    data: {
                        p_id: $("#product_code1").val()
                    },
                    success: function(data) {
                        $('#rate1').html(data)
                        $("#rate1").val(data);
                    },
                    error: function() {}
                });
            }
        });
    });

    $(document).ready(function() {
        $('#product_code1').keyup(function() {
            msg = 'p_id=' + $(this).val();
            var pid = $(this).val();
            if (pid) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . 'index.php/Purchase_Return/getpdate'; ?>',
                    data: {
                        p_id: $("#product_code1").val()
                    },
                    success: function(data) {
                        $('#pdate1').html(data)
                        $("#pdate1").val(data);
                    },
                    error: function() {}
                });
            }
        });
    });
    

    function getdata(idx, bal) {
      //  var wc = document.getElementById("product_code" + idx).value;
      var wc =bal.value;
        let length = wc.length;
         //   alert(length);
         if (length < 9 ) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Sale/getpid'; ?>',
                data: {
                    p_id: wc
                },
                success: function(data) {
                    $('#product_num' + idx).html(data)
                    $("#product_num" + idx).val(data);
                },
                error: function() {}
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Sale/getpname'; ?>',
                data: {
                    p_id: wc
                },
                success: function(data) {
                    $('#product_name' + idx).html(data)
                    $("#product_name" + idx).val(data);
                },
                error: function() {}
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Purchase_Return/getrate'; ?>',
                data: {
                    p_id: wc
                },
                success: function(data) {
                    $('#rate' + idx).html(data)
                    $("#rate" + idx).val(data);
                },
                error: function() {}
            });

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Purchase_Return/getpdate'; ?>',
                data: {
                    p_id: wc
                },
                success: function(data) {
                    $('#pdate' + idx).html(data)
                    $("#pdate" + idx).val(data);
                },
                error: function() {}
            });
          
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Sale/getstock1'; ?>',
                data: {
                    p_id: wc
                },
                success: function(data) {
                    $('#quant').html(data);
                    $('#myDiv').show();
                },
                error: function() {}
            });
        }//if(wc !="")
    }

    function gettotal(bal,id) { //alert("hai");
        var qty = $('#tamount_'+id).val();
        var prate = parseFloat(document.getElementById("rate_"+id).value);
        var total_amount = parseFloat(prate) * parseFloat(qty);
     //   var discount_amount = parseFloat(total_amount);
      //  var total = parseFloat(discount_amount);
        var idx = 1;
        var igst1 = parseFloat(document.getElementById("sale_igst"+id).value);
        var igst =igst1/100;
        var igstamt=total_amount * igst;
        var total=Math.round(parseFloat(total_amount) + parseFloat(igstamt));
        document.getElementById("taxableamount_"+id).value = isNaN(total_amount) ? "0.00" : total_amount.toFixed(2);
        document.getElementById("sale_igstamt"+id).value= isNaN(igstamt)?"0.00":igstamt.toFixed(2);
        document.getElementById("taxamount_"+id).value= isNaN(total)?"0.00":total.toFixed(2);
        totalamt(idx);
    }


    function totalamt(idx) { //alert(idx);
        var total = 0;
        var total1 = 0;
        var total2 = 0;
        var total3 = 0;
        for (var i = 1; i <= idx; i++) {
            var price = parseFloat(document.getElementById("taxamount_" + i).value);
            total += isNaN(price) ? 0 : price;
        }
        document.getElementById("netamt").value = isNaN(total) ? "0.00" : total.toFixed(2);
        document.getElementById("net").innerHTML = isNaN(total) ? "0.00" : total.toFixed(2);
    }

   

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
    $(document).ready(function() {
        $('#product_name1').change(function() {
            var reg = $(this).val();
            //alert(reg);
            $.ajax({
                url: "<?php echo base_url(); ?>Purchase_Return/fetch_list",
                method: "POST",
                data: {
                    reg: reg
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    $('#pbar1').show();
                    var html = '';
                    html += '<option value="">--Select Barcode--</option>';
                    html += '<option value="">Barcode - Price - Stock</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].pbarcodes + '>' + data[i].pbarcodes + ' - ' + data[i].purchase_price + ' - ' + data[i].product_quantity + '</option>';
                    }
                    $('#pbar1').html(html);
                }
            });
            return false;
        });
    });

    function getbarcode(row) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchase_Return/getProductDetails1'; ?>',
            data: {
                p_name: $("#pbar" + row).val()
            },
            success: function(data) {
                d = JSON.parse(data);
                // console.log(d);
                $('#product_code' + row).html(d.barcode);
                $('#product_code' + row).val(d.barcode);
                $('#rate' + row).html(d.price);
                $('#rate' + row).val(d.price);
                $('#product_num' + row).html(d.prod_id);
                $('#product_num' + row).val(d.prod_id);
                $('#quant').html(d.stock);
                $('#myDiv').show();
                $('#pbar' + row).hide();
            },
            error: function() {}
        });
    }

    $('#vendor_ids').on('change',function(){
       var vendor_id = this.value;
       $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchase_Return/getVendorDetails'; ?>',
            data: {
                vendor_id: vendor_id,
            },
            success: function(data) {
                var d = JSON.parse(data);
                console.log(d);
                $('#customer_addre').val(d.vendoraddress);
            },
            error: function() {}
        });
    })

    
    /* var optionsb = {
        // url: "<?php echo base_url() ?>Sale/getproduct_names",
        url: function(phrase) {
            return "<?php echo base_url() ?>Purchase_Return/getproduct_barcode?phrase=" + phrase + "&format=json";
        },
        getValue: "name",
        list: {
            match: {
                enabled: true
            }
        }
    };
    $("#product_code1").easyAutocomplete(optionsb); */
</script>