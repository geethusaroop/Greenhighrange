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
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Damage/edit_damage" enctype="multipart/form-data">
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
                  <h3 class="panel-title"><b>UPDATE DAMAGED PRODUCT</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <input type="hidden" name="damage_id" value="<?php if(isset($records->damage_id)) echo $records->damage_id ?>"/>

                  <input type="hidden" name="damage_count_old" value="<?php if(isset($records->damage_count)) echo $records->damage_count ?>"/>
                 
                <div class="form-group row">
           
                <div class="col-md-6">
                  <label class="fsize">Product Name <span style="color:red"> *</span></label>
                  <select name="damage_item_id_fk" id="damage_item_id_fk" style="width:350px;" class="form-control select2">
                                          <option value="" selected="selected">--SELECT--</option>
                                          <?php
                                          foreach ($product_names as $w)
                                          {
                                            ?><option <?php if(isset($records->damage_item_id_fk)){if($records->damage_item_id_fk==$w->product_id){echo "selected";}} ?> value="<?php echo $w->product_id;?>"><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>         
                                           </select> 
                </div>

                    <div class="col-md-3">
                        <label>Damaged Qty</label>
                        <input type="text"  autofocus class="form-control" name="damage_count"  id="damage_count" value="<?php if(isset($records->damage_count)) echo $records->damage_count ?>" style="font-weight: bold; text-transform: uppercase;background: white;">
                    </div>
                    <div class="col-md-3">
                    <label class="fsize"> Unit <span style="color:red"> *</span></label>
                    <select name="product_unit" class="form-control">
                        <option value="">-SELECT UNIT-</option>
                    <?php foreach($unit as $un){ ?>
                        <option <?php if(isset($records->damage_unit)){if($records->damage_unit==$un->unit_id){echo "selected";}} ?> value="<?php  echo  $un->unit_id;?>"><?php  echo  $un->unit_name;?></option>
                    <?php } ?>
                    </select>
                    </div>
                </div>

               <div class="form-group" style="font-weight: bold;">
                   <div class="col-md-6">
                      <label>Current Stock</label>
                    <input type="text" readonly autofocus class="form-control" name="current_stock"  id="current_stock" value="<?php if(isset($record->product_stock)) echo $record->product_stock ?>" style="font-weight: bold; text-transform: uppercase;color:red;background: white;">
                  </div>

                  <div class="col-md-6">
                      <label>Unit</label>
                    <input type="text" readonly autofocus class="form-control" name="current_stock_unit"  id="current_stock_unit" value="<?php if(isset($records->current_stock_unit)) echo $records->current_stock_unit ?>" style="font-weight: bold; text-transform: uppercase;color:red;background: white;">
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
          <a href="<?php echo base_url(); ?>Damage"  <button type="button" class="btn btn-danger">Cancel</button></a>
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

