
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ledger
       <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>GLedger/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">  Ledger</li>
      </ol>
    </section>
   
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
        	  <form name="" method="post" action="<?php echo base_url(); ?>GLedger/getledger">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
			  
				<div class="col-md-3">
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover">Ledger Head</button>
						</div><!-- /btn-group -->
					<!--<input type="text"  class="form-control"  id="ledgerbuk_head"  placeholder="Ledger Head">-->
					<select name="ledgerbuk_head"  class="form-control"  id="ledgerbuk_head">
						<option value="">-SELECT LEDGER HEAD-</option>
						<?php foreach($ledger as $row){?>
							<option <?php if(isset($head)){if($head==$row->head){echo "selected";}} ?> value="<?php echo $row->head; ?>"><?php echo $row->head; ?></option>
						 <?php } ?>
					</select>
				</div><!-- /input-group -->
				</div>
			<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">From</button>
					</div><!-- /btn-group -->
						<input type="text"  name="start_date" id="month" class="col-md-5 form-control" placeholder="dd/mm/yyyy" value="<?php if(isset($cdate)){echo date('d-m-Y',strtotime($cdate));} ?>">
						
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">To</button>
					</div><!-- /btn-group -->
						<input type="text" name="end_date" id="edate"  class="col-md-5 form-control" placeholder="dd/mm/yyyy"  value="<?php if(isset($edate)){echo date('d-m-Y',strtotime($edate));} ?>">
						
				</div>
			</div>
			<div class="col-sm-1">
					<div class="input-group">
						<button type="submit" id="search" class="btn bg-orange btn-flat margin" >Search</button>
					</div>
			</div>

            </div>
              </form>
              <hr>
            <!-- /.box-header -->
            <?php if(isset($gid) && isset($cdate) && isset($edate)){ ?>
            	<div class="col-lg-1"></div>
            <div class="box-body col-lg-10">
			
              <table class="table table-bordered table-striped" style="border-color:#d4d6d5;" width="100%">
                <thead>
                <tr>
                  <th style="border-color:#d4d6d5;">SL.NO</th>
				  <th style="border-color:#d4d6d5;">DATE</th>
				  <th style="border-color:#d4d6d5;">PARTICULARS</th>
                  <th style="border-color:#d4d6d5;text-align: center;">CREDIT</th>
				  <th style="border-color:#d4d6d5;text-align: center;">DEBIT</th>
                </tr>
                
                </thead>
                <tbody>
                	<?php 
                	
                	$i=0;
                	foreach($data as $value)
                	{
                		$i=$i+1;
                		?>
                		<tr style="font-weight: bold;">
                			<td style="border-color:#d4d6d5;"><?php  echo $i;?></td>
                			<td style="border-color:#d4d6d5;"><?php  echo date('d-m-Y',strtotime($value->date));?></td>
                			<td style="border-color:#d4d6d5;"><?php  echo $value->ledgerbuk_head;?></td>
                			<td style="border-color:#d4d6d5;text-align: center;"><?php  echo $value->credit;?></td>
                			<td style="border-color:#d4d6d5;text-align: center;"><?php  echo $value->debit;?></td>

                		</tr>
                		<?php
                	}
               
                	?>
                </tbody>
				 
			 </table>
			
            </div>
            <!-- /.box-body -->
        <?php } ?>
			<br><br>	<br><br>	<br><br>	<br><br>	<br><br>	<br><br>	<br><br>	  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>    <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>  <br><br>
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




