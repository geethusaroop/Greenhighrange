<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Receipt Head Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Receipthead"><i class="fa fa-dashboard"></i> Back to list</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Receipthead/add">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <fieldset>
              <legend>Receipt Head Details</legend>
              <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
              <!-- radio -->
              <div class="form-group">
                <input type="hidden" name="receipt_id" value="<?php if (isset($records->receipt_id)) echo $records->receipt_id ?>" />
                <div class="box-body">
                  <div class="form-group">
                    <label for="customer_email" class="col-sm-4 control-label"> Receipt Head </label>
                    <div class="col-sm-5">
                      <input type="Text" class="form-control" required name="receipt_head" value="<?php if (isset($records->receipt_head)) echo $records->receipt_head; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="customer_email" class="col-sm-4 control-label"> Description</label>
                    <div class="col-sm-5">
                      <textarea class="form-control" name="receipt_desc"><?php if (isset($records->receipt_desc)) echo $records->receipt_desc; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </section>
    <div class="box-footer">
      <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-4">
          <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->