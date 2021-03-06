@extends('admin.layouts.app')

@section('content')
    <h1>Element hinzufügen</h1>

    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>Element hinzufügen</h2>
        </header>
        <div class="main-box-body clearfix">
            <form action="{{url("admin/node/saveadded/" . $parentNode->id)}}" method="post">

                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Klasse</label>
                    <select name="class_id" class="form-control">
                        @foreach($nodeClasses as $nodeClass)
                            @if( \App\PermissionHelper::allowedClass($nodeClass->id) && (in_array("all",$parentNode->class->allowed_child_classes) || in_array($nodeClass->id, $parentNode->class->allowed_child_classes) ) )
                                <option value="{{$nodeClass->id}}">{{$nodeClass->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
        

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Speichern" />
                </div>
            </form>
        </div>
    </div>
@endsection