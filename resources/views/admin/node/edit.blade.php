@extends('admin.layouts.app')

@section('javascript-head')
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/attributes/attributes.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/attributes/images-edit.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/attributes/image-edit.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/attributes/object-relation-edit.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/attributes/object-relation-list-edit.js') }}"></script>
@endsection


@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/language-switch.js') }}"></script>
@endsection

@section('sidebar')
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
@endsection

@section('content')

    <h1>{{$node->name}}</h1>



    <form action="{{url("admin/node/save/" . $node->id) }}" enctype="multipart/form-data" method="post">

        {!! csrf_field() !!}

        @if( ! $node->class->locked )

            @foreach($groupedNodeAttributes as $classAttributeGroup)
                    
                <div class="main-box">
                    <header class="main-box-header clearfix">
                        @if($classAttributeGroup->group)
                            <h2><b>{{$classAttributeGroup->group->name}}</b></h2>
                        @endif
                    </header>
                    <div class="main-box-body clearfix">

                        @foreach($classAttributeGroup->items as $attribute)
                            @continue($attribute->classAttribute->locked)
                            

                            <div class="form-group">
                                <label>{{ $attribute->classAttribute->name }}</label>
                                
                                @if($attribute->classAttribute->translate)
                                    <div class="lang-container">
                                        <div class="lang-switch-container">
                                            @foreach($languages as $i => $language)
                                                <div class="lang-switch {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">{{$language->name}}</div>
                                            @endforeach
                                        </div>

                                        @foreach($languages as $i => $language)
                                            <div class="lang-content {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">
                                                {!! $attribute->class->renderEdit($language->id)!!} 
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    {!! $attribute->class->renderEdit(Config::get("app.locale_id"))!!}
                                @endif
                            </div>

                        @endforeach

                    </div>
                </div>

            @endforeach


            <div class="form-group pull-right">
                <a href="{{url("/admin/dashboard")}}" class="btn btn-primary">Abbrechen</a>
                <input type="submit" class="btn btn-success" value="Speichern" />
            </div>
            <div class="clearfix"></div>
            <br /><br /><br />
        @endif
    </form>

    @if($node->class->list_children)
         <div class="main-box">
            <header class="main-box-header clearfix">
                <h2>
                    <div class="pull-left">Kinder</div>
                    @if($node->class->allow_children)
                        <div class="pull-right">
                            <a href="{{url("admin/node/add/" . $node->id)}}" class="btn btn-info btn-xs">
                                Unterobjekt einfügen
                            </a>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </h2>
            </header>
            <div class="main-box-body clearfix">        
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Name</span></a></th>
                                <th class="text-right"><span>&nbsp;</span></th>
                            </tr>
                        </thead>
                        <tbody id="sortable-children"> 
                            @foreach($childNodes as $childNode) 
                                @continue( ! \App\PermissionHelper::allowedClass($childNode->class->id))
                                <tr data-node-id="{{$childNode->id}}">
                                    <td>
                                        <a href="{{ url("admin/node/edit/" . $childNode->id) }}"><i class="fa fa-{{$childNode->class->icon}}" ></i> {{$childNode->name}}</a>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="{{ url("admin/node/edit/" . $childNode->id) }}" class="btn btn-xs btn-info">Bearbeiten</a>
                                            <a href="{{ url("admin/node/delete/" . $childNode->id) }}" onclick="return confirm('Objekt wirklich löschen?');" class="btn btn-xs btn-danger">Löschen</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if( count($childNodes) )
                        <script>
                            $( "#sortable-children" ).sortable({
                                revert: true,
                                stop: function(){
                                    var $childNodes = $("#sortable-children > tr"),
                                        sortOrder = 0,
                                        childNodes = {};

                                    $childNodes.each(function(){
                                        childNodes[$(this).data("node-id")] = sortOrder++;

                                    });
                                    
                                    $.post("/admin/node/sort", {nodes:childNodes});
                                }
                            });
                        </script>
                    @else
                        <center><i>Keine Kindelemente verfügbar...</i></center>
                        <br />
                    @endif
                </div>
            </div>
        </div>
    @endif

@endsection