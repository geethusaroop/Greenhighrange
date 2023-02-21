<style>
    @media (min-width: 768px) {
  .modal-lg {
    width: 90%;
   max-width:1400px;
  }
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="row">Products - Curtains & Drapes
        <!-- Company Management -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Item</li>
      </ol>
    </section><br>

    <!-- Main content -->
    <section class="content">
      <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
      <div class="box">
        <div class="box-header">
          <div class="row">
            <div class="col-sm-8">
              <h3></h3>  
            </div>
            <div class="row">
                <div class="col-md-1">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus-square"></i> Add New</button>

<!--                   <a href="<?php echo base_url();?>Items/addItem" class="btn btn-sm btn-primary" data-inline="true"><i class="fa fa-plus-square"></i> Add New</a>
 -->                </div>
            </div>
          <!-- </div> -->
          <!-- <div class="row">
            <div class="col-md-3">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary nohover">Code</button>
                </div>
                <select class="form-control supp_id" name="product_code" id="product_code">
                  <option selected disabled>Select Code</option>
                  <?php
                  foreach ($codes as $key) {
                  ?>
                  <option value="<?php echo $key->product_code; ?>"><?php echo $key->product_code; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div><
            </div>
          </div>
        </div> -->
        <div class="box-body">
            <table id="product_table" class="table table-bordered table-striped table-responsive">
                <thead>
                  <tr>
                    <th>SI.NO</th>
                    <th>PRODUCT CODE</th>
                    <th>PRODUCT NAME</th>
                    <th>MODEL</th>
                    <th>WIDTH</th>
                    <th>HEIGHT</th>
                    <th>SQ.FT.</th>
                    <th>UNIT PRICE</th>
                    <th>QTY</th>
                    <th>TOT SQ.FT.</th>
                    <th>PRODUCT PRICE</th>
                    <th>REMARK</th>
                    <th>EDIT/DELETE</th>
                  </tr>
                </thead>
                <tbody>         
                </tbody>
            </table>
        </div>
      </div>
    </section>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exampleModalLabel" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><b> Products-Curtains & Drapes</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Items/addItem" enctype="multipart/form-data">
      <div class="modal-body" style="font-weight: bold;">
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
                            <label>Category<span style="color:red">*</span></label>
                           
                            <select class="form-control" name="cat_id_fk" id="cat_id_fk">
                              <option value="">Select</option>
                              <?php
                              foreach ($codes as $key) {
                              ?>
                              <option value="<?php echo $key->cat_id; ?>" selected><?php echo $key->cat_name; ?></option>
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
                        <input type="text" data-pms-required="true"  class="form-control" name="product_code" id="product_code"  value="">
                        </div>
                       
                        <div class="col-md-6">
                        <label >Product Name<span style="color:red">*</span></label>
                        <input type="text" data-pms-required="true"  class="form-control" name="product_name" id="product_name"  value="">
                        </div>
                     
                    
                       
                      </div>
                      <div class="form-group">

                      <div class="col-md-4">
                        <label>Type <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_type" id="product_type"  value="">
                        </div>


                      <div class="col-md-4">
                        <label>Model <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_model" id="product_model"  value="">
                        </div>


                        <div class="col-md-2">
                        <label>Material <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_material" id="product_material"  value="">
                        </div>

                        <div class="col-md-2">
                        <label>Color <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="product_color" id="product_color"  value="">
                        </div>
                       
                   
                      </div>
                     

                      <div class="form-group">

                        <div class="col-md-2">
                          <label>Width <span style="color:red">*</span></label>
                          <input type="text" class="form-control" name="product_width" id="product_width"  value="">
                          </div>


                        <div class="col-md-2">
                          <label>Height <span style="color:red">*</span></label>
                          <input type="text" class="form-control" name="product_height" id="product_height"  value="">
                          </div>


                          <div class="col-md-2">
                          <label>Set Content(Pcs) <span style="color:red">*</span></label>
                          <input type="text" class="form-control" name="product_pcs" id="product_pcs"  value="">
                          </div>

                          <div class="col-md-2">
                          <label>Unit <span style="color:red">*</span></label>
                          <select class="form-control" name="product_unit" id="product_unit">
                              <option value="">Select</option>
                              <option value="Mtr">Meter</option>
                              <option value="feet">Feet</option>
                              <option value="Sqfeet">Sq.Feet</option>
                              <option value="Inches">Inches</option>
                          </select>
                          </div>

                          <div class="col-md-2">
                          <label>Unit Price <span style="color:red">*</span></label>
                          <input type="text" class="form-control" name="product_unit_price" id="product_unit_price"  value="">
                          </div>

                        </div>


                        <div class="form-group">
                 
                  <div class="col-md-12">
                  <label>Product Remark</label>
                    <textarea class="form-control" name="product_remark" id=""><?php if(isset($records->product_remark)) echo $records->product_remark ?></textarea>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="sub" class="btn btn-primary">SAVE</button>
      </div>
      </form>
    </div>
  </div>
</div><!--end edit-->

</div>
