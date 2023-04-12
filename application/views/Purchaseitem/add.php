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
  <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Purchaseitem/add">
    <section class="content">
      <div class="row">
        <!-- right column -->
        <!-- <div class="col-md-12"> -->
          <!-- Horizontal Form -->
          <div class="box">
            <!-- /.box-header -->
            <!-- form start -->
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <!-- radio -->
            <div class="form-group">
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
              <div class="panel panel-danger" style="margin-top:-20px;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>PURCHASE FORM</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                </div>
                <div class="panel-body" style="font-weight:bold;background: #f5f5f5;">
                  <div class="form-group">
                    <div class="col-md-2">
                      <label>Bill Number</label>
                      <input type="text" data-pms-required="true"  id="purchase_invoice_number"  class="form-control" name="purchase_invoice_number" placeholder="Invoice Number" value="<?php if(isset($records->invoice_number)){echo $records->invoice_number;}else{echo rand(00000,99999);}  ?>" style="font-weight: bold;">
                      </div>
                      <div class="col-md-2">
                        <label>Ref.No(Internal Number)</label>
                        <input type="text" data-pms-required="true"  id="ref_number"  class="form-control" name="ref_number" placeholder="Reference Number" value="<?php if(isset($records->ref_number)) echo $records->ref_number ?>" style="font-weight: bold;">
                        </div>
                        <div class="col-md-2">
                          <label>Purchase Date: </label>
                          <input type="date" placeholder="Date" data-pms-required="true" class="form-control" name="purchase_date" value="<?php if(isset($records->purchase_date)) { echo $records->purchase_date;}  ?>" style="font-weight: bold;">
                          </div>
                          <div class="col-md-2">
                            <label>Date of receipt: </label>
                            <input type="text" placeholder="Date" data-pms-required="true" class="form-control" name="entry_date" value="<?php if(isset($records->entry_date)) { echo $records->entry_date;}else{echo date('d-m-Y');}  ?>" style="font-weight: bold;">
                            </div>
                            <div class="col-md-2">
                              <label>MOP</label>
                              <select name="purchase_mop" class="form-control" style="font-weight: bold;">
                                <option value="">-SELECT-</option>
                                <option <?php if(isset($records->purchase_mop)) { if($records->purchase_mop=="Cash"){echo "selected";}} ?> value="Cash">CASH</option>
                                <option <?php if(isset($records->purchase_mop)) { if($records->purchase_mop=="Bank"){echo "selected";}} ?> value="Bank">BANK</option>
                                <option <?php if(isset($records->purchase_mop)) { if($records->purchase_mop=="Credit"){echo "selected";}} ?> value="Credit">CREDIT</option>
                              </select>
                            </div>
                            <div class="col-md-2">
                              <label>TAX mode</label>
                              <select name="purchase_taxmode" class="form-control" style="font-weight: bold;">
                                <option value="">-SELECT-</option>
                                <option <?php if(isset($records->purchase_taxmode)) { if($records->purchase_taxmode=="GST"){echo "selected";}} ?> value="GST">GST</option>
                                <option <?php if(isset($records->purchase_taxmode)) { if($records->purchase_taxmode=="VAT"){echo "selected";}} ?> value="VAT">VAT</option>
                                <option <?php if(isset($records->purchase_taxmode)) { if($records->purchase_taxmode=="NONE"){echo "selected";}} ?> value="NONE">NONE</option>
                              </select>
                            </div>
                          </div>
                          <!--<h4><b>SUPPLIER DETAILS</b></h4>--->
                          <div class="form-group">
                            <div class="col-md-2" style="font-weight: bold;">
                              <label> Supplier Name <span style="color:red">*</span></label>
                              <input type="hidden" id="vendor_name" value="<?php if(isset($records->vendor_name)) echo $records->vendor_name; ?>"/>
                              <?php echo form_dropdown('vendor_id', $vendor_names,'', 'id="vendor_id_fk" class="form-control select2"  data-pms-required="true" data-pms-type="dropDown"', 'name="vendor_id"');?>
                              <!-- <button type="button" class="btn btn-default" name="button"><a href="<?php echo base_url();?>Vendor_master/">Add new supplier</a></button> -->
                              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mySupplier">Add New Vendor</button>
                            </div>
                            <div class="col-md-2">
                              <label>State Type</label>
                              <input type="text" id="vendor_statetype" class="form-control" name="vendor_statetype" placeholder="State Type" value="<?php if(isset($records->vendor_statetype)) echo $records->vendor_statetype ?>" style="font-weight: bold;">
                              </div>
                              <div class="col-md-2">
                                <label>Place Of Sale</label>
                                <input type="text" id="vendorstate" class="form-control" name="vendorstate" placeholder="State with TIN" value="<?php if(isset($records->vendorstate)) echo $records->vendorstate ?>" style="font-weight: bold;">
                                </div>
                                <div class="col-md-2">
                                  <label>GSTIN No.</label>
                                  <input type="text" id="vendorgst" class="form-control" name="vendorgst" placeholder="GST Number" value="<?php if(isset($records->vendorgst)) echo $records->vendorgst ?>" style="font-weight: bold;">
                                  </div>
                                  <div class="col-md-2">
                                    <label>Tax Type</label>
                                    <input type="text" id="vendor_gsttype" class="form-control" name="vendor_gsttype" placeholder="Tax Type" value="<?php if(isset($records->vendor_gsttype)) echo $records->vendor_gsttype ?>" style="font-weight: bold;">
                                    </div>
                                  </div>
                                  <br><br>
                                  <!-- <h4><b>PURCHASE ITEMS</b></h4>-->
                                  <button type="submit" class="btn btn-primary" value="Add Row" onClick="addRow('dataTable')">Add</button>
                                  <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTable')">Delete</button>
