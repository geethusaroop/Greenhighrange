<script>
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
            } else {
            }
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
            var htmlVal = '<DIV class="product-item" id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="1" ><tr><div class="form-group"><div class="col-md-2"><select name="product_id_fk[]" class="form-control product_num"  id="product_num' + counter + '" autofocus /></select></div><div class="form-group"><div class="col-md-2"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="mrp' + counter + '" name="mrp[]"  placeholder="Rate"></div><div class="form-group"><div class="col-md-1"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control quantity" id="pquantity_' + counter + '" name="purchase_quantity[]" placeholder="Qty"></div><div class="col-md-1"><input type="text" data-pms-required="true" class="form-control unit" id="punit_' + counter + '" name="purchase_unit[]" placeholder="Unit"></div><div class="col-md-2"><input type="text" placeholder="discount %" data-pms-required="true" data-validation="digitsOnly" class="form-control discount" id="discount_' + counter + '" name="discount_price[]" placeholder="Discount Rate"></div><div class="col-md-2"><select class="form-control amountclass" id="taxtype_' + counter + '" name="taxtype[]"></select></div><div class="col-md-1"><label>Total Amount :</label><label><span id="totalAmount_' + counter + '"></span></label><input type="hidden" class="totalPrice"  name="purchase_total_price[]" id="total_price_' + counter + '" ><input type="hidden" id="taxpercantage_' + counter + '" ></div></div></tr></table></DIV>';
            $("#product").append(htmlVal);
            var param = '';
            $('#product_num_' + counter + '').focus();
            $('#product_num_' + counter + '').click(function() {
                $("#product_num").val('');
            });
            $('#product_num_' + counter + '').change(function() {
                setTimeout(function() {
                    var a = $("#productnum_").val();
                    if (a === '') {
                        $('#product_num_' + counter + '').val('');
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
                }, 1000);
            });
            $.ajax({
                url: "<?php echo base_url() ?>Purchase/getproductname",
                type: 'POST',
                success: function(data) {
                    $.each(data, function(raw_id, raw_item) {
                        var opt = $('<option />');
                        opt.val(raw_id);
                        opt.text(raw_item);
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
                url: "<?php echo base_url() ?>Purchase/gettax",
                success: function(cities) {
                    $('#taxtype_' + counter + '').append('<option value="">---Select Tax---</option>');
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
    $(document).on("change", '.amountclass', function() {
        var taxtype = $(this).val();
        var counterId = $(this).attr("id");
        var counter = counterId.split("_")[1];
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
                    var amount = $('#mrp' + counter + '').val();
                    var quantity = $('#pquantity_' + counter + '').val();
                    var tax = $('#taxpercantage_' + counter + '').val();
                    var cost = $('#pprice_' + counter + '').val();
                    var discount = $('#discount_' + counter + '').val();
                    if (tax !== '' && quantity !== '' && amount !== '') {
                        var total_amount = parseFloat(amount) * parseFloat(quantity);
                        if (discount > 0) {
                            var discount_amount = parseFloat(total_amount) - (parseFloat(total_amount) * parseFloat(discount)) / 100;
                        } else {
                            var discount_amount = parseFloat(total_amount);
                        }
                        var taxamount = (parseFloat(discount_amount) * parseFloat(tax)) / 100;
                        var full_amount = parseFloat(discount_amount) + parseFloat(taxamount);
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
                        $('#net_total').trigger('change');
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
            var taxamount = (parseFloat(amount) * parseFloat(tax)) / 100;
            var full_amount = parseFloat(amount) + parseFloat(taxamount);
            var total_amount = parseFloat(full_amount) * parseFloat(quantity);
            $('#totalAmount_' + counter + '').html(parseFloat(total_amount).toFixed(2));
            $('#total_price_' + counter + '').val(parseFloat(total_amount).toFixed(2));
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
            total_amount = 0;
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
            var taxamount = (parseFloat(amount) * parseFloat(tax)) / 100;
            var full_amount = parseFloat(amount) + parseFloat(taxamount);
            var total_amount = parseFloat(full_amount) * parseFloat(quantity);
            $('#totalAmount_' + counter + '').html(parseFloat(total_amount).toFixed(2));
            $('#total_price_' + counter + '').val(parseFloat(total_amount).toFixed(2));
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
            total_amount = 0;
        }
    });
    var $productList = [{
        'columnName': 'product_name',
        'label': 'Product'
    }];
    var param = '';
    $('#product_name').rcm_autoComplete('<?php echo base_url(); ?>index.php/common/getProductList', $productList, param, getProduct);
    function getProduct(el, event, item) {
        console.log(el);
        console.log(el.next());
        if (item.product_id) {
            el.val(item.product_num);
            $('#product_id').val(item.product_id);
        }
    }
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
            "fixedHeader": true,
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
                "url": "<?php echo base_url(); ?>purchaseitem/get/",
                "type": "POST",
                "data": function(d) {
                    d.invoice_number = $('#invoice_number').val();
                }
            },
            "createdRow": function(row, data, index) {
                console.log(data);
                $table.column(0).nodes().each(function(node, index, dt) {
                    $table.cell(node).data(index + 1);
                });
             //   $('td', row).eq(6).html('<center><a target ="_blank" class="btn btn-primary" href="<?php echo base_url(); ?>purchaseitem/showRetunPurchase/' + data['auto_invoice'] + '">RETURN</a></center>');
                $('td', row).eq(6).html('<center><a target ="_blank"  href="<?php echo base_url(); ?>purchaseitem/invoice/' + data['auto_invoice'] + '"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
                $('td', row).eq(7).html('<center><a href="<?php echo base_url(); ?>purchaseitem/editPurchase/' + data['auto_invoice'] + '"><i class="fa fa-edit" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['auto_invoice']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
            },
            "columns": [{ "data": "purchase_status","orderable": false },
                { "data": "invoice_number","orderable": false },
                { "data": "vendorname","orderable": false },
                { "data": "purchase_dat","orderable": false },
                { "data": "prcount","orderable": false },
                { "data": "total","orderable": false },
             //   { "data": "invoice_number","orderable": false },
                { "data": "invoice_number","orderable": false },
                { "data": "invoice_number","orderable": false },
            ]
        });
    });
    function getVendorName(el, event, item) {
        console.log(item);
        if (item.vendor_id) {
            el.val(item.vendorname);
            $("#vendor_id").val(item.vendor_id);
            $("#vendor_phone").val(item.vendor_phone);
            $("#vendorgst").val(item.vendorgst);
            $("#vendorstate").val(item.vendorstate);
            $("#vendor_gsttype").val(item.vendor_gsttype);
            $("#vendor_statetype").val(item.vendor_statetype);
        }
    }
    $(document).on("change", '#vendor_id_fk', function() {
        var id = $(this).val();
        if (id) {
            $.ajax({
                url: "<?php echo base_url(); ?>purchaseitem/get_gst",
                type: 'POST',
                data: {
                    vid: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#vendorgst').val(data[0]['vendorgst']);
                    $('#vendorstate').val(data[0]['vendorstate']);
                    $('#vendor_gsttype').val(data[0]['vendor_gsttype']);
                    $('#vendor_statetype').val(data[0]['vendor_statetype']);
                }
            });
            $.ajax({
                url: "<?php echo base_url(); ?>purchaseitem/get_old_bal",
                type: 'POST',
                data: {
                    vid: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#old_bal').html(data[0]['old_balance']);
                    $('#old_bal_').val(data[0]['old_balance']);
                    $('#net_bal').html(data[0]['old_balance']);
                    $('#net_balance').val(data[0]['old_balance']);
                    $('#netbal').val(data[0]['old_balance']);
                }
            });
        }
    });
    function send() {
        document.theform.submit()
    }
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo base_url(); ?>Purchaseitem/get_invc_no/",
            type: "POST",
            datatype: "json",
            success: function(data) {
                var options = $.parseJSON(data);
                var d = parseFloat(options);
            }
        });
    });
