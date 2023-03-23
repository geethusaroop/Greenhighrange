<script>
var counter = 0;
var response = $("#response").val();
  if(response){
      //console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
      }

      $table = $('#sale_details_table').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Sale/getmsg/",
            "type": "POST",
            "data" : function (d) {
               
                    //alert(d.start_date);
           }
        },
        "createdRow": function ( row, data, index ) {
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
             $('td', row).eq(2).css('color','red');

             $('td', row).eq(3).html('<center><a href="<?php echo base_url(); ?>/upload/message/' + data['msg_document'] + '" target="blank"><i class="fa fa-download"></i></a></center>');
            },
        "columns": [
            { "data": "msg_status", "orderable": false },
            {
                    "data": "msg_date",
                    "orderable": false
                },
                {
                    "data": "msg_phone",
                    "orderable": false
                },
                {
                    "data": "msg_document",
                    "orderable": false
                },
               
         ]
    } );
    $('#product').keyup(function (){
    $table.ajax.reload();
    });

    $('#links').on('click',function(){
        var no =$('#p_no').val();
        if(no){
            $("#links").attr("href", "https://api.whatsapp.com/send?phone="+no);
        }
        else{
            alert('Please Enter Valid Phone number!');
        }
       
    })
    

</script>