<!--                                   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myItems">Add Item</button>
 -->                                  <br> <br>
                                  <div class="table-responsive">
                                  <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:1px solid #ccc;color:black;">
                                    <thead>
                                      <tr style="background: black;color: white;text-transform: uppercase;">
                                        <th style="border:1px solid #ccc;" width="20" class="col-small center style2 style3"> </th>
                                        <th style="border:1px solid #ccc;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:1px solid #ccc;" width="45">Item Name</th>
                                        <th style="border:1px solid #ccc;" width="45">HSNCODE</th>
                                        <th style="border:1px solid #ccc;" width="72">Qty</th>
                                        <th style="border:1px solid #ccc;" width="72">Unit</th>
                                        <th style="border:1px solid #ccc;" width="69">PRate</th>
                                        <th style="border:1px solid #ccc;" width="46">MRP</th>
                                        <th style="border:1px solid #ccc;" width="46">SPrice(R1)</th>
                                        <th style="border:1px solid #ccc;" width="46">SPrice(R2)</th>
                                        <th style="border:1px solid #ccc;" width="46">SPrice(R3)</th>
                                        <th style="border:1px solid #ccc;" width="46">Discount.% </th>
                                        <th style="border:1px solid #ccc;" width="49">Amount</th>
                                        <th style="border:1px solid #ccc;" width="40">Taxable_Amount </th>
                                        <th style="border:1px solid #ccc;" width="49">CGST.%</th>
                                        <th style="border:1px solid #ccc;" width="49">CGST_Amount</th>
                                        <th style="border:1px solid #ccc;" width="49">SGST.%</th>
                                        <th style="border:1px solid #ccc;" width="49">SGST_Amount</th>
                                        <th style="border:1px solid #ccc;" width="49">IGST.%</th>
                                        <th style="border:1px solid #ccc;" width="49">IGST_Amount</th>
                                        <th style="border:1px solid #ccc;" width="49">NetAmount</th>
                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD><INPUT type="checkbox" name="chk[]"/></TD>
                                        <TD style="color:black;"> 1 </TD>
                                        <TD> <select name="product_id_fk[]" id="product_num1" style="width:180px;" class="form-control select2" onchange="gethsncode(this);">
                                          <option value="" selected="selected">--SELECT--</option>
                                          <?php
                                          foreach ($product_names as $w)
                                          {
                                            ?><option value="<?php echo $w->product_id;?>"><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>          </select> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="purchase_hsn[]" id="purchase_hsn1" style="width:100px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="purchase_quantity[]" id="pquantity_1" style="width:80px;" required/> </TD>
                                          <TD><select name="purchase_unit[]" class="form-control" id="p_unit1" style="width:100px;" placeholder="Unit">
                                            <option value="">--SELECT--</option>
                                            <?php foreach($product_unit as $ut){ ?>
                                              <option value="<?php echo $ut->unit_id ?>"><?php echo $ut->unit_name ?></option>
                                            <?php } ?>
                                          </select></TD>
                                          <TD> <INPUT type="text" class="form-control" id="rate1" name="rate[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="mrp1" name="mrp[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="r1_1" name="r1[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="r2_1" name="r2[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="r3_1" name="r3[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="discount_1" name="discount_price[]"  style="width:80px;" onKeyUp="gettotal(this)"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" name="tamount[]" id="tamount1"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="taxamount1" name="taxamount[]"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="cgst1" name="cgst[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="cgstamt1" name="cgstamt[]"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="sgst1" name="sgst[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="sgstamt1" name="sgstamt[]"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="igst1" name="igst[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="igstamt1" name="igstamt[]"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="netamt1" name="netamt[]"/> </TD>
                                        </TR>
                                      </table>
                                      </div>
                                    </table>
                                    <br><br>
                                    <!-------------------------------------------------------------------------------------------------->
                                    <div class="panel-body" style="font-weight:bold;">
                                      <br>
                                      <table style="width:30%" align="left" class="table table-bordered">
                                        <tr>
                                          <td>Gross Amount<input type='text' id='gross_amt' class="form-control" name="gross_amt" /></td>
                                          <td>Taxable Amount<input type='text' id='taxamounts' class="form-control" name="taxamounts" /></td>
                                          <td>Purchase Tax<input type='text' id='ptax' name="ptax" class="form-control"/> </td>
                                        </tr>
                                        <tr style="width:30%" align="left" class="table table-bordered">
                                          <td>Purchase Amount<input type='text' id='pamount' class="form-control" name="pamount"/></td>
                                          <td>Qty. Total<input type='text' id='qty_total' class="form-control" name="qty_total" /></td>
                                          <td> Net Total<input type='text' id='net_total' class="form-control" name="net_total" /></td>
                                        </tr>
                                        <tr style="width:30%" align="left" class="table table-bordered">
                                          <td >Old Balance<input type='text' id='old_bal_' class="form-control" value="0" name="old_bal"/></td>
                                        </tr>
                                      </table>
                                      <!--   <h4><b>TOTAL BILL DETAILS</b></h4> -->
                                      <div class="NetTotalAmount pull-right" style="font-size:18px;">
                                        <div class=" form-group pull-right" >
                                          <div class="col-md-12">
                                            <label>Paid Amount: &nbsp; </label>
                                            <input type="text" class="form-control" name="paid_amt" id="paid_amt" onkeyup="getamount();" value="" required style="text-align: right;font-weight: bold;" />
                                          </div><br>
                                          <div class="col-md-12">
                                            <label>Total Amount: &nbsp; </label>
                                            <input type="text" class="form-control" name="total_amt" id="total_amt" value="0" style="text-align: right;font-weight: bold;background: black;color:white;" />
                                          </div><br>
                                          <div class="col-md-12">
                                            <label>New Balance : &nbsp; </label>
                                            <input type="text" class="form-control" name="net_balance" id="net_balances" value="0" style="text-align: right;font-weight: bold;background: black;color:white;" />
                                          </div>
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
                                    <a href="<?php echo base_url(); ?>Purchaseitem"  <button type="button" class="btn btn-danger">Cancel</button></a>
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
                              <h3 class="modal-title">Add Vendor</h3>
                            </div>
                            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Purchaseitem/addVendor">
                            <div class="modal-body">

                            <div class="form-group">
                                <div class="col-md-12">
                                  <label for="vendor_name">Vendor Name</label>
                                  <input type="text" name="vendor_name" class="form-control" id="vendor_name" placeholder="Enter Vendor Name">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-md-12">
                                  <label for="vendor_name">Vendor Address</label>
                                  <textarea name="vendor_address" class="form-control" id="" placeholder="Enter Vendor Address"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-md-6">
                                  <label for="vendor_name">Phone Number</label>
                                  <input type="text" name="vendor_phone_number" class="form-control" id="vendor_name" placeholder="Enter Vendor Phone Number">
                                </div>

                                <div class="col-md-6">
                                  <label for="vendor_name">Email ID</label>
                                  <input type="text" name="vendor_email" class="form-control" id="vendor_name" placeholder="Enter Vendor Email ID">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-md-12">
                                  <label>State</label>
                                    <select name="vendorstate" class="form-control">
                                      <option value="">-SELECT-</option>
                                      <?php foreach($state as $st){?>
                                      <option <?php if(isset($records->vendorstate)) {if($records->vendorstate==$st->state_name."-"." ".$st->state_gst_code){echo "selected";}}  ?> value="<?php echo $st->state_name."-"." ".$st->state_gst_code; ?>"><?php echo $st->state_name."-"." ".$st->state_gst_code; ?></option>
                                    <?php } ?>
                                      
                                    </select>
                              </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-12">
                            <label>State Type</label>
                            <select name="vendor_statetype" class="form-control">
                              <option value="">-SELECT-</option>
                              <option <?php if(isset($records->vendor_statetype)) {if($records->vendor_statetype=="INTRA STATE"){echo "selected";}}  ?> value="INTRA STATE">INTRA STATE</option>
                                <option <?php if(isset($records->vendor_statetype)) {if($records->vendor_statetype=="INTER STATE"){echo "selected";}}  ?> value="INTER STATE">INTER STATE</option>
                        
                            </select>
                              </div>
                            </div>
                              <div class="form-group">
                                        <div class="col-md-12">
                                          <label>GST</label>
                                      <input type="text"  class="form-control" name="vendor_gst" id="vendor_gst"  value="<?php if(isset($records->vendorgst)) echo $records->vendorgst ?>">
                                      </div>
                              </div>
                                  <div class="form-group">
                                <div class="col-md-12">
                                    <label>Tax Type</label>
                                    <select name="vendor_gsttype" class="form-control">
                                      <option value="">-SELECT-</option>
                                      <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2B"){echo "selected";}}  ?> value="GSTR1 B2B">GSTR1 B2B</option>
                                        <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2CL"){echo "selected";}}  ?> value="GSTR1 B2CL">GSTR1 B2CL</option>
                                          <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2CS"){echo "selected";}}  ?> value="GSTR1 B2CS">GSTR1 B2CS</option>
                                            <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2BA"){echo "selected";}}  ?> value="GSTR1 B2BA">GSTR1 B2BA</option>
                                              <option <?php if(isset($records->vendor_gsttype)) {if($records->vendor_gsttype=="GSTR1 B2CLA"){echo "selected";}}  ?> value="GSTR1 B2CLA">GSTR1 B2CLA</option>
                                    </select>
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
                      </div>
                      <!-- Items -->
<!-- Modal -->
<div id="myItems" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Items</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url(); ?>Purchaseitem/addItem">
        <div class="form-group row">
               <div class="col-md-6">
                 <label class="fsize">Product Type <span style="color:red"> *</span></label>
                 <select name="product_type"  id="product_type" class="form-control" style="font-weight: bold;" onChange="getsubcat();">
                   <option value="">-SELECT-</option>
                    <?php foreach($category as $categories){ ?>
                     <option value="<?php echo $categories->prod_cat_id ?>"<?php if(isset($records->product_type)) { if($records->product_type==$categories->prod_cat_id){ echo "selected"; } } ?>><?php echo $categories->prod_cat_name ?></option>
                    <?php } ?>
                 </select>
               </div>
               <div class="col-md-6">
                 <label class="fsize">Sub category <span style="color:red"> *</span></label>
                 <select name="subcategory"  id="subcat" class="form-control" style="font-weight: bold;" onChange="getsubcat();">
                   <option value="">-SELECT-</option>
                    <?php foreach($subcategories as $item){ ?>
                     <option value="<?php echo $item->subcat_id ?>"<?php if(isset($records->product_sub_type)) { if($records->product_sub_type==$item->subcat_id){ echo "selected"; } } ?>><?php echo $item->subcat_name ?></option>
                    <?php } ?>
                 </select>
               </div>
               </div>
               <div class="form-group row">
                   <div class="col-md-6">
                       <label for="">Product Code</label>
                       <input type="text" class="form-control" name="prod_code" style="text-transform:uppercase" data-pms-required="true" autofocus value="<?php if(isset($records->product_code)) echo $records->product_code ?>">
                    </div>
               </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label class="fsize">Product Name <span style="color:red"> *</span></label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_name"  value="<?php if(isset($records->product_name)) echo $records->product_name ?>">
                </div>
                <div class="col-md-6">
                  <label class="fsize">Product Unit <span style="color:red"> *</span></label>
                  <select name="product_unit" class="form-control">
                    <option value="">-SELECT UNIT-</option>
                   <?php foreach($unit as $un){ ?>
                    <option <?php if(isset($records->product_unit)){if($records->product_unit==$un->unit_id){echo "selected";}} ?> value="<?php  echo  $un->unit_id;?>"><?php  echo  $un->unit_name;?></option>
                   <?php } ?>
                  </select>
                </div>
              </div><br>
               <div class="form-group row">
                  <div class="col-md-6">
                    <label>HSN Code Description</label>
                     <select name="product_hsn" class="form-control" id="product_hsn">
                    <option value="">-SELECT-</option>
                    <?php foreach($hsncode as $hsn){ ?>
                    <option <?php if(isset($records->product_hsn)){if($records->product_hsn==$hsn->hsn_id){echo "selected";}} ?> value="<?php echo $hsn->hsn_id; ?>"><?php echo $hsn->description; ?></option>
                  <?php } ?>
                    </select>
                  </div>
                   <div class="col-md-6">
                      <label>HSNCode</label>
                    <input type="text" readonly autofocus class="form-control" name="product_hsncode"  id="product_hsncode" value="<?php if(isset($records->product_hsncode)) echo $records->product_hsncode ?>" style="font-weight: bold; text-transform: uppercase;color:red;background: white;">
                  </div>
              </div>
              <br>
              <div class="form-group row">
                <div class="col-md-6">
                  <label class="fsize">Opening Stock <span style="color:red"> *</span></label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_open_stock"  value="<?php if(isset($records->product_open_stock)) echo $records->product_open_stock ?>">
                </div>
                <div class="col-md-6">
                  <label class="fsize">Minimum Stock</label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="min_stock"  value="<?php if(isset($records->min_stock)) echo $records->min_stock ?>">
                </div>
              </div>
               <div class="form-group row">
                <div class="col-md-12">
                  <label class="fsize">Description</label>
                 <textarea class="form-control" name="product_des" rows="3"><?php if(isset($records->product_des)) echo $records->product_des ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <center><button type="submit" class="btn btn-success">SAVE</button></center>
                </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Items -->
                      <!-- New Supplier End -->
