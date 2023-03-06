
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
      <center>  Bank Balance</center>
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Bank Balance</li>
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

                    <form name="" method="post" action="<?php echo base_url(); ?>Bankdeposit/getbankbalance">
                        <div class="col-md-12">

                            <div class="row" style="border:ridge;border-radius:20px;box-shadow:2px 2px 2px 2px grey;">
                            <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <div class="input-group margin">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary nohover">From </button>
                                        </div><!-- /btn-group -->
                                        <select name="bd_bank_id_fk" id="bd_bank_id_fk" class="form-control">
                                                <option value="">-SELECT-</option>
                                                <?php foreach($bank as $row){ ?>
                                                    <option <?php if(isset($bank_a)){if($bank_a==$row->bank_id){echo "selected";}} ?> value="<?php echo $row->bank_id; ?>"><?php echo $row->bank_name; ?></option>
                                                <?php } ?>
                                                </select>
                                    </div>
                                </div>

                              
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <button type="submit" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if (isset($values->mainhead_id)) echo $values->mainhead_id; ?>">Search</button>
                                         <a href="<?php echo base_url(); ?>Bankdeposit/balance/"><button class="btn bg-navy btn-flat margin">Refresh</button></a>
                                     <!--    <a class="btn btn-primary" onclick="printDiv();"><i class="fa fa-print"></i> Print</a>
                                        &nbsp;&nbsp;
                                        <div class="dropdown" style="margin-top:10px;float:right">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Export
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dataExport" data-type="csv">CSV</a></li>
                                                <li><a class="dataExport" data-type="excel">XLS</a></li>
                                                <li><a  class="dataExport" data-type="txt">TXT</a></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                    <br> <br> <br>
                </div>

                <!-- /.box-header -->
                        <?php if(isset($bank_a)){ ?>                                                                                                                                    
                <div class="box-body table-responsive" style="font-size:15px;color:black;">
                    <div id="divName">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-hover" id="dataTable1" style="border:1px solid #0a0a0b;">
                                <thead style="border:1px solid #0a0a0b;">
                                <tr>
                                    <th colspan="6" style="border:1px solid #0a0a0b;text-align:center;">
                                    GREENHIGHRANGE FARMERS PRODUCER CO. LTD.<br>
                                        106/14 VAKACHUVADU, PRABHACITY
                                    </th>
                                </tr>

                                <tr>
                                    <th colspan="6" style="border:1px solid #0a0a0b;text-align:center;text-transform:uppercase;">
                                  <?php echo $records->bank_name; ?>
                                    </th>
                                </tr>
                               
                                    <tr style="border:1px solid #0a0a0b;">
                                    <th style="border:1px solid #0a0a0b;">DATE</th>
                                    <th style="border:1px solid #0a0a0b;">PARTICULAR</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;">CREDIT</th>
                                        <th style="border:1px solid #0a0a0b;text-align:right;">DEBIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                        <tr style="border:1px solid #0a0a0b;">
                                            <td style="border:1px solid #0a0a0b;font-weight:bold;"><?php echo date('d/m/Y',strtotime($records->bank_date)); ?></td>
                                            <td style="border:1px solid #0a0a0b;font-weight:bold;"><?php echo "OPENING BALANCE"; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;font-weight:bold;"><?php echo $records->bank_opening_balance; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"></td>
                                        </tr>

                                        <?php $bd1=0;
                                    foreach  ($record as $row) { ?>
                                        <tr style="border:1px solid #0a0a0b;">
                                            <td style="border:1px solid #0a0a0b;"><?php echo date('d/m/Y',strtotime($row->bd_date)); ?></td>
                                            <td style="border:1px solid #0a0a0b;"><?php echo "FPO DEPOSIT"; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo $row->bd_amount; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"></td>
                                        </tr>
                                    <?php 
                                        $bd1=$bd1+$row->bd_amount;
                                    } ?>

                                    <?php $bd2=0;
                                    foreach  ($record2 as $row) { ?>
                                        <tr style="border:1px solid #0a0a0b;">
                                            <td style="border:1px solid #0a0a0b;"><?php echo date('d/m/Y',strtotime($row->bd_date)); ?></td>
                                            <td style="border:1px solid #0a0a0b;text-transform:uppercase;"><?php echo "PAYMENT TO VENDOR -". $row->vendorname; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo $row->bd_amount; ?></td>
                                        </tr>
                                    <?php 
                                            $bd2=$bd2+$row->bd_amount;
                                    } ?>

                                    <?php $bd3=0;
                                    foreach  ($record1 as $row) { ?>
                                        <tr style="border:1px solid #0a0a0b;">
                                            <td style="border:1px solid #0a0a0b;"><?php echo date('d/m/Y',strtotime($row->bd_date)); ?></td>
                                            <td style="border:1px solid #0a0a0b;text-transform:uppercase;"><?php echo "MEMBER DEPOSIT -". $row->member_name; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo $row->bd_amount; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"></td>
                                        </tr>
                                    <?php 
                                        $bd3=$bd3+$row->bd_amount;
                                    } ?>
                                    

                                </tbody>
                               
                                    <tr style="border:1px solid #0a0a0b;">
                                        <td style="border:1px solid #0a0a0b;text-align:center;font-weight:bold;" colspan="2">TOTAL</td>
                                        <td style="border:1px solid #0a0a0b;text-align:right;font-weight:bold;"><?php echo $records->bank_opening_balance+$bd1+$bd3; ?></td>
                                        <td style="border:1px solid #0a0a0b;text-align:right;font-weight:bold;"><?php echo $bd2; ?></td>
                                    </tr>

                                    <tr style="border:1px solid #0a0a0b;">
                                        <td style="border:1px solid #0a0a0b;text-align:center;color:red;font-weight:bold;" colspan="2">BALANCE</td>
                                        <td style="border:1px solid #0a0a0b;text-align:center;color:red;font-weight:bold;"  colspan="2"><?php echo ($records->bank_opening_balance+$bd1+$bd3)-$bd2; ?></td>
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