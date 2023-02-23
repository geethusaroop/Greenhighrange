<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  Vendor Voucher Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	  </ol>
    </section>
	<!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Vendor_voucher/add" >
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="voucher_id" value="<?php if(isset($records->voucher_id)) echo $records->voucher_id ?>"/>
                <div class="box-body">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
				<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title"><b>NEW VOUCHER</b></h3>
				</div>
				<div class="panel-body" style="font-weight: bold;">
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Vendor Name</label>
					<div class="col-sm-4">
						<select name="vendor_id" class="form-control" style="font-weight: bold;">
							<option value="">-SELECT-</option>
							<?php foreach($vendor_names as $row){ ?>
								<option <?php if(isset($records->vendor_id_fk)){if($records->vendor_id_fk==$row->vendor_id){echo "selected";}} ?> value="<?php echo $row->vendor_id; ?>"><?php echo $row->vendorname; ?></option>
							<?php } ?>
						</select>
						<!-- <input type="hidden" id="vouch_id_fk" value="<?php if(isset($records->vendor_id)) echo $records->vendor_id; ?>">  -->
						<?php //echo form_dropdown('vendor_id', $vendor_name, '', 'id="vouch_name" class="form-control select2"  required data-pms-type="dropDown"', 'name="vendor_id"');?>
					</div>
					<label for="customer_email" class="col-sm-2 control-label">Date (dd/mm/yyyy)</label>
					<div class="col-sm-4">
					    <input type="date" class="form-control" name="voucher_date" id="voucher_date" value="<?php if(isset($records->voucher_date)) echo $records->voucher_date; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Amount <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="number" step="0.1" class="form-control"  name="voucher_amount" id="voucher_amount" value="<?php if(isset($records->voucher_amount)) echo $records->voucher_amount; ?>"/>
					</div>
					<label for="customer_email" class="col-sm-2 control-label"> Bill No <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="Text"  class="form-control"  name="voucher_group" id="voucher_group" value="<?php if(isset($records->voucher_group)){echo $records->voucher_group;}else{echo $adm;}  ?>"/>
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
			
			</div>

				</div></div></div>

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






