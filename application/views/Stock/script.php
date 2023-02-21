<script type="text/javascript">
$table = $('#distributionTable').DataTable( {
  "fixedHeader": true,
  "processing": true,
  "serverSide": false,
  "bDestroy" : true,
  "ajax": {
    "url": "<?php echo base_url();?>Stock/getStockDetails",
    "type": "POST",
    "data" : function (d) {
    }
  },
  "createdRow": function ( row, data, index ) {
    $table.column(0).nodes().each(function(node,index,dt){
      $table.cell(node).data(index+1);
    });
    $('td', row).eq(1).css('font-weight','bold');
    if(data['product_unit_type']==1)
      {
        $('td', row).eq(1).html('MASALA UNIT');
        $('td', row).eq(1).css('color','orange');
      }
      else if(data['product_unit_type']==2)
      {
        $('td', row).eq(1).html('SPICES UNIT');
        $('td', row).eq(1).css('color','brown');
      }
      else if(data['product_unit_type']==3)
      {
        $('td', row).eq(1).html('OIL UNIT');
        $('td', row).eq(1).css('color','green');
      }
      else if(data['product_unit_type']==4)
      {
        $('td', row).eq(1).html('PICKLE UNIT');
        $('td', row).eq(1).css('color','red');
      }

      else if(data['product_unit_type']==5)
      {
        $('td', row).eq(1).html('MISCELLANEOUS ITEMS');
      }
      else
      {
        $('td', row).eq(1).html('OTHER ITEMS');
      }
  },
  "columns": [
    { "data": "product_status", "defaultContent":""},
    { "data": "product_unit_type", "orderable": false },
    { "data": "product_name", "orderable": false },
    { "data": "product_code", "orderable": false },
    { "data": "product_open_stock", "orderable": false },
   // { "data": "transfer_qty", "orderable": false },
 //   { "data": "sale_qty", "orderable": false },
    { "data": "product_stock", "orderable": false },
    { "data": "product_price_r1", "orderable": false },
    { "data": "product_price_r2", "orderable": false },
    { "data": "product_price_r3", "orderable": false },
    { "data": "product_updated_date", "orderable": false },
  ]
} );
$('#memberTypeSelect').on('change', function() {
  $('#memberSelect').empty();
  var id=this.value;
  $.ajax({
    url: '<?php echo base_url(); ?>Allotment/getMembersWhere',
    type: 'post',
    data: {
      id:id
    },
    success: function(response){
      var data = JSON.parse(response);
      var dataset = data;
      var select=document.getElementById("memberSelect");
      dataset.forEach((item) => {
        $(select).append('<option value="'+item.member_id+'">'+item.member_name+'</option>');
      });
    }
  });
});
</script>