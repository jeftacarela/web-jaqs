
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Dashboard Home</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{ URL::to('images/cabaretti-sm.png') }}">
    <link href="{{ URL::to('../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{ URL::to('../plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('../plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::to('../plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ URL::to('../plugins/morris/morris.css') }}">
    <link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
    {{-- message toastr --}}
    {{-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
    <script src="{{ URL::to('assets/js/jquery224.min.js') }}"></script>
    {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    body{
    margin-top:20px;
    background:#eee;
}

.invoice {
    background: #fff;
    padding: 20px
}

.invoice-company {
    font-size: 20px
}

.invoice-header {
    margin: 0 -20px;
    background: #f0f3f4;
    padding: 20px
}

.invoice-date,
.invoice-from,
.invoice-to {
    display: table-cell;
    width: 1%
}

.invoice-from,
.invoice-to {
    padding-right: 20px
}

.invoice-date .date,
.invoice-from strong,
.invoice-to strong {
    font-size: 16px;
    font-weight: 600
}

.invoice-date {
    text-align: right;
    padding-left: 20px
}

.invoice-price {
    background: #f0f3f4;
    display: table;
    width: 100%
}

.invoice-price .invoice-price-left,
.invoice-price .invoice-price-right {
    display: table-cell;
    padding: 20px;
    font-size: 20px;
    font-weight: 600;
    width: 75%;
    position: relative;
    vertical-align: middle
}

.invoice-price .invoice-price-left .sub-price {
    display: table-cell;
    vertical-align: middle;
    padding: 0 20px
}

.invoice-price small {
    font-size: 12px;
    font-weight: 400;
    display: block
}

.invoice-price .invoice-price-row {
    display: table;
    float: left
}

.invoice-price .invoice-price-right {
    width: 25%;
    background: #2d353c;
    color: #fff;
    font-size: 28px;
    text-align: right;
    vertical-align: bottom;
    font-weight: 300
}

.invoice-price .invoice-price-right small {
    display: block;
    opacity: .6;
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 12px
}

.invoice-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
    font-size: 10px
}

.invoice-note {
    color: #999;
    margin-top: 80px;
    font-size: 85%
}

.invoice>div:not(.invoice-footer) {
    margin-bottom: 20px
}

.btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
    color: #2d353c;
    background: #fff;
    border-color: #d9dfe3;
}
</style>
</head>
<body>
    <!-- Begin page -->
    <div id="wrapper">
      
        <!-- content -->
        @yield('content')
        <!-- End content -->
    </div>
    <!-- END wrapper -->

   <!-- jQuery  -->
   <script src="{{ URL::to('assets/js/jquery.min.js') }}"></script>
   <script src="{{ URL::to('assets/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ URL::to('assets/js/metismenu.min.js') }}"></script>
   <script src="{{ URL::to('assets/js/jquery.slimscroll.js') }}"></script>
   <script src="{{ URL::to('assets/js/waves.min.js') }}"></script>

   <script src="{{ URL::to('../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

   <!-- Required datatable js -->
   <script src="{{ URL::to('../plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <!-- Buttons examples -->
   <script src="{{ URL::to('../plugins/datatables/dataTables.buttons.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/jszip.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/pdfmake.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/vfs_fonts.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/buttons.html5.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/buttons.print.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/buttons.colVis.min.js') }}"></script>
   <!-- Responsive examples -->
   <script src="{{ URL::to('../plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ URL::to('../plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ URL::to('../plugins/morris/morris.min.js') }}"></script>
    <script src="{{ URL::to('../plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('assets/pages/dashboard.init.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::to('assets/pages/datatables.init.js') }}"></script>

   <!-- App js -->
   <script src="{{ URL::to('assets/js/app.js') }}"></script>

    <!-- PDF js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.0-beta.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.1.135/jspdf.min.js"></script>
    <script type="text/javascript" src="http://cdn.uriit.ru/jsPDF/libs/adler32cs.js/adler32cs.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2014-11-29/FileSaver.min.js"></script>
    <script type="text/javascript" src="libs/Blob.js/BlobBuilder.js"></script>
    <script type="text/javascript" src="http://cdn.immex1.com/js/jspdf/plugins/jspdf.plugin.addimage.js"></script>
    <script type="text/javascript" src="http://cdn.immex1.com/js/jspdf/plugins/jspdf.plugin.standard_fonts_metrics.js"></script>
    <script type="text/javascript" src="http://cdn.immex1.com/js/jspdf/plugins/jspdf.plugin.split_text_to_size.js"></script>
    <script type="text/javascript" src="http://cdn.immex1.com/js/jspdf/plugins/jspdf.plugin.from_html.js"></script>
    <script type="text/javascript" src="js/basic.js"></script>
   
    <script>
        $(function () {
           var specialElementHandlers = {
              '#editor': function (element,renderer) {
                 return true;
              }
           };
        $('#cmd').click(function () {
           var doc = new jsPDF();
           doc.fromHTML(
              $('#target').html(), 15, 15, 
              { 'width': 200, 'elementHandlers': specialElementHandlers }, 
              function(){ doc.save('sample-file.pdf'); }
           );
        });  
        });
     </script>

</body>
</html>