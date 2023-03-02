<style>
    /* table,
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
    } */

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
      <center>  Purchase Register</center>
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Purchase Register</li>
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

                    <form name="" method="post" action="<?php echo base_url(); ?>Purchaseregister/getPurchaseReports">
                        <div class="col-md-12">

                            <div class="row" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
                            <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <div class="input-group margin">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary nohover">From </button>
                                        </div><!-- /btn-group -->
                                        <input id="pmsDateStart" type="date" name="start_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy" value="<?php if (isset($cdate)) {
                                                                                                                                                               } ?>">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group margin">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary nohover">To </button>
                                        </div><!-- /btn-group -->

                                        <input id="pmsDateEnd" type="date" name="end_date" class="col-md-5 form-control" placeholder="dd/mm/yyyy" value="<?php if (isset($cdate)) {
                                                                                                                                                                echo $cdate;
                                                                                                                                                            } ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <button type="submit" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button>
                                         <a href="<?php echo base_url(); ?>Purchaseregister/"><button class="btn bg-navy btn-flat margin">Refresh</button></a>
                                        <a class="btn btn-primary" onclick="printDiv();"><i class="fa fa-print"></i> Print</a>
                                        &nbsp;&nbsp;
                                        <div class="dropdown" style="margin-top:10px;float:right">
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
                    </form>
                    <br> <br> <br>
                </div>

                <!-- /.box-header -->
                        <?php if(isset($cdate) && isset($edate)){ ?>                                                                                                                                    
                <div class="box-body table-responsive" style="font-size:15px;color:black;">
                    <div id="divName">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-hover" id="dataTable1" style="border:1px solid #0a0a0b;">
                                <thead style="border:1px solid #0a0a0b;">
                                <tr>
                                    <th colspan="6"style="border:1px solid #0a0a0b;text-align:center;">Purchase Register From <?php echo date('d/m/Y',strtotime($cdate)) ?> To <?php echo date('d/m/Y',strtotime($edate)) ?></th>
                                </tr>
                                    <tr style="border:1px solid #0a0a0b;">
                                    <th style="border:1px solid #0a0a0b;">DATE</th>
                                    <th style="border:1px solid #0a0a0b;">NAME</th>
                                        <th style="border:1px solid #0a0a0b;">INVOICE_NO</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;">GROSS_AMT</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;">TAX</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;">NETTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $tasx = 0;
                                    $tot=0;
                                    $net=0;
                                    foreach ($records as $row) { ?>
                                        <tr style="border:1px solid #0a0a0b;">
                                            <td style="border:1px solid #0a0a0b;"><?php echo $row->purchase_date; ?></td>
                                            <td style="border:1px solid #0a0a0b;"><?php echo $row->vendorname; ?></td>
                                            <td style="border:1px solid #0a0a0b;"><?php echo $row->invoice_number; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo $row->total; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo $row->tax; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo ($row->total)+($row->tax); ?></td>
                                        </tr>
                                    <?php $i++;
                                        $tasx = $tasx + $row->tax;
                                        $tot = $tot + $row->total;
                                        $net = $net + ($row->total)+($row->tax);
                                    } ?>

                                </tbody>
                               
                                    <tr style="border:1px solid #0a0a0b;">
                                        <th style="border:1px solid #0a0a0b;text-align:center;" colspan="3">TOTAL</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;"><?php echo $tot; ?></th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;"><?php echo $tasx; ?></th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;"><?php echo $net; ?></th>
                                    </tr>
                               
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->