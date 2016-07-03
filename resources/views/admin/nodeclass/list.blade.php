@extends('admin.layouts.app')

@section('content')

    <h1>
    	Klassen
        <div class="pull-right">
    		<a href="{{ url("admin/nodeclass/addgroup") }}" class="btn btn-xs btn-success">Klassegruppe hinzufügen</a>
    		<a href="{{ url("admin/nodeclass/add") }}" class="btn btn-xs btn-success">Klasse hinzufügen</a>
        </div>
    </h1>

    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>Klassen-Gruppen</h2>
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
                    <tbody> 
                        @foreach($nodeClassGroups as $_nodeClassGroup)
                            <tr>
                                <td>
                                    <a href="{{ url("admin/nodeclass/list/" . $_nodeClassGroup->id) }}">{{$_nodeClassGroup->name}}</a>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ url("admin/nodeclass/editgroup/" . $_nodeClassGroup->id) }}" class="btn btn-xs btn-info">Bearbeiten</a>
                                        <a href="{{ url("admin/nodeclass/deletegroup/" . $_nodeClassGroup->id) }}" onclick="return confirm('Objekt wirklich löschen?');" class="btn btn-xs btn-danger">Löschen</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>
                Klassen
                @if( $nodeClassGroup )
                    - {{$nodeClassGroup->name}}
                @endif
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
                    <tbody> 
                        @foreach($nodeClasses as $nodeClass)
                            <tr>
                                <td>
                                    <a href="{{ url("admin/nodeclass/attributes/" . $nodeClass->id) }}">{{$nodeClass->name}}</a>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ url("admin/nodeclass/edit/" . $nodeClass->id) }}" class="btn btn-info btn-xs">Bearbeiten</a>
                                        <a href="{{ url("admin/nodeclass/delete/" . $nodeClass->id) }}" onclick="return confirm('Objekt wirklich löschen?');" class="btn btn-xs btn-danger">Löschen</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

@endsection