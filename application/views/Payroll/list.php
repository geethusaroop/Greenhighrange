<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Payroll Details
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Payroll/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">Payroll</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Month</button>
          </div><!-- /btn-group -->
          <select class="form-control" id="month" name="month">
            <option value="">--Select Month--</option>
            <option value="01">JANUARY</option>
            <option value="02">FEBRUARY</option>
            <option value="03">MARCH</option>
            <option value="04">APRIL</option>
            <option value="05">MAY</option>
            <option value="06">JUNE</option>
            <option value="07">JULY</option>
            <option value="08">AUGUST</option>
            <option value="09">SEPTEMBER</option>
            <option value="10">OCTOBER</option>
            <option value="11">NOVEMBER</option>
            <option value="12">DECEMBER
            </option>
          </select>
        </div><!-- /input-group -->
      </div>
      <div class="col-sm-2">
        <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" id="search" class="btn btn-primary nohover">Search</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="box">
        <div class="box-header">
          <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
          <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
          <div class="col-md-8">
            <h2 class="box-title"></h2>
          </div>
          <div class="col-md-2 pull-right">
            <a href="<?php echo base_url(); ?>Payroll/add" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add Payroll</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="product_table" class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                <th>S.NO</th>
                <th>SALARY.DATE</th>
                <th>EMPLOYEE.NAME</th>
                <th>BASIC.SALARY</th>
                <th>LEAVE.DEDUCT</th>
                <th>ADVANCE.PAYMENT</th>
                <th>OVERTIME.PAYMENT</th>
                <th>SALARY.AMOUNT</th>
                <th>PAY SLIP</th>
                <th>DELETE</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --