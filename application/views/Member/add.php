<style type="text/css">
  .fsize {
    font-size: 14px;
    font-family: 'Rubik', sans-serif;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Member
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Member/"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active"></li>
    </ol>
  </section>
  <!-- Main content -->
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/Member/add" enctype="multipart/form-data">
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            <div class="col-md-8">
              <h2 class="box-title"></h2>
            </div>
          </div>
          <div class="box-body">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>NEW MEMBER</b></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;">
                  <div class="col-md-6">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myDistrict">Add Distirct</button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myPanchayat">Add Panchayat</button>
                  </div>
                  <div class="col-md-12">

                  </div>


                  <input type="hidden" name="member_id" value="<?php if (isset($records->member_id)) echo $records->member_id ?>" />
                  <?php if (isset($records->member_img)) { ?>
                    <div class="form-group row">
                      <div class="col-md-12" style="text-align: center;">
                        <?php if (isset($records->member_img) != '') { ?>
                          <img src="<?php echo base_url(); ?>/uploads/<?php echo $records->member_img; ?>" width="150" height="150">
                        <?php } else { ?>
                          <img src="<?php echo base_url(); ?>/images/nimage.jpg" width="200" height="200">
                        <?php } ?>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="form-group row">
                    <div class="col-md-2">
                      <label class="fsize">Member ID <span style="color: red;"> *</span></label>
                      <input type="text" data-pms-required="true" autofocus class="form-control" name="member_mid" value="<?php if (isset($records->member_mid)) echo $records->member_mid ?>">
                    </div>
                    <div class="col-md-4">
                      <label class="fsize">Member Name<span style="color: red;"> *</span></label>
                      <input type="text" data-pms-required="true" autofocus class="form-control" name="member_name" value="<?php if (isset($records->member_name)) echo $records->member_name ?>">
                    </div>
                 
                 
                    <div class="col-md-3">
                      <label class="fsize">Gender </label>
                      <select name="member_gender" class="form-control">
                        <option value="">Please Select</option>
                        <option value="1" <?php if (isset($records->member_gender) && ($records->member_gender == "1")) {
                                            echo "selected";
                                          } ?>>Male</option>
                        <option value="2" <?php if (isset($records->member_gender) && ($records->member_gender == "2")) {
                                            echo "selected";
                                          } ?>>Female</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="fsize">DOB</label>
                      <input type="date" autofocus class="form-control" name="member_dob" value="<?php if (isset($records->member_dob)) echo $records->member_dob ?>">
                    </div>
                  </div>
                  <!--form-group--><br>
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label class="fsize">Address </label>
                      <textarea autofocus class="form-control" name="member_address"><?php if (isset($records->member_address)) echo $records->member_address ?></textarea>
                    </div>
                  </div>
                 
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label class="fsize">Email ID <span style="color: red;"> *</span></label>
                      <input type="text" autofocus class="form-control" name="member_email" value="<?php if (isset($records->member_email)) echo $records->member_email ?>">
                    </div>
                    <div class="col-md-6">
                      <label class="fsize">Phone Number<span style="color: red;"> *</span></label>
                      <input type="text" autofocus class="form-control" name="member_pnumber" value="<?php if (isset($records->member_pnumber)) echo $records->member_pnumber ?>">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label class="fsize">State </label>
                      <select name="member_state" class="form-control" id="member_state">
                        <option value="">-SELECT STATE-</option>
                        <?php foreach ($state as $state) { ?>
                          <option <?php if (isset($records->member_state)) {
                                    if ($records->member_state == $state->state_id) {
                                      echo "selected";
                                    }
                                  } ?> value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label class="fsize">District</label>
                      <select name="member_district" class="form-control" id="member_district">
                        <option value="">-SELECT DISTRICT-</option>
                        <?php if (isset($records->member_district)) { ?>
                          <?php foreach ($district as $district) { ?>
                            <option <?php if (isset($records->member_district)) {
                                      if ($records->member_district == $district->district_id) {
                                        echo "selected";
                                      }
                                    } ?> value="<?php echo $district->district_id; ?>"><?php echo $district->district_name; ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select><br>

                    </div>
                  
                    <div class="col-md-4">
                      <label class="fsize">Panchayath </label>
                      <select name="member_panchayath" class="form-control" id="member_panchayath">
                        <option value="">-SELECT PANCHAYATH-</option>
                        <?php if (isset($records->member_panchayath)) { ?>
                          <?php foreach ($panchayath as $panchayath) { ?>
                            <option <?php if (isset($records->member_panchayath)) {
                                      if ($records->member_panchayath == $panchayath->panchayath_id) {
                                        echo "selected";
                                      }
                                    } ?> value="<?php echo $panchayath->panchayath_id; ?>"><?php echo $panchayath->panchayath_name; ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>

                    </div>
                    </div>
                  
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label class="fsize">Photo</label>
                      <input type="hidden" name="member_img1" value="<?php if (isset($records->member_img)) echo $records->member_img ?>" />
                      <input type="file" class="form-control" id="fileupload" onclick="hide()" name="member_img" />
                    </div>
                 
                    <div class="col-md-4">
                      <label class="fsize">Joining Date</label>
                      <input type="date" autofocus class="form-control" name="member_exitdate" value="<?php if (isset($records->created_at)) echo $records->created_at ?>">
                    </div>
                    <div class="col-md-4">
                      <label class="fsize">Member Type</label>
                      <select name="member_type" class="form-control" id="shareholder">
                        <option value="">Please Select</option>
                       
                        <option value="2" <?php if (isset($records->member_type) && ($records->member_type == "2")) {
                                            echo "selected";
                                          } ?>>Wholesale Customer</option>
                        <option value="3" <?php if (isset($records->member_type) && ($records->member_type == "3")) {
                                            echo "selected";
                                          } ?>>Customers/Retailers</option>
                      </select>
                    </div>
                  
                  </div>
                  <!--form-group--><br>
                  <!-- /.box-header -->
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <br>
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
    </section>
  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--District Modal -->
<div id="myDistrict" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">District Details</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>Member/addDistrictName" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">District Name</label>
            <input type="text" class="form-control" placeholder="Enter District Name" autofocus name="dist_name">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">State</label>
            <select name="dist_state" id="" class="form-control">
              <option value="">SELECT STATE</option>
              <?php foreach ($states as $s_list) { ?>
                <option value="<?php echo $s_list->state_id ?>"><?php echo $s_list->state_name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Phone Number</label>
            <input type="text" name="dist_phone" class="form-control" placeholder="Enter Phone Number">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Incharge</label>
            <input type="text" name="dist_incharge" class="form-control" placeholder="Enter Incharge Name">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--End District Modal -->
<!--Panchayat Modal -->
<div id="myPanchayat" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Panchayat Details</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>Member/addPanchayatName" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Panchayat Name</label>
            <input type="text" class="form-control" placeholder="Enter Panchayat Name" autofocus name="panch_name">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">District</label>
            <select name="panch_dist" id="" class="form-control">
              <option value="">SELECT DISTRICT</option>
              <?php foreach ($districts as $d_list) { ?>
                <option value="<?php echo $d_list->district_id ?>"><?php echo $d_list->district_name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <textarea name="panch_address" id="" cols="30" rows="4" class="form-control" placeholder="Enter Address"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Phone Number</label>
            <input type="text" name="panch_number" class="form-control" placeholder="Enter Phone Number">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Incharge</label>
            <input type="text" name="panch_incharge" class="form-control" placeholder="Enter Incharge Name">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--End Panchayat Modal -->
