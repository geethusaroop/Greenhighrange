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
      Production Items Information
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Production/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Production/add" enctype="multipart/form-data">
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
                        <div class="col-md-6">
                                <label class="fsize">Production Unit<span style="color:red"> *</span></label>
                                <select name="product_unit_type"  id="product_unit_type" class="form-control" style="font-weight: bold;">
                                  <option value="">-SELECT-</option>
                                  <option <?php if(isset($records->product_unit_type)) {if($records->product_unit_type==1){echo "selected";}} ?> value="1">Masala Unit</option>
                                  <option <?php if(isset($records->product_unit_type)) {if($records->product_unit_type==2){echo "selected";}} ?> value="2">Spices Unit</option>
                                  <option <?php if(isset($records->product_unit_type)) {if($records->product_unit_type==3){echo "selected";}} ?> value="3">Oil Unit</option>
                                  <option <?php if(isset($records->product_unit_type)) {if($records->product_unit_type==4){echo "selected";}} ?> value="4">Pickle Unit</option>
                                  <option <?php if(isset($records->product_unit_type)) {if($records->product_unit_type==5){echo "selected";}} ?> value="5">Miscellaneous Unit</option>
                                </select>
                      </div>
                        
                <div class="col-md-6">
                  <label class="fsize">Product Name <span style="color:red"> *</span></label>
                  <input type="text" data-pms-required="true" autofocus class="form-control" name="product_name"  value="<?php if(isset($records->product_name)) echo $records->product_name ?>">
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
