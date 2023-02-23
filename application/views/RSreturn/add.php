<style type="text/css">
   .fsize
  {
    font-size: 14px;
    font-family: 'Rubik', sans-serif;
  }
</style>
<style>
.democlass {
  display: block;
  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
}
</style>
<style>
h4 {
  display: flex;
  flex-direction: row;
}
h4:before,
h4:after {
  content: "";
  flex: 1 1;
  border-bottom: 2px solid #000;
  margin: auto;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Stock Return
         <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>RSreturn/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active"></li>
      </ol>
    </section>
     <!-- Main content -->
     <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/RSreturn/add" enctype="multipart/form-data">
    <section class="content">
    <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
            </div>
            <div class="box-body">
              
              <div class="row">  
                 <div class="col-lg-1"></div>
                <div class="col-lg-10">
                      <div class="panel panel-danger" style="box-shadow: 2px 2px 2px 2px black;">
                                    <div class="panel-heading">
                                      <h3 class="panel-title"><b>Routsale Stock - Return To Main Stock</b></h3>
                                    </div>
                                    <div class="panel-body" style="font-weight:bold;">

                                    <div class="form-group row">
                                    <div class="col-md-4">
                                    <label class="fsize">Date<span style="color:red"> *</span></label>
                                    <input type="date" autofocus class="form-control" name="routsale_return_date" id="routsale_return_date"  required value="<?php echo date('Y-m-d'); ?>"  style="background:white;">
                                    </div>
                                    </div>
                                
                                  <div class="table-responsive">
                                  <table class="table table-striped table-bordered tc-table footable" style="border:1px solid #ccc;color:black;">
                                    <thead>
                                      <tr style="color: black;text-transform: uppercase;">
                                        <th style="border:1px solid #ccc;" width="25" class="col-small center ">SlNo</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Name</th>
                                        <th style="border:1px solid #ccc;" width="45">Product_Code</th>
                                        <th style="border:1px solid #ccc;text-align: right;" width="72">Total Stock</th>
                                        <th style="border:1px solid #ccc;text-align: right;" width="45">Total_Item_Saled</th>

                                        <th style="border:1px solid #ccc;text-align: right;" width="45">Return_Stock</th>

                                      </tr>
                                    </thead>
                                    <tbody  style="background: #ffff;">
                                    <?php  $i=0; foreach($records as $row){$i=$i+1; ?> 
                                      <TR style="border:1px solid #ccc;background: #ffff;">
                                        <TD style="color:black;"> <?php echo $i; ?><INPUT type="hidden" class="form-control"  name="product_id_fk[]" id="product_id_fk" value="<?php echo $row->product_id; ?>"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="prod_code[]" id="product_code" value="<?php echo $row->product_code; ?>"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  name="prod_name[]" id="prod_name" value="<?php echo $row->product_name; ?>"/> </TD>
                                          <TD> <INPUT type="text" class="form-control" style="text-align: right;"  name="routsale_stock[]" id="routsale_stock" value="<?php echo $row->routsale_stock; ?>"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  style="text-align: right;" name="routsale_sale_count[]" id="routsale_sale_count" value="<?php echo $row->routsale_sale_count; ?>"/> </TD>
                                          <TD> <INPUT type="text" class="form-control"  style="text-align: right;" name="routsale_return_stock[]" id="routsale_return_stock" value="<?php echo ($row->routsale_stock-$row->routsale_sale_count); ?>"/> </TD>
                                        </TR>
                                        <?php } ?>
                                      </table>
                                      </div>
                                    </table>

                              
                                  </div>
                        </div>
                </div>

              </div>



            <!-- /.box-body -->
          </div>
          <!-- /.box -->
             <br>
          <div class="box-footer">
          <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-4">
          <a href="<?php echo base_url(); ?>RSreturn"  <button type="button" class="btn btn-danger">Cancel</button></a>
          <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </div>
          </div>
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
