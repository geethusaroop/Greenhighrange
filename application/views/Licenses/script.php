<script type="text/javascript">
$table = $('#Licenses').DataTable({
  "processing": true,
  "serverSide": true,
  "bDestroy" : true,
  "ajax": {
    "url": "<?php echo base_url();?>Dashboard/getLicenses",
    "type": "POST",
    "data" : function (d) {
    }
  },
  "createdRow": function ( row, data, index ) {
    console.log(data);
    $table.column(0).nodes().each(function(node,index,dt){
      $table.cell(node).data(index+1);
    });
    $('td', row).eq(6).html('<center><a href="<?php echo base_url();?>Licenses/edit/'+data['license_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete3('+data['license_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    $('td', row).eq(5).html('<center><a target="_blank" href="<?php echo base_url();?>Licenses/print/'+data['license_id']+'"><i class="fa fa-print iconFontSize-medium" ></i></a></center>');
  },
  "columns": [
    { "data": "license_status", "orderable": true },
    { "data": "license_name", "orderable": false },
    { "data": "license_number", "orderable": false },
    { "data": "license_reminder", "orderable": false },
    { "data": "license_expirery_date", "orderable": false },
    { "data": "license_upload", "orderable": false },
    { "data": "license_id", "orderable": false }
  ]
});

function confirmDelete3(license_id){
  var conf = confirm("Do you want to Delete License Details ?");
  if(conf){
      $.ajax({
          url:"<?php echo base_url();?>Licenses/delete",
          data:{license_id:license_id},
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
</script>
