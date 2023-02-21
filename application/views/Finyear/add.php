<style type="text/css">
  .fsize
  {
    font-size: 16px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
  <!--<div class="content-wrapper" style="background: url('<?php //echo base_url();?>images/marina.jpg');">-->
    <div class="content-wrapper" style="background-color: #eef1f5;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Financial Year
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Finyear"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Financial Year</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
		<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Finyear/add">
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="finyear_id" value="<?php if(isset($records->finyear_id)) echo $records->finyear_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
				
				<div class="form-group">
                  <label for="size_name" class="col-sm-5 control-label fsize">Financial Year</label>

                  <div class="col-sm-2">
                    <input type="text" data-pms-required="true" class="form-control input-sm" name="fin_year" placeholder="Eg : 2016 - 2017" value="<?php if(isset($records->fin_year)) echo $records->fin_year ?>" style="font-size:16px;">
                  </div>
				  
				</div>	
				<div class="form-group">
                  <label for="size_name" class="col-sm-5 control-label fsize">Start Date</label>

                  <div class="col-sm-2">
                    <input type="text" data-pms-required="true" class="form-control input-sm" id="start_date" name="start_date" placeholder="Start Date" value="<?php if(isset($records->fin_startdate)){ $fin_startdate = str_replace('-', '/', $records->fin_startdate); $fin_startdate =  date("d/m/Y",strtotime($fin_startdate)); echo $fin_startdate;} ?>" style="font-size:16px;">
                  </div>
				  
				</div>
				<div class="form-group">
                  <label for="size_name" class="col-sm-5 control-label fsize">End Date</label>

                  <div class="col-sm-2">
                    <input type="text" data-pms-required="true" class="form-control input-sm" id="end_date" name="end_date" placeholder="End Date" value="<?php if(isset($records->fin_enddate)){ $fin_enddate = str_replace('-', '/', $records->fin_enddate); $fin_enddate =  date("d/m/Y",strtotime($fin_enddate)); echo $fin_enddate;} ?>" style="font-size:16px;">
                  </div>
				  
				</div>
				
            </div>
              <!-- /.box-body -->
              
			  <div class="box-footer" align="right">
				<button type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
              </div>
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






