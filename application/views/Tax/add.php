<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Taxdetails

        <small id="date" class="col-md-4"></small>

        <!-- <small>Optional description</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="<?php echo base_url();?>Taxdetails/"><i class="fa fa-dashboard"></i> Back to View</a></li>

        <li class="active">Taxdetails</li>

      </ol>

    </section>

	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Taxdetails/add" >

     <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-md-12">

          <div class="box">

		  

		  <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

            

              <!-- radio -->

               <div class="form-group">

			   <input type="hidden" name="tax_id" value="<?php if(isset($records->tax_id)) echo $records->tax_id ?>"/>

                <?php echo validation_errors(); ?>

			    <div class="box-body">

              <div class="col-lg-2"></div>

              <div class="col-lg-8">

              <div class="panel panel-default" style="box-shadow:2px 2px 2px 2px black;">

                <div class="panel-heading">

                  <h3 class="panel-title"><b>TAX DETAILS</b></h3>

                </div>

                  <div class="panel-body" style="font-weight: bold;">

				<div class="form-group">

					  <label for="size_name" class="col-sm-4 control-label">Tax Name <span style="color:red">*</span></label>



					  <div class="col-sm-5">

						<input type="text"  required  class="form-control" name="taxname" id="taxname"  value="<?php if(isset($records->taxname)) echo $records->taxname ?>">

					  </div>

				</div>

                <div class="form-group">

					  <label for="size_name" class="col-sm-4 control-label">Tax Amount(%)</label>



					  <div class="col-sm-5">

						<input type="text"  required  class="form-control" name="taxamount" id="taxamount"  value="<?php if(isset($records->taxamount)) echo $records->taxamount ?>">

					  </div>

				</div>

				<div class="form-group">

					  <label for="size_name" class="col-sm-4 control-label">Tax Details</label>



					  <div class="col-sm-5">

						<textarea class="form-control" name="taxdetails" ><?php if(isset($records->taxdetails)) echo $records->taxdetails ?></textarea>

					  </div>

				</div>

                </div>

              <!-- /.box-body -->

              

            

		

          </div>

        </div></div></div>

          <div class="box-footer">                

                <div class="row">

                  <div class="col-md-5">

                  </div>

                  <div class="col-md-4">

                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>

                      <button type="submit" class="btn btn-primary">Save</button>

                    </div>

                  </div>

      </div>

          <!-- /.box -->

        </div>

		

        <!-- /.col -->

        </div>

      

    </section>

	

	</form>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->













