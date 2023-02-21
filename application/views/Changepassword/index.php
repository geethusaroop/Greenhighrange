<!-- Content Wrapper. Contains page content -->
  <!--<div class="content-wrapper" style="background: url('<?php //echo base_url();?>images/sky1.jpg');">-->
    <div class="content-wrapper" style="background-color: #eef1f5;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Password
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info container">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Company/resetPassword">
              <!-- radio -->
                
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                    <input type="hidden" name="id" value="<?php if(isset($records->id)) echo $records->id ?>"/>
                  <?php echo validation_errors(); ?>
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                        </div>
                      </div>
                    </div>
                    <!-- <fieldset><legend>Reset Password</legend> -->
            <div class="box-body">
            <div class="col-lg-1"></div>
              <div class="col-lg-10">
                <div class="panel panel-default" style="box-shadow:2px 2px 2px 2px black;">
                  <div class="panel-heading">
                    <b>Reset Password </b>
                  </div>
                  <div class="panel-body">
        <div class="">
        <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                  <label for="size_name" class="col-md-5 control-label" style="font-size:16px;">Username</label>

                  <div class="col-md-6">
                    <input type="text"  required  class="form-control" name="username" id="username"  value="<?php if(isset($records->user_name)) echo $records->user_name ?>" style="font-size:16px;">
                  </div>
          
                </div>
              </div>
            </div>
        
                 <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                  <label for="size_name" class="col-md-5 control-label" style="font-size:16px;">Password</label>

                  <div class="col-md-6">
                     <input type="text"  required  class="form-control" name="password" id="password"  value="<?php if(isset($records->admin_password)) echo $records->admin_password ?>" style="font-size:16px;">
                  </div>
          
                </div>
              </div>
            </div>
        
        </div></div></div>

              
              </div>
          </div>
              <!-- /.box-body -->
              
        <div class="box-footer" align="right">
          <div class="col-md-9">
        <button type="reset" class="btn btn-danger">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          <!-- </fieldset> -->
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






