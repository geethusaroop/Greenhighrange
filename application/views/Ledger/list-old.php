
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ledger
       <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Ledger/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">  Ledger</li>
      </ol>
    </section>
   
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
			    
				<div class="col-md-3">
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover">Ledger Head</button>
						</div><!-- /btn-group -->
					<!--<input type="text"  class="form-control"  id="ledgerbuk_head"  placeholder="Ledger Head">-->
					<select name=""  class="form-control"  id="ledgerbuk_head">
						<option value="">-SELECT LEDGER HEAD-</option>
						<?php foreach($ledger as $row){?>
							<option value="<?php echo $row->head; ?>"><?php echo $row->head; ?></option>
						 <?php } ?>
					</select>
				</div><!-- /input-group -->
				</div>
			<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">From</button>
					</div><!-- /btn-group -->
						<input id="start_date" type="date"  name="start_date" data-pms-date-to="pmsDateEnd" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
						
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">To</button>
					</div><!-- /btn-group -->
						<input id="end_date" type="date" name="end_date"  class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
						
				</div>
			</div>
			<div class="col-sm-1">
					<div class="input-group">
						<button type="submit" id="search" class="btn bg-orange btn-flat margin" >Search</button>
					</div>
			</div>
			  
			  
			  
			  
			  
			  
			  
			  <!--
			  
              <div class="col-md-4"><h2 class="box-title"></h2> </div>
			  <div class="col-md-2">
				
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover">Ledger Head</button>
						</div>
							<input type="text" class="form-control" id="ledgerbuk_head">
					</div>
					
				</div>
				<div class="col-md-2">
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover">Start Date</button>
						</div>
							<input type="text" class="form-control" id="start_date">
							
					</div>
					
				</div>
				<div class="col-md-2">
					<div class="input-group margin">
						
							<input type="text" class="form-control" id="end_date">
					</div>
					
				</div>
				
				<div class="col-md-4">
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover" id="search">Search</button>
						</div>
					</div>
					
				</div>
				-->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			
              <table id="enquiry_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL.NO</th>
				  <th>DATE</th>
				  <th>PARTICULARS</th>
                  <th>CREDIT</th>
				  <th>DEBIT</th>
                </tr>
                
                </thead>
                <tbody>
                </tbody>
				 
			 </table>
			
            </div>
            <!-- /.box-body -->
			
          </div>
          <!-- /.box -->

         
     </div>

    </section>
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






