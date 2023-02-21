<style type="text/css">
   .fsize
  {
    font-size: 14px;
    font-family: 'Rubik', sans-serif;
  }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Product- Transfer To Production Unit
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>ProductTransfer/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/ProductTransfer/add" enctype="multipart/form-data">
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
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
             <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Product Info</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <input type="hidden" name="punit_id" value="<?php if(isset($records->punit_id)) echo $records->punit_id ?>"/>
                  <div class="form-group row">
                    <div class="col-md-6">
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

                    

                  </div>
               
              <div class="form-group row">

              <div class="col-md-6">
                          <label class="fsize">Product Name <span style="color:red"> *</span></label>
                          <select name="punit_product_id_fk"  id="punit_product_id_fk" class="form-control select2" style="font-weight: bold;">
                            <option value="">-SELECT-</option>
                             <?php foreach($product_names as $item){ ?>
                              <option value="<?php echo $item->product_id ?>" <?php if(isset($records->punit_product_id_fk)) { if($records->punit_product_id_fk==$item->product_id){ echo "selected"; } } ?>><?php echo $item->product_name ?></option>
                             <?php } ?>
                          </select>
                </div>
              
                <div class="col-md-3">
                  <label class="fsize">Current Stock <span style="color:red"> *</span></label>
                  <input type="text" autofocus class="form-control" name="punit_stock" id="punit_stock"  value="<?php if(isset($records->punit_stock)) echo $records->punit_stock ?>" readonly style="background:white;">
                </div>

                <div class="col-md-3">
                  <label class="fsize">Unit <span style="color:red"> *</span></label>
                  <input type="text" autofocus class="form-control" name="punit_stock_unit" id="punit_stock_unit"  value="<?php if(isset($records->punit_stock_unit)) echo $records->punit_stock_unit ?>" readonly style="background:white;">
                </div>
              </div>
              

          </div>
        </div>
      </div>
            </div>
      <!--------------------------------------------------------------------->
      <div class="row"> <div class="col-lg-2"></div>
      <div class="col-lg-8">
             <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Transfer Products To Production Unit</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <input type="hidden" name="punit_id" value="<?php if(isset($records->punit_id)) echo $records->punit_id ?>"/>
                
               
              <div class="form-group row">

                <div class="col-md-3">
                  <label class="fsize">Date Of Transfer<span style="color:red"> *</span></label>
                  <input type="date" autofocus class="form-control" name="punit_date" id="punit_date"  value="<?php if(isset($records->punit_date)) echo $records->punit_date ?>"  style="background:white;">
                </div>

             

                <div class="col-md-3">
                  <label class="fsize">Qty <span style="color:red"> *</span></label>
                  <input type="text" autofocus class="form-control" name="punit_qty" id="punit_qty" onkeyup="getstockbal();" value="<?php if(isset($records->punit_qty)) echo $records->punit_qty ?>"  style="background:white;">
                </div>  

                <div class="col-md-3">
                  <label class="fsize">Product Unit <span style="color:red"> *</span></label>
                  <select name="punit_unit" class="form-control">
                    <option value="">-SELECT UNIT-</option>
                   <?php foreach($unit as $un){ ?>
                    <option <?php if(isset($records->punit_unit)){if($records->punit_unit==$un->unit_id){echo "selected";}} ?> value="<?php  echo  $un->unit_id;?>"><?php  echo  $un->unit_name;?></option>
                   <?php } ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="fsize">Stock Balance <span style="color:red"> *</span></label>
                  <input type="text" autofocus class="form-control" name="punit_bal" id="punit_bal"  value="<?php if(isset($records->punit_bal_stock)) echo $records->punit_bal_stock ?>" readonly style="background:white;">
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
