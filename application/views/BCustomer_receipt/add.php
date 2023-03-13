<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  Customer Receipt (Cash Payment)
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	  </ol>
    </section>
	<!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>BCustomer_receipt/add">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="receipt_id" value="<?php if(isset($records->receipt_id)) echo $records->receipt_id ?>"/>
                <div class="box-body">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
				<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title"><b>NEW CUSTOMER RECEIPT FORM</b></h3>
				</div>
				<div class="panel-body" style="font-weight: bold;">
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Customer Name</label>
					<div class="col-sm-4">
						<select name="member_id_fk" class="form-control select2" style="font-weight: bold;">
							<option value="">-SELECT-</option>
							<?php foreach($member as $row){ ?>
								<option <?php if(isset($records->receipt_member_id_fk)){if($records->receipt_member_id_fk==$row->member_id){echo "selected";}} ?> value="<?php echo $row->member_id; ?>"><?php echo $row->member_name."-".$row->member_mid; ?></option>
							<?php } ?>
						</select>
					
					</div>
					<label for="customer_email" class="col-sm-2 control-label">Date (dd/mm/yyyy)</label>
					<div class="col-sm-4">
					    <input type="date" class="form-control" name="receipt_date" id="receipt_date" value="<?php if(isset($records->receipt_date)) echo $records->receipt_date; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label"> Amount <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="text" step="0.1" class="form-control"  name="receipt_amount" id="receipt_amount" value="<?php if(isset($records->receipt_amount)) echo $records->receipt_amount; ?>"/>
						<input type="hidden" step="0.1" class="form-control"  name="receipt_amount1" id="receipt_amount1" value="<?php if(isset($records->receipt_amount)) echo $records->receipt_amount; ?>"/>
					</div>
					<label for="customer_email" class="col-sm-2 control-label"> Bill No <span style="color:red">*</span></label>
					<div class="col-sm-4">
						<input type="Text"  class="form-control"  name="receipt_group" id="receipt_group" value="<?php if(isset($records->receipt_group)){echo $records->receipt_group;}else{echo $adm;}  ?>"/>
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
                     <a href="<?php echo base_url();?>BCustomer_receipt"> <button type="button" class="btn btn-danger">Cancel</button></a>
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






