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
      <center> Sundry Debtors</center>
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sundry Debtors</li>
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

                        <div class="col-md-12">

                            <div class="row">
                            <div class="col-md-8"></div>
                               

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <a class="btn btn-primary" onclick="printDiv();"><i class="fa fa-print"></i> Print</a>
                                        &nbsp;&nbsp;
                                        <div class="dropdown" style="margin-top:1px;float:right">
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
               
               

                <!-- /.box-header -->
                      <br>                                                                                                                              
                <div class="box-body table-responsive" style="font-size:15px;color:black;">
                    <div id="divName">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-hover" id="dataTable1" style="border:1px solid #0a0a0b;">
                                <thead style="border:1px solid #0a0a0b;">
                                <tr>
                                    <th colspan="5" style="border:1px solid #0a0a0b;text-align:center;">
                                    GREENHIGHRANGE FARMERS PRODUCER CO. LTD.<br>
                                        106/14 VAKACHUVADU, PRABHACITY
                                    </th>
                                </tr>
                              
                                    <tr style="border:1px solid #0a0a0b;">
                                    <th style="border:1px solid #0a0a0b;">SL.NO</th>
                                    <th style="border:1px solid #0a0a0b;">NAME</th>
                                    <th style="border:1px solid #0a0a0b;">OPENING_BALANCE</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;">Cr.AMT</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;">Dr.AMT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    $tasx = 0;
                                    $tot=0;
                                    $net=0;
                                    foreach ($records as $row) {
                                        if($this->session->userdata('user_type')=="A")
                                        {
                                            $old_bal=$row->member_old_balance;
                                            $current_bal=$row->member_sale_balance;
                                        }
                                        else if($this->session->userdata('user_type')=="B")
                                        {
                                            $old_bal=$row->member_branch_old_balance;
                                            $current_bal=$row->member_branch_sale_balance;
                                        }
                                    if($old_bal!=0 || $current_bal!=0)
                                    {
                                        $i=$i+1;
                                    ?>
                                        <tr style="border:1px solid #0a0a0b;">
                                            <td style="border:1px solid #0a0a0b;"><?php echo $i; ?></td>
                                            <td style="border:1px solid #0a0a0b;"><?php echo $row->member_name; ?></td>
                                            <td style="border:1px solid #0a0a0b;"><?php   echo $old_bal; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php //echo $row->bamount; ?></td>
                                           <!--  <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo ($old_bal+ $current_bal)-($row->bamount+$row->ramount); ?></td> -->
                                           <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo ($old_bal+ $current_bal); ?></td>
                                        </tr>
                                    <?php $tot=$tot+$old_bal;$net=$net+($old_bal+ $current_bal);}} ?>
                                    

                                </tbody>
                                <tfoot>
                                    <tr style="color:red;font-weight:bold;">
                                        <td style="border:1px solid #0a0a0b;" colspan="2">TOTAL</td>
                                        <td style="border:1px solid #0a0a0b;"><?php echo $tot; ?></td>
                                        <td style="border:1px solid #0a0a0b;"></td>
                                        <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo $net; ?></td>
                                    </tr>

                                    </tfoot>
                               
                               
                            </table>
                        </div>
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