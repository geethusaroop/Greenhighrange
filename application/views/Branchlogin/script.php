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

    $('#date').datepicker({

      autoclose: true,

      format: 'dd/mm/yyyy'

    });

	$('#wdate').datepicker({

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

    $table = $('#employee_table').DataTable( {

		"processing": true,

        "serverSide": true,

        "bDestroy" : true,

        "ajax": {

            "url": "<?php echo base_url();?>Branchlogin/get",

            "type": "POST",

            "data" : function (d) {

            

           }

        },

        "createdRow": function ( row, data, index ) {

          

			$table.column(0).nodes().each(function(node,index,dt){

            $table.cell(node).data(index+1);

      });



      $('td', row).eq(2).css('font-weight','bold');




			$('td', row).eq(4).html('<center><a href="<?php echo base_url();?>Branchlogin/edit/'+data['id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');

		},

        "columns": [

            { "data": "user_status", "orderable": true },

            { "data": "branch_name", "orderable": false },


            { "data": "user_name", "orderable": false },

            { "data": "admin_password", "orderable": false },

      			{ "data": "id", "orderable": false }

        ]

        

    } );

    

    

  });

  function confirmDelete(id){

    var conf = confirm("Do you want to Delete ?");

        if(conf){

        $.ajax({

            url:"<?php echo base_url();?>Branchlogin/delete/",

            data:{id:id},

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

    $(document).on('change','#emp_id',function(){

  var id = $(this).val();

  if(id)

  {

    $.ajax({

            url:"<?php echo base_url()?>Branchlogin/getdes",

            type: 'POST',

            data: {id:id},

            dataType: 'json',

            success:

            function(data)

            {

         $('#emp_designation').val(data['emp_designation']);

         if(data['emp_designation']==1)

         {

          $('#emp_designation1').val('Office Assistant');

         }

         else if(data['emp_designation']==2)

         {

          $('#emp_designation1').val('Sales Executive');

         }

         else if(data['emp_designation']==3)

         {

          $('#emp_designation1').val('Technician');

         }

         

      },

    });

    }

  });

</script>