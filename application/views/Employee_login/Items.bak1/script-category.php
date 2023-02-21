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
            "url": "<?php echo base_url();?>Items/getcategory/",
            "type": "POST",
            "data" : function (d) {
                d.product_code = $('#product_code').val();
           }
        },
        "createdRow": function ( row, data, index ) {
          
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(2).css('color','blue');
          //  $('td', row).eq(2).html('<center><i class="fa fa-edit iconFontSize-medium"  data-toggle="modal" data-cat_id="'+data['cat_id']+'" data-cat_name="'+data['cat_name']+'" style="color:blue;cursor: pointer;" onclick="edit_data(this);"></i> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['cat_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },

        "columns": [
            { "data": "cat_status", "orderable": false },
            { "data": "cat_name", "orderable": false },
          ////  { "data": "cat_id", "orderable": false }
        ]
        
    } );
function confirmDelete(cat_id){
    var conf = confirm("Do you want to Delete Category ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>deletecategory",
            data:{cat_id:cat_id},
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
  var id=data.getAttribute('data-cat_id');
  //alert(id);
  
 
  $('#exampleModalLabel').modal('show');
  $('#cat_id').val(id);
  $('#cat_name').val(data.getAttribute('data-cat_name'));
}
</script>