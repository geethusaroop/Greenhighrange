<script>

  // $(document).on('click','#print', function(){
   //  var divContents = $("#invcontent").html();
    //  window.print();
   //});

  //   $(document).on('click','#print', function(){
  //      var divContents = $("#invcontent").html();
  //      var printWindow = window.open('', '', 'height=300,width=400');
  //      //printWindow.document.write('<html><head>');
  //      //printWindow.document.write('<body>');
  //      printWindow.document.write(divContents);
  //      //printWindow.document.write('</body>');
  //      printWindow.document.close();
  //      printWindow.print();
  // });


 
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}



  
</script>