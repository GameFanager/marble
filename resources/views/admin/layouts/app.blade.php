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
        <link rel='stylesheet' href='{{ URL::asset('assets/admin/css/custom.css') }}'/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/jquery-ui.js') }}"></script>
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
                <a href="admin/dashboard" id="logo" class="navbar-brand">
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
                                <a class="btn" href="admin/dashboard">
                                    <i class="fa fa-dashboard">
                                    </i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a class="btn" href="{{url("admin/nodeclass/list")}}">
                                    <i class="fa fa-folder">
                                    </i>
                                    <span>Klassen</span>
                                </a>
                            </li>
                            <li>
                                <a class="btn" href="admin/users">
                                    <i class="fa fa-user">
                                    </i>
                                    <span>Benutzer</span>
                                </a>
                            </li>
                            <li>
                                <a class="btn" href="admin/groups">
                                    <i class="fa fa-users">
                                    </i>
                                    <span>Benutzergruppen</span>
                                </a>
                            </li>
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


                                @include("admin/layouts/tree", array("nodes" => $nodeTree, "isRoot" => true, "isModal" => false, "selectedNode" => isset($node) ? $node->id : -1))


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

                            @if( isset($nodeClass) and isset($classAttributeGroups) )
                                <div class="main-box clearfix profile-box-menu">
                                    <div class="main-box-body clearfix">
                                        <div class="profile-box-header gray-bg clearfix" style="padding:0 15px 15px">
                                            <h2>Attribut Gruppen</h2>
                                            <div class="job-position">
                                                {{$nodeClass->name}}
                                            </div>
                                        </div>
                                        <div class="profile-box-content clearfix">
                                            <ul class="menu-items" id="class-attribute-groups">
                                                @foreach($classAttributeGroups as $classAttributeGroup)
                                                    <li class="more" data-group-id="{{$classAttributeGroup->id}}">
                                                        <div class="pull-left">
                                                            <i class="fa fa-folder-open-o fa-lg"></i> {{$classAttributeGroup->name}}
                                                        </div>
                                                        <a style="display:inline-block" href="{{url("admin/nodeclass/deleteattributegroup/" . $nodeClass->id . "/" . $classAttributeGroup->id)}}" class="btn pull-right btn-danger btn-xs">
                                                            löschen
                                                        </a>
                                                        <div class="clearfix"></div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <ul class="menu-items">
                                                <li>
                                                    <a data-modal-id="add-attribute-group-modal" href="javascript:$('#add-attribute-group-modal').modal('show')" class="clearfix" class="add-attribute-group">
                                                        <i class="fa fa-plus fa-lg"></i> Gruppe hinzufügen
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $( "#class-attribute-groups" ).sortable({
                                        revert: true,
                                        stop: function(){
                                            var classAttributeGroups = {},
                                                i = 0;

                                            $("#class-attribute-groups > li").each(function(){
                                                classAttributeGroups[$(this).data("group-id")] = i++;
                                            });

                                            $.post("/admin/nodeclass/sortattributegroups/{{$nodeClass->id}}", {groups:classAttributeGroups});
                                        }
                                    });
                                </script>
                            @endif
                            
                            @if( isset($node) )

                                <div class="main-box clearfix profile-box-menu">
                                    <div class="main-box-body clearfix">
                                        <div class="profile-box-header green-bg clearfix" style="padding:0 15px 15px">
                                            <h2>{{$node->name}}</h2>
                                            <div class="job-position">
                                                {{$node->class->name}}
                                            </div>
                                        </div>
                                        <div class="profile-box-content clearfix">
                                            <ul class="menu-items">
                                                @if($node->parent_id != 0)
                                                    <li>
                                                        <a href="{{url("admin/node/delete/" . $node->id) }}" onclick="return confirm('Objekt wirklich löschen?');" class="clearfix">
                                                            <i class="fa fa-trash-o fa-lg"></i> Inhalt löschen
                                                        </a>
                                                    </li>
                                                @endif
                                                @if($node->class->allow_children)
                                                    <li>
                                                        <a href="{{url("admin/node/add/" . $node->id)}}" class="clearfix">
                                                            <i class="fa fa-plus fa-lg"></i> Unterobjekt einfügen
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="main-box clearfix profile-box-menu">
                                    <div class="main-box-body clearfix">
                                        <div class="profile-box-header gray-bg clearfix" style="padding:0 15px 15px">
                                            <h2>Meta Information</h2>
                                        </div>
                                        <div class="profile-box-content clearfix">
                                            <ul class="menu-items">
                                                <li><a href="#"><b>ID:</b> {{$node->id}}</a></li>
                                                <li><a href="#"><b>Class ID:</b> {{$node->class->id}}</a></li>
                                                <li><a href="#"><b>Parent ID:</b> {{$node->parent_id}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif 

                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/bootstrap.datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/admin/js/scripts.js') }}"></script>
        

        <script type="text/javascript" src="{{ URL::asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
        <script type="text/javascript">
    		
            
            
            $(".datepicker").datepicker();
        </script>
	</body>
</html>