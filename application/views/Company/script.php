<script type="text/javascript">
  $("#fileUpload").on('change', function() {
    if (typeof(FileReader) != "undefined") {
      var image_holder = $("#image");
      image_holder.empty();
      var reader = new FileReader();
      reader.onload = function(e) {
        $("<img />", {
          "src": e.target.result,
          "width": '200px',
          // "height": '200px',
          "class": "thumb-image"
        }).appendTo(image_holder);
      }
      image_holder.show();
      reader.readAsDataURL($(this)[0].files[0]);
    } else {
      alert("This browser does not support FileReader.");
    }
  });
</script>
<script>
  $(document).on('click', '.btn-danger', function() {
    $('#room_ac').val('').change();
    $('#room_type').val('').change();
    //alert('hai');
  });
  $(document).on('change', '#room_type', function() {
    var id = $(this).val();
    if (id) {
      $.ajax({
        url: "<?php echo base_url() ?>NewRoom/getFeatures",
        type: 'POST',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(data) {
          $('#room_features').val(data['masterdescription']);
        },
      });
    }
  });
  var response = $("#response").val();
  if (response) {
    console.log(response, 'response');
    var options = $.parseJSON(response);
    noty(options);
  }
  var param = '';
  var $customerList = [{
    'columnName': 'customer_name',
    'label': 'Customer'
  }];
  $(function() {
    $(".select2").select2();
    var roomtype = $('#roomtype').val();
    if (roomtype) {
      $('#room_type').val(roomtype).change();
    }
    var room_ac = $('#roomac').val();
    if (room_ac) {
      $('#room_ac').val(room_ac).change();
    }
    var hotel_id = $('#hotel_id').val();
    if (hotel_id) {
      $('#hotel_name').val(hotel_id).change();
    }
    var enquiry_type = {
      'J': 'Job',
      'C': 'Complaint',
      'F': 'Follow-up'
    };
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {
      "placeholder": "dd/mm/yyyy"
    });
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
    $table = $('#Finyear_table').DataTable({
      "processing": true,
      "serverSide": true,
      "bDestroy": true,
      dom: 'lBfrtip',
      buttons: [{
          extend: 'copy',
          exportOptions: {
            columns: [1, 2, 3, 4, 5]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [1, 2, 3, 4, 5]
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: [1, 2, 3, 4, 5]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          }
        },
        {
          extend: 'csv',
          exportOptions: {
            columns: [1, 2, 3, 4, 5]
          }
        },
      ],
      "ajax": {
        "url": "<?php echo base_url(); ?>Company/get/",
        "type": "POST",
        "data": function(d) {
        }
      },
      "createdRow": function(row, data, index) {
        $table.column(0).nodes().each(function(node, index, dt) {
          $table.cell(node).data(index + 1);
        });
        if (data['info_logo'] == 'Not uploaded') {
          $('td', row).eq(1).html('Not uploaded');
        } else {
          $('td', row).eq(1).html('<img src="<?php echo base_url(); ?>/Companylogo/' + data['info_logo'] + '" width="100px"/>');
        }
        //  if(data['info_status']=='1')
        // {
        //     $('td',row).eq(7).html('Active');
        // }
        // else if(data['info_status']=='0')
        // {
        //     $('td',row).eq(7).html('Inactive');
        //  }
        //$('td',row).eq(4).html(enquiry_type[data['type']]);
        <?php if ($this->session->userdata['user_type'] == 'A') { ?>
          $('td', row).eq(7).html('<center><a href="<?php echo base_url(); ?>Company/edit/' + data['info_id'] + '"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete(' + data['info_id'] + ')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        <?php } else { ?>
          $('td', row).eq(7).html('<center><i class="fa fa-ban iconFontSize-medium" ></i></center>');
        <?php } ?>
        //$('td', row).eq(4).html('<center><a onclick="return confirmDelete('+data['category_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i> </a></center>');
      },
      "columns": [{
          "data": "info_status",
          "orderable": false
        },
        {
          "data": "info_logo",
          "orderable": false
        },
        {
          "data": "info_name",
          "orderable": false
        },
        {
          "data": "info_address",
          "orderable": false
        },
        {
          "data": "info_mobile1",
          "orderable": false
        },
        {
          "data": "info_email1",
          "orderable": false
        },
        {
          "data": "info_website",
          "orderable": false
        },
       
        {
          "data": "info_id",
          "orderable": false
        }
      ]
    });
  });
  function confirmDelete(info_id) {
    var conf = confirm("Do you want to Delete Company Information?");
    if (conf) {
      $.ajax({
        url: "<?php echo base_url(); ?>Company/delete",
        data: {
          info_id: info_id
        },
        method: "POST",
        datatype: "json",
        success: function(data) {
          var options = $.parseJSON(data);
          noty(options);
          $table.ajax.reload();
        }
      });
    }
  }
  function send() {
    document.theform.submit()
  }
</script>