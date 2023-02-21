 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       Branch Information
       <small id="date" class="col-md-4"></small>
       <!-- <small>Optional description</small> -->
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url(); ?>Branch/"><i class="fa fa-dashboard"></i> Back to List</a></li>
       <li class="active"></li>
     </ol>
   </section>
   <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/Branch/add" enctype="multipart/form-data">
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
                     <h3 class="panel-title"><b>BRANCH INFORMATION</b></h3>
                   </div>
                   <div class="panel-body" style="font-weight:bold;">

                     <div class="form-group">
                       <div class="col-md-6">
                         <label>Branch Name</label>
                         <input type="text" autofocus class="form-control" name="branch_name" value="<?php if (isset($records->branch_name)) echo $records->branch_name ?>">
                       </div>

                       <div class="col-md-6">
                         <label>C/N Number<span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="branch_cn" value="<?php if (isset($records->branch_trade_licenses)) echo $records->branch_trade_licenses ?>">
                       </div>
                     </div>


                     <div class="form-group">
                       <div class="col-md-12">
                         <label>Address <span style="color:red"></span></label>
                         <textarea required class="form-control" name="branch_address" id="branch_address" rows="3"><?php if (isset($records->branch_address)) echo $records->branch_address ?></textarea>
                       </div>
                     </div>

                     <div class="form-group">
                       <div class="col-md-6">
                         <label>email <span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="branch_email" value="<?php if (isset($records->branch_email)) echo $records->branch_email ?>">
                       </div>
                       <div class="col-md-6">
                         <label>GSTN <span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="branch_gst" value="<?php if (isset($records->branch_gst)) echo $records->branch_gst ?>">
                       </div>
                     </div>

                     <div class="form-group">

                       <div class="col-md-6">
                         <label>Phone Number <span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="branch_phn" value="<?php if (isset($records->branch_phn)) echo $records->branch_phn ?>">
                       </div>

                       <div class="col-md-6">
                         <label>Phone Number 2<span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="branch_phn2" value="<?php if (isset($records->branch_phn2)) echo $records->branch_phn2 ?>">
                       </div>

                     </div>
                     <div class="form-group">

                       <div class="col-md-6">
                         <label>Web Address <span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="branch_web" value="<?php if (isset($records->branch_web_address)) echo $records->branch_web_address ?>">
                       </div>

                       <div class="col-md-6">
                         <label>Trade License<span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="branch_trade" value="<?php if (isset($records->branch_trade_licenses)) echo $records->branch_trade_licenses ?>">
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