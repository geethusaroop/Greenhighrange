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
$(function () {
  var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
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
  $table = $('#classinfo_table').DataTable( {
    "processing": true,
    "serverSide": true,
    "bDestroy" : true,
    "ajax": {
      "url": "<?php echo base_url();?>Routsale/get/",
      "type": "POST",
      "data" : function (d) {
        d.item_name = $('#item_names').val();
      }
    },
    "createdRow": function ( row, data, index ) {
      //            $('td',row).eq(0).html(index+1);
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      $('td', row).eq(1).css( "font-weight", "bold");
      $('td', row).eq(2).css( "font-weight", "bold");
      $('td', row).eq(3).css( "font-weight", "bold" );
     // $('td', row).eq(2).css( "text-align", "center" );
      $('td', row).eq(4).css( "font-weight", "bold" );
      $('td', row).eq(4).css( "text-align", "center" );
      $('td', row).eq(5).css( "font-weight", "bold" );
      $('td', row).eq(6).css( "font-weight", "bold" );
    
      $('td', row).eq(4).html(''+data['routsale_from']+'-'+data['routsale_to']+'');

 //    $('td', row).eq(7).html('<center><a href="<?php echo base_url();?>index.php/Productionitem/edit/'+data['pstock_id']+'/'+data['pstock_product_id_fk']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['pstock_id']+','+data['pstock_product_id_fk']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    },
    "columns": [
      { "data": "routsale_status", "orderable": false },
      { "data": "routsale_date", "orderable": false },
      { "data": "routsale_driver", "orderable": false },
      { "data": "routsale_vehicle_no", "orderable": false },
      { "data": "routsale_from", "orderable": false },
      { "data": "product_name", "orderable": false },
      { "data": "product_code", "orderable": false },
      { "data": "routsale_stock", "orderable": false },
    //  { "data": "routsale_id", "orderable": false }
    ]
  } );
});
function confirmDelete(pstock_id,product_id){
  var conf = confirm("Do you want to Delete Class ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>Productionitem/delete",
      data:{pstock_id:pstock_id,product_id:product_id},
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
$(document).on('change','#product_hsn',function(){
  var id = $(this).val();
  if(id)
  {
    $.ajax({
            url:"<?php echo base_url()?>Product/gethsncode",
            type: 'POST',
            data: {id:id},
            dataType: 'json',
            success:
            function(data)
            {
         $('#product_hsncode').val(data['hsncode']);
      },
    });
    }
  });


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
        element3.name = "product_name[]";
        element3.id = "product_num" + rowCount;
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
        element4.required = "required";
        element4.id = "product_code" + rowCount;
        cell4.appendChild(element4);
        var cell5 = row.insertCell(4);
        var element5 = document.createElement("input");
        element5.type = "text";
        element5.name = "product_stock[]";
        element5.setAttribute("size", "6");
        element5.setAttribute("class", "democlass");
        element5.id = "pquantity_" + rowCount;
        //  element5.required = "required";
        cell5.appendChild(element5);
        var cell6 = row.insertCell(5);
        var element6 = document.createElement("select");
        element6.type = "select";
        element6.name = "product_unit[]";
        element6.id = "p_unit" + rowCount;
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
        element7.name = "pstock[]";
        element7.setAttribute("size", "6");
        element7.setAttribute("class", "democlass");
        element7.id = "pstock" + rowCount;
        //  element5.required = "required";
        cell7.appendChild(element7);
      
       
        $('#product_num'+rowCount).select2();
    }
    $('#product_num1').select2();

    
    function getproductdetails(row)
    { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . 'index.php/Routsale/getProductDetails1'; ?>',
                      data: {
                          pid: $("#product_num"+row).val()
                      },
                      success: function(data) {
                          d = JSON.parse(data);
                          console.log(d);
                          $('#product_code'+row).html(d.prod_cod);
                          $('#product_code'+row).val(d.prod_cod);
                          $('#pstock'+row).html(d.product_stock);
                          $('#pstock'+row).val(d.product_stock);
                        
                      },
                      error: function() {
                      }
                  });
    }
</script>
