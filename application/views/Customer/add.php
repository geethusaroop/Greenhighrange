<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Customer Details
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Customer/"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Customer Details</li>
    </ol>
  </section>
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Customer/add">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="cust_id" value="<?php if (isset($records->cust_id)) echo $records->cust_id ?>" />
              <?php echo validation_errors(); ?>
              <div class="box-body">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="panel panel-danger">
                    <div class="panel-heading">
                      <h3 class="panel-title"><b>CUSTOMER DETAILS</b></h3>
                    </div>
                    <div class="panel-body" style="font-weight: bold;">
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Customer Type<span style="color:red"></span></label>
                          <select name="ctype" class="form-control">
                            <option value="">-SELECT-</option>
                            <option value="retail">Retail Customer</option>
                            <option value="whole">Wholesale Customer</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Name <span style="color:red">*</span></label>
                          <input type="text" required class="form-control" name="custname" id="custname" value="<?php if (isset($records->custname)) echo $records->custname ?>">
                        </div>
                        <div class="col-md-6">
                          <label>Shop Name</label>
                          <input type="text" required class="form-control" name="shopname" id="shopname" value="<?php if (isset($records->shopname)) echo $records->shopname ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Address</label>
                          <textarea class="form-control" name="custaddress"> <?php if (isset($records->custaddress)) echo $records->custaddress ?> </textarea>
                        </div>
                        <div class="col-md-6">
                          <label>Phone</label>
                          <input type="text" required class="form-control" name="custphone" id="custphone" value="<?php if (isset($records->custphone)) echo $records->custphone ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Email</label>
                          <input type="text" required class="form-control" name="custemail" id="custemail" value="<?php if (isset($records->custemail)) echo $records->custemail ?>">
                        </div>
                        <div class="col-md-6">
                          <label>Place</label>
                          <input type="text" required class="form-control" name="custplace" id="custplace" value="<?php if (isset($records->custplace)) echo $records->custplace ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>PAN</label>
                          <input type="text" class="form-control" name="custpan" id="custpan" value="<?php if (isset($records->custpan)) echo $records->custpan ?>">
                        </div>
                        <div class="col-md-6">
                          <label>GST</label>
                          <input type="text" class="form-control" name="custgst" id="custgst" value="<?php if (isset($records->custgst)) echo $records->custgst ?>">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box -->
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
          </div>
          <!-- /.col -->
        </div>
    </section>
  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->