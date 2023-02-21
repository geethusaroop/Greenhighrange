<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Other Member Information
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Member/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
      <li class="active"></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
        <div class="box-header">
          <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
          <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
          <div class="row">
            <div class="col-md-4">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-danger nohover">Search Here</button>
                </div><!-- /btn-group -->
                <input type="text" name="member_mid" placeholder="" id="member_mid" class="form-control">
              </div><!-- /input-group -->
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button>
                <a href="<?php echo base_url(); ?>Member/add" class="btn btn-danger"><i class="fa fa-plus-square"></i> Add Member</a>
              </div>
            </div>
          </div>
          <br>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="classinfo_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SINO</th>
                <th>PHOTO</th>
                <th>MEMEBER_TYPE</th>
                <th>MEMBER_ID</th>
                <th>NAME&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                <th>ADDRESS&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                <th>PHONE_NUMBER</th>
                <th>EMAIL</th>
                <th>PANCHAYATH</th>
                <th>DISTRICT</th>
                <th>STATE</th>
                <th>DATE_OF_JOINING</th>
                <th>
                  <center>EDIT/DELETE</center>
                </th>
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
<!-- /.content-wrapper -->
