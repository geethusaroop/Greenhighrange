<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Voucher Head Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>BVoucherhead"><i class="fa fa-dashboard"></i> Back to list</a></li>
	  </ol>
    </section>
	<!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>BVoucherhead/add" >
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="vouch_id" value="<?php if(isset($records->vouch_id)) echo $records->vouch_id ?>"/>
                <div class="box-body">
				<div class="col-lg-1"></div>
            <div class="col-lg-10">
              <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Voucher Head Details</b></h3>
                </div>
              <div class="panel-body" style="font-weight:bold;">
				<div class="form-group">
					<label for="customer_email" class="col-sm-4 control-label"> Voucher Head </label>
					<div class="col-sm-5">
						<input type="Text"  class="form-control" required name="vouch_head" value="<?php if(isset($records->vouch_head)) echo $records->vouch_head; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="customer_email" class="col-sm-4 control-label"> Description</label>
					<div class="col-sm-5">
					    <textarea class="form-control" required name="vouch_desc"><?php if(isset($records->vouch_desc)) echo $records->vouch_desc; ?></textarea>
					</div>
				</div>
			  </div></div></div>
				</div>

				<div class="box-footer">                
	    <div class="row">
	      <div class="col-md-6">
	      </div>
	      <div class="col-md-4">
		  <a href="<?php echo base_url();?>BVoucherhead/">  <button type="button" class="btn btn-danger">Cancel</button></a>
	          <button type="submit" class="btn btn-primary">Save</button>
	        </div>
	      </div>
	</div>


				</div>
		
			</div>
			</div>
		</div>
    </section>

	</form>
	<!-- /.content -->
  </div>
<!-- /.content-wrapper -->
