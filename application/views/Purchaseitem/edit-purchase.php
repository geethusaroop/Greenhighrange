<?php $arTax = array("" => '---Please Select---', 1 => 'Yes', 2 => 'No') ?>
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
    <section class="content-header">
        <h1>
            Update Purchase Details Form
            <small id="date" class="col-md-4"></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>Purchaseitem/"><i class="fa fa-dashboard"></i> Back to List</a></li>
            <li class="active"> Update Purchase Form</li>
        </ol>
    </section>
    <!-- Main content -->
    <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Purchaseitem/edit">
        <section class="content">
            <div class="row">
                <div class="box">
                    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
                    <div class="form-group">
                        <?php echo validation_errors(); ?>
                        <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    </div>
                    <div class="box-body">
                        <div class="panel panel-danger" style="margin-top:-20px;">
                            <div class="panel-heading">
                                <h3 class="panel-title"><b>UPDATE PURCHASE FORM</b> <span style="float: right;font-weight: bold;">Date : <?php echo date('d-m-Y'); ?></span></h3>
                            </div>
                            <div class="panel-body" style="font-weight:bold;background: #f5f5f5;">
                                <div class="form-group">
                                    <input type="hidden" name="auto_inv" value="<?php if (isset($records[0]->auto_invoice)) echo $records[0]->auto_invoice ?>">
                                    <div class="col-md-2">
                                        <label>Bill Number</label>
                                        <input type="text" data-pms-required="true" id="purchase_invoice_number" class="form-control" name="purchase_invoice_number" placeholder="Invoice Number" value="<?php if (isset($records[0]->invoice_number)) {echo $records[0]->invoice_number;} else {echo rand(00000, 99999);}  ?>" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Ref.No(Internal Number)</label>
                                        <input type="text" data-pms-required="true" id="ref_number" class="form-control" name="ref_number" placeholder="Reference Number" value="<?php if (isset($records[0]->ref_number)) echo $records[0]->ref_number ?>" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Purchase Date: </label>
                                        <input type="date" placeholder="Date" data-pms-required="true" class="form-control" name="purchase_date" value="<?php if (isset($records[0]->purchase_date)) {echo $records[0]->purchase_date;}  ?>" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Date of receipt: </label>
                                        <input type="text" placeholder="Date" data-pms-required="true" class="form-control" name="entry_date" value="<?php if (isset($records[0]->entry_date)) {echo $records[0]->entry_date;} else {echo date('d-m-Y');}  ?>" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2">
                                        <label>MOP</label>
                                        <select name="purchase_mop" class="form-control" style="font-weight: bold;">
                                            <option value="">-SELECT-</option>
                                            <option <?php if (isset($records[0]->purchase_mop)) {if ($records[0]->purchase_mop == "Cash") {echo "selected";}} ?> value="Cash">CASH</option>
                                            <option <?php if (isset($records[0]->purchase_mop)) {if ($records[0]->purchase_mop == "Bank") {echo "selected";}} ?> value="Bank">BANK</option>
                                            <option <?php if (isset($records[0]->purchase_mop)) {if ($records[0]->purchase_mop == "Credit") {echo "selected";}} ?> value="Credit">CREDIT</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>TAX mode</label>
                                        <select name="purchase_taxmode" class="form-control" style="font-weight: bold;">
                                            <option value="">-SELECT-</option>
                                            <option <?php if (isset($records[0]->purchase_taxmode)) {if ($records[0]->purchase_taxmode == "GST") {echo "selected";}} ?> value="GST">GST</option>
                                            <option <?php if (isset($records[0]->purchase_taxmode)) {if ($records[0]->purchase_taxmode == "VAT") {echo "selected";}} ?> value="VAT">VAT</option>
                                            <option <?php if (isset($records[0]->purchase_taxmode)) {if ($records[0]->purchase_taxmode == "NONE") {echo "selected";}} ?> value="NONE">NONE</option>
                                        </select>
                                    </div>
                                </div>
                                <!--<h4><b>SUPPLIER DETAILS</b></h4>--->
                                <div class="form-group">
                                    <div class="col-md-2" style="font-weight: bold;">
                                        <label> Supplier Name <span style="color:red">*</span></label>
                                        <select class="form-control" name="vendor_id" id="">
                                            <option value="">SELECT</option>
                                            <?php foreach ($vendor_names as $vn) { ?>
                                                <option <?php echo (isset($records[0]->vendor_id) && $records[0]->vendor_id == $vn->vendor_id) ? "selected" : ""; ?> value="<?php echo $vn->vendor_id ?>"><?php echo $vn->vendorname ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mySupplier">Add New Vendor</button>
                                    </div>
                                    <div class="col-md-2">
                                        <label>State Type</label>
                                        <input type="text" data-pms-required="true" id="vendor_statetype" class="form-control" name="vendor_statetype" placeholder="State Type" value="<?php if (isset($records[0]->vendor_statetype)) echo $records[0]->vendor_statetype ?>" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Place Of Sale</label>
                                        <input type="text" data-pms-required="true" id="vendorstate" class="form-control" name="vendorstate" placeholder="State with TIN" value="<?php if (isset($records[0]->vendorstate)) echo $records[0]->vendorstate ?>" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2">
                                        <label>GSTIN No.</label>
                                        <input type="text" data-pms-required="true" id="vendorgst" class="form-control" name="vendorgst" placeholder="GST Number" value="<?php if (isset($records[0]->vendorgst)) echo $records[0]->vendorgst ?>" style="font-weight: bold;">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Tax Type</label>
                                        <input type="text" data-pms-required="true" id="vendor_gsttype" class="form-control" name="vendor_gsttype" placeholder="Tax Type" value="<?php if (isset($records[0]->vendor_gsttype)) echo $records[0]->vendor_gsttype ?>" style="font-weight: bold;">
                                    </div>
                                </div>
                                <br><br>
                                <!-- <h4><b>PURCHASE ITEMS</b></h4>-->
                                <button type="submit" class="btn btn-primary" value="Add Row" onClick="addRow('dataTable')">Add</button>
                                <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTable')">Delete</button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myItems">Add Item</button>
                                <br> <br>
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
                                        <tbody style="background: #ffff;">
                                            <?php
                                            $gross_amt = 0;
                                            $sum_igstamt = 0;
                                            $tot_qty = 0;
                                            $new_bal = 0;
                                            foreach ($records as $rd) { ?>
                                                <TR style="border:1px solid #ccc;background: #ffff;">
                                                    <TD><INPUT type="checkbox" name="chk[]" /></TD>
                                                    <TD style="color:black;"> 1 </TD>
                                                    <TD> <select name="product_id_fk[]" id="product_num1" style="width:180px;" class="form-control select2" onchange="gethsncode(this);">
                                                            <option value="" selected="selected">--SELECT--</option>
                                                            <?php foreach ($product_names as $w) { ?>
                                                                <option <?php echo ($rd->product_id == $w->product_id) ? "selected" : ""; ?> value="<?php echo $w->product_id; ?>"><?php echo $w->product_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </TD>
                                                    <TD> <INPUT type="text" class="form-control" name="purchase_hsn[]" id="purchase_hsn1" style="width:100px;" value="<?php echo $rd->purchase_hsn ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" name="purchase_quantity[]" id="pquantity_1" style="width:80px;" value="<?php $tot_qty += $rd->purchase_quantity;
                                                                                                                                                                        echo $rd->purchase_quantity ?>" required /> </TD>
                                                    <TD><select name="purchase_unit[]" class="form-control" id="p_unit1" style="width:100px;" placeholder="Unit">
                                                            <option value="">--SELECT--</option>
                                                            <?php
                                                            foreach ($product_unit as $ut) { ?>
                                                                <option <?php echo ($rd->purchase_unit_fk == $ut->unit_id) ? "selected" : ""; ?> value="<?php echo $ut->unit_id ?>"><?php echo $ut->unit_name ?></option>
                                                            <?php } ?>
                                                        </select></TD>
                                                    <TD> <INPUT type="text" class="form-control" id="rate1" name="rate[]" style="width:80px;" value="<?php echo $rd->purchase_price ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="mrp1" name="mrp[]" style="width:80px;" value="<?php echo $rd->purchase_mrp ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="r1_1" name="r1[]" style="width:80px;" value="<?php echo $rd->purchase_selling_price_r1 ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="r2_1" name="r2[]" style="width:80px;" value="<?php echo $rd->purchase_selling_price_r2 ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="r3_1" name="r3[]" style="width:80px;" value="<?php echo $rd->purchase_selling_price_r3 ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="discount_1" name="discount_price[]" style="width:80px;" onKeyUp="gettotal(this)" value="<?php echo $rd->discount_price ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" name="tamount[]" id="tamount1" style="width:80px;" value="<?php echo $rd->total_price ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="taxamount1" name="taxamount[]" value="<?php $gross_amt += $rd->taxamount;echo $rd->taxamount ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="cgst1" name="cgst[]" style="width:80px;" value="<?php echo $rd->purchase_cgst ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="cgstamt1" name="cgstamt[]" value="<?php echo $rd->purchase_cgstamt ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="sgst1" name="sgst[]" style="width:80px;" value="<?php echo $rd->purchase_sgst ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="sgstamt1" name="sgstamt[]" value="<?php echo $rd->purchase_sgstamt ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="igst1" name="igst[]" style="width:80px;" value="<?php echo $rd->purchase_igst ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="igstamt1" name="igstamt[]" value="<?php $sum_igstamt += $rd->purchase_igstamt;echo $rd->purchase_igstamt ?>" /> </TD>
                                                    <TD> <INPUT type="text" class="form-control" id="netamt1" name="netamt[]" value="<?php echo $rd->purchase_netamt ?>" /> 
                                                    <input type="hidden" class="form-control" name="purchase_id[]" value="<?php echo $rd->purchase_id ?>">
                                                    </TD>
                                                </TR>
                                            <?php } ?>
                                    </table>
                                </div>
                                </table>
                                <br><br>
                                <!-------------------------------------------------------------------------------------------------->
                                <div class="panel-body" style="font-weight:bold;">
                                    <br>
                                    <table style="width:30%" align="left" class="table table-bordered">
                                        <tr>
                                            <td>Gross Amount<input type='text' id='gross_amt' class="form-control" name="gross_amt" value="<?php echo $gross_amt ?>" /></td>
                                            <td>Taxable Amount<input type='text' id='taxamounts' class="form-control" name="taxamounts" value="<?php echo $gross_amt ?>" /></td>
                                            <td>Purchase Tax<input type='text' id='ptax' name="ptax" class="form-control" value="<?php echo $sum_igstamt ?>" /> </td>
                                        </tr>
                                        <tr style="width:30%" align="left" class="table table-bordered">
                                            <td>Purchase Amount<input type='text' id='pamount' class="form-control" name="pamount" value="<?php echo $records[0]->purchase_netamt ?>" /></td>
                                            <td>Qty. Total<input type='text' id='qty_total' class="form-control" name="qty_total" value="<?php echo $tot_qty ?>" /></td>
                                            <td> Net Total<input type='text' id='net_total' class="form-control" name="net_total" value="<?php echo $records[0]->purchase_netamt ?>" /></td>
                                        </tr>
                                        <tr style="width:30%" align="left" class="table table-bordered">
                                            <td>Old Balance<input type='text' id='old_bal_' class="form-control" name="old_bal" value="<?php echo $records[0]->pur_old_bal ?>" /></td>
                                        </tr>
                                    </table>
                                    <!--   <h4><b>TOTAL BILL DETAILS</b></h4> -->
                                    <div class="NetTotalAmount pull-right" style="font-size:18px;">
                                        <div class=" form-group pull-right">
                                            <div class="col-md-12">
                                                <label>Paid Amount: &nbsp; </label>
                                                <input type="text" class="form-control" name="paid_amt" id="paid_amt" onkeyup="getamount();" value="<?php echo $records[0]->pur_paid_amt ?>" style="text-align: right;font-weight: bold;" />
                                            </div><br>
                                            <div class="col-md-12">
                                                <label>Total Amount: &nbsp; </label>
                                                <input type="text" class="form-control" name="total_amt" id="total_amt" value="<?php echo $records[0]->purchase_netamt ?>" style="text-align: right;font-weight: bold;background: black;color:white;" />
                                            </div><br>
                                            <div class="col-md-12">
                                                <label>New Balance : &nbsp; </label>
                                                <input type="text" class="form-control" name="net_balance" id="net_balances" value="<?php echo $records[0]->purchase_netamt - $records[0]->pur_paid_amt + $records[0]->pur_old_bal ?>" style="text-align: right;font-weight: bold;background: black;color:white;" />
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
                                    <a href="<?php echo base_url(); ?>Purchaseitem" <button type="button" class="btn btn-danger">Cancel</button></a>
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
                            <select name="product_type" id="product_type" class="form-control" style="font-weight: bold;" onChange="getsubcat();">
                                <option value="">-SELECT-</option>
                                <?php foreach ($category as $categories) { ?>
                                    <option value="<?php echo $categories->prod_cat_id ?>" <?php if (isset($records->product_type)) {
                                                                                                if ($records->product_type == $categories->prod_cat_id) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                            } ?>><?php echo $categories->prod_cat_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fsize">Sub category <span style="color:red"> *</span></label>
                            <select name="subcategory" id="subcat" class="form-control" style="font-weight: bold;" onChange="getsubcat();">
                                <option value="">-SELECT-</option>
                                <?php foreach ($subcategories as $item) { ?>
                                    <option value="<?php echo $item->subcat_id ?>" <?php if (isset($records->product_sub_type)) {
                                                                                        if ($records->product_sub_type == $item->subcat_id) {
                                                                                            echo "selected";
                                                                                        }
                                                                                    } ?>><?php echo $item->subcat_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Product Code</label>
                            <input type="text" class="form-control" name="prod_code" style="text-transform:uppercase" data-pms-required="true" autofocus value="<?php if (isset($records->product_code)) echo $records->product_code ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="fsize">Product Name <span style="color:red"> *</span></label>
                            <input type="text" data-pms-required="true" autofocus class="form-control" name="product_name" value="<?php if (isset($records->product_name)) echo $records->product_name ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="fsize">Product Unit <span style="color:red"> *</span></label>
                            <select name="product_unit" class="form-control">
                                <option value="">-SELECT UNIT-</option>
                                <?php foreach ($unit as $un) { ?>
                                    <option <?php if (isset($records->product_unit)) {
                                                if ($records->product_unit == $un->unit_id) {
                                                    echo "selected";
                                                }
                                            } ?> value="<?php echo  $un->unit_id; ?>"><?php echo  $un->unit_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>HSN Code Description</label>
                            <select name="product_hsn" class="form-control" id="product_hsn">
                                <option value="">-SELECT-</option>
                                <?php foreach ($hsncode as $hsn) { ?>
                                    <option <?php if (isset($records->product_hsn)) {
                                                if ($records->product_hsn == $hsn->hsn_id) {
                                                    echo "selected";
                                                }
                                            } ?> value="<?php echo $hsn->hsn_id; ?>"><?php echo $hsn->description; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>HSNCode</label>
                            <input type="text" readonly autofocus class="form-control" name="product_hsncode" id="product_hsncode" value="<?php if (isset($records->product_hsncode)) echo $records->product_hsncode ?>" style="font-weight: bold; text-transform: uppercase;color:red;background: white;">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="fsize">Opening Stock <span style="color:red"> *</span></label>
                            <input type="text" data-pms-required="true" autofocus class="form-control" name="product_open_stock" value="<?php if (isset($records->product_open_stock)) echo $records->product_open_stock ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="fsize">Minimum Stock</label>
                            <input type="text" data-pms-required="true" autofocus class="form-control" name="min_stock" value="<?php if (isset($records->min_stock)) echo $records->min_stock ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="fsize">Description</label>
                            <textarea class="form-control" name="product_des" rows="3"><?php if (isset($records->product_des)) echo $records->product_des ?></textarea>
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