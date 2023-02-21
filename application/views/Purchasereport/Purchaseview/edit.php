<?php $arTax = array(""=>'---Please Select---',1=>'Yes',2=>'No') ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Purchase/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Purchase Form</li>
      </ol>
    </section>

     <!-- Main content -->
 <form class="form-horizontal" method="POST" action="<?php echo base_url();?>purchase/edit/<?php echo $records[0]->purchase_id; ?>">
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
			       
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <!-- radio -->
               <div class="form-group">
			   <input type="hidden" id="purchase_id" name="purchase_id" value="<?php if(isset($records[0]->purchase_id)) echo $records[0]->purchase_id ?>" />
			   <input type="hidden" id="invoice_number" name="invoice_number" value="<?php if(isset($records[0]->invoice_number)) echo $records[0]->invoice_number ?>" />
			   
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label> 
                </div>
                <div class="box-body">
                    <div class="form-group">
						
						<label for="product_name" class="col-sm-2 control-label">Product Name </label>
						<div class="col-sm-4">
							<input type="hidden"  id="product_name"  value="<?php if(isset($records[0]->product_id)) echo $records[0]->product_id ?>">
							<?php echo form_dropdown('product_id', $product_names,'', 'id="product_id_fk" class="form-control select2"  data-pms-required="true" data-pms-type="dropDown"', 'name="product_id"');?>
						</div>
						<label for="vendor_name" class="col-sm-2 control-label">Vendor Name </label>
						<div class="col-sm-4">
							<input type="hidden"  id="vendor_name"   value="<?php if(isset($records[0]->vendor_id)) echo $records[0]->vendor_id ?>">
							<?php echo form_dropdown('vendor_id', $vendor_names,'', 'id="vendor_id_fk" class="form-control select2"  data-pms-required="true" data-pms-type="dropDown"', 'name="vendor_id"');?>
								
						</div>
					 </div>
                   
                    <div class="form-group">
						
						<label for="purchase_quantity" class="col-sm-2 control-label">Purchase Quantity</label>
						<div class="col-sm-4">
							<input type="text"  id="purchase_quantity" data-pms-required="true" class="form-control" name="purchase_quantity" placeholder="Purchase Quantity" value="<?php if(isset($records[0]->purchase_quantity)) echo $records[0]->purchase_quantity ?>">	
						</div>
						<label for="purchase_price" class="col-sm-2 control-label">Purchase Price</label>
                        <div class="col-sm-4">
							<input type="text" data-pms-required="true" id="purchase_price" data-pms-required="true" class="form-control" name="purchase_price" placeholder="Purchase Price" value="<?php if(isset($records[0]->purchase_price)) echo $records[0]->purchase_price ?>">
                        </div>
					</div>
					<div class="form-group">
						<label for="product_name" class="col-sm-2 control-label">Tax</label>
                        <div class="col-sm-4">
                            <input type="hidden" id="tax_id"  value="<?php if(isset($records[0]->tax_id)) echo $records[0]->tax_id ?>">
							<?php echo form_dropdown('tax_id', $tax_names,'', 'id="tax_id_fk" class="form-control select2"  data-pms-required="true" data-pms-type="dropDown"', 'name="tax_id"');?>
						</div>
                    </div>
              </div>
              <!-- /.box-footer -->
            
          </div>
          <!-- /.box -->
			<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                      <button type="submit" class="btn btn-primary" onclick="addMore();">Save</button>
                    </div>
                  </div>
			</div>
        </div>
        <!--/.col (right) -->
     </div>

    </section>
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->