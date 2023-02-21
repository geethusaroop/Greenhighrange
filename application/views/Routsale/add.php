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
      Driver & Rout Details
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Routsale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Routsale/add" enctype="multipart/form-data">
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
                  <h3 class="panel-title"><b>Driver & Rout Details</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <div class="form-group row">
                  <div class="col-md-4">
                  <label class="fsize">Date<span style="color:red"> *</span></label>
                  <input type="date" autofocus class="form-control" name="routsale_date" id="routsale_date"  required value="<?php if(isset($records->routsale_date)) echo $records->routsale_date ?>"  style="background:white;">

                </div>
                    <div class="col-md-4">
                     <label class="fsize">Driver Name<span style="color:red"> *</span></label>
                     <input type="text" class="form-control" name="routsale_driver" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->routsale_driver)) echo $records->routsale_driver; ?>">
         
                      </div>

                      <div class="col-md-4">
                      <label class="fsize">Vehicle Number<span style="color:red"> *</span></label>
                     <input type="text" class="form-control" name="routsale_vehicle_no" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->routsale_driver)) echo $records->routsale_driver; ?>">
         
                </div>

                  </div>

                  <div class="form-group row">
                  <div class="col-md-6">
                              <label for="">Rout Sale From</label>
                              <input type="text" class="form-control" name="routsale_from" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->punit_qty)) echo $records->punit_qty."-".$records->unit_name; ?>">
                   </div>
                   <div class="col-md-6">
                              <label for="">Rout Sale To<span style="color:red"> *</span></label>
                              <input type="text" class="form-control" name="routsale_to" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->punit_weight)) echo $records->punit_weight; ?>">
                   </div>

                  
                  </div>

              
            <!-- /.box-header -->
          </div>
        </div>
      </div>

              </div>
              <!--------------------------------------------------------------------------------->


              <div class="row">   <div class="col-lg-1"></div>
                <div class="col-lg-10">
                      <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                                    <div class="panel-heading">
                                      <h3 class="panel-title"><b>Product Stock Details</b></h3>
                                    </div>
                                    <div class="panel-body" style="font-weight:bold;">

                                   
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
                                        <th style="border:1px solid #ccc;" width="72">Stock</th>
                                        <th style="border:1px solid #ccc;" width="72">Unit</th>
                                        <th style="border:1px solid #ccc;" width="45">Current Stock</th>

                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD><INPUT type="checkbox" name="chk[]"/></TD>
                                        <TD style="color:black;"> 1 </TD>
                                        <TD> <select name="product_name[]" id="product_num1" style="width:250px;" class="form-control select2" onchange="getproductdetails(<?php echo $i=1; ?>);">
                                          <option value="" selected="selected">--SELECT--</option>
                                          <?php
                                          foreach ($product_names as $w)
                                          {
                                            ?><option value="<?php echo $w->product_id;?>"><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>          </select> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="prod_code[]" id="product_code1" style="width:100px;"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="product_stock[]" id="pquantity_1" style="width:80px;" required/> </TD>
                                          <TD><select name="product_unit[]" class="form-control" id="p_unit1" style="width:120px;" placeholder="Unit">
                                            <option value="">--SELECT--</option>
                                            <?php foreach($unit as $ut){ ?>
                                              <option value="<?php echo $ut->unit_id ?>"><?php echo $ut->unit_name ?></option>
                                            <?php } ?>
                                          </select></TD>
                                          <TD> <INPUT type="text" class="form-control"  name="pstock[]" id="pstock1" style="width:100px;"/> </TD>
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
