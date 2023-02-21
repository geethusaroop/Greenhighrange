<script>
        $table = $('#purchase_details_table').DataTable({
            "fixedHeader": true,
            "searching": false,
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "aLengthMenu": [
                [100, 200, 400],
                [100, 200, 400]
            ],
            "iDisplayLength": 100,
            "ajax": {
                "url": "<?php echo base_url(); ?>purchaseitem/getReturnList/",
                "type": "POST",
                "data": function(d) {
                }
            },
            "createdRow": function(row, data, index) {
                console.log(data);
                $table.column(0).nodes().each(function(node, index, dt) {
                    $table.cell(node).data(index + 1);
                });
            },
            "columns": [
                { "data": "purchase_status","orderable": false },
                { "data": "invoice_number","orderable": false },
                { "data": "vendorname","orderable": false },
                { "data": "purchase_dat","orderable": false },
                { "data": "product_name","orderable": false },
                { "data": "purchase_return","orderable": false },
                { "data": "purchase_return_dates","orderable": false },
            ]
        });

</script>
