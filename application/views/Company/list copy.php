 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #eef1f5;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Basic Information
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Company/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
        <li class="active">Basic Information</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
        
        
        <div class="col-md-2">
                  <a href="<?php echo base_url();?>Company/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Company Information</a>
        </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="Finyear_table" class="table table-bordered table-striped" style="font-size:15px;color: #000;border: 1px solid #f0f0f0;">
                <thead>
                <tr>
                  <th>SlNo.</th>
                 
                   <th>Logo</th>
                    <th style="width:10%;">Company_Name</th>
                    <th>Address</th>
                    <th style="width:10%;">Phone</th>
                    <th style="width:10%;">Email</th>
                    <th style="width:10%;">Website</th>
                  <th style="text-align: center;">Edit/Delete</th>
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
 </div><!--div col-md-12-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
