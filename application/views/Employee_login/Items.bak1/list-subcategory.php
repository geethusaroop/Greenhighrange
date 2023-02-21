<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="row">
        <!-- Company Management -->Product Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus-square"></i> Add Category</button>
                </div>
            </div>
          <!-- </div> -->
          <!-- <div class="row">
            <div class="col-md-3">
              <div class="input-group margin">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary nohover">Code</button>
                </div>
                <select class="form-control supp_id" name="cat_id_fk" id="cat_id_fk">
                  <option selected disabled>Select Code</option>
                  <?php
                  foreach ($codes as $key) {
                  ?>
                  <option value="<?php echo $key->cat_id_fk; ?>"><?php echo $key->cat_id_fk; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div><
            </div>
          </div>
        </div> -->
        <div class="box-body">
            <table id="product_table" class="table table-bordered table-striped table-responsive" style="font-weight: bold;">
                <thead>
                  <tr>
                    <th>SI.NO</th>
                    <th>PRODUCT CATEGORY</th>
                    <th>PRODUCT SUB CATEGORY</th>
                    <th style="text-align: center;">EDIT/DELETE</th>
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
        <h4 class="modal-title"><b> Products Sub-Category</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Items/addsubcategory" enctype="multipart/form-data">
      <div class="modal-body" style="font-weight: bold;">
      <input type="hidden" name="subcat_id" id="subcat_id" value=""/>
      <div class="form-group">
                    <div class="col-md-6">
                      <label>Category</label>
                      <select class="form-control" name="cat_id_fk" id="cat_id_fk">
                        <option value="">Select</option>
                        <?php
                        foreach ($codes as $key) {
                        ?>
                        <option value="<?php echo $key->cat_id; ?>"><?php echo $key->cat_name; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                       
                      <div class="col-md-6">
                        <label>Sub-Category <span style="color:red"></span></label>
                        <input type="text" data-pms-required="true" autofocus class="form-control" name="subcat_name" id="subcat_name" value="" style="text-transform: uppercase;">
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
