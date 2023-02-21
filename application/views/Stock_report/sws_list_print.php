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
            Supplier Wise Stock Report
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Supplier Wise Report</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
                    <form name="" method="post" action="<?php echo base_url(); ?>Stock_Reports/saleWisestock1">
                    <div class="col-md-12">
                    <div class="row" style="border:1px solid #dee2e6;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
            <div class="col-md-5">
                <div class="input-group margin">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary nohover">Supplier</button>
                    </div><!-- /btn-group -->
                    <select name="vendor_id" class="form-control select" id="vendor_id">
                        <option value="">SELECT</option>
                        <?php foreach($supplier as $supplier_list){ ?>
                        <option <?php if (isset($vendor_id)) {if ($vendor_id == $supplier_list->vendor_id) {echo "selected";  } } ?> value="<?php echo $supplier_list->vendor_id ?>"><?php echo $supplier_list->vendorname ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group margin">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary nohover">Date </button>
                    </div><!-- /btn-group -->

                    <input type="date" data-validation-optional="true" name="start_date" id="pmsDateStart" class="col-md-5 form-control" placeholder="dd/mm/yyyy" value="<?php if (isset($cdate)) {echo $cdate; } ?>">
                                                                                                                                                               
                                                                                                                                                                    
                  
                </div>
            </div>

                 

                    <div class="col-md-3">
                                    <div class="input-group">
                                        <button type="submit" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button>
                                       <a href="<?php echo base_url(); ?>Stock_Reports/saleWisestock"><button class="btn bg-navy btn-flat margin">Refresh</button></a>
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
                    </div>
                </div><!--col-md-12-->
                </form>
              
                <!-- /.box-header -->
                
                <div class="box-body table-responsive">
                <div id="divName">
                <div class="col-md-12">
                    <table id="dataTable1" class="table table-bordered table-info table-hover">
                        <thead  style="box-shadow: 0px 2px 10px 0px rgb(53 44 44 / 75%);border:1px solid #dee2e6;">
                            <tr>
                                <th style="border:1px solid #dee2e6;" class="text-center">SINO</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">INVOICE</th>
                                <th style="border:1px solid #dee2e6;">PURCHASE_DATE</th>
                                <th style="border:1px solid #dee2e6;">ITEM_NAME</th>
                                <th style="border:1px solid #dee2e6;">PRODUCT_CODE</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">PURCHASE_QTY</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">CURRENT_STOCK</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">PURCHASE_RATE</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">TOTAL</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">SALE_RATE(R1)</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">SALE_RATE(R2)</th>
                                <th style="border:1px solid #dee2e6;" class="text-center">SALE_RATE(R3)</th>
                                <th style="border:1px solid #dee2e6;">SUPPLIER</th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php $i = 1;
                                    $qty = 0;
                                    $pqty=0;
                                    $pprice=0;
                                    $total=0;
                                    $sprice=0;
                                    foreach ($records as $row) { ?>
                                        <tr>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $i; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->invoice_number; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->purchase_date; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->product_name; ?></td>
                                            <td style="border:1px solid #dee2e6;"><?php echo $row->product_code; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_quantity; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->product_stock; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_price; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo ($row->product_stock)*($row->purchase_price); ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_selling_price_r1; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_selling_price_r2; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->purchase_selling_price_r2; ?></td>
                                            <td style="border:1px solid #dee2e6;" class="text-center"><?php echo $row->vendorname; ?></td>
                                        </tr>
                                    <?php $i++;
                                        $pqty = $pqty + $row->purchase_quantity;
                                        $qty = $qty + $row->product_stock;
                                        $pprice = $pprice + $row->purchase_price;
                                        $total = $total + ($row->product_stock * $row->purchase_price);
                                        $sprice = $sprice + $row->purchase_selling_price_r1;
                                    } ?>

                                </tbody>
                                <tr style="box-shadow: 0px 2px 10px 0px rgb(53 44 44 / 75%);border:1px solid #dee2e6;">
                                            <th style="border:1px solid #dee2e6;" class="text-center"></th>
                                            <th style="border:1px solid #dee2e6;" class="text-center"></th>
                                          
                                <th style="font-weight:bold;border:1px solid #dee2e6;">TOTAL</th>
                                <th  style="text-align:center;font-weight:bold;border:1px solid #dee2e6;"><?php echo $pqty; ?></th>
                                <th style="text-align:center;font-weight:bold;border:1px solid #dee2e6;"><?php echo $qty; ?></th>
                                <th style="text-align:center;font-weight:bold;border:1px solid #dee2e6;"><?php echo number_format((float)$pprice, 2, '.', ''); //echo $pprice; ?></th>
                                <th style="text-align:center;font-weight:bold;border:1px solid #dee2e6;"><?php echo number_format((float)$total, 2, '.', ''); //echo $total; ?></th>
                                <th style="border:1px solid #dee2e6;"></th>
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
