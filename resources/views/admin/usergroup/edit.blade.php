@extends('admin.layouts.app')

@section('javascript-head')
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/attributes/attributes.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/admin/js/attributes/object_relation_edit.js') }}"></script>
@endsection

@section('content')

    <h1>{{$group->name}}</h1>

    <form action="{{url("admin/usergroup/save/" . $group->id) }}" enctype="multipart/form-data" method="post">

        {!! csrf_field() !!}

            
        <div class="main-box">
            <header class="main-box-header clearfix">
                    <h2><b>{{$group->name}}</b></h2>
            </header>
            <div class="main-box-body clearfix">


                <div class="form-group">
                    <label>Name</label>
                    
                    <input type="text" class="form-control" name="name" value="{{$group->name}}" />
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Klassen</label>
                            <br />
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                
                                    <input type="checkbox" name="create_class" class="onoffswitch-checkbox" value="1" id="onoff-create_class" {{ $group->create_class ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-create_class">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>erstellen</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="edit_class" class="onoffswitch-checkbox" value="1" id="onoff-edit_class" {{ $group->edit_class ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-edit_class">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>bearbeiten</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="delete_class" class="onoffswitch-checkbox" value="1" id="onoff-delete_class" {{ $group->delete_class ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-delete_class">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>löschen</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="list_class" class="onoffswitch-checkbox" value="1" id="onoff-list_class" {{ $group->list_class ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-list_class">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>auflisten</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Benutzer</label>
                            <br />
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                
                                    <input type="checkbox" name="create_user" class="onoffswitch-checkbox" value="1" id="onoff-create_user" {{ $group->create_user ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-create_user">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>erstellen</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="edit_user" class="onoffswitch-checkbox" value="1" id="onoff-edit_user" {{ $group->edit_user ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-edit_user">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>bearbeiten</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="delete_user" class="onoffswitch-checkbox" value="1" id="onoff-delete_user" {{ $group->delete_user ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-delete_user">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>löschen</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="list_user" class="onoffswitch-checkbox" value="1" id="onoff-list_user" {{ $group->list_user ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-list_user">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>auflisten</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Benutzergruppen</label>
                            <br />
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                
                                    <input type="checkbox" name="create_group" class="onoffswitch-checkbox" value="1" id="onoff-create_group" {{ $group->create_group ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-create_group">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>erstellen</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="edit_group" class="onoffswitch-checkbox" value="1" id="onoff-edit_group" {{ $group->edit_group ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-edit_group">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>bearbeiten</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="delete_group" class="onoffswitch-checkbox" value="1" id="onoff-delete_group" {{ $group->delete_group ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-delete_group">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>löschen</label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="pull-left">
                                <div class="onoffswitch onoffswitch-success">
                                    
                                    <input type="checkbox" name="list_group" class="onoffswitch-checkbox" value="1" id="onoff-list_group" {{ $group->list_group ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="onoff-list_group">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pull-left" style="padding-top:5px;margin-right: 40px;">
                                <label>auflisten</label>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Entry Node</label>
                        
                        <div class="attribute-container" id="object-relation-entry-node-id">
                            <div class="attribute-object-relation-view"></div>
                            <div class="clearfix"></div>
                            
                            <input type="hidden" name="entry_node_id" class="attribute-object-relation-input" value="{{$group->entry_node_id}}" />
                            <a href="javascript:;" class="btn btn-default btn-xs attribute-object-relation-add">Objekt auswählen...</a>

                        </div>
                        <script>
                            ;(function(){

                                var container = Attributes.ObjectRelation.register("object-relation-entry-node-id");

                                @if($group->entry_node_id !== -1)
                                    container.setNode({
                                        id: '{{$group->entry_node_id}}',
                                        name: '{{App\Node::find($group->entry_node_id)->name}}'
                                    });
                                @endif

                            })();
                        </script>



                    </div>


            
                    <div class="form-group">
                        <label>Erlaubte Klassen</label>
                        <select multiple name="allowed_classes[]" class="form-control" size="10">
                            <option value="all" {{ (in_array("all",$group->allowed_classes) || !count($group->allowed_classes) ? 'selected="selected"' : '')}} >- Alle -</option>
                            @foreach($groupedNodeClasses as $nodeClasses)
                                <option disabled="disabled">{{$nodeClasses->group->name}}</option>
                                @foreach($nodeClasses->items as $nodeClass)
                                    <option value="{{$nodeClass->id}}" {{ (in_array($nodeClass->id,$group->allowed_classes) ? 'selected="selected"' : '') }}>&nbsp; &nbsp; &nbsp; {{$nodeClass->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                </div>




            </div>

        <div class="form-group pull-right">
            <a href="{{url("/admin/usergroup/list")}}" class="btn btn-primary">Abbrechen</a>
            <input type="submit" class="btn btn-success" value="Speichern" />
        </div>
        <div class="clearfix"></div>

    </form>

@endsection