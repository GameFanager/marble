<div id="object-relation-list-inputs-{{$attribute->id}}-{{$locale}}">
    @foreach($attribute->value[$locale] as $key => $nodeId)
        <input type="hidden" name="attributes[{{$attribute->id}}][{{$locale}}][]" id="object-relation-list-input-{{$attribute->id}}-{{$locale}}-{{$key}}" value="{{$nodeId}}" />
    @endforeach
</div>

<div style="background: #f4f4f4;padding: 15px;border-radius: 3px">
    <div id="object-relation-list-names-{{$attribute->id}}-{{$locale}}">
        @foreach($attribute->processedValue[$locale] as $key => $subNode)
            <p id="object-relation-list-name-{{$attribute->id}}-{{$locale}}-{{$key}}">
                <b>{{ $subNode->name }}</b> 
                &nbsp;
                <b style="cursor:pointer;color:red;" class="object-browser-list-delete" data-attribute-id="{{$attribute->id}}" data-locale="{{$locale}}" data-index="{{$key}}">&times;</b>
            </p>
        @endforeach

    </div>
    <p id="object-relation-list-no-items-{{$attribute->id}}-{{$locale}}" @if( count(@$attribute->value[$locale]) ) style="display:none" @endif
        <b class="no-ojects">Noch keine Objekte ausgewählt!</b>
    </p>

    <a href="javascript:;" class="btn btn-default btn-xs object-browser-list" data-locale="{{$locale}}" data-attribute-id="{{$attribute->id}}">Objekt auswählen...</a>
    

    <div class="modal fade" id="edit-modal-{{$attribute->id}}-{{$locale}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Objekt auswählen...</h4>
                </div>
                <div class="modal-body">
                    <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav" style="background:#2c3e50">
                        @include("admin/layouts/tree", array("nodes" => \App\TreeHelper::generate(), "isRoot" => true, "isModal" => true, "selectedNode" => $attribute->value[$locale]))
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

