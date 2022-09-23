var manageReportTable;

$(document).ready(function() {
    $('#navReport').addClass('active');
    $('#topNavDailyReport').addClass('active');

    manageReportTable = $('#manageReportTable').DataTable({
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
         var quantitytotal = api
         .column(2)
         .data()
         .reduce( function (a,b){
             return intVal(a) + intVal(b);
         },0);
         var Pricetotal = api
         .column(3)
         .data()
         .reduce( function (a,b){
             return intVal(a) + intVal(b);
         },0);
         var Profittotal =api
         .column(4)
         .data()
         .reduce( function (a,b){
             return intVal(a) + intVal(b);
         },0);
         $( api.column( 0 ).footer() ).html('ทั้งหมด');
         $( api.column( 2 ).footer() ).html(quantitytotal);
         $( api.column( 3 ).footer() ).html(Pricetotal);
         $( api.column( 4 ).footer() ).html(Profittotal);   
        },
		'ajax' : 'php_action/fetchDaily.php',
		'order': []
	});
    $("#generateReportBtn").unbind('click').bind('click', function() {
        var form = $(this);

			$.ajax({
				url: 'php_action/printDaily.php',
				type: 'post',
				data: form.serialize(),
				dataType: 'text',
				success:function(response) {
					var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>Order Report Slip</title>');        
	        mywindow.document.write('</head><body>');
	        mywindow.document.write(response);
	        mywindow.document.write('</body></html>');

	        mywindow.document.close(); // necessary for IE >= 10
	        mywindow.focus(); // necessary for IE >= 10

	        mywindow.print();
	        mywindow.close();
				} // /success
			});	// /ajax

		return false;

    }); 
});