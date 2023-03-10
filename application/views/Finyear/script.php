<script>

  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
  $(function () {

    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#start_date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
	$('#end_date').datepicker({
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

    $table = $('#Finyear_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				// {
                                    // extend: 'copy',
                                    // exportOptions: {
                                        // columns: [ 1, 2 ]
                                    // }
                                // },
                                // {
                                    // extend: 'excel',
                                    // exportOptions: {
                                        // columns: [ 1, 2 ]
                                    // }
                                // },
                                // {
                                    // extend: 'pdf',
                                    // exportOptions: {
                                        // columns: [ 1, 2]
                                    // }
                                // },
                                // {
                                    // extend: 'print',
                                    // exportOptions: {
                                        // columns: [ 0,1, 2]
                                    // }
                                // },
                                // {
                                    // extend: 'csv',
                                    // exportOptions: {
                                        // columns: [ 1, 2]
                                    // }
                                // },
			],
        "ajax": {
            "url": "<?php echo base_url();?>Finyear/get/",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			var status = "(Active Year)";
			if(data['finyear_status']=='1'){
			$('td', row).eq(1).html(data['fin_year']+' <span style="color:green">(Active Year)</span>');
			}
			else{
			$('td', row).eq(1).html(data['fin_year']);
			}
            //$('td',row).eq(4).html(enquiry_type[data['type']]);
            <?php if($this->session->userdata['user_type']=='A'){ ?>
            $('td', row).eq(4).html('<center><a href="<?php echo base_url();?>Finyear/edit/'+data['finyear_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['finyear_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
            <?php } else{ ?>
            $('td', row).eq(4).html('<center><i class="fa fa-ban iconFontSize-medium" ></i></center>');
            <?php } ?>
            
			
        },

        "columns": [
            { "data": "finyear_status", "orderable": false },
            { "data": "fin_year", "orderable": false },
            { "data": "fin_startdate", "orderable": false },
            { "data": "fin_enddate", "orderable": false },
            { "data": "finyear_id", "orderable": false }
        ]
        
    } );
    
    
  });

  $(document).on("ifChecked",".customerType",function(){
    console.log("ENter");
    var val = $(this).val();
    console.log(val,'val');
    if(val == 'N'){
      $("#customer_id").val('');
      // $("#customer_name").val('');
      $("#customer_address").val('');
      $("#customer_phone").val('');
      $("#customer_email").val('');
      $('#customer_name').rcm_autoComplete_d();
    }
    else {
      console.log("customer name append");
      $('#customer_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getCustomerList',$customerList,param,getCustomerName);
    }
  });

  function getCustomerName(el,event,item){
        console.log(item);
        if(item.customer_id){
            el.val(item.customer_name);
            $("#customer_id").val(item.customer_id);
            $("#customer_address").val(item.customer_address);
            $("#customer_phone").val(item.customer_phone);
            $("#customer_email").val(item.customer_email);
            
        }
    }
	function confirmDelete(finyear_id){
    var conf = confirm("Do you want to Delete Guest?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Finyear/delete",
            data:{finyear_id:finyear_id},
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
	function send()
{document.theform.submit()}
  
</script>