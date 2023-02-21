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
            "url": "<?php echo base_url();?>Items/getProducts/",
            "type": "POST",
            "data" : function (d) {
                d.product_code = $('#product_code').val();
           }
        },
        "createdRow": function ( row, data, index ) {
          
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(12).html('<center><a href="<?php echo base_url();?>editProduct/'+data['product_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['product_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },

        "columns": [
            { "data": "product_status", "orderable": false },
            { "data": "product_code", "orderable": false },
            { "data": "product_name", "orderable": false },
            { "data": "product_model", "orderable": false },
            { "data": "product_width", "orderable": false },
            { "data": "product_height", "orderable": false },
            { "data": "product_sq_ft", "orderable": false },
            { "data": "product_unit_price", "orderable": false },
            { "data": "product_qty", "orderable": false },
            { "data": "product_total_sq_ft", "orderable": false },
            { "data": "product_price", "orderable": false },
            { "data": "product_remark", "orderable": false },
            { "data": "product_id", "orderable": false }
        ]
        
    } );
function confirmDelete(product_id){
    var conf = confirm("Do you want to Delete Category ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>itemDelete",
            data:{product_id:product_id},
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

  /*   $(document).ready(function() {
        $('#cat_id_fk').change(function() {
          //  msg = 'dist_id=' + $(this).val();
            var cat_id_fk = $('#cat_id_fk').val(); //alert(cat_id_fk);
            if (cat_id_fk) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . 'index.php/Items/getsubcategorys'; ?>',
                    data: {
                        cat_id_fk:cat_id_fk
                    },
                    success: function(data) {console.log(data);
                        $('#subcat_names').html(data);
                        $('#subcat_names').val(data);
                    },
                    error: function() {}
                });
            }
        });
   
        $('#cat_id_fk').change(function() {
          //  msg = 'dist_id=' + $(this).val();
            var cat_id_fk = $(this).val();
            if (cat_id_fk) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . 'index.php/Items/getsubcategory1'; ?>',
                    data: {
                        cat_id_fk:cat_id_fk
                    },
                    success: function(data) {
                        $('#subcat_id_fk').html(data);
                        $('#subcat_id_fk').val(data);
                    },
                    error: function() {}
                });
            }
        });
    });

$(document).on('change','#product_code',function(){
    $table.ajax.reload();
});  */   
$(document).on('change','#cat_id_fk',function(){
    var cat_id_fk = $('#cat_id_fk').val();
    $.ajax({
            url:"<?php echo base_url();?>Items/getsubcategorys",
            data:{cat_id_fk:cat_id_fk},
            type:'POST',
            dataType:"json",
            success:function(data){
                var html = '<option disabled="disabled" value="0" selected="selected">select</option>';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].subcat_id+'>'+data[i].subcat_name+'</option>';
                    }
                    // $('#subcategory_div').hide();
                    // $('#subcategory_section').show();
                    $('#subcat_id_fk').html(html);
                }
            });
});
   

jQuery(function ($) {
    //form submit handler
    $('#multiple').submit(function (e) {
        //check atleat 1 checkbox is checked
        if (!$('.chkdata').is(':checked')) {
            //prevent the default form submit if it is not checked
            e.preventDefault();
            alert('Please Select The Product you want to edit by clicking checkboxes');
        }
    })
})
</script>