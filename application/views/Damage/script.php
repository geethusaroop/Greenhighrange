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
      console.log("HI");
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
            foreach ($unit as $uts) { ?> {
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
        element3.name = "damage_item_id_fk[]";
        element3.id = "damage_item_id_fk" + rowCount;
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
        element4.name = "damage_count[]";
        element4.setAttribute("size", "6");
        element4.setAttribute("class", "democlass");
        element4.id = "damage_count" + rowCount;
        element4.setAttribute("onkeyup", "getstockbal(" + rowCount + ")");
        cell4.appendChild(element4);

        var cell5 = row.insertCell(4);
        var element5 = document.createElement("select");
        element5.type = "select";
        element5.name = "damage_unit[]";
        element5.id = "damage_unit" + rowCount;
        element5.setAttribute("class", "democlass");
        // element3.required = "required";
        for (var i = 0; i < listUnits.length; i += 1) {
            var option = document.createElement('option');
            option.setAttribute('value', listUnits[i].value);
            option.appendChild(document.createTextNode(listUnits[i].text));
            element5.appendChild(option);
        }
        cell5.appendChild(element5);

        var cell6 = row.insertCell(5);
        var element6 = document.createElement("input");
        element6.type = "text";
        element6.name = "current_stock[]";
        element6.setAttribute("size", "6");
        element6.setAttribute("class", "democlass");
        element6.id = "current_stock" + rowCount;
        cell6.appendChild(element6);

        var cell7 = row.insertCell(6);
        var element7 = document.createElement("input");
        element7.type = "text";
        element7.name = "current_stock_unit[]";
        element7.setAttribute("size", "6");
        element7.setAttribute("class", "democlass");
        element7.id = "current_stock_unit" + rowCount;
        cell7.appendChild(element7);


        var cell8 = row.insertCell(7);
        var element8 = document.createElement("input");
        element8.type = "text";
        element8.name = "damage_bal[]";
        element8.setAttribute("size", "6");
        element8.setAttribute("class", "democlass");
        element8.id = "damage_bal" + rowCount;
        cell8.appendChild(element8);
      
       
        $('#damage_item_id_fk'+rowCount).select2();
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

    $('#damage_item_id_fk1').select2();

    
    function getproductdetails(row)
    { 
     // alert($("#damage_product_id_fk"+row).val());
                  $.ajax({
                      type: 'POST',
                      url:"<?php echo base_url()?>Damage/getpstock",
                      data: {
                          pid: $("#damage_item_id_fk"+row).val()
                      },
                      success: function(data) {
                          d = JSON.parse(data);
                          console.log(d);
                           $('#current_stock'+row).html(d.product_stock);
                          $('#current_stock'+row).val(d.product_stock);
                          $('#current_stock_unit'+row).html(d.unit_name);
                          $('#current_stock_unit'+row).val(d.unit_name); 
                        
                      },
                      error: function() {
                      }
                  });
    }

  function getstockbal(row)
  {
    var damage_qty=parseFloat(document.getElementById('damage_count'+row).value);
    var damage_stock=parseFloat(document.getElementById('current_stock'+row).value);
    var bal=parseFloat(damage_stock)-parseFloat(damage_qty);
    document.getElementById('damage_bal'+row).value=isNaN(bal) ? "0" : bal;
  }
</script>
