 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Branch Transfer Information
       <small id="date" class="col-md-4"></small>
       <!-- <small>Optional description</small> -->
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url(); ?>Branch_transfer/"><i class="fa fa-dashboard"></i> Back to List</a></li>
       <li class="active"></li>
     </ol>
   </section>
   <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/Branch_transfer/add" enctype="multipart/form-data">
     <!-- Main content -->
     <section class="content">
       <div class="row">
         <!-- right column -->
         <div class="col-md-12">
           <!-- Horizontal Form -->
           <div class="box">
            
             <!-- /.box-header -->
             <!-- form start -->

             <!-- radio -->
             <div class="form-group">
               <input type="hidden" name="branch_id" value="<?php if (isset($records->branch_id)) echo $records->branch_id ?>" />
               <?php echo validation_errors(); ?>
               <label for="inputEmail3" class="col-sm-2 control-label"></label>
             </div>
             <div class="box-body">
               <div class="col-lg-1"></div>
               <div class="col-lg-10">
                 <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                   <div class="panel-heading">
                     <h3 class="panel-title"><b>BRANCH WISE STOCK TRANSFER INFORMATION</b></h3>
                   </div>
                   <div class="panel-body" style="font-weight:bold;">

                     <div class="form-group">
                       <div class="col-md-6">
                         <label>Product Name</label>
                         <select class="form-control" name="prod_name" id="prod_name">
                          <option value="">SELECT</option>
                          <?php foreach($product as $pr){ ?>
                            <option value="<?php echo $pr->product_id ?>"><?php echo $pr->product_name ?></option>
                          <?php } ?>  
                         </select>
                       </div>

                       <div class="col-md-6">
                         <label>Branch Name<span style="color:red"></span></label>
                         <select class="form-control" name="branch_name" id="branch_name">
                          <option value="">SELECT</option>
                          <?php foreach($branch as $br){ ?>
                            <option value="<?php echo $br->branch_id ?>"><?php echo $br->branch_name ?></option>
                          <?php } ?>  
                         </select>
                       </div>
                     </div>


                     <div class="form-group">
                       <div class="col-md-12">
                         <label>Stock Amount<span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="stck_amt" id="" value="<?php if (isset($records->branch_trade_licenses)) echo $records->branch_trade_licenses ?>">
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="col-md-12">
                         <center><small >Available Stock: <span id="av_stk"></span></small></center>
                       </div>
                     </div>
                   </div>

                 </div>
               </div>
             </div>

             <div class="box-footer">
               <div class="row">
                 <div class="col-md-6">
                 </div>
                 <div class="col-md-4">
                 <a href="<?php echo base_url(); ?>Branch"  <button type="button" class="btn btn-danger">Cancel</button></a>
                   <button type="submit" class="btn btn-primary">Save</button>
                 </div>
               </div>
             </div>

           </div>
           <!-- /.box-body -->

         </div>
         <!-- /.box -->

       </div>
       <!--/.col (right) -->
 </div>
 </section>
 </form>
 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->