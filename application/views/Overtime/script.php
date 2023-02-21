<script>
(function($){
    jQuery.fn.timepicker = function(){
        this.each(function(){
            // get the ID and value of the current element
            var i = this.id;
            var v = $(this).val();
            // the options we need to generate
            var hrs = new Array('01','02','03','04','05','06','07','08','09','10','11','12');
            var mins = new Array('00','15','30','45');
            var ap = new Array('am','pm');
            // default to the current time
            var d = new Date;
            var h = d.getHours();
            var m = d.getMinutes();
            var p = (h >= 12 ? 'pm' : 'am');
            // adjust hour to 12-hour format
            if(h > 12) h = h - 12;
            // round minutes to nearest quarter hour
            for(mn in mins){
                if(m <= parseInt(mins[mn])){
                    m = parseInt(mins[mn]);
                    break;
                }
            }
            // increment hour if we push minutes to next 00
            if(m > 45){
                m = 0;
                switch(h){
                    case(11):
                        h += 1;
                        p = (p == 'am' ? 'pm' : 'am');
                        break;
                    case(12):
                        h = 1;
                        break;
                    default:
                        h += 1;
                        break;
                }
            }
            // override with current values if applicable
            if(v.length == 7){
                h = parseInt(v.substr(0,2));
                m = parseInt(v.substr(3,2));
                p = v.substr(5);
            }
            // build the new DOM objects
            var output = '';
            output += '<select id="h_' + i + '" class="h timepicker">';             
            for(hr in hrs){
                output += '<option value="' + hrs[hr] + '"';
                if(parseInt(hrs[hr]) == h) output += ' selected';
                output += '>' + hrs[hr] + '</option>';
            }
            output += '</select>';
            output += '<select id="m_' + i + '" class="m timepicker">';             
            for(mn in mins){
                output += '<option value="' + mins[mn] + '"';
                if(parseInt(mins[mn]) == m) output += ' selected';
                output += '>' + mins[mn] + '</option>';
            }
            output += '</select>';              
            output += '<select id="p_' + i + '" class="p timepicker">';             
            for(pp in ap){
                output += '<option value="' + ap[pp] + '"';
                if(ap[pp] == p) output += ' selected';
                output += '>' + ap[pp] + '</option>';
            }
            output += '</select>';              
            // hide original input and append new replacement inputs
            $(this).attr('type','hidden').after(output);
        });
        $('select.timepicker').change(function(){
            var i = this.id.substr(2);
            var h = $('#h_' + i).val();
            var m = $('#m_' + i).val();
            var p = $('#p_' + i).val();
            var v = h + ':' + m + p;
            $('#' + i).val(v);
        });
        return this;
    };
})(jQuery);
$(document).ready(function() {
   $('#from_time').timepicker();
   $('#to_time').timepicker();
});
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  
  $(function () {
	$("#empname option:first").before('<option value="">----Please Select----</option>');
	$("#empname").val("").change();
	var cpnm = $('#design').val(); 
	if(cpnm){$("#empname").val(cpnm).change();} 
	
    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#overtym_date').datepicker({
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
    $table = $('#category_table').DataTable( {
        "fixedHeader": true, 
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Overtime/get/",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(4).html('<center><a href="<?php echo base_url();?>index.php/Overtime/edit/'+data['overtym_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['overtym_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },
        "columns": [
            { "data": "overtym_status", "orderable": false },
			{ "data": "overtym_date", "orderable": false },
            { "data": "emp_name", "orderable": false },
            //  { "data": "overtym_hrs", "orderable": false },
			{ "data": "total_amount", "orderable": false },
            { "data": "overtym_id", "orderable": false }
            
        ]
        
    } );
    
    
  });
function confirmDelete(overtym_id){
    var conf = confirm("Do you want to Delete Overtime ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Overtime/delete",
            data:{overtym_id:overtym_id},
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