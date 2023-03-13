<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	 	CREDIT DETAILS
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	  </ol>
    </section>
	<!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Bankdeposit/add_bcredit">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="bd_id" value="<?php if(isset($records->bd_id)) echo $records->bd_id ?>"/>
                <div class="box-body">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
				<div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
				<div class="panel-heading">
					<h3 class="panel-title"><b>NEW CREDIT DETAILS</b></h3>
				</div>
				<div class="panel-body" style="font-weight: bold;">
				
				<div class="form-group">
					
					<div class="col-md-6">
					<label>Date</label>
						<input type="date" class="form-control"  name="bd_date" id="bd_date" value="<?php if(isset($records->bd_date)) echo $records->bd_date; ?>"/>
					</div>

					<div class="col-md-6">
					<label> Bank Name </label>
					<select name="bd_bank_id_fk" id="bd_bank_id_fk" class="form-control">
						<option value="">-SELECT-</option>
						<?php foreach($bank as $row){ ?>
							<option <?php if(isset($records->bd_bank_id_fk)){if($records->bd_bank_id_fk==$row->bank_id){echo "selected";}} ?> value="<?php echo $row->bank_id; ?>"><?php echo $row->bank_name; ?></option>
						<?php } ?>
					</select>
					</div>

				</div>

				<div class="form-group">
				
					<div class="col-md-6">
					<label> Member Name</label>
					<select name="bd_member_id_fk" id="bd_member_id_fk" class="form-control">
						<option value="">-SELECT-</option>
						<?php foreach($member as $row){ ?>
							<option <?php if(isset($records->bd_member_id_fk)){if($records->bd_member_id_fk==$row->member_id){echo "selected";}} ?> value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?></option>
						<?php } ?>
					</select>					
				</div>

				<div class="col-md-6">
					<label>Amount</label>
						<input type="text" class="form-control"  name="bd_amount" id="bd_amount" value="<?php if(isset($records->bd_amount)) echo $records->bd_amount; ?>"/>
						<input type="hidden" class="form-control"  name="bd_amount1" id="bd_amount1" value="<?php if(isset($records->bd_amount)) echo $records->bd_amount; ?>"/>

					</div>

				</div>

				<div class="form-group">
					
					<div class="col-md-12">
					<label> Remarks </label>
					<textarea class="form-control" name="bd_remark"><?php if(isset($records->bd_remark)) echo $records->bd_remark; ?> </textarea>
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
                      <a href="<?php echo base_url(); ?>Bankdeposit/bcredit"><button type="button" class="btn btn-danger">Cancel</button></a>
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






