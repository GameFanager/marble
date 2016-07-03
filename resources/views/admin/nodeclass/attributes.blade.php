@extends('admin.layouts.app')

@section('content')

    <h1>
        <span class="pull-left">Editieren - {{$nodeClass->name}}</span>

        <div class="pull-right">
            <form action="{{url("admin/nodeclass/addattribute/" . $nodeClass->id) }}" method="post">
                {!! csrf_field() !!}
                <input style="margin-right:15px" type="submit" class="btn btn-xs btn-success pull-right" value="Attribut hinzufügen" />
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

    <div class="modal fade" id="add-attribute-group-modal">
        <form action="{{url("admin/nodeclass/addattributegroup/" . $nodeClass->id)}}" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Attribut Gruppe hinzufügen...</h4>
                    </div>
                    <div class="modal-body">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-success">Hinzufügen</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
    

    <form action="{{url("admin/nodeclass/saveattributes/" . $nodeClass->id) }}" method="post" id="class-attributes">
        {!! csrf_field() !!}

        @foreach($groupedClassAttributes as $classAttributeGroup)

            <div class="class-attribute-sortable">

                @foreach($classAttributeGroup->items as $attribute)
                    <div class="main-box" data-attribute-id="{{$attribute->id}}" style="position: relative">

                        <input type="hidden" name="sort_order[{{$attribute->id}}]" value="{{$attribute->sort_order}}" class="input-sort-order"/>
                        
                        <header class="main-box-header clearfix">
                            @if($attribute->named_identifier == "name")
                                <h2><b>{{$attribute->name}}</b></h2>
                            @else
                            <h2>
                                <b>{{$attribute->name}}</b> &lt; {{$attribute->type->name}} &gt; 
                                
                            </h2>
                            @endif
                        </header>
                        <div class="main-box-body clearfix">
                            @if($attribute->named_identifier != "name")
                                <div style="position: absolute; top: 10px; right: 10px">
                                    <a href="{{url("admin/nodeclass/deleteattribute/" . $nodeClass->id . "/" . $attribute->id)}}" class="btn btn-xs btn-danger">Löschen</a>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name[{{$attribute->id}}]" value="{{$attribute->name}}" class="form-control"/>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Identifier</label>
                                            <input type="text" name="named_identifier[{{$attribute->id}}]" value="{{$attribute->named_identifier}}" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            @else 
                                <input type="hidden" name="name[{{$attribute->id}}]" value="{{$attribute->name}}" />
                                <input type="hidden" name="named_identifier[{{$attribute->id}}]" value="{{$attribute->named_identifier}}" />
                            @endif

                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="translate[{{$attribute->id}}]" value="1" {{ $attribute->translate ? 'checked="checked"' : '' }} /> &nbsp; Übersetzbar?
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="locked[{{$attribute->id}}]" value="1" {{ $attribute->locked ? 'checked="checked"' : '' }} /> &nbsp; Gesperrt?
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select name="group_id[{{$attribute->id}}]" class="form-control">
                                        <option {{ $attribute->group_id == 0 ? "selected" : "" }}value="0">Keine Gruppe</option>
                                        @foreach($classAttributeGroups as $classAttributeGroup)
                                            <option {{ $attribute->group_id == $classAttributeGroup->id ? "selected" : "" }} value="{{$classAttributeGroup->id}}">{{$classAttributeGroup->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if(method_exists($attribute->class, "renderConfiguration"))
                                {!! $attribute->class->renderConfiguration() !!}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <script>
            $( ".class-attribute-sortable" ).sortable({
                revert: true,
                stop: function(){
                    var $classAttributeGroups = $(".class-attribute-sortable");

                    $classAttributeGroups.each(function(){
                        var i = 0;

                        $(this).find(".input-sort-order").each(function(){
                            $(this).val(i++);
                        });

                    });
                    //$.post("/admin/nodeclass/sortattributegroups/{{$nodeClass->id}}", {groups:classAttributeGroups});
                }
            });
        </script>
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