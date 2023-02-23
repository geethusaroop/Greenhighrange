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
      Purchase Return Form
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Sale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Purchase Return Form</li>
    </ol>
  </section>
  <!-- Main content -->
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Purchase_Return/editReturnPurchase">
  <input type="hidden" class="form-control" name="m_pur_invo" value="<?php if(isset($records[0]->m_pur_invo)) echo $records[0]->m_pur_invo; ?>" style="font-weight: bold;">
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
                  <h3 class="panel-title"><b>PURCHASE RETURN FORM</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;background: #ffffff;">
                <div style="border:ridge;">
                  <div class="form-group" style="float:right;">
                    <div class="col-md-6">
                      <label>Bill Number</label>
                      <input type="text" data-pms-required="true" id="invoice_no" class="form-control" name="invoice_no" placeholder="Invoice Number" value="<?php  echo(isset($records[0]->m_pur_invo))? $records[0]->m_pur_invo:$adm;  ?>" style="font-weight: bold;">
                    </div>
                    <div class="col-md-6">
                      <label>Date: </label>
                      <input type="date" placeholder="Date" class="form-control" name="return_date" value="<?php if(isset($records[0]->m_pur_date)) echo $records[0]->m_pur_date; ?>" style="font-weight: bold;">
                    </div>                                                                                              
                  </div>
                  <!--<h4><b>SUPPLIER DETAILS</b></h4>--->
                  <div class="form-group" style="margin-left: 20px;">
                    <div class="col-md-6" style="font-weight: bold;">
                      <label>Supplier Name <span style="color:red">*</span></label>
                      <select class="form-control select2" data-pms-required="required" name="vendor_id" id="vendor_ids">
                        <option value="">SELECT</option>
                        <?php foreach($vendor_names as $names){ ?>
                        <option <?php if(isset($records[0]->m_pur_vendor_id) && $records[0]->m_pur_vendor_id==$names->vendor_id) echo "selected"; ?> value="<?php echo $names->vendor_id; ?>"><?php echo $names->vendorname; ?></option>
                        <?php } ?>
                      </select>
                    </div><br>
                    <div class="col-md-6">
                      <label>Address: </label>
                      <input type="text" class="form-control" name="customer_address" id="customer_addre" value="<?php if(isset($records[0]->vendoraddress)) echo $records[0]->vendoraddress; ?>" />
                    <!--   <textarea class="form-control" name="customer_address" id="customer_addre"></textarea> -->
                    </div>
                  </div>
                  <div class="form-group" style="margin-left: 20px;margin-top:-10px;">
                    <div class="col-md-6">
                      <label>TIN</label>
                      <input type="text" class="form-control custphone" name="customer_phone" id="custphone" value="<?php if(isset($records[0]->vendorphone)) echo $records[0]->vendorphone; ?>" />
                    </div>
                  </div>
                
                </div>
                  <br>
                  <!-- <h4><b>PURCHASE ITEMS</b></h4>-->
                  <button type="submit" class="btn btn-primary"  value="Add Row" onClick="addRow('dataTable')">Add</button>
                  <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTable')">Delete</button>
                  <!-- <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:ridge;background: #5c5656;color:white;"> -->
                  <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:ridge;background: #ffff;color:black;">
                  <thead>
                      <tr>
                        <th style="border:ridge;" width="20" class="col-small center style2 style3"> </th>
                        <th style="border:ridge;" width="25" class="col-small center ">SlNo</th>
                        <th style="border:ridge;" width="45">Barcode</th>
                        <th width="45">Item Name</th>
                        <th width="5"></th>
                        <th width="69">Rate</th>
                        <th style="border:ridge;" width="72">Qty</th>
                        <th style="border:ridge;" width="49">Amount</th>
                        <th style="border:ridge;" width="40">Taxable_Amount </th>
                        <th style="border:ridge;" width="49">NetAmount</th>
                        <th style="border:ridge;" width="49">Purchase_Date</th>
                      </tr>
                    </thead>
                    <tbody style="background: white;color:black;">
                    <?php $qtys = 0; foreach($records as $listed){ ?>
                      <TR style="border:ridge;background: white;color:black;">
                        <TD><INPUT type="checkbox" name="chk[]" /></TD>
                        <TD style="color:black;"> 1 </TD>
                        <TD> <INPUT type="text" class="form-control" name="product_code[]" id="product_code1" value="<?php echo $listed->product_code ?>" style="width:150px;text-transform:uppercase;" /> </TD>
                        <td><input type="text" name="product_name[]" class="form-control" id="product_name1" value="<?php echo $listed->product_name ?>"  placeholder="product name" style="color:black;width:450px;text-transform:uppercase;"/></td>
                        <TD><select name="pbar" class="form-control" id="pbar<?php echo $i=1; ?>" style="display:none;width:250px;" onchange="getbarcode(<?php echo $i; ?>);">
                                <option value="">select</option>
                            </select>
                        </TD> 
                        <TD> <INPUT type="text" class="form-control" id="rate1" value="<?php echo $listed->m_pur_amt ?>" name="rate[]" style="width:120px;" /> </TD>
                        <TD><INPUT type="text" class="form-control" name="sale_quantity[]" value="<?php $qtys +=$listed->m_pur_qty; echo $listed->m_pur_qty ?>" id="pquantity_1" style="width:150px;" required onKeyUp="gettotal(this)" /></TD>                       
                        <TD> <INPUT type="text" class="form-control" name="tamount[]" value="" id="tamount1" style="width:120px;" /> </TD>
                        <TD> <INPUT type="text" class="form-control" id="taxamount1" value="" name="taxamount[]" style="width:120px;" /> </TD>
                        <TD> <INPUT type="text" class="form-control" id="netamt1" value="<?php echo $listed->m_pur_net_amt ?>" name="netamt[]" style="width:120px;" /> </TD>
                        <TD> <INPUT type="text" class="form-control" id="pdate1" value="<?php echo $listed->m_pur_date ?>" name="pdate[]" style="width:120px;" /> </TD>
                        <TD> <INPUT type="hidden" class="form-control" id="product_num1" value="<?php echo $listed->m_pur_prod_id_fk ?>" name="product_id_fk[]" style="width: 20px;" /> </TD>
                      </TR>
                      <?php } ?>
                  </table>
                  <br><br>
                  <!-------------------------------------------------------------------------------------------------->
                  <div class="panel-body" style="font-weight:bold;">
                    <br>
                    <table align="left" class="table table-bordered" style="border:ridge;">
                      <tr>
                        <td>Total Amount<input type='text' id='net_total' class="form-control" value="<?php echo $records[0]->m_pur_total ?>" name="net_total" readonly style="background-color:white;text-align:right;width:250px;"/></td>
                        <td>Qty. Total<input type='text' id='qty_total' class="form-control" value="<?php echo $qtys ?>" name="qty_total" readonly style="background-color:white;text-align:right;width:250px;"/></td>
                        <td style="float:right;">Received Amount<input type='text' id='pamount' value="<?php echo $records[0]->m_pur_total ?>" class="form-control" name="pamount" readonly style="background-color:white;text-align:right;width:250px;"/></td>
                      </tr>
                      <tr>
                        <td>Discount Amount<input type="text" class="form-control" name="discount_price" id="discount_price" value="0" style="width:250px;text-align: right;font-weight: bold;background: white;" onkeyup="getdiscamount();" />
                        <td></td>
                        <td style="float:right;">Balance <input type='text' id='total_amt' class="form-control" name="total_amt" readonly style="background-color:white;text-align:right;width:250px;"/></td>
                      </tr>
                    </table>
                    <table align="left" class="table table-bordered" style="border:ridge;">
                      <tr>
                        <td style="text-align: right;font-size:20px;color:blue;">Net Amount &nbsp;&nbsp; :&nbsp;&nbsp;<span id="net"></span></td>
                      </tr>
                    </table>
                    <div class="row" style="border:#000;">
                    </div>
                    <!--   <h4><b>TOTAL BILL DETAILS</b></h4> -->
                    <br> <br>
                    <i class="col-sm-5"></i>
                    <strong id="myDiv" style="font-size: 18px;">Available Stock is: <span id="quant"></span></strong>
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