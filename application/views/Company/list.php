<style type="text/css">
  .fsize {
    font-size: 16px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<!--<div class="content-wrapper" style="background: url('<?php //echo base_url();
                                                          ?>images/sky1.jpg');">-->
<div class="content-wrapper" style="background-color: #eef1f5;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Basic Information
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Company"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Basic Information</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info container">
          <div class="box-header">
          <!-- <div class="col-md-8"><h2 class="box-title"></h2> </div>
        
        <div class="col-md-2">
            <a href="<?php echo base_url();?>Company/edit/<?php echo $info_id=1; ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Update Company Information</a>
        </div> -->
          </div>
          <!-- /.box-header -->
          <!-- form start -->
        
            <!-- radio -->
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <input type="hidden" name="info_id" value="<?php if (isset($records->info_id)) echo $records->info_id ?>" />
                  <?php echo validation_errors(); ?>
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
              </div>
            </div>
           
              <div class="box-body">
              <div class="col-lg-1"></div>
              <div class="col-lg-10">
                <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                  <div class="panel-heading">
                    <b>Company Details</b>
                    <span style="float:right;margin-top:-8px;">            
                    <a href="<?php echo base_url();?>Company/edit/<?php echo $info_id=1; ?>" class="btn btn-danger"><i class="fa fa-edit"></i>  Update Company Information</a>
                    </span>
                  </div>
                  <div class="panel-body">
                <div class="">
               
                <table class="table table-bordered table-striped" style="font-size:15px;color: #000;">
                <tr><td colspan="3" style="text-align:center"><img src="<?php echo base_url(); ?>/Companylogo/<?php echo $records->info_logo; ?>"  class="card-img-top"></td></tr>
                <tr><td style="font-weight:normal;color:black;">Corporate Identification Number(CIN)</td><td></td><td style="color:blue;"><?php if (isset($records->info_cin)) echo $records->info_cin; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Company Name</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_name)) echo $records->info_name; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Registration Number</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_reg_no)) echo $records->info_reg_no; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">RoC</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_roc)) echo $records->info_roc; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Company Category</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_category)) echo $records->info_category; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Company SubCategory</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_subcategory)) echo $records->info_subcategory; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Class Of Company</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_class_company)) echo $records->info_class_company; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Date of Incorporation</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_start_date)) echo $records->info_start_date; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Age Of Company</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_age_company)) echo $records->info_age_company; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Total Members</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_tot_members)) echo $records->info_tot_members; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Address</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_address)) echo $records->info_address; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Phone Number(1)</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_mobile1)) echo $records->info_mobile1; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Phone Number(2)</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_mobile2)) echo $records->info_mobile2; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Email Id(1)</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_email1)) echo $records->info_email1; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Email Id(2)</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_email2)) echo $records->info_email2; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Website</td><td></td><td style="font-weight: bold;"><a href="<?php if (isset($records->info_website)) echo $records->info_website; ?>" target="_blank"><?php if (isset($records->info_website)) echo $records->info_website; ?></a></td></tr>
                <tr><td style="font-weight:normal;color:black;">GSTIN</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_gstin)) echo $records->info_gstin; ?></td></tr>
                <tr><td style="font-weight:normal;color:black;">Company Activity</td><td></td><td style="font-weight: bold;"><?php if (isset($records->info_activity)) echo $records->info_activity; ?></td></tr>

              </table>
                
                      <!-- <div class="form-group">
                      <div class="col-md-3">
                        <label>Corporate Identification Number(CIN)</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_cin" value="<?php if (isset($records->info_cin)) echo $records->info_cin; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>
                        <div class="col-md-6">
                        <label>Company Name</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="name" value="<?php if (isset($records->info_name)) echo $records->info_name; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>

                        <div class="col-md-3">
                        <label>Registration Number</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_reg_no" value="<?php if (isset($records->info_reg_no)) echo $records->info_reg_no; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>
                      </div>

                      <div class="form-group">
                      <div class="col-md-4">
                        <label>RoC</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_roc" value="<?php if (isset($records->info_roc)) echo $records->info_roc; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>
                        <div class="col-md-4">
                        <label>Company Category</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_category" value="<?php if (isset($records->info_category)) echo $records->info_category; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>

                        <div class="col-md-4">
                        <label>Company SubCategory</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_subcategory" value="<?php if (isset($records->info_subcategory)) echo $records->info_subcategory; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>

                      </div>

                      <div class="form-group">
                      <div class="col-md-3">
                        <label>Class Of Company</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_class_company" value="<?php if (isset($records->info_class_company)) echo $records->info_class_company; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>
                      <div class="col-md-3">
                        <label>Date of Incorporation</label>
                          <input type="Date" data-pms-required="true" class="form-control input-sm" name="info_start_date" value="<?php if (isset($records->info_start_date)) echo $records->info_start_date; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>
                        <div class="col-md-3">
                        <label>Age of Company</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_age_company" value="<?php if (isset($records->info_age_company)) echo $records->info_age_company; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>

                        <div class="col-md-3">
                        <label>Total Members</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="info_tot_members" value="<?php if (isset($records->info_tot_members)) echo $records->info_tot_members; ?>" style="text-transform: uppercase;font-size:16px;">
                        </div>

                      </div>
                   
                      <div class="form-group">
                       
                        <div class="col-md-12">
                        <label>Address</label>
                          <textarea rows="1" name="address" data-pms-required="true" class="form-control input-sm" style="font-size:16px;"><?php if (isset($records->info_address)) echo $records->info_address; ?></textarea>
                        </div>
                      </div>
                 
                      <div class="form-group">
                      
                        <div class="col-md-3">
                        <label>Phone (1)</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="fphone" value="<?php if (isset($records->info_mobile1)) echo $records->info_mobile1; ?>" style="font-size:16px;">
                        </div>
                    
                        <div class="col-md-3">
                        <label>Phone (2)</label>
                          <input type="text" class="form-control input-sm" name="sphone" value="<?php if (isset($records->info_mobile2)) echo $records->info_mobile2; ?>" style="font-size:16px;">
                        </div>
                  
                       
                        <div class="col-md-3">
                        <label>Email (1)</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="femail" value="<?php if (isset($records->info_email1)) echo $records->info_email1; ?>" style="font-size:16px;">
                        </div>
                        
                        <div class="col-md-3">
                        <label>Email (2)</label>
                          <input type="text" class="form-control input-sm" name="semail" value="<?php if (isset($records->info_email2)) echo $records->info_email2; ?>" style="font-size:16px;">
                        </div>
                  </div>
                 
                      <div class="form-group">
                      
                        <div class="col-md-4">
                        <label>Website</label>
                          <input type="text" class="form-control input-sm" name="webiste" value="<?php if (isset($records->info_website)) echo $records->info_website; ?>" style="font-size:16px;">
                        </div>
                        
                        <div class="col-md-4">
                        <label>GSTIN No</label>
                          <input type="text" data-pms-required="true" class="form-control input-sm" name="gstin" value="<?php if (isset($records->info_gstin)) echo $records->info_gstin; ?>" style="font-size:16px;text-transform: uppercase;">
                        </div>
                       
                       
                  </div>

                  <div class="form-group">
                       
                       <div class="col-md-12">
                       <label>Company Activity</label>
                         <textarea rows="4" name="info_activity" data-pms-required="true" class="form-control input-sm" style="font-size:16px;"><?php if (isset($records->info_activity)) echo $records->info_activity; ?></textarea>
                       </div>
                     </div> -->
                

                </div>
                  </div></div></div>
              </div>
              <!-- /.box-body -->
             
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->