</script>
<script type="text/javascript">
    var rowCount = 0;
    function addRow(tableID) {
        <?php
        $i = 0;
        ?>
        var listValues = [
            { value: '', text: 'SELECT' }, 
            <?php $i = 0;
            foreach ($product_names as $w) { ?> {
                    value: '<?php echo $w->product_id; ?>',
                    text: '<?php echo $w->product_name ?>'
                },
            <?php
            }
            ?>
        ];
        var listUnits = [
            { value: '', text: 'SELECT' }, 
            <?php $i = 0;
            foreach ($product_unit as $uts) { ?> {
                    value: '<?php echo $uts->unit_id; ?>',
                    text: '<?php echo $uts->unit_name ?>'
                },
            <?php
            }
            ?>
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
        var element3 = document.createElement("select");
        element3.type = "select";
        element3.name = "product_id_fk[]";
        element3.id = "product_num" + rowCount;
        element3.setAttribute("onchange", "getdata(" + rowCount + ")");
        element3.setAttribute("class", "democlass");
        // element3.required = "required";
        for (var i = 0; i < listValues.length; i += 1) {
            var option = document.createElement('option');
            option.setAttribute('value', listValues[i].value);
            option.appendChild(document.createTextNode(listValues[i].text));
            element3.appendChild(option);
        }
        cell3.appendChild(element3);
        var cell4 = row.insertCell(3);
        var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "purchase_hsn[]";
        element4.setAttribute("size", "16");
        element4.setAttribute("class", "democlass");
        element4.required = "required";
        element4.id = "purchase_hsn" + rowCount;
        cell4.appendChild(element4);
        var cell5 = row.insertCell(4);
        var element5 = document.createElement("input");
        element5.type = "text";
        element5.name = "purchase_quantity[]";
        element5.setAttribute("size", "6");
        element5.setAttribute("class", "democlass");
        element5.id = "pquantity_" + rowCount;
        //  element5.required = "required";
        cell5.appendChild(element5);
        var cell6 = row.insertCell(5);
        var element6 = document.createElement("select");
        element6.type = "select";
        element6.name = "purchase_unit[]";
        element6.id = "product_num" + rowCount;
        element6.setAttribute("class", "democlass");
        // element3.required = "required";
        for (var i = 0; i < listUnits.length; i += 1) {
            var option = document.createElement('option');
            option.setAttribute('value', listUnits[i].value);
            option.appendChild(document.createTextNode(listUnits[i].text));
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
        element7.id = "rate" + rowCount;
        cell7.appendChild(element7);
        var cell8 = row.insertCell(7);
        var element8 = document.createElement("input");
        element8.type = "text";
        element8.name = "mrp[]";
        element8.setAttribute("size", "6");
        element8.setAttribute("class", "democlass");
        //   element7.required = "required";
        cell8.appendChild(element8);

        var cell9 = row.insertCell(8);
        var element9 = document.createElement("input");
        element9.type = "text";
        element9.name = "r1[]";
        element9.setAttribute("size", "6");
        element9.setAttribute("class", "democlass");
        //   element7.required = "required";
        cell9.appendChild(element9);

        var cell10 = row.insertCell(9);
        var element10 = document.createElement("input");
        element10.type = "text";
        element10.name = "r2[]";
        element10.setAttribute("size", "6");
        element10.setAttribute("class", "democlass");
        //   element7.required = "required";
        cell10.appendChild(element10);

        var cell11 = row.insertCell(10);
        var element11 = document.createElement("input");
        element11.type = "text";
        element11.name = "r3[]";
        element11.setAttribute("size", "6");
        element11.setAttribute("class", "democlass");
        //   element7.required = "required";
        cell11.appendChild(element11);

        var cell12 = row.insertCell(11);
        var element12 = document.createElement("input");
        element12.type = "text";
        element12.name = "discount_price[]";
        element12.setAttribute("size", "6");
        element12.setAttribute("class", "democlass");
        element12.id = "discount_" + rowCount;
        //  element8.required = "required";
        element12.onkeyup = function() {
            gettotalgrid(rowCount, this);
        }
        cell12.appendChild(element12);
        var cell13 = row.insertCell(12);
        var element13 = document.createElement("input");
        element13.type = "text";
        element13.name = "tamount[]";
        element13.setAttribute("size", "6");
        element13.setAttribute("class", "democlass");
        //  element9.required = "required";
        element13.id = "tamount" + rowCount;
        cell13.appendChild(element13);

        var cell14 = row.insertCell(13);
        var element14 = document.createElement("input");
        element14.type = "text";
        element14.name = "taxamount[]";
        element14.setAttribute("size", "6");
        element14.setAttribute("class", "democlass");
        element14.id = "taxamount" + rowCount;
        // element10.required = "required";
        cell14.appendChild(element14);

        var cell15 = row.insertCell(14);
        var element15 = document.createElement("input");
        element15.type = "text";
        element15.name = "cgst[]";
        element15.id = "cgst" + rowCount;
        element15.setAttribute("size", "6");
        element15.setAttribute("class", "democlass");
        // element11.required = "required";
        cell15.appendChild(element15);

        var cell16 = row.insertCell(15);
        var element16 = document.createElement("input");
        element16.type = "text";
        element16.name = "cgstamt[]";
        element16.id = "cgstamt" + rowCount;
        element16.setAttribute("size", "6");
        element16.setAttribute("class", "democlass");
        // element12.required = "required";
        cell16.appendChild(element16);

        var cell17 = row.insertCell(16);
        var element17 = document.createElement("input");
        element17.type = "text";
        element17.name = "sgst[]";
        element17.id = "sgst" + rowCount;
        element17.setAttribute("size", "6");
        element17.setAttribute("class", "democlass");
        //  element13.required = "required";
        cell17.appendChild(element17);

        var cell18 = row.insertCell(17);
        var element18 = document.createElement("input");
        element18.type = "text";
        element18.name = "sgstamt[]";
        element18.id = "sgstamt" + rowCount;
        element18.setAttribute("size", "6");
        element18.setAttribute("class", "democlass");
        //   element14.required = "required";
        cell18.appendChild(element18);

        var cell19 = row.insertCell(18);
        var element19 = document.createElement("input");
        element19.type = "text";
        element19.name = "igst[]";
        element19.id = "igst" + rowCount;
        element19.setAttribute("size", "6");
        element19.setAttribute("class", "democlass");
        //   element15.required = "required";
        cell19.appendChild(element19);

        var cell20 = row.insertCell(19);
        var element20 = document.createElement("input");
        element20.type = "text";
        element20.name = "igstamt[]";
        element20.id = "igstamt" + rowCount;
        element20.setAttribute("size", "6");
        element20.setAttribute("class", "democlass");
        // element16.required = "required";
        cell20.appendChild(element20);

        var cell21 = row.insertCell(20);
        var element21 = document.createElement("input");
        element21.type = "text";
        element21.name = "netamt[]";
        element21.id = "netamt" + rowCount;
        element21.setAttribute("size", "6");
        element21.setAttribute("class", "democlass");
        //  element17.required = "required";
        cell21.appendChild(element21);
        $('#product_num'+rowCount).select2();
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
        } catch (e) {
            alert(e);
        }
    }
    $(document).ready(function() {
        $('#product_num1').change(function() {
            msg = 'p_id=' + $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Purchaseitem/gethsn'; ?>',
                data: {
                    p_id: $("#product_num1").val()
                },
                success: function(data) {
                    $('#purchase_hsn1').html(data)
                    $("#purchase_hsn1").val(data);
                },
                error: function() {
                }
            });
        });
    });
    $(document).ready(function() {
        $('#product_num1').change(function() {
            msg = 'p_id=' + $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Purchaseitem/getcgst'; ?>',
                data: {
                    p_id: $("#product_num1").val()
                },
                success: function(data) {
                    $('#cgst1').html(data)
                    $("#cgst1").val(data);
                },
                error: function() {
                }
            });
        });
    });
    $(document).ready(function() {
        $('#product_num1').change(function() {
            msg = 'p_id=' + $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Purchaseitem/getsgst'; ?>',
                data: {
                    p_id: $("#product_num1").val()
                },
                success: function(data) {
                    $('#sgst1').html(data)
                    $("#sgst1").val(data);
                },
                error: function() {
                }
            });
        });
    });
    $(document).ready(function() {
        $('#product_num1').change(function() {
            msg = 'p_id=' + $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . 'index.php/Purchaseitem/getigst'; ?>',
                data: {
                    p_id: $("#product_num1").val()
                },
                success: function(data) {
                    $('#igst1').html(data)
                    $("#igst1").val(data);
                },
                error: function() {
                }
            });
        });
    });
    function getdata(idx) {
        var wc = document.getElementById("product_num" + idx).value;
        ///alert(wc);
        //  document.getElementById("wname"+idx).value = wc ;
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchaseitem/gethsn'; ?>',
            data: {
                p_id: wc
            },
            success: function(data) {
                $('#purchase_hsn' + idx).html(data)
                $("#purchase_hsn" + idx).val(data);
            },
            error: function() {
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchaseitem/getcgst'; ?>',
            data: {
                p_id: wc
            },
            success: function(data) {
                $('#cgst' + idx).html(data)
                $("#cgst" + idx).val(data);
            },
            error: function() {
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchaseitem/getsgst'; ?>',
            data: {
                p_id: wc
            },
            success: function(data) {
                $('#sgst' + idx).html(data)
                $("#sgst" + idx).val(data);
            },
            error: function() {
            }
        });
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchaseitem/getigst'; ?>',
            data: {
                p_id: wc
            },
            success: function(data) {
                $('#igst' + idx).html(data)
                $("#igst" + idx).val(data);
            },
            error: function() {
            }
        });
    }
    function gettotal(bal) {
        var qty = parseFloat(document.getElementById("pquantity_1").value);
        var prate = parseFloat(document.getElementById("rate1").value);
        var cgst1 = parseFloat(document.getElementById("cgst1").value);
        var cgst = cgst1 / 100;
        var sgst1 = parseFloat(document.getElementById("sgst1").value);
        var sgst = sgst1 / 100;
        var igst1 = parseFloat(document.getElementById("igst1").value);
        var igst = igst1 / 100;
        //var kol = (((84/ 28)* brith * width* bal.value) / 12 ) ;
        var total_amount = parseFloat(prate) * parseFloat(qty);
        var discount = bal.value;
        if (discount > 0) {
            var discount_amount = parseFloat(total_amount) - (parseFloat(total_amount) * parseFloat(discount)) / 100;
        } else {
            var discount_amount = parseFloat(total_amount);
        }
        var cgstamt = discount_amount * cgst;
        var sgstamt = discount_amount * sgst;
        var igstamt = discount_amount * igst;
        var total = parseFloat(discount_amount) + parseFloat(igstamt);
        var idx = 1;
        document.getElementById("tamount1").value = isNaN(discount_amount) ? "0.00" : discount_amount.toFixed(2);
        document.getElementById("taxamount1").value = isNaN(discount_amount) ? "0.00" : discount_amount.toFixed(2);
        document.getElementById("cgstamt1").value = isNaN(cgstamt) ? "0.00" : cgstamt.toFixed(2);
        document.getElementById("sgstamt1").value = isNaN(sgstamt) ? "0.00" : sgstamt.toFixed(2);
        document.getElementById("igstamt1").value = isNaN(igstamt) ? "0.00" : igstamt.toFixed(2);
        document.getElementById("netamt1").value = isNaN(total) ? "0.00" : total.toFixed(2);
        totalamt(idx);
    }
    function gettotalgrid(idx, bal) { //alert(idx);
        var qty = parseFloat(document.getElementById("pquantity_" + idx).value);
        var prate = parseFloat(document.getElementById("rate" + idx).value);
        //var kol = (((84/ 28)* brith * width* bal.value) / 12 ) ;
        var total_amount = parseFloat(prate) * parseFloat(qty);
        var cgst1 = parseFloat(document.getElementById("cgst" + idx).value);
        var cgst = cgst1 / 100;
        var sgst1 = parseFloat(document.getElementById("sgst" + idx).value);
        var sgst = sgst1 / 100;
        var igst1 = parseFloat(document.getElementById("igst" + idx).value);
        var igst = igst1 / 100;
        var discount = bal.value;
        if (discount > 0) {
            var discount_amount = parseFloat(total_amount) - (parseFloat(total_amount) * parseFloat(discount)) / 100;
        } else {
            var discount_amount = parseFloat(total_amount);
        }
        var cgstamt = discount_amount * cgst;
        var sgstamt = discount_amount * sgst;
        var igstamt = discount_amount * igst;
        var total = parseFloat(discount_amount) + parseFloat(igstamt);
        document.getElementById("tamount" + idx).value = isNaN(discount_amount) ? "0.00" : discount_amount.toFixed(2);
        document.getElementById("taxamount" + idx).value = isNaN(discount_amount) ? "0.00" : discount_amount.toFixed(2);
        document.getElementById("cgstamt" + idx).value = isNaN(cgstamt) ? "0.00" : cgstamt.toFixed(2);
        document.getElementById("sgstamt" + idx).value = isNaN(sgstamt) ? "0.00" : sgstamt.toFixed(2);
        document.getElementById("igstamt" + idx).value = isNaN(igstamt) ? "0.00" : igstamt.toFixed(2);
        document.getElementById("netamt" + idx).value = isNaN(total) ? "0.00" : total.toFixed(2);
        totalamt(idx);
    }
    function totalamt(idx) { //alert(idx);
        var total = 0;
        var total1 = 0;
        var total2 = 0;
        var total3 = 0;
        for (var i = 1; i <= idx; i++) {
            var price = parseFloat(document.getElementById("netamt" + i).value);
            var tamount = parseFloat(document.getElementById("tamount" + i).value);
            var pquantity = parseFloat(document.getElementById("pquantity_" + i).value);
            var ptax1 = parseFloat(document.getElementById("igstamt" + i).value);
            var old_bal = parseFloat(document.getElementById("old_bal_").value);
            total += isNaN(price) ? 0 : price;
            total1 += isNaN(tamount) ? 0 : tamount;
            total2 += isNaN(pquantity) ? 0 : pquantity;
            total3 += isNaN(ptax1) ? 0 : ptax1;
        }
        var totals = parseFloat(old_bal) + parseFloat(total);
        //alert(total);
        document.getElementById("net_total").value = isNaN(total) ? "0.00" : total.toFixed(2);
        document.getElementById("gross_amt").value = isNaN(total1) ? "0.00" : total1.toFixed(2);
        document.getElementById("taxamounts").value = isNaN(total1) ? "0.00" : total1.toFixed(2);
        document.getElementById("qty_total").value = isNaN(total2) ? "0.00" : total2.toFixed(2);
        document.getElementById("ptax").value = isNaN(total3) ? "0.00" : total3.toFixed(2);
        document.getElementById("pamount").value = isNaN(total) ? "0.00" : total.toFixed(2);
        document.getElementById("total_amt").value = isNaN(totals) ? "0.00" : totals.toFixed(2);
    }
    function getamount() {
        var total_amt = parseFloat(document.getElementById("total_amt").value);
        var paid_amt = parseFloat(document.getElementById("paid_amt").value);
        if (total_amt > paid_amt) {
            var total = parseFloat(total_amt) - parseFloat(paid_amt);
        } else if (total_amt < paid_amt) {
            var total = parseFloat(paid_amt) - parseFloat(total_amt);
        }
        document.getElementById("net_balances").value = isNaN(total) ? "0.00" : total.toFixed(2);
    };
    function masterStock(auto_invoice){
        // alert(auto_invoice)
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'index.php/Purchaseitem/masterStock'; ?>',
            data: {
                auto_invoice: auto_invoice
            },
            success: function(data) {
                $table.ajax.reload();
                alert("Stock Updated!")
            },
            error: function() {
            }
        });
    }
    $('#product_hsn').on('change',function(){
    var hsn_id = this.value;
    var resp = "";
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'Purchaseitem/getHsnCode'; ?>',
            data: {
                hsn_id: hsn_id,
            },
            success: function(data) {
                resp = JSON.parse(data);
                console.log(resp);
                $('#product_hsncode').val(resp.hsncode);
            },
            error: function() {
            }
        });
})
$(document).ready(function() {
    $('#product_num1').select2();
});
</script>
