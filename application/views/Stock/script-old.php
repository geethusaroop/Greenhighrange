<script type="text/javascript">

$table = $('#distributionTable').DataTable( {

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
    $('td', row).eq(7).html('<center><a href="<?php echo base_url();?>Drivers/edit/'+data['dist_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['dist_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
  },
  "columns": [

  ]
} );
function confirmDelete(driver_id){
  var conf = confirm("Do you want to Delete Driver Details ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>Drivers/delete",
      data:{driver_id:driver_id},
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

$('#memberTypeSelect').on('change', function() {
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
        // $(select).append('<option value="'+item.member_id+'">'+item.member_name+'</option>');
        var html = '';
        html +='<option value="" disabled>Select Member</option>';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value='+item.member_id+'>'+item.member_name+'</option>';
        }
        $('#memberSelect').html(html);
      });
    }
  });
});
</script>
