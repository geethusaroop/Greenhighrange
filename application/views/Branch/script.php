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
	$("#unit option:first").before('<option value="">----Please Select---</option>');
	$("#unit").val("").change();
	var ctnm = $('#branch_unit').val();
	if(ctnm){$("#unit").val(ctnm).change();}
    $(".select2").select2();

	$("#animator option:first").before('<option value="">----Please Select---</option>');
	$("#animator").val("").change();
	var ctnm = $('#branch_animator').val();
	if(ctnm){$("#animator").val(ctnm).change();}
    $(".select2").select2();
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
    $table = $('#classinfo_table').DataTable( {
        "fixedHeader": true,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Branch/get/",
            "type": "POST",
            "data" : function (d) {

           }
        },
        "createdRow": function ( row, data, index ) {

//            $('td',row).eq(0).html(index+1);
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });

            $('td', row).eq(7).html('<center><a href="<?php echo base_url();?>index.php/Branch/edit/'+data['branch_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['branch_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },
        "columns": [
            { "data": "branch_status", "orderable": false },
              { "data": "branch_name", "orderable": false },
      			{ "data": "branch_address", "orderable": false },
      			{ "data": "branch_email", "orderable": false },
      			{ "data": "branch_phn", "orderable": false },
            { "data": "branch_phn2", "orderable": false },
      			{ "data": "branch_gst", "orderable": false },
            { "data": "branch_id", "orderable": false }

        ]

    } );


  });
function confirmDelete(branch_id){
    var conf = confirm("Do you want to Delete Class ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Branch/delete",
            data:{branch_id:branch_id},
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
