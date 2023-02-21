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
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
            </div>
            <div class="box-body">
              <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-10">
             <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Production Details</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <div class="form-group row">
                  <div class="col-md-4">
                  <label class="fsize">Item  Transfer Date<span style="color:red"> *</span></label>
                  <input type="hidden" autofocus class="form-control" name="punit_id" id="punit_id"  value="<?php if(isset($records->punit_id)) echo $records->punit_id ?>"  style="background:white;">

                  <input type="text" autofocus class="form-control" name="punit_date" id="punit_date"  value="<?php if(isset($records->punit_date)) echo $records->punit_date ?>"  style="background:white;">
                </div>
                    <div class="col-md-4">
                                <label class="fsize">Production Unit<span style="color:red"> *</span></label>
                                <select name="punit_type"  id="punit_type" class="form-control" style="font-weight: bold;">
                                  <option value="">-SELECT-</option>
                                  <option <?php if(isset($records->punit_type)) {if($records->punit_type==1){echo "selected";}} ?> value="1">Masala Unit</option>
                                  <option <?php if(isset($records->punit_type)) {if($records->punit_type==2){echo "selected";}} ?> value="2">Spices Unit</option>
                                  <option <?php if(isset($records->punit_type)) {if($records->punit_type==3){echo "selected";}} ?> value="3">Oil Unit</option>
                                  <option <?php if(isset($records->punit_type)) {if($records->punit_type==4){echo "selected";}} ?> value="4">Pickle Unit</option>
                                  <option <?php if(isset($records->punit_type)) {if($records->punit_type==5){echo "selected";}} ?> value="5">Miscellaneous Unit</option>
                                </select>
                      </div>

                      <div class="col-md-4">
                     <label class="fsize">Raw Material Used <span style="color:red"> *</span></label>
                          <select name="punit_product_id_fk"  id="punit_product_id_fk" class="form-control select2" style="font-weight: bold;">
                            <option value="">-SELECT-</option>
                             <?php foreach($product as $item){ ?>
                              <option value="<?php echo $item->product_id ?>" <?php if(isset($records->punit_product_id_fk)) { if($records->punit_product_id_fk==$item->product_id){ echo "selected"; } } ?>><?php echo $item->product_name ?></option>
                             <?php } ?>
                          </select>
                </div>

                  </div>

                  <div class="form-group row">
                  <div class="col-md-3">
                              <label for="">Total Qty Transfered</label>
                              <input type="text" class="form-control" name="punit_qty" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->punit_qty)) echo $records->punit_qty."-".$records->unit_name; ?>">
                   </div>
                   <div class="col-md-2">
                              <label for="">Used Weight <span style="color:red"> *</span></label>
                              <input type="text" class="form-control" name="punit_weight" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->punit_weight)) echo $records->punit_weight; ?>">
                   </div>

                   <div class="col-md-2">
                  <label class="fsize">Unit <span style="color:red"> *</span></label>
                  <select name="punit_weight_unit" class="form-control">
                    <option value="">-SELECT UNIT-</option>
                   <?php foreach($unit as $un){ ?>
                    <option <?php if(isset($records->punit_weight_unit)){if($records->punit_weight_unit==$un->unit_name){echo "selected";}} ?> value="<?php  echo  $un->unit_name;?>"><?php  echo  $un->unit_name;?></option>
                   <?php } ?>
                  </select>
                </div>

                   <div class="col-md-2">
                              <label for="">Wastage <span style="color:red"> *</span></label>
                              <input type="text" class="form-control" name="punit_waste" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->punit_waste)) echo $records->punit_waste; ?>">
                   </div>

                   <div class="col-md-2">
                  <label class="fsize">Unit <span style="color:red"> *</span></label>
                  <select name="punit_waste_unit" class="form-control">
                    <option value="">-SELECT UNIT-</option>
                   <?php foreach($unit as $un){ ?>
                    <option <?php if(isset($records->punit_waste_unit)){if($records->punit_waste_unit==$un->unit_name){echo "selected";}} ?> value="<?php  echo  $un->unit_name;?>"><?php  echo  $un->unit_name;?></option>
                   <?php } ?>
                  </select>
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
                                    </table>

                              
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
