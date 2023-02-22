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
      Sales Details Form
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Sale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Sales Form</li>
    </ol>
  </section>
  <!-- Main content -->
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Sale/add">
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
            <div class="box-body" style="margin-top:-20px;font-family:'Times New Roman', Times, serif;font-size:16px;">
              <div class="panel panel-info" style="box-shadow: 4px 3px 4px 3px #172158;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>SALES FORM</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;background: aliceblue;">
                <div style="box-shadow: 4px 3px 4px 3px #97989b;">
                  <div class="form-group" style="float:right;">
                    <div class="col-md-4">
                      <label>Bill Number</label>
                      <input type="hidden" data-pms-required="true" id="invoice" class="form-control" name="invoice" value="<?php if(isset($records->invoice)){echo $records->invoice;}else{echo $adm;} ?>">  
                      <input type="text" data-pms-required="true" id="invoice_no" class="form-control" name="invoice_no" placeholder="Invoice Number" value="<?php if (isset($records->invoice_number)) {

                                                                echo $records->invoice_number;

                                                                } else {

                                                                echo "GHR000".$adm;

                                                                }  ?>" style="font-weight: bold;">                    
                                                                </div>
                    <div class="col-md-4">
                      <label>Sale Date: </label>
                      <input type="date" placeholder="Date" class="form-control" name="sale_date" value="<?php echo date('Y-m-d'); ?>" style="font-weight: bold;">
                    </div>
                    <div class="col-md-4">
                      <label>Entry Date: </label>
                      <input type="date" placeholder="Date" class="form-control" name="entry_date" value="<?php echo date('Y-m-d');?>" style="font-weight: bold;">
                         
                    </div>
                    <div class="col-md-4">
                    <label>MOP</label>
                      <select name="purchase_mop" data-pms-required="true" class="form-control" style="font-weight: bold;">
                        <option value="">-SELECT-</option>
                        <option selected value="Cash">Cash</option>
                        <option value="Credit">Credit</option>
                      </select>
                    </div>                                                                                                           
                  </div>
                    
                  <div class="form-group" style="margin-left: 20px;">
                  <div class="col-md-4">
                      <label class="fsize">Customer Type</label>
                      <select name="member_type" class="form-control" id="member_types_all" onchange="getcustomer();">
                        <option value="">Please Select</option>
                        <option value="1">Share Holder</option>
                        <option value="2">Wholesale Customer</option>
                        <option value="3">Customers/Retailers</option>
                         <option value="4">Others</option>
                      </select>
                    </div>
                    <div id="member" style="display: none;">
                    <div class="col-md-4">
                    <label>Customer Name <span style="color:red">*</span></label>
                    <select name="custname" class="form-control" id="custname">
                      <option value="">-SELECT-</option>
                    </select>
                    </div>
                    </div>
                    <!--------------------------------------------------->
                    <div id="other" style="display: none;">
                    <div class="col-md-3" style="font-weight: bold;">
                      <label>Customer Name <span style="color:red">*</span></label>
                      <input type="text" class="form-control" name="customer_name" id="customer_nam" value="CASH ON SALE" />
                    </div><br>
                    <div class="col-md-3">
                      <label>Address: </label>
                      <input type="text" class="form-control" name="customer_address" id="customer_addre" value="CASH" />
                    <!--   <textarea class="form-control" name="customer_address" id="customer_addre"></textarea> -->
                    </div>
                  
                  <div class="form-group" style="margin-left: 1px;margin-top:-10px;">
                    <div class="col-md-3">
                      <label>Mobile No.</label>
                      <input type="text" class="form-control custphone" name="customer_phone" id="custphone" value="" />
                    </div>
                  </div>
                  </div>
                  </div>
                    <!--------------------------------------------------->
                
                </div>
                  <br>
                  <!-- <h4><b>PURCHASE ITEMS</b></h4>-->
                  <button type="submit" class="btn btn-primary"  value="Add Row" onClick="addRow('dataTable')">Add</button>
                  <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTable')">Delete</button>
                  <!-- <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:ridge;background: #5c5656;color:white;"> -->
                <div class="table-responsive">
                  <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:ridge;background: #ffff;color:black;">
 
                  <thead style="background: black;color: white;text-transform: uppercase;">
                      <tr>
                        <th style="text-transform:uppercase;" width="20" class="col-small center style2 style3"> </th>
                        <th style="text-transform:uppercase;" width="25" class="col-small center ">SlNo</th>
                        <th style="text-transform:uppercase;" width="45">Product_Code</th>
                        <th width="45" style="text-transform:uppercase;">Item Name</th>
                        <th style="text-transform:uppercase;" width="45">HSNCODE</th>
                       <th width="5" style="text-transform:uppercase;">Rate_Type</th>
                        <th width="69" style="text-transform:uppercase;">Rate</th>
                        <th style="text-transform:uppercase;" width="72">Qty</th>
                        <th style="text-transform:uppercase;" width="46">Discount.% </th>

                         <th style="text-transform:uppercase;" width="49">Amount</th>

                         <th style="text-transform:uppercase;" width="40">Taxable_Amount </th>

                        <!--  <th style="text-transform:uppercase;" width="49">CGST.%</th>

                          <th style="text-transform:uppercase;" width="49">CGST_Amount</th> 

                          <th style="text-transform:uppercase;" width="49">SGST.%</th>

                          <th style="text-transform:uppercase;" width="49">SGST_Amount</th>  -->

                          <th style="text-transform:uppercase;" width="49">IGST.%</th>

                          <th style="text-transform:uppercase;" width="49">IGST_Amount</th> 
                        <th style="text-transform:uppercase;" width="49">NetAmount</th>
                        <th style="text-transform:uppercase;" width="49" colspan="5"></th>
                      </tr>
                    </thead>
                    <tbody style="background: white;color:black;">
                      <TR style="border:ridge;background: white;color:black;">
                        <TD><INPUT type="checkbox" name="chk[]" /></TD>
                        <TD style="color:black;"> 1 </TD>
                        <TD> <INPUT type="text" class="form-control" name="product_code[]" id="product_code1" style="width:150px;" /> </TD>
                        <td><input type="text" name="product_name[]" class="form-control" id="product_name1"  placeholder="product name" style="color:black;width:350px;text-transform:uppercase;" onchange="getproductdetails(<?php echo $i=1; ?>);"/></td>
                        <td><input type="text" name="hsn[]" class="form-control" id="hsn1"  placeholder="" style="color:black;width:150px;text-transform:uppercase;"/></td>
                        <TD> <select class="form-control" name="rate_type" id="rate_type1" onchange="getratetype(<?php echo $i=1; ?>);">
                        <option value="">-RATE-</option>
                        <option value="1">R1</option>
                        <option value="2">R2</option>
                        <option value="3">R3</option>
                      </select> </TD>
                        <TD> <INPUT type="text" class="form-control" id="rate1" name="rate[]" style="width:120px;" /> </TD>
                    <TD> <INPUT type="text" class="form-control" name="sale_quantity[]" id="pquantity_1" style="width:110px;" required onKeyUp="gettotal(<?php echo $i=1; ?>,this)" />  </TD>
                    <TD> <INPUT type="text" class="form-control" id="discount_1" name="discount_price[]"  style="width:80px;" onKeyUp="gettotalgrid(<?php echo $i=1; ?>,this)"/> </TD>
                        <TD> <INPUT type="text" class="form-control" name="tamount[]" id="tamount1" style="width:120px;" /> </TD>
                        <TD> <INPUT type="text" class="form-control" id="taxamount1" name="taxamount[]" style="width:120px;" /> </TD>
                        <TD> <INPUT type="text" class="form-control" id="igst1" name="igst[]"  style="width:80px;"/> </TD>
                        <TD> <INPUT type="text" class="form-control" id="igstamt1" name="igstamt[]"/> </TD>
                        <TD> <INPUT type="text" class="form-control" id="netamt1" name="netamt[]" style="width:120px;" /> </TD>
                        <TD> <INPUT type="hidden" class="form-control" id="cgst1" name="cgst[]"  style="width:80px;"/> </TD>
                        <TD> <INPUT type="hidden" class="form-control" id="cgstamt1" name="cgstamt[]"/> </TD>
                        <TD> <INPUT type="hidden" class="form-control" id="sgst1" name="sgst[]"  style="width:80px;"/> </TD>
                        <TD> <INPUT type="hidden" class="form-control" id="sgstamt1" name="sgstamt[]"/> </TD>
                        <TD> <INPUT type="hidden" class="form-control" id="product_num1" name="product_id_fk[]" style="width: 30px;" /> </TD>
                      </TR>
                  </table>
                  </div>
                 
                 
                  <!-------------------------------------------------------------------------------------------------->
                  <div class="panel-body" style="font-weight:bold;">
                    <br>
                    <table align="left" class="table table-bordered" style="box-shadow: 4px 3px 4px 3px #97989b;">
                      <tr>
                      <td>Old Balance<input type='text' id='sale_old_balance' class="form-control" name="sale_old_balance" value="0" style="background-color:white;text-align:right;width:250px;"/></td>
                      <td>Total Amount<input type='text' id='net_total' class="form-control" name="net_total" readonly style="background-color:white;text-align:right;width:250px;"/></td>
                      <td>Qty. Total<input type='text' id='qty_total' class="form-control" name="qty_total" readonly style="background-color:white;text-align:right;width:250px;"/></td>
                      
                      </tr>
                   
                      <tr>
                        <td>Discount Amount<input type="text" class="form-control" name="discount_prices" id="discount_prices" value="0" style="width:250px;text-align: right;font-weight: bold;background: white;" onkeyup="getdiscamount();" />
                        <td>Shareholder Discount Amount<input type="text" class="form-control" name="sale_shareholder_discount" id="sale_shareholder_discount" value="0" style="width:250px;text-align: right;font-weight: bold;background: white;" onkeyup="getsharediscamount();" />

                        <td>Received Amount<input type='text' id='pamount' class="form-control" name="pamount"  onkeyup="getamount();" style="background-color:white;text-align:right;width:250px;"/></td>

                        <td style="float:right;">Balance <input type='text' id='total_amt' class="form-control" name="total_amt" readonly style="background-color:white;text-align:right;width:250px;"/></td>
                      </tr>
                    </table>
                    <table align="left" class="table table-bordered" style="box-shadow: 4px 3px 4px 3px #97989b;">
                  
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
                  <!--  
                    <div class="NetTotalAmount pull-right" style="font-size:18px;">
                      <div class=" form-group pull-right">
                        <div class="col-md-12">
                          <label>Total Amount: &nbsp; </label>
                          <input type="text" class="form-control" name="total_amt1" id="total_amt1" value="" style="text-align: right;font-weight: bold;background: white;" />
                        </div><br>
                        <div class="col-md-12">
                          <label>Discount: &nbsp; </label>
                          <input type="text" class="form-control" name="discount_price" id="discount_price" value="" style="text-align: right;font-weight: bold;background: white;" onkeyup="getdiscamount();" />
                        </div><br>
                        <div class="col-md-12">
                          <label>Net Total: &nbsp; </label>
                          <input type="text" class="form-control" name="total_amt" id="total_amt" value="0" style="text-align: right;font-weight: bold;background: black;color:white;" />
                        </div><br>
                        <div class="col-md-12">
                          <label>Paid Amount: &nbsp; </label>
                          <input type="text" class="form-control" name="paid_amt" id="paid_amt" onkeyup="getamount();" value="0" style="text-align: right;font-weight: bold;" />
                        </div><br>
                        <div class="col-md-12">
                          <label>Balance : &nbsp; </label>
                          <input type="text" class="form-control" name="net_balance" id="net_balances" value="0" style="text-align: right;font-weight: bold;background: black;color:white;" />
                        </div>
                      </div>
                    </div> -->
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