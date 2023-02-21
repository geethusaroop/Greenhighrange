<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Voucher Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url();?>Voucherhead"><i class="fa fa-dashboard"></i> Back To list</a></li>
	  </ol>
    </section>
	<!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Voucher/add" >
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  <fieldset>
		    <legend>Voucher Details</legend>
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="voucher_id" value="<?php if(isset($records->voucher_id)) echo $records->voucher_id ?>"/>
                <div class="box-body">
                <div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Voucher Number <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="Text"  class="form-control"  name="voucher_number" value="<?php if(isset($records->voucher_number)){ echo $records->voucher_number;}else{echo rand(00000,99999);} ?>" style="color:red;"/>
					</div>
					
				</div>
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Voucher Head </label>
					<div class="col-sm-4">
						<input type="hidden" id="vouch_id_fk" value="<?php if(isset($records->vouch_id_fk)) echo $records->vouch_id_fk; ?>"/>
						<?php echo form_dropdown('vouch_id', $vouchnames, '', 'id="vouch_name" class="form-control select2"  required data-pms-type="dropDown"', 'name="vouch_id"');?>
					</div>
					<label for="customer_email" class="col-sm-2 control-label">Date (dd/mm/yyyy)</label>
					<div class="col-sm-4">
					    <input type="date" class="form-control" name="voucher_date" id="voucher_date" placeholder="DD/MM/YYYY" value="<?php if(isset($records->voucher_date)) echo $records->voucher_date; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Amount <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="Text"  class="form-control"  name="voucher_amount" id="voucher_amount" value="<?php if(isset($records->voucher_amount)) echo $records->voucher_amount; ?>"/>
					</div>
					<label for="customer_email" class="col-sm-2 control-label"> Paid to <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="Text"  class="form-control"  name="paid_to" id="paid_to" value="<?php if(isset($records->paid_to)) echo $records->paid_to; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Narration </label>
					<div class="col-sm-4">
					<textarea class="form-control" name="narration"><?php if(isset($records->narration)) echo $records->narration; ?> </textarea>
					</div>
				</div>
				</div>
				</div>
			</fieldset>
			</div>
			</div>
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
