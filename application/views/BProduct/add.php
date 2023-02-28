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
      Product Information
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>BProduct/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/BProduct/add" enctype="multipart/form-data">
    <section class="content">
    <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
            </div>
            <div class="box-body"><div class="col-lg-2"></div>
              <div class="col-lg-8">
             <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>NEW PRODUCT</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <input type="hidden" name="product_id" value="<?php if(isset($records->product_id)) echo $records->product_id ?>"/>
                   <input type="hidden" name="product_stock" value="<?php if(isset($records->product_stock)) echo $records->product_stock ?>"/>
                
              <div class="form-group row">
              <div class="col-md-3">
                          <label for="">Product Code</label>
                          <input type="text" class="form-control" name="prod_code" style="text-transform:uppercase"  autofocus value="<?php if(isset($records->product_code)) echo $records->product_code ?>">
                        </div>
                <div class="col-md-6">
                  <label class="fsize">Product Name <span style="color:red"> *</span></label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_name"  value="<?php if(isset($records->product_name)) echo $records->product_name ?>">
                </div>
                <div class="col-md-3">
                  <label class="fsize">Product Unit <span style="color:red"> *</span></label>
                  <select name="product_unit" class="form-control">
                    <option value="">-SELECT UNIT-</option>
                   <?php foreach($unit as $un){ ?>
                    <option <?php if(isset($records->product_unit)){if($records->product_unit==$un->unit_id){echo "selected";}} ?> value="<?php  echo  $un->unit_id;?>"><?php  echo  $un->unit_name;?></option>
                   <?php } ?>
                  </select>
                </div>
              </div>

               <div class="form-group" style="font-weight: bold;">
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

              <div class="form-group row">
                <div class="col-md-4">
                  <label class="fsize">R1 Price <span style="color:red"> *</span></label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_price_r1"  value="<?php if(isset($records->product_price_r1)) echo $records->product_price_r1 ?>">
                </div>
                <div class="col-md-4">
                  <label class="fsize">R2 Price</label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_price_r2"  value="<?php if(isset($records->product_price_r2)) echo $records->product_price_r2 ?>">
                </div>

                <div class="col-md-4">
                  <label class="fsize">R3 Price</label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_price_r3"  value="<?php if(isset($records->product_price_r3)) echo $records->product_price_r3 ?>">
                </div>
              </div>

            <!--   <div class="form-group row">
                <div class="col-md-6">
                  <label class="fsize">Opening Stock <span style="color:red"> *</span></label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_open_stock"  value="<?php if(isset($records->product_open_stock)) echo $records->product_open_stock ?>">
                </div>
                <div class="col-md-6">
                  <label class="fsize">Minimum Stock</label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="min_stock"  value="<?php if(isset($records->min_stock)) echo $records->min_stock ?>">
                </div>
              </div> -->


               <div class="form-group row">
                <div class="col-md-12">
                  <label class="fsize">Description</label>
                 <textarea class="form-control" name="product_des" rows="3"><?php if(isset($records->product_des)) echo $records->product_des ?></textarea>
                </div>
              </div>
            <!-- /.box-header -->
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
          <a href="<?php echo base_url(); ?>BProduct"  <button type="button" class="btn btn-danger">Cancel</button></a>
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
