<script>


  var k = new Date();


var n = k.toString(); 


var c=n.substr(0,34);


var d=c+"(IST)";


 $('#date').html(d);


$(document).on('change','#empname',function(){


	var emp_id = $(this).val();


	if(emp_id){


		$.ajax({


            url:"<?php echo base_url();?>Salarystructure/get_empdetails",


            data:{emp_id:emp_id},


            type:'POST',


            dataType:"json",


            success:function(data){


				$('#desig').val(data['desig_name']);


            }


		});


	}


});


$(document).on('change','#empname',function(){


	var emp_id = $(this).val();


	if(emp_id)	


	{


		$.ajax({


            url:"<?php echo base_url();?>Payroll/get_values",


            data:{emp_id:emp_id},


            type:'POST',


            dataType:"json",


            success:function(data){


                $('#basic_sal').val(data['emp_sal']);  


				


            }


		});


	}


});


$(document).on('change','#adv_amt',function(){


	var basicpay = $('#basic_sal').val();


	var adv = $('#adv_amt').val();


	var bal = (parseFloat(basicpay) - parseFloat(adv)) 


  $('#total_sal').val(bal);


	


});


  var response = $("#response").val();


  if(response){


      console.log(response,'response');


      var options = $.parseJSON(response);


      noty(options);


  }


  


  $(function () {


	$("#department option:first").before('<option value="">----Please Select----</option>');


	$("#department").val("").change();


	var ctnm = $('#depart').val();


	if(ctnm){$("#department").val(ctnm).change();}


	


	$("#empname option:first").before('<option value="">----Please Select----</option>');


	$("#empname").val("").change();


	var cpnm = $('#design').val(); 


	if(cpnm){$("#empname").val(cpnm).change();} 


	


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





    $table = $('#category_table').DataTable( {

        "fixedHeader": true,

        "processing": true,


        "serverSide": true,


        "bDestroy" : true,


        "ajax": {


            "url": "<?php echo base_url();?>Advancepayments/get/",


            "type": "POST",


            "data" : function (d) {


            


           }


        },


        "createdRow": function ( row, data, index ) {


           $table.column(0).nodes().each(function(node,index,dt){


            $table.cell(node).data(index+1);


            });


            $('td', row).eq(6).html('<center><a href="<?php echo base_url();?>index.php/Advancepayments/edit/'+data['adv_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['adv_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');


        },





        "columns": [


            { "data": "adv_status", "orderable": false },


			{ "data": "adv_date", "orderable": false },


            { "data": "emp_name", "orderable": false },


            { "data": "emp_sal", "orderable": false },


			{ "data": "adv_amount", "orderable": false },


			{ "data": "remaining_amount", "orderable": false },


			{ "data": "adv_id", "orderable": false }


            


        ]


        


    } );


    


    


  });





function confirmDelete(adv_id){


    var conf = confirm("Do you want to Delete Advance Payment details ?");


    if(conf){


        $.ajax({


            url:"<?php echo base_url();?>Advancepayments/delete",


            data:{adv_id:adv_id},


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