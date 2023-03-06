<style type="text/css">
   .fsize
  {
    font-size: 14px;
    font-family: 'Rubik', sans-serif;
  }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     Stock Return Form
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>BProduct/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/BProduct/add_return" enctype="multipart/form-data">
    <section class="content">
    <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
            </div>
            <div class="box-body"><div class="col-lg-2"></div>
              <div class="col-lg-8">
             <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>NEW  Stock Return</b></h3>
                </div>
                  <div class="panel-body" style="font-weight:bold;">
                  <input type="hidden" name="return_id" value="<?php if(isset($records->return_id)) echo $records->return_id ?>"/>
                  <input type="hidden" autofocus class="form-control" name="bproduct_id_fk" id="bproduct_id_fk" value="<?php if (isset($records->return_bproduct_id_fk)) echo $records->return_bproduct_id_fk ?>">

                  <input type="hidden" autofocus class="form-control" name="return_stock1" id="return_stock1" value="<?php if (isset($records->return_stock)) echo $records->return_stock ?>">

                  <div class="form-group">
                  <div class="col-md-6">
                         <label>Date<span style="color:red"></span></label>
                         <input type="date" autofocus class="form-control" name="return_date" id="" value="<?php if (isset($records->return_date)) echo $records->return_date ?>">
                       </div>
                  </div>

                  <div class="form-group">
                       <div class="col-md-6">
                         <label>Product Name</label>
                         <select class="form-control" name="prod_name" id="prod_name">
                          <option value="">SELECT</option>
                          <?php foreach($product as $pr){ ?>
                            <option <?php if(isset($records->return_product_id_fk)){if($records->return_product_id_fk==$pr->product_id){echo "selected";}} ?> value="<?php echo $pr->product_id ?>"><?php echo $pr->product_name ?></option>
                          <?php } ?>  
                         </select>
                       </div>

                       <div class="col-md-6">
                         <label>Stock Amount<span style="color:red"></span></label>
                         <input type="text" autofocus class="form-control" name="return_stock" id="" value="<?php if (isset($records->return_stock)) echo $records->return_stock ?>">
                       </div>

                  </div>

                  <div class="form-group">
                       <div class="col-md-12">
                         <center><small >Available Stock: <span id="av_stk"></span></small></center>
                       </div>
                     </div>
                   </div>
                
            <!-- /.box-header -->
          </div>

          <div class="box-footer">
          <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-4">
          <a href="<?php echo base_url(); ?>BProduct"  <button type="button" class="btn btn-danger">Cancel</button></a>
          <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </div>
          </div>

        </div>
      </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
             <br>
        
     </div>
    </section>
  </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
  function getsubcat()
  {
   var type= document.getElementById("product_type").value;
   ///alert(type);
   if(type==3)
   {
    document.getElementById("product_sub_type").style.display = "block";
   }
   else
   {
    document.getElementById("product_sub_type").style.display = "none";
   }
  }
</script>
