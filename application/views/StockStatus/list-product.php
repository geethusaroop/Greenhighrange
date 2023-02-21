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
       Production Unit-Stock Transfer History
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="<?php echo base_url();?>Purchase/add"><i class="fa fa-dashboard"></i> Back to Add</a></li> -->
        <li class="active"> Production Unit-Stock Transfer History</li>
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
                                      <th style="border:1px solid #dee2e6;">UNIT_NAME</th>
                                        <th style="border:1px solid #dee2e6;">DATE_OF_TRANSFER</th>
                                        <th style="border:1px solid #dee2e6;">PRODUCT NAME</th>
                                        <th style="text-align: left;border:1px solid #dee2e6;">PRODUCT CODE</th>
                                        <th style="text-align: center;border:1px solid #dee2e6;">TOTAL_QTY_TRANSFERED</th>
                                    </tr>
                                </thead>
                                  <tbody>
                                  <?php $i = 1;
                                    $qty = 0;
                                    $pprice=0;
                                    $tot=0;
                                    foreach ($records as $row) {

                                      if($row->punit_type==1)
                                      {
                                        $typem="MASALA UNIT";
                                      }
                                      else if($row->punit_type==2)
                                      {
                                        $typem="SPICES UNIT";
                                      }
                                      else if($row->punit_type==3)
                                      {
                                        $typem="OIL UNIT";
                                      }
                                      else if($row->punit_type==4)
                                      {
                                        $typem="PICKLE UNIT";
                                      }
                                
                                      else if($row->punit_type==5)
                                      {
                                        $typem="MISCELLANEOUS ITEMS";
                                      }
                                      
                                      ?>
                                        <tr>
                                            <td style="border:1px solid #dee2e6;"><?php echo $i; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $typem; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->punit_date; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->product_name; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->product_code; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->punit_qty; ?></td>
                                        </tr>
                                    <?php $i++;
                                        $qty = $qty + $row->punit_qty;
                                    } ?>

                                  </tbody>
                                      <tr style="box-shadow: 0px 2px 10px 0px rgb(53 44 44 / 75%);border:1px solid #dee2e6;">
                                      <th style="border:1px solid #dee2e6;"></th>
                                     <th style="border:1px solid #dee2e6;"></th>
                                     <th style="border:1px solid #dee2e6;"></th>
                                     <th style="border:1px solid #dee2e6;"></th>
                                    <th style="border:1px solid #dee2e6;" class="text-center">TOTAL</th>
                                    <th style="text-align:center;border:1px solid #dee2e6;"><?php echo $qty; ?></th>
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






