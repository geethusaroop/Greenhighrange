<style type="text/css">
  .fsize {
    font-size: 14px;
    font-family: 'Rubik', sans-serif;
  }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/webcam.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #eef1f5;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Product Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Items"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Products</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info container">
          <div class="box-header">
            
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Items/addItem" enctype="multipart/form-data">
            <div class="row">
              <!--  Personal Info -->
              <div class="col-lg-1"></div>
              <div class="col-lg-10">
                <div class="panel panel-default" style="box-shadow:2px 2px 2px 2px black;font-weight:bold;">
                  <div class="panel-heading">
                    <b> Product Details </b>
                  </div>
                  <div class="panel-body">
                    <!-- radio -->
                    <div class="form-group">
                      <input type="hidden" id="product_id" name="product_id" value="<?php if (isset($records->product_id)) echo $records->product_id ?>" />
                      <?php echo validation_errors(); ?>
                      <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    </div>
                    <div class="box-body">
                      <?php if (isset($records->product_photo)) { ?>
                        <div class="form-group">
                          <div class="col-md-12" style="text-align: center;">
                            <?php if (isset($records->product_photo) != '') { ?>
                              <img src="<?php echo base_url(); ?>/product_photo/<?php echo $records->product_photo; ?>" width="150" height="150">
                            <?php } else { ?>
                              <img src="<?php echo base_url(); ?>/images/images.png" width="200" height="200">
                            <?php } ?>
                          </div>
                        </div>
                      <?php } ?>
                      <div class="form-group">

                          <div class="col-md-4">
                            <label>Product Type<span style="color:red">*</span></label>
                           
                            <select class="form-control" name="cat_id_fk" id="cat_id_fk">
                              <option value="">Select</option>
                              <?php
                              foreach ($codes as $key) {
                              ?>
                              <option value="<?php echo $key->cat_name; ?>"><?php echo $key->cat_name; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                        </div>

                      <!--   <div class="col-md-4">
                        <label>Product Subcategory<span style="color:red">*</span></label>
                        <select class="form-control" name="subcat_id_fk" id="subcat_id_fk">
                              <option value="">Select</option>
                        </select>
                      </div> -->
                        
                        <div class="col-md-2">
                        <label>Product Code<span style="color:red">*</span></label>
                        <input type="text" data-pms-required="true"  class="form-control" name="product_code" id="product_code"  value="<?php if(isset($records->product_code)) echo $records->product_code ?>">
                        </div>
                       
                        <div class="col-md-6">
                        <label >Product Name<span style="color:red">*</span></label>
                        <input type="text" data-pms-required="true"  class="form-control" name="product_name" id="product_name"  value="<?php if(isset($records->product_name)) echo $records->product_name ?>">
                        </div>
                     
                    
                       
                      </div>
                      <div class="form-group">

                      <div class="col-md-4">
                        <label>Type <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_model" id="product_model"  value="<?php if(isset($records->product_model)) echo $records->product_model ?>">
                        </div>


                      <div class="col-md-4">
                        <label>Model <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_model" id="product_model"  value="<?php if(isset($records->product_model)) echo $records->product_model ?>">
                        </div>


                        <div class="col-md-2">
                        <label>Material <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_material" id="product_material"  value="<?php if(isset($records->product_material)) echo $records->product_material ?>">
                        </div>

                        <div class="col-md-2">
                        <label>Color <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_color" id="product_color"  value="<?php if(isset($records->product_color)) echo $records->product_color ?>">
                        </div>
                       
                   
                      </div>
                     
                   
                      
                      <div class="form-group">
                       
                        <div class="col-md-3">
                        <label>Upload Image</label>
                          <input type="hidden" name="product_photo1" value="<?php if(isset($records->product_photo)) echo $records->product_photo ?>"/>
                          <input  type="file" id="fileupload" name="product_photo" class="form-control fsize" />
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" align="right">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <button type="reset" class="btn btn-danger">Cancel</button>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->