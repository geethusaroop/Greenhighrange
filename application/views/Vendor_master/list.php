

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

      Vendor Details

        <small id="date" class="col-md-4"></small>

        <!-- <small>Optional description</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="<?php echo base_url();?>Vendor_master/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>

        <li class="active">Vendor Details</li>

      </ol>

    </section>



     <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="box">

            <div class="box-header">

            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->

              <div class="col-md-8"><h2 class="box-title"></h2> </div>

				

				

				<div class="col-md-2">

                  <a href="<?php echo base_url();?>Vendor_master/add" class="btn btn-danger"><i class="fa fa-plus-square"></i>  Add New</a>

				</div>

				

            </div>

            <!-- /.box-header -->

            <div class="box-body table-responsive">

              <table id="Vendor_table" class="table table-bordered table-striped">

                <thead>

                <tr>

                  <th>SINO</th>

				  <th>NAME</th>

                  <th>ADDRESS</th>

				  <th>PHONE</th>

          <th>EMAIL</th>

         <th>STATE & TIN</th>

				  <th>GST</th>

           <th>TAX TYPE</th>

				  <th>OLD BALANCE</th>

                  <th style="text-align: center;">EDIT/DELETE</th>

                </tr>

                </thead>

                <tbody>

                </tbody>

              </table>

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->



         

     </div>



    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->













