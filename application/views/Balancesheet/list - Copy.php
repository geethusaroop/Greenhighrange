<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        </a></li>
        <li class="active"></li>
      </ol>
    </section>
<br/>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
              <div class="form-group">
                   <label for="product_fit" class="col-sm-2 control-label"><font color="white">date</font></label>
                  <div class="col-sm-4">
                    <b>FROM DATE</b><input type="date" placeholder ="from date" class="form-control"  id="fdate" name="fromdate" value="<?php if(isset($records->exp_date)) { $exp_date = str_replace('-', '/', $records->exp_date); $exp_date =  date("d/m/Y",strtotime($exp_date)); echo $exp_date;}?>">
                  </div>
                   <div class="col-sm-4">
                    <b>TO DATE</b><input type="date" class="form-control" placeholder ="from date" id="tdate" name="todate" value="<?php if(isset($records->exp_date)) { $exp_date = str_replace('-', '/', $records->exp_date); $exp_date =  date("d/m/Y",strtotime($exp_date)); echo $exp_date;}?>">
                  </div>

                  <div class="col-sm-4">
                    <b>SELECT BRANCH</b>
                    <select class="form-control" id="branchid">
                      <?php for($i=0;$i<count($branch);$i++){ ?>
                        <option value="<?php echo $branch[$i]->shpid; ?>"><?php echo $branch[$i]->shpname; ?>
                        </option> <?php } ?>
                      </select>
                 </div>

            </div>              
          </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

               <center><b><h2>BALANCE SHEET FOR ARCHANA WOMEN'S CENTER AS AT <?php echo date("Y"); ?> </h2></b></center>
                <table style="width: 500px;" class="table table-bordered table-striped">
                <tr>
               
                 
                  <th>Liabilities</th>
                  <th></th>
                  <th>Amount</th>
                   <th></th>                 
				        </tr>
                <?php
                
                foreach($debit as $row){
                 
                 
                 echo '<tr>
                  <td>'.$row->ledgerbuk_head.'</td>
                  <td></td>
                  <td>'.$row->debit.'</td>
      
                </tr>';
                
                  }

                  if($sum[0]->debit_sum < $sum[0]->credit_sum){

                  $pr = $sum[0]->credit_sum - $sum[0]->debit_sum;
                  $total = $sum[0]->debit_sum + $pr;
                    echo '
                    <tr>
                    <td>Total Liablities</td>
                    <td>'.$sum[0]->debit_sum.'</td>
                    </tr>
                    
                    <tr>
                    <td>profit</td>
                    <td>'.$pr.'</td>
                    </tr>';
                    }
                   
                  
                
                //  echo '<tr>
                //  <td><b>Total</b></td>
                //  <td></td>
                //  <td><b>'.$sum[0]->debit_sum.'</b></td>
                //  </tr>';
                ?>

               

                
               </table>
               <table style="margin-left: 600px;margin-top: -600px;width: 500px;" class="table table-bordered table-striped">
                <tr>
            
      
                  <th>Assets</th>
                  <th></th>
                  <th>Amount</th>
                   <th></th>                 
				        </tr>
                <?php
                
                foreach($credit as $row){
                 
                 
                 echo '<tr>
                  <td>'.$row->ledgerbuk_head.'</td>
                  <td></td>
                  <td>'.$row->credit.'</td>
      
                </tr>';
                
                  }

                  if($sum[0]->credit_sum < $sum[0]->debit_sum){

                  $pr = $sum[0]->debit_sum - $sum[0]->credit_sum;
                  $total = $sum[0]->credit_sum + $pr;
                    echo '
                    <tr>
                    <td>Total Assets</td>
                    <td>'.$sum[0]->credit_sum.'</td>
                    </tr>
                    
                    <tr>
                    <td>loss</td>
                    <td>'.$pr.'</td>
                    </tr>
                    <tr>';
               
                    }
                  
                  
                
                //  echo '<tr>
                //  <td><b>Total</b></td>
                //  <td></td>
                //  <td><b>'.$sum[0]->debit_sum.'</b></td>
                //  </tr>';
                ?>

               

                
               </table>
              <table class="table table-bordered table-striped">

              <tr>
                <td><b>Total</b></td>

                <?php
                 
                 if($sum[0]->debit_sum < $sum[0]->credit_sum){
                  $pr = $sum[0]->debit_sum - $sum[0]->credit_sum;
                  $total = $sum[0]->credit_sum + $pr;
                 }
                  if($sum[0]->credit_sum < $sum[0]->debit_sum){
                   
                    $pr = $sum[0]->debit_sum - $sum[0]->credit_sum;
                    $total = $sum[0]->credit_sum + $pr;
                  
                 }

                 echo '<td><b>'.$total.'</b></td>
                 <td><b>'.$total.'</b></td>';
                 
                ?>
             </tr>

              </table>
              
            </div>
            
          </div>
          <!-- /.box -->

         
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->





</script>


