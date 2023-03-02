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


    var rowCount = 0;
    function addRow(tableID) {
        <?php
        $i = 0;
        ?>
        var listValues = [
            { value: '', text: 'SELECT' }, 
            <?php $i = 0;
            foreach ($product as $w) { ?> {
                    value: '<?php echo $w->product_id; ?>',
                    text: '<?php echo $w->product_name ?>'
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
        element3.name = "prod_name[]";
        element3.id = "prod_name" + rowCount;
        element3.setAttribute("onchange", "getproductdetails(" + rowCount + ")");
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
        element4.name = "prod_code[]";
        element4.setAttribute("size", "16");
        element4.setAttribute("class", "democlass");
        element4.id = "prod_code" + rowCount;
        cell4.appendChild(element4);

        var cell5 = row.insertCell(4);
        var element5 = document.createElement("input");
        element5.type = "text";
        element5.name = "stck_amt[]";
        element5.setAttribute("size", "16");
        element5.setAttribute("class", "democlass");
        element5.required = "required";
        element5.id = "stck_amt" + rowCount;
        cell5.appendChild(element5);

        var cell6 = row.insertCell(5);
        var element6 = document.createElement("input");
        element6.type = "text";
        element6.name = "av_stk[]";
        element6.setAttribute("size", "6");
        element6.setAttribute("class", "democlass");
        element6.id = "av_stk" + rowCount;
        cell6.appendChild(element6);

        var cell7 = row.insertCell(6);
        var element7 = document.createElement("input");
        element7.type = "hidden";
        element7.name = "product_name[]";
        element7.id = "product_name" + rowCount;
        element6.setAttribute("size", "6");
        element7.setAttribute("class", "democlass");
        cell7.appendChild(element7);

        var cell8 = row.insertCell(7);
        var element8 = document.createElement("input");
        element8.type = "hidden";
        element8.name = "product_unit[]";
        element8.setAttribute("size", "6");
        element8.setAttribute("class", "democlass");
        element8.id = "product_unit" + rowCount;
        cell8.appendChild(element8);

        var cell9 = row.insertCell(8);
        var element9 = document.createElement("input");
        element9.type = "hidden";
        element9.name = "product_price_r1[]";
        element9.setAttribute("size", "6");
        element9.setAttribute("class", "democlass");
        element9.id = "product_price_r1_" + rowCount;
        cell9.appendChild(element9);

        var cell10 = row.insertCell(9);
        var element10 = document.createElement("input");
        element10.type = "hidden";
        element10.name = "product_price_r2[]";
        element10.setAttribute("size", "6");
        element10.setAttribute("class", "democlass");
        element10.id = "product_price_r2_" + rowCount;
        cell10.appendChild(element10);

        var cell11 = row.insertCell(10);
        var element11 = document.createElement("input");
        element11.type = "hidden";
        element11.name = "product_price_r3[]";
        element11.setAttribute("size", "6");
        element11.setAttribute("class", "democlass");
        element11.id = "product_price_r3_" + rowCount;
        cell11.appendChild(element11);


        var cell12 = row.insertCell(11);
        var element12 = document.createElement("input");
        element12.type = "hidden";
        element12.name = "product_des[]";
        element12.setAttribute("size", "6");
        element12.setAttribute("class", "democlass");
        element12.id = "product_des" + rowCount;
        cell12.appendChild(element12);

        var cell13 = row.insertCell(12);
        var element13 = document.createElement("input");
        element13.type = "hidden";
        element13.name = "product_category[]";
        element13.setAttribute("size", "6");
        element13.setAttribute("class", "democlass");
        element13.id = "product_category" + rowCount;
        cell13.appendChild(element13);

        var cell14 = row.insertCell(13);
        var element14 = document.createElement("input");
        element14.type = "hidden";
        element14.name = "product_unit_type[]";
        element14.setAttribute("size", "6");
        element14.setAttribute("class", "democlass");
        element14.id = "product_unit_type" + rowCount;
        cell14.appendChild(element14);

        var cell15 = row.insertCell(14);
        var element15 = document.createElement("input");
        element15.type = "hidden";
        element15.name = "product_hsn[]";
        element15.setAttribute("size", "6");
        element15.setAttribute("class", "democlass");
        element15.id = "product_hsn" + rowCount;
        cell15.appendChild(element15);


        var cell16 = row.insertCell(15);
        var element16 = document.createElement("input");
        element16.type = "hidden";
        element16.name = "product_hsncode[]";
        element16.setAttribute("size", "6");
        element16.setAttribute("class", "democlass");
        element16.id = "product_hsncode" + rowCount;
        cell16.appendChild(element16);
       
        $('#prod_name'+rowCount).select2();
    }
        $('#prod_name1').select2();


        function getproductdetails(row)
        { 
                      $.ajax({
                          type: 'POST',
                          url:"<?php echo base_url()?>Branch_transfer/getAvailStock",
                          data: {
                              pid: $("#prod_name"+row).val()
                          },
                          success: function(data) {
                              d = JSON.parse(data);
                              console.log(d);
                              $('#av_stk'+row).html(d.product_stock);
                              $('#av_stk'+row).val(d.product_stock);
                              $('#prod_code'+row).html(d.product_code);
                              $('#prod_code'+row).val(d.product_code); 

                              $('#product_name'+row).val(d.product_name);
                              $('#product_name'+row).html(d.product_name);

                              $('#product_unit'+row).val(d.product_unit);
                              $('#product_unit'+row).html(d.product_unit);

                              $('#product_hsn'+row).val(d.product_hsn);
                              $('#product_hsn'+row).html(d.product_hsn);

                              $('#product_hsncode'+row).val(d.product_hsncode);
                              $('#product_hsncode'+row).html(d.product_hsncode);

                              $('#product_price_r1_'+row).val(d.product_price_r1);
                              $('#product_price_r1_'+row).html(d.product_price_r1);

                              $('#product_price_r2_'+row).val(d.product_price_r2);
                              $('#product_price_r2_'+row).html(d.product_price_r2);

                              $('#product_price_r3_'+row).val(d.product_price_r3);
                              $('#product_price_r3_'+row).html(d.product_price_r3);

                              $('#product_des'+row).val(d.product_des);
                              $('#product_des'+row).html(d.product_des);

                              $('#product_category'+row).val(d.product_category);
                              $('#product_category'+row).html(d.product_category);

                              $('#product_unit_type'+row).val(d.product_unit_type); 
                              $('#product_unit_type'+row).html(d.product_unit_type);
                            
                          },
                          error: function() {
                          }
                      });
        }

</script>
