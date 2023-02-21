<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Physical Stock Report
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Physical Stock Report</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
        <div class="row">
            <div class="box">

           

                <div class="box-header">
                    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
                    <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
                 <!--    <div class="col-md-8">
                        <h2 class="box-title"></h2>
                    </div> -->
                </div>
               <!--  <form name="" method="post" action="<?php echo base_url(); ?>Stock_Reports/physicalStock1"> -->
            <div class="col-md-12">
           
            <div class="row" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
            <div class="col-md-3">
                <div class="input-group margin">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary nohover">Product</button>
                    </div><!-- /btn-group -->
                    <select name="product_name" class="form-control select" id="product_name">
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
                        <button type="button" class="btn btn-primary nohover">Barcode List</button>
                    </div><!-- /btn-group -->
                    <select name="product_id" class="form-control select" id="pbar1">
                       
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

            <div class="col-md-4">
                <div class="input-group">
                    <!-- <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button> -->
                    <button type="button" id="search" class="btn bg-orange btn-flat margin">Search</button>
                    <a href="<?php echo base_url(); ?>Stock_Reports/physicalStock"><button class="btn bg-navy btn-flat margin">Refresh</button></a>

                    <a href="<?php echo base_url(); ?>Stock_Reports/physicalStocks" target="_blank"><button class="btn bg-info btn-flat margin">Print All</button></a>
                </div>
            </div>
        </div>
            
            </div>
           <!--  </form> -->
            <br> <br> <br>

                <!-- /.box-header -->
                <div class="box-body table-responsive" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;margin-top:68px;">
                <div class="col-md-12">
                    <table id="supplier_wise_report" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SINO</th>
                                <th>PRODUCT_NAME</th>
                                <th>BARCODE</th>
                                <th class="text-center">OPENING_STOCK</th>
<!--                                 <th>MIN STOCK</th>
 -->                                <th class="text-center">CURRENT_STOCK</th>
                                <th class="text-center">PURCHASE_PRICE</th>
                                <th class="text-center">SELLING_PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php /* $i=1; foreach($records as $row){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->product_name; ?></td>
                                </tr>
                            <?php $i++;}*/ ?>
                            
                        </tbody>
                      <!--   <tfoot>
                         <tr style="font-weight:bold;">
                        <td></td>
                        <td style="text-align:center;font-weight:bold;">TOTAL</td>
                        <td></td><td></td>
                        <td style="text-align:center"></td>
                    </tr>
                        </tfoot> -->
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