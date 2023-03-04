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
      
        $("#cag option:first").before('<option value="">----Please Select---</option>');
	$("#cag").val("").change();
	var ctnm = $('#cag_name').val();
	if(ctnm){$("#cag").val(ctnm).change();}
    $(".select2").select2();
      
      $("#unit option:first").before('<option value="">----Please Select---</option>');
	$("#unit").val("").change();
	var ctnm = $('#member_unit').val();
	if(ctnm){$("#unit").val(ctnm).change();}
    $(".select2").select2();
    
     $("#fedaration option:first").before('<option value="">----Please Select---</option>');
	$("#fedaration").val("").change();
	var ctnm = $('#member_zone').val();
	if(ctnm){$("#fedaration").val(ctnm).change();}
    $(".select2").select2();
	
	$("#president option:first").before('<option value="">----Please Select---</option>');
	$("#president").val("").change();
	var ctnm = $('#member_president').val();
	if(ctnm){$("#president").val(ctnm).change();}
    $(".select2").select2();
    
    $("#secratary option:first").before('<option value="">----Please Select---</option>');
	$("#secratary").val("").change();
	var ctnm = $('#member_secratary').val();
	if(ctnm){$("#secratary").val(ctnm).change();}
    $(".select2").select2();
    
    $("#region option:first").before('<option value="">----Please Select---</option>');
	$("#region").val("").change();
	var ctnm = $('#member_region').val();
	if(ctnm){$("#region").val(ctnm).change();}
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
	$('#search').click(function () {
        $table.ajax.reload();
    });
    $table = $('#classinfo_table').DataTable( {
		
        "fixedHeader": true, 
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Shareholder/get_shareholders/",
            "type": "POST",
            "data" : function (d) {
				d.memberid = $('#member_mid').val();
                d.start_date = $("#pmsDateStart").val();
                d.end_date = $("#pmsDateEnd").val();
           }
        },
        "createdRow": function ( row, data, index ) {
          
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td',row).eq(11).html('Bank Name :<b>'+data['member_bank']+'</b><br>Branch:   <b>'+data['member_branch']+'</b>,  <br>A/C No : <b>'+data['member_account']+'</b>,  <br>IFSC : <b>'+data['member_ifsc']+'</b>');

            $('td', row).eq(14).html('<center><a href="<?php echo base_url();?>index.php/Shareholder/edit/'+data['member_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['member_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        
        }, 
        "columns": [
        
            { "data": "member_status", "orderable": false},
           { "data": "member_mid", "orderable": false },
            { "data": "member_name", "orderable": false },
            { "data": "member_dob", "orderable": false },
      		{ "data": "member_address", "orderable": false },
      		{ "data": "member_pnumber", "orderable": false },
      		{ "data": "member_email", "orderable": false },
            { "data": "member_share_aahar", "orderable": false },
            { "data": "member_share_pan", "orderable": false },
            { "data": "member_share_no_shares", "orderable": false },
            { "data": "m_created_at", "orderable": false } ,
            { "data": "member_bank", "orderable": false } ,
            { "data": "member_old_balance", "orderable": false } ,
            { "data": "member_sale_balance", "orderable": false } ,
            { "data": "member_id", "orderable": false }        
            
        ]
        
    } );
    
    
  });
function confirmDelete(member_id){
    var conf = confirm("Do you want to Delete Member ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Shareholder/delete",
            data:{member_id:member_id},
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
<script type="text/javascript">
  $(document).ready(function(){
 
            $('#member_state').change(function(){ 
                var state=$(this).val();
              //alert(reg);
                $.ajax({
                    url:"<?php echo base_url(); ?>Shareholder/fetch_district",
                    method : "POST",
                    data : {state: state},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        html +='<option value="">--SELECT DISTRICTS--</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].district_id+'>'+data[i].district_name+'</option>';
                        }
                        $('#member_district').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
        $(document).ready(function(){
 
 $('#member_district').change(function(){ 
     var district=$(this).val();
   //alert(reg);
     $.ajax({
         url:"<?php echo base_url(); ?>Shareholder/fetch_panchayath",
         method : "POST",
         data : {district: district},
         async : true,
         dataType : 'json',
         success: function(data){
              
             var html = '';
             html +='<option value="">--SELECT PANCHAYATH--</option>';
             var i;
             for(i=0; i<data.length; i++){
                 html += '<option value='+data[i].panchayath_id+'>'+data[i].panchayath_name+'</option>';
             }
             $('#member_panchayath').html(html);
         }
     });
     return false;
 }); 
  
});
</script>