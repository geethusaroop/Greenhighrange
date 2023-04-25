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
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Damaged Products
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Damage/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Damage/add" enctype="multipart/form-data">
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
      <div class="col-lg-12">
             <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Damaged Products</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <input type="hidden" name="damage_id" value="<?php if(isset($records->damage_id)) echo $records->damage_id ?>"/>
                  <div class="form-group row">
                   

                 <div class="col-md-4">
                  <label class="fsize">Date<span style="color:red"> *</span></label>
                  <input type="date" autofocus class="form-control" name="damage_date" id="damage_date"  value="<?php if(isset($records->damage_date)) {echo $records->damage_date;}else{echo date('Y-m-d');} ?>"  style="background:white;">
                </div>

                  </div>
                  <!----------------------------------->
                  <button type="button" class="btn btn-primary" value="Add Row" onClick="addRow('dataTables')">Add</button>
                  <button type="button" class="btn btn-danger" value="Delete Row" onClick="deleteRow('dataTables')">Delete</button>
                                 
                                  <div class="table-responsive">
                                  <table id="dataTables" class="table table-striped table-bordered tc-table footable" style="border:1px solid #ccc;color:black;">
                                    <thead>
                                      <tr style="background: black;color: white;text-transform: uppercase;">
                                        <th style="border:1px solid #ccc;" width="20" class="col-small center style2 style3"> </th>
                                        <th style="border:1px solid #ccc;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Name</th>
                                        <th style="border:1px solid #ccc;" width="72">Damaged Qty</th>
                                        <th style="border:1px solid #ccc;" width="72">Unit</th>
                                        <th style="border:1px solid #ccc;" width="45">Current Stock</th>
                                        <th style="border:1px solid #ccc;" width="45">Unit</th>
                                        <th style="border:1px solid #ccc;" width="45">Stock Balance</th>
                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD><INPUT type="checkbox" name="chk[]"/></TD>
                                        <TD style="color:black;"> 1 </TD>
                                        <TD> <select name="damage_item_id_fk[]" id="damage_item_id_fk1" style="width:350px;" class="form-control select2" onchange="getproductdetails(<?php echo $i=1; ?>);" required>
                                          <option value="" selected="selected">--SELECT--</option>
                                          <?php
                                          foreach ($product_names as $w)
                                          {
                                            ?><option value="<?php echo $w->product_id;?>"><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>          </select> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="damage_count[]" id="damage_count1" style="width:180px;" onkeyup="getstockbal(<?php echo $i=1; ?>);"/> </TD>
                                          <TD><select name="damage_unit[]" class="form-control" id="damage_unit1" style="width:180px;" placeholder="Unit">
                                            <option value="">--SELECT--</option>
                                            <?php foreach($unit as $ut){ ?>
                                              <option value="<?php echo $ut->unit_id ?>"><?php echo $ut->unit_name ?></option>
                                            <?php } ?>
                                          </select></TD>
                                          <TD> <INPUT type="text" class="form-control"  name="current_stock[]" id="current_stock1" style="width:180px;"/> </TD>
                                          <TD><input type="text" autofocus class="form-control" name="current_stock_unit[]" id="current_stock_unit1"  value="" readonly style="background:white;width:180px;"></TD>
                                          <TD><input type="text" autofocus class="form-control" name="damage_bal[]" id="damage_bal1"  value="0" readonly style="background:white;width:180px;"></TD>

                                        </TR>
                                      </table>
                                      </div>
                                    </table>

                                  </div>


          </div>
        </div>
      </div>
      </div>
      
          <div class="box-footer">
          <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-4">
          <a href="<?php echo base_url(); ?>Damage"  <button type="button" class="btn btn-danger">Cancel</button></a>
          <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </div>
          </div>

            <!-- /.box-body -->
          </div>
          
          <!-- /.box -->
        
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
