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
        Customer Sale Report
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Customer Sale Report</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
	
		<div class="row">
        <div class="box">
            <div class="box-header">
				<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
			  <div class="col-md-12">
        <form name="" method="post" action="<?php echo base_url(); ?>Sale_Report/cutomerSaleRport1">
     <div class="row" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
      <div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">From </button>
					</div><!-- /btn-group -->
						<input id="pmsDateStart" type="date" name="start_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy"   value="<?php if(isset($cdate)){echo $cdate;}?>">
					
				</div>
			</div>

      <div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">To </button>
					</div><!-- /btn-group -->
						
						<input id="pmsDateEnd" type="date" name="end_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy"   value="<?php if(isset($edate)){echo $edate;}?>">
				</div>
			</div>
					
		
      <div class="col-md-3">
                                    <div class="input-group">
                                        <button type="submit" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button>
                                         <a href="<?php echo base_url(); ?>Sale_Report/cutomerSaleRport"><button class="btn bg-navy btn-flat margin">Refresh</button></a>
                                        <a class="btn btn-primary" onclick="printDiv();"><i class="fa fa-print"></i> Print</a>
                                        &nbsp;&nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Export
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dataExport" data-type="csv">CSV</a></li>
                                                <li><a class="dataExport" data-type="excel">XLS</a></li>
                                                <li><a  class="dataExport" data-type="txt">TXT</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>



		</div>
        </form>
	</div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                    <div id="divName">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="dataTable1" style="border:1px solid #dee2e6;">
                         <thead style="box-shadow: 0px 2px 10px 0px rgb(53 44 44 / 75%);border:1px solid #dee2e6;">
                           <tr style="border:1px solid #dee2e6;">
                          <th style="border:1px solid #dee2e6;">SINO</th>
                          <th style="border:1px solid #dee2e6;">INVOICE</th>
                          <th style="border:1px solid #dee2e6;">DATE</th>
                          <th style="border:1px solid #dee2e6;">CUSTOMER.NAME</th>
                          <th style="border:1px solid #dee2e6;">PRODUCT.NAME</th>
                          <th style="border:1px solid #dee2e6;" class="text-center">PRODUCT.PRICE</th>
                          <th style="border:1px solid #dee2e6;" class="text-center">QTY</th>
                          <th style="border:1px solid #dee2e6;" class="text-center">TOTAL</th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                                    $qty = 0;
                                    $tot=0;
                                    $tprice =0;
                                    foreach ($records as $row) { ?>
                                        <tr>
                                            <td style="border:1px solid #dee2e6;"><?php echo $i; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->invoice_number; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->sale_date; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->member_name; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->product_name; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->sale_price; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->sale_quantity; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->sale_netamt; ?></td>
                                        </tr>
                                    <?php $i++;
                                        $qty = $qty + $row->sale_quantity;
                                        $tot = $tot + $row->sale_price;
                                        $tprice = $tprice + $row->sale_netamt;
                                    } ?>
                        </tbody>
               
                        <tr style="box-shadow: 0px 2px 10px 0px rgb(53 44 44 / 75%);border:1px solid #dee2e6;">
                        <th style="border:1px solid #dee2e6;"></th>

                        <th style="border:1px solid #dee2e6;"></th>

                        <th style="border:1px solid #dee2e6;"></th>
                        <th style="border:1px solid #dee2e6;"></th>

                        <th style="border:1px solid #dee2e6;" class="text-center">TOTAL</th>

                        <th style="border:1px solid #dee2e6;" class="text-center"><?php echo $tot; ?></th>

                        <th style="border:1px solid #dee2e6;" class="text-center"><?php echo $qty; ?></th>


                        <th style="border:1px solid #dee2e6;" class="text-center"><?php echo $tprice; ?></th>


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






