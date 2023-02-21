<?php $arTax = array(""=>'---Please Select---',1=>'Yes',2=>'No') ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Group Members
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Purchase/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>

     <!-- Main content -->
 <form class="form-horizontal" method="POST" action="<?php echo base_url();?>purchase/add">
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
			       
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
		
            <!-- radio -->
               <div class="form-group">
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label> 
                </div>
                <div class="box-body">
                    <div class="form-group">
					
					<div class="col-sm-6 invoice-col">
					<strong>GROUP DETAILS</strong><br>
					 
					</div>
					
					 <div class="col-sm-4 invoice-col">
					 
					
						
					 </div>
					 <div class="pull-right">
					 <div class="col-sm-12 ">
					 
						
						
					 </div>
					 </div>
					 </div>	
                    </div>
                    <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
				<th>Slno</th>
				<th>Member Name</th>
				<th>Date</th>
				
            </tr>
            </thead>
            <tbody>
			<?php $sum = 0; for($i=0;$i<count($records);$i++){?>
			<tr>
				<td><?php echo $j = $i + 1;?></td>
				<td><?php if(isset($records[$i]->emp_name)){ echo $records[$i]->emp_name; }else{ echo "Members Not Added"; }?></td>
				<td><?php if(isset($records[$i]->att_date)) { echo $records[$i]->att_date; } ?> </td>
				
				<td>
				<?php } ?></td>
            </tr>
			
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
              </div>
              <!-- /.box-footer -->
            
          </div>
          <!-- /.box -->
			<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                    <button onclick="history.go(-1);">Back </button>
                    </div>
                  </div>
			</div>
        </div>
        <!--/.col (right) -->
     </div>

    </section>
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->