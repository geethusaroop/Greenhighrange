<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	 	FPO-BANK DETAILS
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	  </ol>
    </section>
	<!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Bank/add">
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
					<h3 class="panel-title"><b>NEW BANK DETAILS</b></h3>
				</div>
				<div class="panel-body" style="font-weight: bold;">
				
				<div class="form-group">
					
					<div class="col-md-6">
					<label> Bank Name </label>
						<input type="text" class="form-control"  name="bank_name" id="bank_name" value="<?php if(isset($records->bank_name)) echo $records->bank_name; ?>"/>
					</div>

					<div class="col-md-6">
					<label> Bank Branch </label>
						<input type="text" class="form-control"  name="bank_branch" id="bank_branch" value="<?php if(isset($records->bank_branch)) echo $records->bank_branch; ?>"/>
					</div>

				</div>
				<div class="form-group">
					
					<div class="col-md-12">
					<label> Bank Address </label>
					<textarea class="form-control" name="bank_address"><?php if(isset($records->bank_address)) echo $records->bank_address; ?> </textarea>
					</div>
					
				</div>

				<div class="form-group">
					
					<div class="col-md-6">
					<label> Account No </label>
						<input type="text" class="form-control"  name="bank_accno" id="bank_accno" value="<?php if(isset($records->bank_accno)) echo $records->bank_accno; ?>"/>
					</div>

					<div class="col-md-6">
					<label> Bank IFSC Code </label>
						<input type="text" class="form-control"  name="bank_ifsc" id="bank_ifsc" value="<?php if(isset($records->bank_ifsc)) echo $records->bank_ifsc; ?>"/>
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
                      <a href="<?php echo base_url(); ?>Bank/"><button type="button" class="btn btn-danger">Cancel</button></a>
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






