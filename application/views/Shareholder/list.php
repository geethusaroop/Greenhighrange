<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Shareholders Information
            <small id="date" class="col-md-4"></small>
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>Shareholder/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
            <li class="active"></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
                    <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group margin">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-danger nohover">Member ID</button>
                                </div><!-- /btn-group -->
                              <input type="text" name="member_mid" placeholder="" id="member_mid" class="form-control">
                              <!--   <select name="member_mid" id="member_mid" class="form-control">
                                    <option value="">SELECT</option>
                                    <?php foreach($member_id as $mem_id_list){ ?>
                                    <option value="<?php echo $mem_id_list->member_mid ?>"><?php echo $mem_id_list->member_mid ?></option>
                                    <?php } ?>
                                </select> -->
                            </div><!-- /input-group -->
                        </div>
                       <!--  <div class="col-md-3">
                            <div class="input-group margin">
                                <div class="input-group-btn">
                                <button type="button" class="btn btn-danger nohover">Date </button>
                                </div>
                                <input id="pmsDateStart" type="text" data-validation-optional="true" data-pms-max-date="today" data-pms-type="date" name="start_date" data-pms-date-to="pmsDateEnd" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                                <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
                                    
                                <input id="pmsDateEnd" type="text" data-validation-optional="true" data-pms-type="date" name="end_date" data-pms-date-from="pmsDateStart" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                                <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
                            </div>
                        </div> -->
                        <div class="col-sm-4">
                            <div class="input-group">
                                <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button>
                                <a href="<?php echo base_url(); ?>Shareholder/add" class="btn btn-danger"><i class="fa fa-plus-square"></i> Add Shareholder</a>
                                &nbsp; <a href="<?php echo base_url(); ?>Shareholder/addExcelShareholder" class="btn btn-danger"><i class="fa fa-plus-square"></i> Import Excel</a>

                            </div>
                            
                        </div>
                       
                      
                    </div>
                    <br>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="classinfo_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SINO</th>
                                <th>MEMBER_ID</th>
                                <th>SHAREHOLDER_NAME&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                                <th>DATE_OF_BIRTH</th>
                                <th>ADDRESS&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                                <th>PHONE_NUMBER</th>
                                <th>EMAIL</th>
                                <th>AADHAAR_NO</th>
                                <th>PAN_NO</th>
                                <th>SHARES_HELD</th>
                                <th>DATE_OF_JOINING</th>
                                 <th>BANK_DETAILS</th> 
                                 <th>OPENING_BALANCE(PURCHASE)</th> 
                                 <th>CURRENT_BALANCE(PURCHASE)</th> 
                                 <th>
                                    <center>ADD_TO_VENDORS</center>
                                </th>
                                <th>
                                    <center>EDIT/DELETE</center>
                                </th>
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

<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" id="exampleModalLabel1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="font-weight: bold;background-color:#dfe3eb;">
    <div class="modal-header">
        <h4 class="modal-title"><b> Add Shareholder To Vendor</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Shareholder/add_to_vendor" enctype="multipart/form-data">
      <div class="modal-body"  style="font-weight: bold;font-size:16px;background-color:#eff2f5;">

      <input type="hidden" data-pms-required="true" autofocus class="form-control" name="member_id" id="member_id" value="" placeholder="Enter Shareholder Name">

   
<div class="form-group">
 
                    <div class="col-md-6">
                      <label class="fsize">Shareholder Name<span style="color: red;"> *</span></label>
                      <input type="text" data-pms-required="true" autofocus class="form-control" name="member_name" id="member_name" value="" placeholder="Enter Shareholder Name">
                    </div>

</div> 

<div class="form-group row">
                    <div class="col-md-12">
                      <label class="fsize">Address </label>
                      <textarea autofocus class="form-control" name="member_address" id="member_address" placeholder="Enter Shareholder Address"></textarea>
                    </div>
</div>
<div class="form-group">
                        <div class="col-md-4">
                      <label class="fsize">Email ID</label>
                      <input type="text" autofocus class="form-control" name="member_email" id="member_email" value="" placeholder="Enter Email">
                    </div>
                    <div class="col-md-4">
                      <label class="fsize">Phone Number</label>
                      <input type="text"" autofocus class="form-control" name="member_pnumber" id="member_pnumber" value="" placeholder="Enter Phone Number">
                    </div>
</div> 
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div><!--endds add dmlogin-->

