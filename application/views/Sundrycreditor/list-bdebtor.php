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
                                    <button type="button" class="btn btn-success"  data-toggle="modal" data-target=".bd-example-modal-lg">Add Opening Balance</button>&nbsp;&nbsp;
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
                                    foreach ($records as $row) {$i=$i+1;
                                       
                                        if($this->session->userdata('user_type')=="B")
                                        {
                                            $old_bal=$row->bmb_opening_balance;
                                            $current_bal=$row->bmb_sale_balance;
                                        }
                                    
                                    ?>
                                        <tr style="border:1px solid #0a0a0b;">
                                            <td style="border:1px solid #0a0a0b;"><?php echo $i; ?></td>
                                            <td style="border:1px solid #0a0a0b;"><?php echo $row->member_name; ?></td>
                                            <td style="border:1px solid #0a0a0b;"><?php   echo $old_bal; ?></td>
                                            <td style="border:1px solid #0a0a0b;text-align:right;"><?php //echo $row->bamount; ?></td>
                                           <td style="border:1px solid #0a0a0b;text-align:right;"><?php echo ($old_bal+ $current_bal); ?></td>
                                        </tr>
                                    <?php 
                                    } ?>

                                </tbody>
                               
                               
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exampleModalLabel" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title"><b>Add Opening Balance</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Sundrycreditor/add_opening_balance" enctype="multipart/form-data">
      <div class="modal-body" style="font-weight: bold;">
    

<div class="form-group">

    <div class="col-md-4">
    <label>Member Name<span style="color:red"></span></label>
    <select name="bmb_member_id_fk" id="bmb_member_id_fk" class="form-control" style="font-weight: bold;">
                      <option value="">-SELECT-</option>
							<?php foreach($member as $row){ ?>
								<option <?php if(isset($records->bmb_member_id_fk)){if($records->bmb_member_id_fk==$row->member_id){echo "selected";}} ?> value="<?php echo $row->member_id; ?>"><?php echo $row->member_name."-".$row->member_mid; ?></option>
							<?php } ?>
                    </select>
    </div>


    <div class="col-md-4">
       <label>Date<span style="color:red"></span></label>
      <input type="date" data-pms-required="true" autofocus class="form-control" name="bmb_opening_date"  value="<?php echo "2021-03-31"; ?>">
    </div>
 <div class="col-md-4">
        <label>Opening Balance<span style="color:red"></span></label>
      <input type="text" data-pms-required="true" autofocus class="form-control" name="bmb_opening_balance"  value="">
    </div>
</div> 

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div><!--endds add dmlogin-->