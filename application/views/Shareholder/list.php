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