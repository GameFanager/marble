@extends('admin.layouts.app')

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
                        
                        <input type="hidden" name="entry_node_id" id="object-relation-entry-node" value="{{$group->entry_node_id}}" />

                        <div id="selectbox-config-entry-node" style="background: #f4f4f4;padding: 15px;border-radius: 3px">
                            <p>
                                <b id="object-relation-name-entry-node">{{ $group->entry_node_id !== -1 ? App\Node::find($group->entry_node_id)->name : "Kein Objekt ausgewählt!" }}</b> 
                                &nbsp;
                                <b style="cursor:pointer;color:red; {{ $group->entry_node_id === -1 ? "display:none" : "" }}" class="object-browser-delete" data-input-name="object-relation-name-entry-node" data-input-id="object-relation-entry-node" >&times;</b>
                            </p>
                            <a href="javascript:;" class="btn btn-default btn-xs object-browser" data-modal-id="edit-modal-entry-node" data-input-id="object-relation-entry-node" data-input-name="object-relation-name-entry-node">Objekt auswählen...</a>

                            <div class="modal fade" id="edit-modal-entry-node">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Objekt auswählen...</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav" style="background:#2c3e50">
                                                @include("admin/layouts/tree", array("nodes" => \App\TreeHelper::generate(0), "isRoot" => true, "isModal" => true, "selectedNode" => $group->entry_node_id))
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>


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
        <br /><br /><br />
    </form>


    <script>
         $(".object-browser").click(function(){
            var id = $(this).data("modal-id"),
                inputId = $(this).data("input-id"),
                nameId = $(this).data("input-name"),
                $modal = $("#" + id);
                
            $modal.modal("show");
            
            $modal.find("[data-node-id]").click(function(){
                var nodeId = $(this).data("node-id"),
                    nodeName = $(this).data("node-name");
                
                $("#" + nameId).text(nodeName);
                $("#" + inputId).val(nodeId);
                
                $modal.parent().find(".object-browser-delete").show();
                
                $modal.modal("hide");
            });
        });

        $(".object-browser-delete").click(function(){
            var inputId = $(this).data("input-id"),
                nameId = $(this).data("input-name");
            
            $("#" + inputId).val("");
            $("#" + nameId).text("Kein Objekt ausgewählt!");
            $(this).hide();
        });
    </script>

@endsection