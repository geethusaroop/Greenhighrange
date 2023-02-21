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
              <center>       
  <form name="" method="post" action="<?php echo base_url(); ?>Balancesheet/get">
  <div class="row">
      
     <div class="col-md-2"></div> 
      <div class="col-md-4">
         <div class="input-group margin">
           <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Start Date</button>
          </div><!-- /btn-group -->
          <input type="text" name="cdate" id="month" class="form-control" value="<?php echo date('d-m-Y',strtotime($sdate));?>">
        </div><!-- /input-group -->
      </div>

      <div class="col-md-4">
         <div class="input-group margin">
           <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">End Date</button>
          </div><!-- /btn-group -->
          <input type="text" name="edate" id="edate" class="form-control" value="<?php echo date('d-m-Y',strtotime($edate));?>">
        </div><!-- /input-group -->
      </div>
      
          
      <div class="col-sm-1">
          <div class="input-group">
            <!--<button type="submit" id="search" name="search" class="btn bg-orange btn-flat margin" onclick="<?php //if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>-->
            <button type="submit" class="btn bg-orange btn-flat margin">Search</button>
          </div>
      </div>
      
    </div>
  </form>
  </center> 
            <!-- /.box-header -->
            <div class="box-body table-responsive">

               <center><b><h2>BALANCE SHEET FOR PEERMADE DEVELOPMENT SOCIETY AS AT <?php echo date("m-Y"); ?> </h2></b></center><hr>
               <div class="col-lg-6">
                <table class="table table-bordered table-striped">
                  <thead>
                <tr>
               
                 
                  <th>Liabilities</th>
                 
                  <th style="text-align: center;">Amount</th>
                           
                </tr>
              </thead>
                <tbody>
                <?php
                $m=0;
                $n=0;
                foreach($debit as $row){
                 ?>
                 
                <tr>
                  <td><?php echo $row->ledgerbuk_head; ?></td>
                 
                  <td style="text-align: center;"><?php echo $row->debit; ?></td>
      
                </tr>
                <?php
                $m=$m+$row->debit;
                  }

                //  if($sum[0]->debit_sum < $sum[0]->credit_sum){

                 // $pr = $sum[0]->credit_sum - $sum[0]->debit_sum;
                // $total = $sum[0]->debit_sum + $pr;
                  ?>

                   
                   <?php  //}?>
                   </tbody>
                    <tfoot>
                  <tr><td style="font-weight: bold;">Total Liabilities</td>
                    <td style="font-weight: bold;text-align: center;"><?php echo $m; ?></td></tr>
                    
                  </tfoot>
                   
              
                 
                
               </table>
               </div>
               <div class="col-lg-6">
               <table class="table table-bordered table-striped">
                <thead>
                <tr>
            
      
                  <th>Assets</th>
                  
                  <th style="text-align: center;">Amount</th>
                                    
                </tr>
                </thead>
                <tbody>
                <?php
                $n=0;
                foreach($credit as $row){ ?>
                 
                 
                 <tr>
                  <td><?php echo $row->ledgerbuk_head; ?></td>
                
                  <td style="text-align: center;"><?php echo $row->credit; ?></td>
      
                </tr>
                <?php
                $n=$n+$row->credit;
                  }

                 

                //  $pr = $sum[0]->debit_sum - $sum[0]->credit_sum;
                 // $total = $sum[0]->credit_sum + $pr;
                  ?>
                  </tbody>
                    <tfoot>
                  <tr><td style="font-weight: bold;">Total Assets</td>
                    <td style="font-weight: bold;text-align: center;"><?php echo $n; ?></td></tr>

                  

                  </tfoot>
               
                 

                
               </table>
               </div>
               <br><br><br><br><br><br><br><br><br><br><br>
                <div class="col-lg-3"></div>
               <div class="col-lg-6">
                 <table class="table table-bordered table-striped">
                    
                 <tfoot>
                  <tr><td style="font-weight: bold;">Total Liabilities</td>
                    <td style="font-weight: bold;text-align: center;"><?php echo $m; ?></td></tr>
                     <tr>
                    <td style="font-weight: bold;">profit</td>
                    <td style="font-weight: bold;text-align: center;"><?php if($n==0){echo $n=0;}else{echo $n-$m;} ?></td>
                    </tr>
                 
                  <tr><td style="font-weight: bold;">Total Assets</td>
                    <td style="font-weight: bold;text-align: center;"><?php echo $n; ?></td></tr>

                     <tr>
                    <td style="font-weight: bold;" style="font-weight: bold;">loss</td>
                    <td style="font-weight: bold;text-align: center;"><?php if($n==0){echo $m;}else{echo $m;} ?></td>
                    </tr>

                  </tfoot>
                 </table>
               </div>
              
              
            </div>
            
          </div>
          <!-- /.box -->

         
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>




<script>
$( document ).ready(function() {
    $("#month").datepicker({ 
        format: 'dd-mm-yyyy',
         // startView: "months", 
   // minViewMode: "months"
    });
   
}); 

$( document ).ready(function() {
    $("#edate").datepicker({ 
        format: 'dd-mm-yyyy',
         // startView: "months", 
   // minViewMode: "months"
    });
   
}); 

</script>
