<script>
$(document).ready(function () {     

    $(".supp_id").select2({
            placeholder: " -- Select supplier -- "
    });
});    
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  $table = $('#product_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Items/getsubcategory/",
            "type": "POST",
            "data" : function (d) {
                d.product_code = $('#product_code').val();
           }
        },
        "createdRow": function ( row, data, index ) {
          
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(3).html('<center><i class="fa fa-edit iconFontSize-medium"  data-toggle="modal" data-subcat_id="'+data['subcat_id']+'" data-cat_id_fk="'+data['cat_id_fk']+'" data-cat_name="'+data['subcat_name']+'" style="color:blue;cursor: pointer;" onclick="edit_data(this);"></i> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['subcat_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },

        "columns": [
            { "data": "subcat_status", "orderable": false },
            { "data": "cat_name", "orderable": false },
            { "data": "subcat_name", "orderable": false },
            { "data": "subcat_id", "orderable": false }
        ]
        
    } );
function confirmDelete(subcat_id){
    var conf = confirm("Do you want to Delete Sub Category ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>deletesubcategory",
            data:{subcat_id:subcat_id},
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
    function edit_data(data){
  var id=data.getAttribute('data-subcat_id');
  //alert(id);
  
 
  $('#exampleModalLabel').modal('show');
  $('#subcat_id').val(id);
  $('#subcat_name').val(data.getAttribute('data-cat_name'));
  $('#cat_id_fk').val(data.getAttribute('data-cat_id_fk'));
}
</script>