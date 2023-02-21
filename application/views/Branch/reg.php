

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Class Info Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Banner/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Class Info Form</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Banner/add_reg" enctype="multipart/form-data">
     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="banner_id" value="<?php if(isset($records->banner_id)) echo $records->banner_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
                <div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Name <span style="color:red">*</span></label>

                  <div class="col-sm-3">
                    <input type="text" data-pms-required="true" autofocus class="form-control" name="name" placeholder="Name" value="<?php if(isset($records->banner_name)) echo $records->banner_name ?>">
                  </div>
				</div> 
				
				<div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Gender <span style="color:red">*</span></label>

                  <div class="col-sm-3">
				  <input type="radio"  name="gender"  value="male">  Male
				  <input type="radio"  name="gender"  value="female">  Female
                    
                  </div>
				</div> 
				<div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Language <span style="color:red">*</span></label>

                  <div class="col-sm-3">
				  <input type="checkbox"   name="language[]"  value="malayalam"<?php if(isset($records->banner_name)) echo $records->banner_name ?>>Malayalam
				  <input type="checkbox"   name="language[]"  value="english"<?php if(isset($records->banner_name)) echo $records->banner_name ?>>English
                    
                  </div>
				</div>
				<div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Department <span style="color:red">*</span></label>

                  <div class="col-sm-3">
				  <select name="department">
					<option value="CSE">CSE</option>
					<option value="IT">IT</option>
					<option value="ECE">ECE</option>
				  </select>
                  </div>
				</div>
                <div class="form-group">
				<label for="size_name" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-2" id="picture">
				  <input type="hidden" name="banner_pic" value="<?php if(isset($records->banner_imgname)) echo $records->banner_imgname ?>"/>
					<input  type="file" id="fileupload" onclick="hide()" name="banner_imgname"/>
				  </div>
				</div> 

				
            </div>
              <!-- /.box-body -->
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
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






