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
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Branch Transfer Information
       <small id="date" class="col-md-4"></small>
       <!-- <small>Optional description</small> -->
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url(); ?>Branch_transfer/"><i class="fa fa-dashboard"></i> Back to List</a></li>
       <li class="active"></li>
     </ol>
   </section>
   <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/Branch_transfer/add" enctype="multipart/form-data">
     <!-- Main content -->
     <section class="content">
       <div class="row">
         <!-- right column -->
         <div class="col-md-12">
           <!-- Horizontal Form -->
           <div class="box">
            
             <!-- /.box-header -->
             <!-- form start -->

             <!-- radio -->
             <div class="form-group">
               <input type="hidden" name="branch_id" value="<?php if (isset($records->branch_id)) echo $records->branch_id ?>" />
               <?php echo validation_errors(); ?>
               <label for="inputEmail3" class="col-sm-2 control-label"></label>
             </div>
             <div class="box-body">
               <div class="col-lg-12">
                 <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                   <div class="panel-heading">
                     <h3 class="panel-title"><b>BRANCH WISE STOCK TRANSFER INFORMATION</b></h3>
                   </div>
                   <div class="panel-body" style="font-weight:bold;">

                     <div class="form-group">
                        <div class="col-md-6">
                         <label>Date Of Transfer<span style="color:red"></span></label>
                         <input type="date" autofocus class="form-control" name="bt_date" id="" value="<?php echo date('Y-m-d'); ?>">
                       </div>

                       <div class="col-md-6">
                         <label>Branch Name<span style="color:red"></span></label>
                         <select class="form-control" name="branch_name" id="branch_name">
                          <option value="">SELECT</option>
                          <?php foreach($branch as $br){ ?>
                            <option value="<?php echo $br->branch_id ?>"><?php echo $br->branch_name ?></option>
                          <?php } ?>  
                         </select>
                       </div>
                     </div>
                     <!----------------------------------------------------------------------------------------->

                     <button type="submit" class="btn btn-primary" value="Add Row" onClick="addRow('dataTables')">Add</button>
                      <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTables')">Delete</button>
                           <br>      
                                  <div class="table-responsive">
                                  <table id="dataTables" class="table table-striped table-bordered tc-table footable" style="border:1px solid #ccc;color:black;">
                                    <thead>
                                      <tr style="background: black;color: white;text-transform: uppercase;">
                                        <th style="border:1px solid #ccc;" width="20" class="col-small center style2 style3"> </th>
                                        <th style="border:1px solid #ccc;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Name</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Code</th>
                                        <th style="border:1px solid #ccc;" width="45">Transfer_Stock_Qty</th>
                                        <th style="border:1px solid #ccc;" width="72">Available_Stock</th>
                                        <th style="border:1px solid #ccc;" width="72" colspan="10"></th>
                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD><INPUT type="checkbox" name="chk[]"/></TD>
                                        <TD style="color:black;"> 1 </TD>
                                        <TD> <select name="prod_name[]" id="prod_name1" required style="width:480px;" class="form-control" onchange="getproductdetails(<?php echo $i=1; ?>);">
                                          <option value="">--SELECT--</option>
                                          <?php
                                          foreach ($product as $w)
                                          {
                                            ?><option value="<?php echo $w->product_id;?>"><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>          </select> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="prod_code[]" id="prod_code1" style="width:150px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="stck_amt[]" id="stck_amt1"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="av_stk[]" id="av_stk1" style="width:180px;" /> </TD>
                                          <TD> <INPUT type="hidden" class="form-control"  name="product_name[]" id="product_name1" style="width:180px;" /> </TD>
                                          <TD><INPUT type="hidden" class="form-control"  name="product_unit[]" id="product_unit1" style="width:80px;" /></TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_price_r1_1" name="product_price_r1[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_price_r2_1" name="product_price_r2[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_price_r3_1" name="product_price_r3[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_des1" name="product_des[]" style="width:80px;"/> </TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_category1" name="product_category[]" style="width:80px;"/> </TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_unit_type1" name="product_unit_type[]" style="width:80px;"/> </TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_hsn1" name="product_hsn[]" style="width:80px;"/> </TD>
                                          <TD> <INPUT type="hidden" class="form-control" id="product_hsncode1" name="product_hsncode[]" style="width:80px;"/> </TD>
                                        </TR>
                                      </table>
                                      </div>            

                 </div>
               </div>
             </div>

             <div class="box-footer">
               <div class="row">
                 <div class="col-md-6">
                 </div>
                 <div class="col-md-4">
                 <a href="<?php echo base_url(); ?>Branch_transfer"  <button type="button" class="btn btn-danger">Cancel</button></a>
                   <button type="submit" class="btn btn-primary">Save</button>
                 </div>
               </div>
             </div>

           </div>
           <!-- /.box-body -->

         </div>
         <!-- /.box -->

       </div>
       <!--/.col (right) -->
 </div>
 </section>
 </form>
 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->