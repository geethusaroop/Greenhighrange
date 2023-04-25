<?php $arTax = array("" => '---Please Select---', 1 => 'Yes', 2 => 'No') ?>
<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css" integrity="sha512-TsNN9S3X3jnaUdLd+JpyR5yVSBvW9M6ruKKqJl5XiBpuzzyIMcBavigTAHaH50MJudhv5XIkXMOwBL7TbhXThQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .democlass {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: black;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    text-transform: uppercase;
  }
  .democlass1 {
    color:black;
  }
  .democlass2 {
    display: none;
    width: 450px;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: black;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    text-transform: uppercase;
  }
</style>
<style>
  h4 {
    display: flex;
    flex-direction: row;
  }
  h4:before,
  h4:after {
    content: "";
    flex: 1 1;
    border-bottom: 2px solid #000;
    margin: auto;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sale Return Form
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Sale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Sale Return Form</li>
    </ol>
  </section>
  <!-- Main content -->
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Sale/editReturnSale2">
  <input type="hidden" class="form-control" name="m_pur_invo" value="<?php if(isset($records[0]->invoice_number)) echo $records[0]->invoice_number; ?>" style="font-weight: bold;">
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-default">
            <!-- /.box-header -->
            <!-- form start -->
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
            <!-- radio -->
            <div class="form-group">
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body" style="margin-top:-20px;">
              <div class="panel panel-primary" style="box-shadow: 4px 3px 4px 3px #172158;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>SALE RETURN FORM</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;background: #ffffff;">
                <div style="border:ridge;">
                  <div class="form-group" style="float:right;">
                    <div class="col-md-6">
                      <label>Bill Number</label>
                      <input type="text" data-pms-required="true" id="invoice_no" class="form-control" name="invoice_no" placeholder="Invoice Number" value="<?php  echo(isset($records[0]->invoice_number))? "SR".$records[0]->invoice_number:$adm=0;  ?>" style="font-weight: bold;">
                    </div>
                    <div class="col-md-6">
                      <label>Return Date: </label>
                      <input type="date" placeholder="Date" class="form-control" name="return_date" value="<?php echo date('Y-m-d'); ?>" style="font-weight: bold;" required>
                    </div>                                                                                              
                  </div>
                  <!--<h4><b>SUPPLIER DETAILS</b></h4>--->
                  <div class="form-group" style="margin-left: 20px;">
                    <div class="col-md-6" style="font-weight: bold;">
                      <label>Customer Name </label>
                      <select class="form-control select2" data-pms-required="required" name="vendor_id" id="vendor_ids">
                        <option value="">SELECT</option>
                        <?php foreach($member_names as $names){ ?>
                        <option <?php if(isset($records[0]->member_id_fk) && $records[0]->member_id_fk==$names->member_id) echo "selected"; ?> value="<?php echo $names->member_id; ?>"><?php echo $names->member_name; ?></option>
                        <?php } ?>
                      </select>
                    </div><br>
                    <div class="col-md-6">
                      <label>Address: </label>
                      <input type="text" class="form-control" name="customer_address" id="customer_addre" value="<?php if(isset($records[0]->member_address)) echo $records[0]->member_address; ?>" />
                    </div>
                  </div>
                  <div class="form-group" style="margin-left: 20px;margin-top:-10px;">
                    <div class="col-md-6">
                      <label>Phone No.</label>
                      <input type="text" class="form-control custphone" name="customer_phone" id="custphone" value="<?php if(isset($records[0]->member_pnumber)) echo $records[0]->member_pnumber; ?>" />
                    </div>
                  </div>
                
                </div>
                  <br>
                  <div class="table-responsive">
                  <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:ridge;background: #ffff;color:black;">
                  <thead>
                      <tr>
                        <th style="border:ridge;" width="20" class="col-small center style2 style3"> </th>
                        <th style="border:ridge;" width="25" class="col-small center ">SlNo</th>
                        <th width="45">Item Name</th>
                        <th width="69">Saled Rate</th>
                        <th style="border:ridge;" width="72">Saled Qty</th>
                        <th style="border:ridge;" width="49">Return Qty</th>
                        <th style="border:ridge;" width="49">Taxable Amt</th>
                        <th width="69">GST%</th>
                        <th style="border:ridge;" width="49">IGST Amt</th>
                        <th style="border:ridge;" width="40">Return Amt</th>
                        <th style="border:ridge;" width="49">Saled_Date</th>
                      </tr>
                    </thead>
                    <tbody style="background: white;color:black;">
                    <?php $qtys = 0; $x=1; foreach($records as $listed){ ?>
                      <TR style="border:ridge;background: white;color:black;">
                        <TD><INPUT type="checkbox" name="chk[]" /></TD>
                        <TD style="color:black;"> <?php echo $x; ?> </TD>
                        <td><input type="text" name="product_name[]" class="form-control" id="product_name_<?php echo $x ?>" value="<?php echo $listed->product_name ?>"  placeholder="product name" style="color:black;width:450px;text-transform:uppercase;" readonly/></td>
                        <TD> <INPUT type="text" class="form-control" id="rate_<?php echo $x ?>" value="<?php echo $listed->sale_price ?>" name="rate[]" style="width:120px;" readonly/> </TD>
                        <TD><INPUT type="text" class="form-control"  id="pquantity_<?php echo $x ?>" name="sale_quantity[]" value="<?php $qtys +=$listed->sale_quantity; echo $listed->sale_quantity ?>"  style="width:150px;" readonly/></TD>                       
                        <TD> <INPUT type="text" class="form-control" id="tamount_<?php echo $x ?>" name="return_qty[]" value="<?php echo $listed->return_qty ?>"  style="width:120px;" required onKeyUp="gettotal(this,<?php echo $x ?>)"/> </TD>
                        <TD> <INPUT type="text" class="form-control" id="taxableamount_<?php echo $x ?>" name="taxableamount[]" value=""  style="width:120px;"/> </TD>
                        <TD> <INPUT type="text" class="form-control" id="sale_igst<?php echo $x ?>" value="<?php echo $listed->sale_igst ?>" name="sale_igst[]" style="width:120px;" readonly/> </TD>
                        <TD> <INPUT type="text" class="form-control" id="sale_igstamt<?php echo $x ?>" value="" name="sale_igstamt[]" style="width:120px;" /> </TD>
                        <TD> <INPUT type="text" class="form-control" id="taxamount_<?php echo $x ?>" value="<?php echo $listed->return_price ?>" name="return_price[]" style="width:120px;" /> </TD>
                        <TD> <INPUT type="text" class="form-control" id="pdate_<?php echo $x ?>" value="<?php echo $listed->sale_date ?>" name="pdate[]" style="width:120px;" readonly/> 
                        <INPUT type="hidden" class="form-control" id="purchase_id<?php echo $x ?>" value="<?php echo $listed->sale_id ?>" name="sale_idss[]"/> 
                        <INPUT type="hidden" class="form-control" value="<?php echo $listed->product_id_fk ?>" name="product_id_fk[]" /></TD>
                      </TR>
                      <?php } ?>
                  </table>
                  </div>
                  <br><br>
                  <!-------------------------------------------------------------------------------------------------->
                  <div class="panel-body" style="font-weight:bold;">
                    <div class="row" style="border:#000;">

                    <table align="left" class="table table-bordered" style="box-shadow: 4px 3px 4px 3px #97989b;">
                  
                      <tr>
                        <td style="text-align: right;font-size:20px;color:blue;">Net Amount &nbsp;&nbsp; :&nbsp;&nbsp;<span id="net"></span>
                      <input type="hidden" name="netamt" id="netamt" value="">
                      </td>
                      </tr>
                    </table>
                    </div>
                    <i class="col-sm-5"></i>
                    <!--first panel-->
                  </div>
                  <!-- /.box-footer -->
                </div>
                <!-- /.box -->
              </div>
              <!--/.col (right) -->
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
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>