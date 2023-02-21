<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Licenses Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Customer/"><i class="fa fa-dashboard"></i> Back to View</a></li>
        <li class="active">Licenses Details</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Licenses/add"  enctype="multipart/form-data">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  
		   
		  	<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="lic_id" value="<?php if(isset($records->license_id)) echo $records->license_id ?>"/>
                <?php echo validation_errors(); ?>
			    <div class="box-body">
			    	  <div class="col-lg-1"></div>
              <div class="col-lg-10">
             <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>LICENSES DETAILS</b></h3>
                </div>
                  <div class="panel-body" style="font-weight: bold;">
				<div class="form-group">
					  <div class="col-md-6">
					  	 <label>License Name <span style="color:red">*</span></label>
						<input type="text" data-pms-required="true" required  class="form-control" name="lic_name" id="custname"  value="<?php if(isset($records->license_name)) echo $records->license_name ?>">
					  </div>
				
					  <div class="col-md-6">
					  	 <label>License Number <span style="color:red">*</span></label>
						<input type="text"  data-pms-required="true"  class="form-control" name="lic_number" id="shopname"  value="<?php if(isset($records->license_number)) echo $records->license_number ?>">
					  </div>
				</div>
				<div class="form-group">
					 
					  <div class="col-md-6">
					  	 <label>License Reminder</label>
              <input type="date"  class="form-control" name="lic_reminder" id="shopname"  value="<?php if(isset($records->license_reminder)) echo $records->license_reminder ?>">
					  </div>
					 
					  <div class="col-md-6">
					  	 <label>Expiry Date</label>
						<input type="date"  class="form-control" name="lic_expiery" id="custphone"  value="<?php if(isset($records->license_expirery_date)) echo $records->license_expirery_date ?>">
					  </div>
				</div>
                <div class="form-group">
				
					  <div class="col-md-6">
					  	 <label>License File</label>
               <input type="hidden" name="lic_file1" value="<?php if(isset($records->license_upload)) echo $records->license_upload ?>">
						<input type="file"  class="form-control" accept="image/png, image/gif, image/jpeg" name="lic_file" id="custemail"  value="">
					  </div>
					 
					  
				</div>
                </div>
              <!-- /.box-body -->
              
            
			</div></div></div>
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
