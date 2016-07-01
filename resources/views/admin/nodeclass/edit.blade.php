@extends('admin.layouts.app')

@section('content')

    <h1>Klasse Editieren - {{$nodeClass->name}}</h1>

    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>Klasse Editieren</h2>
        </header>
        <div class="main-box-body clearfix">
            <form action="{{ url("admin/nodeclass/save/" . $nodeClass->id) }}" method="post">
                {!! csrf_field() !!}
            
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$nodeClass->name}}" class="form-control"/>
                </div>
            
                <div class="form-group">
                    <label>Identifier</label>
                    <input type="text" name="named_identifier" value="{{$nodeClass->named_identifier}}" class="form-control"/>
                </div>   
            
                <div class="form-group">
                    <label>Kinder erlaubt</label>
                    <select name="allow_children" class="form-control">
                        <option value="1" {{ $nodeClass->allow_children == 1 ? 'selected="selected"' : '' }}>ja</option>
                        <option value="0" {{ $nodeClass->allow_children == 0 ? 'selected="selected"' : '' }}>nein</option>
                    </select>
                </div>
            
            
                <div class="form-group">
                    <a class="btn btn-danger" href="admin/dashboard">Abbrechen</a>
                    <input type="submit" class="btn btn-success" value="Speichern" />
                </div>
            </form>
        </div>
    </div>
    

@endsection