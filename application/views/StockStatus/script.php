<script type="text/javascript">
$table = $('#distributionTable').DataTable( {
  "fixedHeader": true, 
  "processing": true,
  "serverSide": false,
  "bDestroy" : true,
  "ajax": {
    "url": "<?php echo base_url();?>StockStatus/getStockDetails",
    "type": "POST",
    "data" : function (d) {
        // console.log(d);
    }
  },
  "createdRow": function ( row, data, index ) {
    $table.column(0).nodes().each(function(node,index,dt){
      $table.cell(node).data(index+1);
    });
    $('td', row).eq(4).html('<center><a href="<?php echo base_url();?>index.php/StockStatus/purchase/'+data['product_id']+'"><button type="button" class="btn btn-success">PURCHASE</button></a> &nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/StockStatus/production/'+data['product_id']+'"><button type="button" class="btn btn-danger">PRODUCTION UNIT-STOCK TRANSFER</button></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/StockStatus/sale/'+data['product_id']+'"><button type="button" class="btn btn-info">SALE</button></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/StockStatus/branchstock/'+data['product_id']+'"><button type="button" class="btn btn-warning">BRANCH TRANSFER</button></a></center>');

   
  },
  "columns": [
    { "data": "product_status", "defaultContent":""},
    { "data": "product_name", "orderable": false },
    { "data": "product_code", "orderable": false },
    { "data": "product_stock", "orderable": false },
    { "data": "product_id", "orderable": false },
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
