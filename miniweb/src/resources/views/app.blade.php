<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Pages - Admin Dashboard UI Kit - Blank Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    @include('spiderworks.miniweb._partials.styles')
    <link href="{{asset('miniweb/assets/pages/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
    @section('head')
    @show
    <link href="{{asset('miniweb/datatables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link  href="{{asset('miniweb/assets/pages/css/themes/modern.css')}}" rel="stylesheet" type="text/css" />
    <link  href="{{asset('miniweb/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('miniweb/css/styles.css')}}" rel="stylesheet" type="text/css">

</head>
<body class="fixed-header menu-pin">
<!-- BEGIN SIDEBPANEL-->
@include('spiderworks.miniweb._partials.nav')
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->
<!-- START PAGE-CONTAINER -->
<div class="page-container ">
    <!-- START HEADER -->
    <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
            <div class="brand inline">
                PITTAPPILLIL
            </div>

        </div>
        <div class="d-flex align-items-center">
            <!-- START User Info-->
            <div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">
                @auth
                    <span class="semi-bold font-weight-bold">{{Auth::user()->username}}</span>
                    <span class="text-master font-italic">({{Auth::user()->email}})</span>
                @endauth
            </div>
            <div class="dropdown pull-right d-lg-block d-none">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="cursor: pointer">
              <span class="thumbnail-wrapper d32  inline">
              <img src="https://img.icons8.com/office/32/000000/user-menu-male--v2.png" alt=""
                   data-src="https://img.icons8.com/office/32/000000/user-menu-male--v2.png"
                   data-src-retina="https://img.icons8.com/office/32/000000/user-menu-male--v2.png" width="32" height="32">
              </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="#" class="dropdown-item"><i class="pg-settings_small"></i> Settings</a>
                    <a href="#" class="dropdown-item"><i class="pg-outdent"></i> Feedback</a>
                    <a href="#" class="dropdown-item"><i class="pg-signals"></i> Help</a>
                    <a href="#" class="clearfix bg-master-lighter dropdown-item">
                        <span class="pull-left">Logout</span>
                        <span class="pull-right"><i class="pg-power"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END HEADER -->
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
            <!-- START JUMBOTRON -->
            <div class="jumbotron page-wrapper" data-pages="parallax">
                @section('spiderworks.miniweb._partials.breadcrumb')
                    @show
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class=" container-fluid   container-fixed-lg">
                @include('spiderworks.miniweb._partials.notifications')
                @section('content')
                    @show
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">Copyright &copy; 2017 </span>
                    <span class="font-montserrat">REVOX</span>.
                    <span class="hint-text">All rights reserved. </span>
                    <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> <span class="muted">|</span> <a href="#" class="m-l-10">Privacy Policy</a></span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    Hand-crafted <span class="hint-text">&amp; made with Love</span>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- END COPYRIGHT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTAINER -->
<!--START QUICKVIEW -->

<!-- END QUICKVIEW-->
<!-- START OVERLAY -->

<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->
@include('spiderworks.miniweb._partials.scripts')
@stack('scripts')
<script type="text/javascript">
    var image_upload_url = "{{ url('summernote/image') }}";
    var _token = "{{csrf_token()}}";
    var base_url = "{{url('/')}}";
    var media_popup_url = "{{route('spiderworks.miniweb.media.popup')}}"
    var columnDefs = [{}];
</script>
@section('bottom')
@show
<script src="{{asset('miniweb/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('miniweb/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- END PAGE LEVEL JS -->
<script src="{{asset('miniweb/js/jquery.imgcheckbox.js')}}"></script>
<script src="{{asset('miniweb/js/scripts.js')}}"></script>
<script>
    $(document).ready(function () {
        $('table').attr('width','100%');
        $('#datatable_wrapper').parent().removeClass('padding-15').addClass('padding-5');
    });

</script>

<script>
        var $table = $('#datatable');
        if($table.length)
        {
            var ajaxUrl = $table.data('datatable-ajax-url');
            console.log(ajaxUrl)
            //var order = '';
            dt_table = $table.DataTable({
                "processing": true,
                "serverSide": true,
                responsive: true,
                ajax: {
                    url: ajaxUrl,
                    data: function(d) {

                    }
                },
                columns: my_columns,
                "stateSave": true,
                'aoColumnDefs': [
                    { 'bSortable': false, 'sClass': "text-center table-width-10", 'aTargets': ['nosort'] },
                    { "bSearchable": false, "aTargets": [ 'nosearch' ] }
                ],
                errMode: 'throw',
                "order": [order],
                "language": {
                    "search": "",
                    'searchPlaceholder': 'Search...'
                },
                initComplete: function(settings, json) {
                    $(this).trigger('initComplete', [this]);
                    $(window).trigger('resize');
                    this.api().columns().every( function () {

                    });
                },
                fnRowCallback : function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
                    updateDtSlno(this, slno_i);
                }
            });

            dt_table.columns().every( function () {
                var that = this;

                $( '.search-input', this.header() ).on( 'keyup change', function (t) {
                    console.log(this.value);
                    console.log(that);
                    if ( that.search() !== this.value ) {
                         that.search( this.value ).draw();
                    }
                });

                $( '.select-box-input', this.header() ).on( 'change', function () {
                    if ( that.search() !== this.value ) {
                        that.search( this.value ).draw();
                    }
                });
            });
        }

        $('#datatable #column-search tr th').each( function () {
            var title = $(this).text();
            var columnClass = $(this).attr('class');
            if($(this).hasClass('searchable-input')){
                if($(this).hasClass('date'))
                {
                    var id = $(this).attr('data-id');
                    $(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control input-sm daterange" name="updated_at" id="'+id+'" />' );
                    $('.daterange').daterangepicker({
                        timePicker: true,
                        autoUpdateInput: false,
                        drops: "up",
                        locale: {
                            cancelLabel: 'Clear',
                            format: 'MM/DD/YYYY HH:mm'
                        }
                    });
                }
                else if($(this).hasClass('date_time'))
                {
                    var id = $(this).attr('data-id');
                    $(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control input-sm daterange" name="date_time" id="'+id+'" />' );
                    $('#'+id).daterangepicker({
                        timePicker: true,
                        autoUpdateInput: false,
                        drops: "up",
                        locale: {
                            cancelLabel: 'Clear',
                            format: 'MM/DD/YYYY HH:mm'
                        }
                    });
                }
                else
                    $(this).html(  '<input type="text" placeholder="Search '+title+'" class="form-control input-sm search-input" />' );
            }
        });


        function updateDtSlno(dt, slno_i) {
            if (typeof dt != "undefined") {
                if(typeof slno_i == 'undefined')
                    slno_i = 0;
                table_rows = dt.fnGetNodes();
                var oSettings = dt.fnSettings();
                $.each(table_rows, function(index){
                    $("td:eq(" + slno_i + ")", this).html(oSettings._iDisplayStart+index+1);
                });
            }
        }

        function dt(){
            dt_table.ajax.reload();
        }
    </script>

</body>
</html>