<script>
 /*$(document).on('click','#print', function(){
       var divContents = $("#invcont").html();
       var printWindow = window.open('', '', 'height=300,width=400');
       //printWindow.document.write('<html><head>');
       //printWindow.document.write('<body>');
       printWindow.document.write(divContents);
       //printWindow.document.write('</body>');
       printWindow.document.close();
       printWindow.print();
  }); */

  function printDiv(divName) {
    var printContents = document.getElementById('divName').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

$(document).ready(function(){
  var array = '';
  $.ajax({
    type : 'POST',
    url : '<?php echo base_url().'index.php/Salekss/stockCountsss';?>',
    data: {},
    success: function(data) {
      var response = JSON.parse(data);
      //console.log(response);
      $.each(response, function(k, v) {
        array += "\n"+v.item_name+" : "+v.stock_balance+"";
        ;
      });
      alert(array)
    },
    error: function() {
    }
  });
})
</script>
