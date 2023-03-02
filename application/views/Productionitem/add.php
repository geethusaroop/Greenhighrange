<style type="text/css">
   .fsize
  {
    font-size: 14px;
    font-family: 'Rubik', sans-serif;
  }
</style>
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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Production Item- Transfer To Stock
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Productionitem/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Productionitem/add" enctype="multipart/form-data">
    <section class="content">
    <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
           
            </div>
            <div class="box-body" >
              <div class="row">
              <div class="col-lg-12">
             <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Production Details</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <div class="form-group row">
                  <div class="col-md-4">
                  <label class="fsize">Item  Transfer Date<span style="color:red"> *</span></label>
                  <input type="hidden" autofocus class="form-control" name="punit_id" id="punit_id"  value="<?php if(isset($records->punit_id)) echo $records->punit_id ?>"  style="background:white;">

                  <input type="text" autofocus class="form-control" name="punit_date" id="punit_date"  value="<?php if(isset($records[0]->punit_date)) echo $records[0]->punit_date ?>"  style="background:white;">
                </div>
                    <div class="col-md-4">
                                <label class="fsize">Production Unit<span style="color:red"> *</span></label>
                                <select name="punit_type"  id="punit_type" class="form-control" style="font-weight: bold;">
                                  <option value="">-SELECT-</option>
                                  <option <?php if(isset($records[0]->punit_type)) {if($records[0]->punit_type==1){echo "selected";}} ?> value="1">Masala Unit</option>
                                  <option <?php if(isset($records[0]->punit_type)) {if($records[0]->punit_type==2){echo "selected";}} ?> value="2">Spices Unit</option>
                                  <option <?php if(isset($records[0]->punit_type)) {if($records[0]->punit_type==3){echo "selected";}} ?> value="3">Oil Unit</option>
                                  <option <?php if(isset($records[0]->punit_type)) {if($records[0]->punit_type==4){echo "selected";}} ?> value="4">Pickle Unit</option>
                                  <option <?php if(isset($records[0]->punit_type)) {if($records[0]->punit_type==5){echo "selected";}} ?> value="5">Miscellaneous Unit</option>
                                </select>
                      </div>

                     
                          <div class="col-md-4">
                          <label class="fsize">Batch No<span style="color:red"> *</span></label>

                          <input type="text" autofocus class="form-control" name="punit_batch_no" id="punit_batch_no"  value="<?php if(isset($records[0]->punit_batch_no)) echo $records[0]->punit_batch_no ?>"  style="background:white;">
                        </div>
                  </div>


                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered tc-table footable" style="border:1px solid #ccc;color:black;">
                                    <thead>
                                      <tr style="color: black;text-transform: uppercase;">
                                        <th style="border:1px solid #ccc;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:1px solid #ccc;" width="45">Raw_Material_Used</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Code</th>
                                        <th style="border:1px solid #ccc;" width="45">Total_Qty_Transfered</th>
                                        <th style="border:1px solid #ccc;" width="72">Unit</th>
                                        <th style="border:1px solid #ccc;" width="250">Purchase_Price</th>
                                        <th style="border:1px solid #ccc;" width="250">Total_Purchase_Price</th>
                                        <th style="border:1px solid #ccc;" width="250">Total_Weight_Used</th>
                                        <th style="border:1px solid #ccc;" width="250">Unit</th>
                                        <th style="border:1px solid #ccc;" width="250">Wastage</th>
                                        <th style="border:1px solid #ccc;" width="250">Unit</th>
                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                    <?php $i=0;$sum=0;foreach($records as $row){$i=$i+1; ?>
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD style="color:black;border:1px solid #ccc;"><?php echo $i; ?><input type="hidden" name="punit_product_id_fk[]" value="<?php echo $row->punit_product_id_fk; ?>"></TD>
                                        <TD style="border:1px solid #ccc;"> <?php echo $row->product_name; ?> </TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->product_code; ?> </TD>
                                          <TD style="border:1px solid #ccc;">  <?php echo $row->punit_qty; ?> </TD>
                                          <TD style="border:1px solid #ccc;"><?php echo $row->unit_name; ?></TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->purchase_price; ?> </TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->purchase_price * $row->punit_qty; ?> </TD>
                                          <TD style="border:1px solid #ccc;"><input type="text" class="form-control" name="punit_weight[]" style="text-transform:uppercase"  autofocus value="<?php echo $row->punit_weight; ?>"></TD>
                                          <TD style="border:1px solid #ccc;"> 
                                          <select name="punit_weight_unit[]" class="form-control">
                                          <option value="">-SELECT UNIT-</option>
                                            <?php foreach($unit as $un){ ?>
                                            <option <?php if(isset($records->punit_weight_unit)){if($records->punit_weight_unit==$un->unit_name){echo "selected";}} ?> value="<?php  echo  $un->unit_name;?>"><?php  echo  $un->unit_name;?></option>
                                            <?php } ?>
                                          </select>
                                          </TD>
                                          <TD style="border:1px solid #ccc;"> 
                                          <input type="text" class="form-control" name="punit_waste[]" style="text-transform:uppercase"  autofocus value="<?php echo $row->punit_waste; ?>">
                                          </TD>
                                          <TD style="border:1px solid #ccc;"> 
                                          <select name="punit_waste_unit[]" class="form-control">
                                          <option value="">-SELECT UNIT-</option>
                                          <?php foreach($unit as $un){ ?>
                                          <option <?php if(isset($records->punit_waste_unit)){if($records->punit_waste_unit==$un->unit_name){echo "selected";}} ?> value="<?php  echo  $un->unit_name;?>"><?php  echo  $un->unit_name;?></option>
                                          <?php } ?>
                                          </select>
                                          </TD>
                                        </TR>
                                        <?php $sum=$sum+($row->purchase_price * $row->punit_qty);} ?>
                                      </table>
                                      </div>

                  
                <div class="form-group row">
                  <div class="col-md-2">
                  <label class="fsize">Total Purchase Cost</label>
                  <input type="text" autofocus class="form-control" name="punit_purchase_cost" id="punit_purchase_cost"  value="<?php if($row->punit_purchase_cost!=0){echo $row->punit_purchase_cost;}else{echo $sum;}  ?>"  style="background:white;">
                </div>
                <div class="col-md-2">
                  <label class="fsize">Total Production Cost</label>
                  <input type="text" autofocus class="form-control" name="punit_product_cost" id="punit_product_cost"  value="<?php echo $row->punit_product_cost; ?>"  style="background:white;">
                </div>
                </div>

              
            <!-- /.box-header -->
          </div>
        </div>
      </div>

              </div>

                 <!--------------------------------------------------------------------------------->


                 <div class="row">
                <div class="col-lg-12">
                      <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                                    <div class="panel-heading">
                                      <h3 class="panel-title"><b>Added Stock</b></h3>
                                    </div>
                                    <div class="panel-body" style="font-weight:bold;">

                                  <div class="table-responsive">
                                  <table  class="table table-striped table-bordered tc-table footable" style="border:1px solid #ccc;color:black;">
                                    <thead>
                                      <tr style="color: black;text-transform: uppercase;">
                                        <th style="border:1px solid #ccc;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Name</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Code</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Batch</th>
                                        <th style="border:1px solid #ccc;" width="72">Qty(Total_Item_Produced)</th>
                                        <th style="border:1px solid #ccc;" width="72">Unit</th>
                                        <th style="border:1px solid #ccc;" width="72">SRate(R1)</th>
                                        <th style="border:1px solid #ccc;" width="69">SRate(R2)</th>
                                        <th style="border:1px solid #ccc;" width="46">SRate(R3)</th>
                                        <th style="border:1px solid #ccc;" width="250">Description</th>
                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                    <?php $i=0;foreach($record as $row){$i=$i+1; ?>
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD style="color:black;border:1px solid #ccc;"> 1 </TD>
                                        <TD style="border:1px solid #ccc;"> <?php echo $row->product_name; ?> </TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->product_code; ?> </TD>
                                          <TD style="border:1px solid #ccc;">  <?php echo $row->product_batch_no; ?> </TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->pstock_total; ?> </TD>
                                          <TD style="border:1px solid #ccc;"><?php echo $row->unit_name; ?></TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->pstock_r1; ?></TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->pstock_r2; ?> </TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->pstock_r3; ?> </TD>
                                          <TD style="border:1px solid #ccc;"> <?php echo $row->product_des; ?> </TD>
                                        </TR>
                                        <?php } ?>
                                      </table>
                                      </div>
                                      <br>
                                    
                                  </div>
                        </div>
                </div>
              </div>
              <!--------------------------------------------------------------------------------->


              <div class="row">
                <div class="col-lg-12">
                      <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                                    <div class="panel-heading">
                                      <h3 class="panel-title"><b>Product Details-Transfer To Stock</b></h3>
                                    </div>
                                    <div class="panel-body" style="font-weight:bold;">

                                    <div class="form-group row">
                                    <div class="col-md-3">
                  <label class="fsize">Stock Date<span style="color:red"> *</span></label>
                  <input type="date" autofocus class="form-control" name="pstock_date" id="pstock_date"  required value="<?php if(isset($records->pstock_date)) echo $records->pstock_date ?>"  style="background:white;">
                </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary" value="Add Row" onClick="addRow('dataTable')">Add</button>
                                  <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTable')">Delete</button>
                                 
                                  <div class="table-responsive">
                                  <table id="dataTable" class="table table-striped table-bordered tc-table footable" style="border:1px solid #ccc;color:black;">
                                    <thead>
                                      <tr style="background: black;color: white;text-transform: uppercase;">
                                        <th style="border:1px solid #ccc;" width="20" class="col-small center style2 style3"> </th>
                                        <th style="border:1px solid #ccc;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Name</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Code</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Batch</th>
                                        <th style="border:1px solid #ccc;" width="72">Qty(Total_Item_Produced)</th>
                                        <th style="border:1px solid #ccc;" width="72">Unit</th>
                                        <th style="border:1px solid #ccc;" width="72">SRate(R1)</th>
                                        <th style="border:1px solid #ccc;" width="69">SRate(R2)</th>
                                        <th style="border:1px solid #ccc;" width="46">SRate(R3)</th>
                                        <th style="border:1px solid #ccc;" width="49">Description</th>
                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD><INPUT type="checkbox" name="chk[]"/></TD>
                                        <TD style="color:black;"> 1 </TD>
                                        <TD> <select name="product_name[]" id="product_num1" style="width:180px;" class="form-control select2" onchange="gethsncode(this);">
                                          <option value="" selected="selected">--SELECT--</option>
                                          <?php
                                          foreach ($product_names as $w)
                                          {
                                            ?><option value="<?php echo $w->product_id;?>"><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>          </select> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="prod_code[]" id="product_code1" style="width:100px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="prod_batch[]" id="product_batch1" style="width:100px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="product_stock[]" id="pquantity_1" style="width:180px;" required/> </TD>
                                          <TD><select name="product_unit[]" class="form-control" id="p_unit1" style="width:120px;" placeholder="Unit">
                                            <option value="">--SELECT--</option>
                                            <?php foreach($unit as $ut){ ?>
                                              <option value="<?php echo $ut->unit_id ?>"><?php echo $ut->unit_name ?></option>
                                            <?php } ?>
                                          </select></TD>
                                          <TD> <INPUT type="text" class="form-control" id="product_price_r1_1" name="product_price_r1[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="product_price_r2_1" name="product_price_r2[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="product_price_r3_1" name="product_price_r3[]"  style="width:80px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" id="product_des" name="product_des[]" style="width:500px;"/> </TD>
                                        </TR>
                                      </table>
                                      </div>
                                      <br>
                                      <div class="row">
                                        <div class="col-md-4">
                                          <label for="">STOCK TRANSFER STATUS</label>
                                          <select class="form-control" name="punit_proceed_status" id="punit_proceed_status">
                                          <option  value="">SELECT</option>
                                            <option <?php if(isset($records->punit_proceed_status)){if($records->punit_proceed_status==1){echo "selected";}} ?> value="1">ACTIVE</option>
                                            <option <?php if(isset($records->punit_proceed_status)){if($records->punit_proceed_status==2){echo "selected";}} ?> value="2">COMPLETED</option>
                                          </select>
                                        </div>
                                      </div>
                                  </div>
                        </div>
                </div>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
             <br>
          <div class="box-footer">
          <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-4">
          <a href="<?php echo base_url(); ?>Product"  <button type="button" class="btn btn-danger">Cancel</button></a>
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
<script type="text/javascript">
  function getsubcat()
  {
   var type= document.getElementById("product_type").value;
   ///alert(type);
   if(type==3)
   {
    document.getElementById("product_sub_type").style.display = "block";
   }
   else
   {
    document.getElementById("product_sub_type").style.display = "none";
   }
  }
</script>
