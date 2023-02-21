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
		
	$("#staff_name option:first").before('<option value="">----Please Select----</option>');
	$("#staff_name").val("").change();
	var ctnm = $('#staff_id_fk').val();
	if(ctnm){$("#staff_name").val(ctnm).change();}
    $(".select2").select2();
	
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
   $("#date").datepicker({
                            format: 'dd/mm/yyyy',
                            autoclose: true,
                            todayHighlight: true
                        })
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
	
    $table = $('#attendence_table').DataTable( {
        "fixedHeader": true, 
        "searching": true,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Emp_attendence/get/",
            "type": "POST",
            "data" : function () {
			}
        },
        "createdRow": function ( row, data, index ) {
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
		  $('td', row).eq(2).html('<input type="checkbox" value="'+data['emp_id']+'" class="chkdata">'),
      $('td', row).eq(3).html('<input type="checkbox" value="'+data['emp_id']+'" class="sick">'),
      $('td', row).eq(4).html('<input type="checkbox" value="'+data['emp_id']+'" class="half_day">');
        },
        "columns": [
            { "data": "emp_status", "orderable": false },
			      { "data": "emp_name", "orderable": false },
			      { "data": "emp_id", "orderable": false },
            { "data": "emp_id", "orderable": false },
            { "data": "emp_id", "orderable": false }
        ]
        
    } );
});
function submit(){
        ckbox = document.getElementsByClassName("chkdata");
        sickbox = document.getElementsByClassName("sick");
        halfbox = document.getElementsByClassName("half_day");
        var option = $('#option').val();
        var att_date = $('#date1').val();
        for(var i=0;i<ckbox.length;i++)
        {
          element = ckbox[i];
          sick_element =sickbox[i];
          half_element =halfbox[i];
          if(element.checked)
          {
            console.log(1);
            var emp_id = ckbox[i].value;
            if(emp_id!='' && ckbox!='')
            {
              console.log('date1=>',att_date);
              $.ajax({
                url:"<?php echo base_url();?>Emp_attendence/attend_reg",
                type: 'POST',
                data:{emp_id:emp_id,att_date:att_date},
                dataType: 'json',
                success:
                function(data){
                    location.reload();
                }
              }); 
            }
          }
          else if(!(element.checked) && !(sick_element.checked) && !(half_element.checked))
          {
            console.log(2);
            var emp_id = ckbox[i].value;
            if(emp_id!='' && ckbox!='')
            {
              $.ajax({
                url:"<?php echo base_url();?>Emp_attendence/absent_reg",
                type: 'POST',
                data:{emp_id:emp_id,att_date:att_date},
                dataType: 'json',
                success:
                function(data){
                    location.reload();
                }
              });
            }
          }
          else if(!(element.checked) && sick_element.checked && !(half_element.checked))
          {
            console.log(3);
            var emp_id = sickbox[i].value;
            if(emp_id!='' && sickbox!='')
            {
              $.ajax({
                url:"<?php echo base_url();?>Emp_attendence/sickleave_reg",
                type: 'POST',
                data:{emp_id:emp_id,att_date:att_date},
                dataType: 'json',
                success:
                function(data){
                    location.reload();
                }
              });    
            }
          }
          else if(!(element.checked) && !(sick_element.checked) && half_element.checked)
          {
            console.log(4);
            var emp_id = halfbox[i].value;
            if(emp_id!='' && halfbox!='')
            {
              $.ajax({
                url:"<?php echo base_url();?>Emp_attendence/halfleave_reg",
                type: 'POST',
                data:{emp_id:emp_id,att_date:att_date},
                dataType: 'json',
                success:
                function(data){
                    location.reload();
                }
              });  
            }
          }
        
      }
        
}
$(document).ready(function() {
    $('#pickbox_all').click(function() {
        $(this).parents('table').find(':checkbox').prop('checked', this.checked);
});
});
	$(document).on('click','#search',function(){
	var date = $('#date').val();
	
	if(date)	
	{
		
		$.ajax({
            url:"<?php echo base_url();?>Emp_attendence/get_att",
            data:{date:date},
            type:'POST',
            dataType:"json",
             success:function(data){
				
				alert("hai");
				
            }
		});
	}
});
 
</script>