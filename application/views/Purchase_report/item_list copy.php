

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item Purchase Report
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="<?php echo base_url();?>Purchase/add"><i class="fa fa-dashboard"></i> Back to Add</a></li> -->
        <li class="active">Item Purchase Report</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		
		<div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <div class="col-md-8"><h2 class="box-title"></h2> </div>
			   -->
         <div class="col-md-12">
         <div class="row" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
			<div class="col-md-4">
			   <div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Product</button>
					</div>
					<select name="product_id" class="form-control select" id="product_id">
                        <option value="">SELECT</option>
                        <?php foreach($product as $product_list){ ?>
                        <option value="<?php echo $product_list->product_name ?>"><?php echo $product_list->product_name ?></option>
                        <?php } ?>
                    </select>
				</div>
			</div>
	
      <div class="col-md-3">
				<div class="input-group margin">
					<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">From </button>
					</div><!-- /btn-group -->
					<input id="pmsDateStart" type="date" name="start_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
						
				
				</div>
			</div>

      <div class="col-md-3">
				<div class="input-group margin">
					<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">To </button>
					</div><!-- /btn-group -->
						
					<input id="pmsDateEnd" type="date" name="end_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
				</div>
			</div>
					
			<div class="col-sm-2">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
				
					<a href="<?php echo base_url();?>Purchase_Report/suppilerPurchase"><button class="btn bg-navy btn-flat margin" >Refresh</button></a>
				</div>
			</div>
		</div>
            </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body table-responsive" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
            <div class="col-md-12">
              <table id="sale_details_table" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>SINO</th>
					<th>INVOICE_NO</th>
					<th>PRODUCT NAME</th>
          <th style="text-align:center;">PURCHASE_QTY</th>
          <th style="text-align:center;">PURCHASE_PRICE</th>
          <th style="text-align:center;">TOTAL</th>
					<th>PURCHASE DATE</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align:center;font-weight:bold;">TOTAL</td>
                        <td  style="text-align:center;font-weight:bold;"></td>
                        <td style="text-align:center;font-weight:bold;"></td>
                        <td style="text-align:center;font-weight:bold;"></td>
                        <td></td>
                    </tr>
                        </tfoot>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
	</div>
   </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






