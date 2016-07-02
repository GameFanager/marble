@extends('admin.layouts.app')

@section('content')

    <h1>
        <span class="pull-left">Editieren - {{$nodeClass->name}}</span>

        <div class="pull-right">
            <form action="{{url("admin/nodeclass/addattribute/" . $nodeClass->id) }}" method="post">
                {!! csrf_field() !!}
    		    <input type="submit" class="btn btn-success pull-right" value="Attribut hinzufügen" />
                <select name="type" class="form-control pull-right" style="width: auto; margin-right: 30px">
                    @foreach($attributes as $attribute)
                        <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                    @endforeach
                </select>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="clearfix"></div>
    </h1>
    

    <form action="{{url("admin/nodeclass/saveattributes/" . $nodeClass->id) }}" method="post">
        {!! csrf_field() !!}

        @foreach($nodeClass->attributes as $attribute)

            @if($attribute->locked)
                @continue
            @endif 
            
            <div class="main-box"  style="position: relative">
                <header class="main-box-header clearfix">
                    <h2><b>{{$attribute->name}}</b> &lt; {{$attribute->type->name}} &gt; <input style="width:55px; display: inline-block;" type="text" name="sort_order[{{$attribute->id}}]" value="{{$attribute->sort_order}}" class="form-control"/></h2>
                </header>
                <div class="main-box-body clearfix">

                    <div style="position: absolute; top: 10px; right: 10px">
                        <a href="{{url("admin/nodeclass/deleteattribute/" . $nodeClass->id . "/" . $attribute->id)}}" class="btn btn-danger">Löschen</a>
                    </div>
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name[{{$attribute->id}}]" value="{{$attribute->name}}" class="form-control"/>
                        
                    </div>
                    <div class="form-group">
                        <label>Identifier</label>
                        <input type="text" name="named_identifier[{{$attribute->id}}]" value="{{$attribute->named_identifier}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="translate[{{$attribute->id}}]" value="1" {{ $attribute->translate ? 'checked="checked"' : '' }} /> &nbsp; Übersetzbar?
                        </label>
                    </div>
                    <input type="hidden" name="configuration[{{$attribute->id}}]" value="" />
                </div>
            </div>
        @endforeach

        <div class="main-box">
            <header class="main-box-header clearfix" style="min-height:30px">
            </header>
            <div class="main-box-body clearfix">
                <div class="form-group">
                    <a class="btn btn-danger" href="{{url("admin/dashboard")}}">Abbrechen</a>
                    <input type="submit" class="btn btn-success" value="Speichern" />
                </div>
            </div>
        </div>
    </form>

@endsection