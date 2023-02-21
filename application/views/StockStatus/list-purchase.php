<style>
    table,
    tr td {
        border: 1px solid red
    }

    tbody {
        display: block;
        height: 400px;
        overflow: auto;
    }

    thead,
    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    thead {
        width: calc(100% - 1em)
    }

    tfoot tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    table {
        width: 400px;
    }

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Stock Purchase History
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="<?php echo base_url();?>Purchase/add"><i class="fa fa-dashboard"></i> Back to Add</a></li> -->
        <li class="active"> Stock Purchase History</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		
		<div class="row">
        <div class="box">
            <div class="box-header">
                     <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
                        <div class="col-md-12">
                       
                                <div class="row" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
                               
                                  <div class="col-md-3">
                                  <div class="input-group margin">
                                      <div class="input-group-btn">
                                        <button type="button" class="btn btn-default nohover">Product Name </button>
                                      </div><!-- /btn-group -->
                                        <input id="pmsDateStart" type="text" name="product_name" readonly class="col-md-5 form-control" style="font-weight:bold" value="<?php if(isset($record->product_name)){echo $record->product_name;}?>">
                                      
                                    </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="input-group margin">
                                      <div class="input-group-btn">
                                        <button type="button" class="btn btn-default nohover">Current Stock </button>
                                      </div><!-- /btn-group -->
                                        <input id="pmsDateStart" type="text" name="product_stock" readonly class="col-md-5 form-control" style="font-weight:bold" value="<?php if(isset($record->product_stock)){echo $record->product_stock;}?>">
                                      
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                         <a href="<?php echo base_url(); ?>StockStatus"><button class="btn bg-navy btn-flat margin">Go Back</button></a>
                                    </div>
                                </div>

		                            </div><!--row-->
                          
                      </div><!----------col-md-12--------------->
                              
			  
                    </div><!--boxheader-->
            
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                    <div id="divName">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="dataTable1" style="border:1px solid #dee2e6;">
                            <thead style="box-shadow: 0px 2px 10px 0px rgb(53 44 44 / 75%);border:1px solid #dee2e6;">
                                    <tr style="border:1px solid #dee2e6;">
                                    <th style="border:1px solid #dee2e6;">SINO</th>
                                    <th style="border:1px solid #dee2e6;">INVOICE_NO</th>
                                    <th style="border:1px solid #dee2e6;">PRODUCT NAME</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;">PURCHASE_QTY</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;">PURCHASE_PRICE</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;">SPRICE(R1)</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;">SPRICE(R2)</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;">SPRICE(R3)</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;">TOTAL</th>
                                    <th style="border:1px solid #dee2e6;">PURCHASE_DATE</th>
                                    </tr>
                                </thead>
                                  <tbody>
                                  <?php $i = 1;
                                    $qty = 0;
                                    $pprice=0;
                                    $tot=0;
                                    foreach ($records as $row) { ?>
                                        <tr>
                                            <td style="border:1px solid #dee2e6;"><?php echo $i; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->invoice_number; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->product_name; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_quantity; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_price; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_selling_price_r1; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_selling_price_r2; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_selling_price_r3; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->total_price; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->purchase_dates; ?></td>
                                        </tr>
                                    <?php $i++;
                                        $qty = $qty + $row->purchase_quantity;
                                        $pprice = $pprice + $row->purchase_price;
                                        $tot = $tot + $row->total_price;
                                    } ?>

                                  </tbody>
                                      <tr style="box-shadow: 0px 2px 10px 0px rgb(53 44 44 / 75%);border:1px solid #dee2e6;">
                                      <th style="border:1px solid #dee2e6;"></th>
                                     <th style="border:1px solid #dee2e6;"></th>
                                    <th style="border:1px solid #dee2e6;" class="text-center">TOTAL</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;"><?php echo $qty; ?></th>
                                    <th style="text-align:center;border:1px solid #dee2e6;"><?php echo $pprice; ?></th>
                                    <th style="border:1px solid #dee2e6;"></th>
                                    <th style="border:1px solid #dee2e6;"></th>
                                    <th style="border:1px solid #dee2e6;"></th>
                                    <th style="text-align:center;border:1px solid #dee2e6;"><?php echo $tot; ?></th>
                                    <th style="border:1px solid #dee2e6;"></th>
                                       
                                    </tr>
                              </table>
                          </div>
                    </div>
            </div>
            <!-- /.box-body -->
        </div>
	</div>
   </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






