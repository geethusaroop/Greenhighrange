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
  $('#search').click(function () {
    $table.ajax.reload();
});
  $table = $('#classinfo_table').DataTable( {
    "processing": true,
    "serverSide": true,
    "bDestroy" : true,
    "ajax": {
      "url": "<?php echo base_url();?>Damage/get/",
      "type": "POST",
      "data" : function (d) {
        d.product_id_fk = $('#product_id_fk').val();
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
      $('td', row).eq(5).css( "font-weight", "bold" );

      $('td', row).eq(6).css( "text-align", "center" );
      $('td', row).eq(6).css( "font-weight", "bold" );

      $('td', row).eq(7).css( "text-align", "center" );
      $('td', row).eq(7).css( "font-weight", "bold" );

      $('td', row).eq(3).html(''+ data['damage_count'] +'-'+ data['unit_name'] +'');
      $('td', row).eq(4).html('<center><a href="<?php echo base_url();?>index.php/Damage/edit/'+data['damage_id']+'/'+data['damage_item_id_fk']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a></center>');

    },
    "columns": [
      { "data": "damage_status", "orderable": false },
      { "data": "damage_date", "orderable": false },
      { "data": "product_name", "orderable": false },
      { "data": "damage_count", "orderable": false },
      { "data": "damage_id", "orderable": false },
      {
                    "data": null,
                    render: function(data, type, row) {
                        return "<div data-id=" + data['damage_id'] + " onclick='test(this)' class='text-center'><i class='fa fa-trash-o iconFontSize-medium'></i></div>";
                    }
                }
    ]
  } );
});


function test(data) {
        var damage_id = data.getAttribute('data-id');
       // alert(invoice_id);
        var conf = confirm("Do you want to Delete Items ?");
        if (conf) {
            $.ajax({
                url: "<?php echo base_url(); ?>Damage/deleteall",
                data: {
                  damage_id: damage_id
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

    $('#product_id_fk').select2();
  
</script>
