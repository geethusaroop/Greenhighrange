<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Credit Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Bankdeposit/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
        <li class="active">  Credit Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->				
			
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <div class="row">
            <div class="row">
                    <div class="col-md-3"></div>
                  <div class="col-md-4">
                    <div class="input-group margin">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-danger nohover">Search Here</button>
                      </div><!-- /btn-group -->
                      <select name="bd_bank_id_fk" id="bd_bank_id_fk" class="form-control">
                      <option value="">-SELECT-</option>
                      <?php foreach($bank as $row){ ?>
                        <option <?php if(isset($records->bd_bank_id_fk)){if($records->bd_bank_id_fk==$row->bank_id){echo "selected";}} ?> value="<?php echo $row->bank_id; ?>"><?php echo $row->bank_name; ?></option>
                      <?php } ?>
                    </select>
                    </div><!-- /input-group -->
                  </div>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button>
                      <a href="<?php echo base_url();?>Bankdeposit/add_credit" class="btn btn-danger"><i class="fa fa-plus-square"></i>  Add new</a>
                    </div>
                  </div>
                </div>
             
              <table class="table table-bordered table-striped" id="receipt_list" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Date</th>
                  <th>Bank_Name</th>
                  <th>Member_Name</th>
                  <th>Deposit_Amount</th>
                  <th>Remark</th>
                  <th class="text-center">Edit/Delete</th>
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






