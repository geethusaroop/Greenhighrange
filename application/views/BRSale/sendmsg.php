
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Send-Whatsapp Message
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Sale/addmsg"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active"> Send-Whatsapp Message</li>
    </ol>
  </section>
  <!-- Main content -->
  <!-- <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Sale/sendmsg" enctype="multipart/form-data"> -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-default">
            <!-- /.box-header -->
            <!-- form start -->
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
            <!-- radio -->
            <div class="form-group">
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body" style="margin-top:-20px;font-family:'Times New Roman', Times, serif;font-size:16px;">
              <div class="panel panel-info" style="box-shadow: 4px 3px 4px 3px #172158;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>NEW WHATSAPP MESSAGE</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;background: aliceblue;">
                <div>
                  <div class="form-group">
<!--                    
                    <div class="col-md-4">
                      <label>Date: </label>
                      <input type="date" placeholder="Date" class="form-control" name="msg_date" required value="<?php echo date('Y-m-d'); ?>" style="font-weight: bold;">
                    </div>
                    <div class="col-md-4">
                      <label>Enter Phone Number</label>
                      <input type="text" placeholder="1234567890" class="form-control" required name="msg_phone" value="" style="font-weight: bold;">
                         
                    </div>
                    <div class="col-md-4">
                    <label>Upload Document</label>
                    <input type="file" class="form-control" name="msg_document" style="font-weight: bold;">
                    </div>   -->
                    <div class="col-md-4">
                      <label for="">Whatsapp No</label>
                      <input type="text" class="form-control" id="p_no" data-pms-required="true" value="" placeholder="Enter Whatsapp No"/>
                    </div>
                    
                  </div>

                    
                </div>

                <div class="box-footer">
                <div class="row">
                  <div class="col-md-9">
                  </div>
                  <div class="col-md-4">
                    <!-- <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button> -->
                    <a href="" class="btn btn-success" target="_blank" id="links">Open whatasapp</a>
                  </div>
                </div>
              </div>
                
                  </div>
                  <!-- /.box-footer -->

                 


                </div>
                <!-- /.box -->
              </div>
              <!--/.col (right) -->

            <!--   <hr>
                  <div class="box-body table-responsive">
              <table id="sale_details_table" class="table table-bordered table-striped">
                <thead>
                <tr>
              <th>SL.NO</th>
              <th>DATE</th>
              <th>MOBILE_NUMBER</th>
              <th class="text-center">DOCUMENT</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div> -->
           
            </div>
    </section>
  <!-- </form> -->
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>