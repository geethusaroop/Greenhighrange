<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	 	FPO-FUND DETAILS
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	  </ol>
    </section>
	<!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Fund/add">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="fund_id" value="<?php if(isset($records->fund_id)) echo $records->fund_id ?>"/>
                <div class="box-body">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
				<div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
				<div class="panel-heading">
					<h3 class="panel-title"><b>NEW FUND</b></h3>
				</div>
				<div class="panel-body" style="font-weight: bold;">
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Fund Type</label>
					<div class="col-sm-4">
						<select name="ftype_id_fk" class="form-control" style="font-weight: bold;">
							<option value="">-SELECT-</option>
							<?php foreach($ftype as $row){ ?>
								<option <?php if(isset($records->ftype_id_fk)){if($records->ftype_id_fk==$row->ftype_id){echo "selected";}} ?> value="<?php echo $row->ftype_id; ?>"><?php echo $row->ftype_name; ?></option>
							<?php } ?>
						</select>
					
					</div>
					<label for="customer_email" class="col-sm-2 control-label">Date (dd/mm/yyyy)</label>
					<div class="col-sm-4">
					    <input type="date" class="form-control" name="fund_date" id="fund_date" value="<?php if(isset($records->fund_date)) echo $records->fund_date; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Amount <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="number" step="0.1" class="form-control"  name="fund_amount" id="fund_amount" value="<?php if(isset($records->fund_amount)) echo $records->fund_amount; ?>"/>
					</div>
				
				
					<label for="customer_email" class="col-sm-2 control-label"> Description </label>
					<div class="col-sm-4">
					<textarea class="form-control" name="fund_des"><?php if(isset($records->fund_des)) echo $records->fund_des; ?> </textarea>
					</div>
					
				</div>
				</div>
				</div>
			
			</div>

				</div></div></div>

			</div>
			<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                      <a href="<?php echo base_url(); ?>Fund/"><button type="button" class="btn btn-danger">Cancel</button></a>
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






