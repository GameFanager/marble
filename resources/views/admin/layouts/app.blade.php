<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='de' lang='de'>
    <head>
		<title>Administration</title>
		<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/bootstrap.min.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/bootstrap.datepicker.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/font-awesome.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/layout.min.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/elements.min.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/morris.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/jquery-ui.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/cropper.css') }}'/>
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/custom.css') }}'/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/jquery-ui.js') }}"></script>


        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/object-browser.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/cropper.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/image-editor.js') }}"></script>

        @yield("javascript-head")

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
	</head>
    <body class="x-theme-blue">
        
        <header class="navbar" id="header-navbar">
            <div class="container">
                <a href="{{url("admin/dashboard")}}" id="logo" class="navbar-brand">
                    <img src="{{URL::asset('assets/admin/images/logo.png')}}" alt="" class="normal-logo logo-white">
                </a>
                <div class="clearfix">
                    <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
                        <span class="sr-only">
                            Toggle navigation
                        </span>
                        <span class="fa fa-bars">
                        </span>
                    </button>
                    <div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
                        <ul class="nav navbar-nav pull-left">
                            <li>
                                <a class="btn" href="{{url("admin/dashboard")}}">
                                    <i class="fa fa-dashboard">
                                    </i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @if(App\PermissionHelper::allowed("list_class"))
                                <li>
                                    <a class="btn" href="{{url("admin/nodeclass/list")}}">
                                        <i class="fa fa-folder">
                                        </i>
                                        <span>Klassen</span>
                                    </a>
                                </li>
                            @endif
                            @if(App\PermissionHelper::allowed("list_user"))
                                <li>
                                    <a class="btn" href="{{url("admin/user/list")}}">
                                        <i class="fa fa-user">
                                        </i>
                                        <span>Benutzer</span>
                                    </a>
                                </li>
                            @endif
                            @if(App\PermissionHelper::allowed("list_group"))
                                <li>
                                    <a class="btn" href="{{url("admin/usergroup/list")}}">
                                        <i class="fa fa-users">
                                        </i>
                                        <span>Benutzergruppen</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="nav-no-collapse pull-right" id="header-nav">
                        <ul class="nav navbar-nav pull-right">
                            <li class="hidden-xxs">
                                <a class="btn" href="{{url("/admin/auth/logout")}}">
                                    <i class="fa fa-power-off">
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        
        <div id="page-wrapper" class="container">
            <div class="row">
                <div id="nav-col">
                    <section id="col-left" class="col-left-nano">
                        <div id="col-left-inner" class="col-left-nano-content">
                            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">


                                @include("admin/layouts/tree", array("nodes" => \App\TreeHelper::generate(), "isRoot" => true, "isModal" => false, "selectedNode" => isset($node) ? $node->id : -1))


                            </div>
                        </div>
                    </section>
                </div>
                
                
                <div id="content-wrapper">
                    <div class="row">
                        <div class="col-lg-9">
                            @yield('content')
                        </div>
                        <div class="col-lg-3">
                            <h1>&nbsp;</h2>

                            @yield('sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="modal fade" id="object-browser-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Objekt auswählen...</h4>
                    </div>
                    <div class="modal-body">
                        <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav" style="background:#2c3e50">
                            @include("admin/layouts/tree", array("nodes" => \App\TreeHelper::generate(), "isRoot" => true, "isModal" => true, "selectedNode" => null))
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="image-editor-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Bild bearbeiten</h4>
                    </div>
                    <div class="modal-body">
                        <div id="image-editor">
                            <div class="canvas">
                                <img class="editor-image" />
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn save-image btn-success" data-dismiss="modal">Speichern</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/bootstrap.datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/scripts.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/ckeditor/ckeditor.js') }}"></script>

        @yield("javascript")

        <script type="text/javascript">

            ObjectBrowser.init();
            ImageEditor.init();

            $(".datepicker").datepicker();

        </script>
	</body>
</html>