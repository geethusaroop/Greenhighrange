<?php $arTax = array(""=>'---Please Select---',1=>'Yes',2=>'No') ?>
<!-- Content Wrapper. Contains page content -->
<style>
.democlass {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
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
      Purchase Details Form
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>Purchaseitem/"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Purchase Form</li>
    </ol>
  </section>
  <!-- Main content -->
  <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Purchaseitem/editReturnPurchase">
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-danger">
            <!-- /.box-header -->
            <!-- form start -->
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <!-- radio -->
            <div class="form-group">
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>PURCHASE FORM</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;background: #f5f5f5;">
                  <div class="form-group">
                    <div class="col-md-2">
                      <label>Bill Number</label>
                      <input type="text" data-pms-required="true"  id="purchase_invoice_number"  class="form-control" name="purchase_invoice_number" placeholder="Invoice Number" value="<?php if(isset($records[0]->invoice_number)){echo $records[0]->invoice_number;}else{echo rand(00000,99999);}  ?>" style="font-weight: bold;" disabled>
                      </div>
                      <div class="col-md-2">
                        <label>Ref.No(Internal Number)</label>
                        <input type="text" data-pms-required="true"  id="ref_number"  class="form-control" name="ref_number" placeholder="Reference Number" value="<?php if(isset($records[0]->ref_number)) echo $records[0]->ref_number ?>" style="font-weight: bold;" disabled>
                        </div>
                        <div class="col-md-2">
                          <label>Purchase Date: </label>
                          <input type="date" placeholder="Date" data-pms-required="true" class="form-control" name="purchase_date" value="<?php if(isset($records[0]->purchase_date)) { echo $records[0]->purchase_date;}  ?>" style="font-weight: bold;" disabled>
                          </div>
                          <div class="col-md-2">
                            <label>Date of receipt: </label>
                            <input type="text" placeholder="Date" data-pms-required="true" class="form-control" name="entry_date" value="<?php if(isset($records[0]->entry_date)) { echo $records[0]->entry_date;}else{echo date('d-m-Y');}  ?>" style="font-weight: bold;" disabled>
                            </div>
                            <div class="col-md-2">
                              <label>MOP</label>
                              <select name="purchase_mop" class="form-control" style="font-weight: bold;" disabled>
                                <option value="">-SELECT-</option>
                                <option <?php if(isset($records[0]->purchase_mop)) { if($records[0]->purchase_mop=="Cash"){echo "selected";}} ?> value="Cash">Cash</option>
                                <option <?php if(isset($records[0]->purchase_mop)) { if($records[0]->purchase_mop=="Credit"){echo "selected";}} ?> value="Credit">Credit</option>
                              </select>
                            </div>
                            <div class="col-md-2">
                              <label>TAX mode</label>
                              <select name="purchase_taxmode" class="form-control" style="font-weight: bold;" disabled>
                                <option value="">-SELECT-</option>
                                <option <?php if(isset($records[0]->purchase_taxmode)) { if($records[0]->purchase_taxmode=="GST"){echo "selected";}} ?> value="GST">GST</option>
                                <option <?php if(isset($records[0]->purchase_taxmode)) { if($records[0]->purchase_taxmode=="VAT"){echo "selected";}} ?> value="VAT">VAT</option>
                                <option <?php if(isset($records[0]->purchase_taxmode)) { if($records[0]->purchase_taxmode=="NONE"){echo "selected";}} ?> value="NONE">NONE</option>
                              </select>
                            </div>
                          </div>
                          <!--<h4><b>SUPPLIER DETAILS</b></h4>--->
                          <div class="form-group">
                            <div class="col-md-2" style="font-weight: bold;">
                              <label> Supplier Name <span style="color:red">*</span></label>
                              <input type="hidden" id="vendor_name" value="<?php if(isset($records[0]->vendor_name)) echo $records[0]->vendor_name; ?>" disabled/>
                              <select name="vendor_id" class="form-control" id="" disabled>
                                  <option value="">SELECT</option>
                                  <?php foreach($vendor_names as $vendor_namess){ ?>
                                  <option value="<?php echo $vendor_namess->vendor_id ?>" <?php if(isset($records[0]->vendor_id_fk) && $records[0]->vendor_id_fk==$vendor_namess->vendor_id) echo "selected"; ?>><?php echo $vendor_namess->vendorname ?></option>
                                  <?php } ?>
                              </select>
                              <!-- <button type="button" class="btn btn-default" name="button"><a href="<?php echo base_url();?>Vendor_master/">Add new supplier</a></button> -->
                              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mySupplier">Add New Vendor</button>
                            </div>
                            <div class="col-md-2">
                              <label>State Type</label>
                              <input type="text" data-pms-required="true" id="vendor_statetype" class="form-control" name="vendor_statetype" placeholder="State Type" value="<?php if(isset($records[0]->vendor_statetype)) echo $records[0]->vendor_statetype ?>" style="font-weight: bold;" disabled>
                              </div>
                              <div class="col-md-2">
                                <label>Place Of Sale</label>
                                <input type="text" data-pms-required="true" id="vendorstate" class="form-control" name="vendorstate" placeholder="State with TIN" value="<?php if(isset($records[0]->vendorstate)) echo $records[0]->vendorstate ?>" style="font-weight: bold;" disabled>
                                </div>
                                <div class="col-md-2">
                                  <label>GSTIN No.</label>
                                  <input type="text" data-pms-required="true" id="vendorgst" class="form-control" name="vendorgst" placeholder="GST Number" value="<?php if(isset($records[0]->vendorgst)) echo $records[0]->vendorgst ?>" style="font-weight: bold;" disabled>
                                  </div>
                                  <div class="col-md-2">
                                    <label>Tax Type</label>
                                    <input type="text" data-pms-required="true" id="vendor_gsttype" class="form-control" name="vendor_gsttype" placeholder="Tax Type" value="<?php if(isset($records[0]->vendor_gsttype)) echo $records[0]->vendor_gsttype ?>" style="font-weight: bold;" disabled>
                                    </div>
                                  </div>
                                  <br><br>
                                  <!-- <h4><b>PURCHASE ITEMS</b></h4>-->
                                  <!-- <button type="submit" class="btn btn-primary" value="Add Row" onClick="addRow('dataTable')">Add</button>
                                  <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTable')">Delete</button> -->
                                  <br> <br>
                                  <div class="table-responsive">
                                  <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:ridge;background: #5c5656;color:white;">
                                    <thead>
                                      <tr>
                                        <th style="border:ridge;" width="20" class="col-small center style2 style3"> </th>
                                        <th style="border:ridge;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:ridge;" width="45">Item Name</th>
                                        <th style="border:ridge;" width="45">HSNCODE</th>
                                        <th style="border:ridge;" width="72">Qty</th>
                                        <th style="border:ridge;" width="72">Return Qty</th>
                                        <th style="border:ridge;" width="72">Unit</th>
                                        <th style="border:ridge;" width="69">PRate</th>
                                        <th style="border:ridge;" width="46">MRP</th>
                                        <th style="border:ridge;" width="46">Discount.% </th>
                                        <th style="border:ridge;" width="49">Amount</th>
                                        <th style="border:ridge;" width="40">Taxable_Amount </th>
                                        <th style="border:ridge;" width="49">CGST.%</th>
                                        <th style="border:ridge;" width="49">CGST_Amount</th>
                                        <th style="border:ridge;" width="49">SGST.%</th>
                                        <th style="border:ridge;" width="49">SGST_Amount</th>
                                        <th style="border:ridge;" width="49">IGST.%</th>
                                        <th style="border:ridge;" width="49">IGST_Amount</th>
                                        <th style="border:ridge;" width="49">NetAmount</th>
                                      </tr>
                                    </thead>
                                    <tbody  style="background: #b3b384;">
                                    <?php foreach($records as $recod){ ?>
                                      <TR style="border:ridge;background: #b3b384;">
                                        <TD><INPUT type="checkbox" name="chk[]"/></TD>
                                        <TD> 1 <input type="hidden" name="purchase_id[]" value="<?php if(isset($recod->purchase_id)) echo $recod->purchase_id ?>"><input type="hidden" name="total_price[]" value="<?php if(isset($recod->total_price)) echo $recod->total_price ?>"></TD>
                                        <TD> <select name="product_id_fk[]" id="product_num1" style="width:180px;" class="form-control" onchange="gethsncode(this);" readonly="readonly">
                                          <option value="" selected="selected">--SELECT--</option>
                                          <?php $i = 1;
                                          foreach ($product_names as $w)
                                          {
                                            ?><option value="<?php echo $w->product_id;?>" <?php if(isset($recod->product_id_fk) && $recod->product_id_fk==$w->product_id) echo "selected"; ?>><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>          </select> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="purchase_hsn[]" id="purchase_hsn<?php echo $i ?>" value="<?php if(isset($recod->purchase_hsn)) echo $recod->purchase_hsn ?>" style="width:100px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="purchase_quantity[]" id="pquantity_<?php echo $i ?>" value="<?php if(isset($recod->purchase_quantity)) echo $recod->purchase_quantity ?>" style="width:80px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="return_quantity[]" id="returnquantity_<?php echo $i ?>" data-id="<?php echo $i ?>" onkeyup="validate_return(this)" value="<?php if(isset($recod->purchase_return)) echo $recod->purchase_return ?>" style="width:80px;"> </TD>
                                          <TD><select name="purchase_unit[]" class="form-control" id="p_unit1"  style="width:100px;" placeholder="Unit" disabled>
                                            <option value="">--SELECT--</option>
                                            <?php foreach($product_unit as $ut){ ?>
                                              <option value="<?php echo $ut->unit_id ?>" <?php if(isset($recod->purchase_unit_fk) && $recod->purchase_unit_fk==$ut->unit_id) echo "selected"; ?>><?php echo $ut->unit_name ?></option>
                                            <?php } ?>  
                                          </select></TD>
                                          <TD> <INPUT type="text" class="form-control" id="rate<?php echo $i ?>" value="<?php if(isset($recod->purchase_price)) echo $recod->purchase_price ?>" name="rate[]"   style="width:80px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="mrp<?php echo $i ?>" value="<?php if(isset($recod->purchase_mrp)) echo $recod->purchase_mrp ?>" name="mrp[]"  style="width:80px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="discount_<?php echo $i ?>" value="<?php if(isset($recod->discount_price)) echo $recod->discount_price ?>" name="discount_price[]"  style="width:80px;" onKeyUp="gettotal(this)" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" name="tamount[]" value="<?php if(isset($recod->purchase_price)) echo $recod->purchase_quantity ?>" id="tamount1"  style="width:80px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="taxamount<?php echo $i ?>" value="<?php if(isset($recod->taxamount)) echo $recod->taxamount ?>" name="taxamount[]" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="cgst<?php echo $i ?>" value="<?php if(isset($recod->purchase_cgst)) echo $recod->purchase_cgst ?>" name="cgst[]"  style="width:80px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="cgstamt<?php echo $i ?>" value="<?php if(isset($recod->purchase_cgstamt)) echo $recod->purchase_cgstamt ?>" name="cgstamt[]" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="sgst<?php echo $i ?>" value="<?php if(isset($recod->purchase_sgst)) echo $recod->purchase_sgst ?>" name="sgst[]"  style="width:80px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="sgstamt<?php echo $i ?>" value="<?php if(isset($recod->purchase_sgstamt)) echo $recod->purchase_sgstamt ?>" name="sgstamt[]" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="igst<?php echo $i ?>" value="<?php if(isset($recod->purchase_igst)) echo $recod->purchase_igst ?>" name="igst[]"  style="width:80px;" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="igstamt<?php echo $i ?>" value="<?php if(isset($recod->purchase_igstamt)) echo $recod->purchase_igstamt ?>" name="igstamt[]" readonly="readonly"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="netamt<?php echo $i ?>" value="<?php if(isset($recod->purchase_netamt)) echo $recod->purchase_netamt ?>" name="netamt[]" readonly="readonly"/> </TD>
                                        </TR>
                                        <?php $i++; } ?>
                                      </table>
                                      </div>
                                    </table>
                                    <br><br>
                                    <!-------------------------------------------------------------------------------------------------->
                                    <div class="panel-body" style="font-weight:bold;">
                                      <br>
                                      <!-- <table style="width:35%" align="left" class="table table-bordered">
                                        <tr>
                                          <td  >Gross Amount<input type='text' id='gross_amt' class="form-control" name="gross_amt" /></td>
                                          <td >Taxable Amount<input type='text' id='taxamounts' class="form-control" name="taxamounts" /></td>
                                          <td >Purchase Tax<input type='text' id='ptax' name="ptax" class="form-control"/> </td>
                                        </tr>
                                        <tr>
                                          <td >Purchase Amount<input type='text' id='pamount' class="form-control" name="pamount"/></td>
                                          <td width=>Qty. Total<input type='text' id='qty_total' class="form-control" name="qty_total" /></td>
                                          <td > Net Total<input type='text' id='net_total' class="form-control" name="net_total" /></td>
                                        </tr>
                                        <tr>
                                          <td >Old Balance<input type='text' id='old_bal_' class="form-control" name="old_bal"/></td>
                                        </tr>
                                      </table> -->
                                      <!--   <h4><b>TOTAL BILL DETAILS</b></h4> -->
                                      <br>       <br>                   <br>                   <br>            <br>                   <br>                   <br>
                                      <div class="NetTotalAmount pull-right" style="font-size:18px;">
                                        <div class=" form-group pull-right" >
                                          <div class="col-md-12">
                                            <label>Paid Amount: &nbsp; </label>
                                            <input type="text" class="form-control" name="paid_amt" id="paid_amt" onkeyup="getamount();" value="<?php if(isset($recod->pur_paid_amt)) echo $recod->pur_paid_amt ?>" style="text-align: right;font-weight: bold;" />
                                          <!-- </div><br>
                                          <div class="col-md-12">
                                            <label>Total Amount: &nbsp; </label>
                                            <input type="text" class="form-control" name="total_amt" id="total_amt" value="0" style="text-align: right;font-weight: bold;background: black;color:white;" />
                                          </div><br>
                                          <div class="col-md-12">
                                            <label>New Balance : &nbsp; </label>
                                            <input type="text" class="form-control" name="net_balance" id="net_balances" value="0" style="text-align: right;font-weight: bold;background: black;color:white;" />
                                          </div> -->
                                        </div>
                                      </div><!--first panel-->
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
                                      <button type="submit" class="btn btn-primary" >Save</button>
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

                        <!--New Supplier Modal -->
                      <div id="mySupplier" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Add Vendor</h4>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="<?php echo base_url(); ?>Purchaseitem/addVendor">
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="vendor_name">Vendor Name</label>
                                    <input type="text" name="vendor_name" class="form-control" id="vendor_name" placeholder="Enter Vendor Name">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="vendor_name">Vendor Address</label>
                                    <textarea name="vendor_address" class="form-control" id="" placeholder="Enter Vendor Address"></textarea>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="vendor_name">Phone Number</label>
                                    <input type="text" name="vendor_phone_number" class="form-control" id="vendor_name" placeholder="Enter Vendor Phone Number">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="vendor_name">Email ID</label>
                                    <input type="text" name="vendor_email" class="form-control" id="vendor_name" placeholder="Enter Vendor Email ID">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="vendor_name">GST NO</label>
                                    <input type="text" name="vendor_gst" class="form-control" id="vendor_name" placeholder="Enter Vendor GST NO">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="vendor_name">OLD BALANCE</label>
                                    <input type="text" name="vendor_old_bal" class="form-control" id="vendor_name" placeholder="Enter Vendor OLD BALANCE">
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary">SAVE</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                      <!-- New Supplier End -->