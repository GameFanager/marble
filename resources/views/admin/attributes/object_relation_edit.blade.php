<input type="hidden" name="attributes[{{$attribute->id}}][{{$locale}}]" id="object-relation-{{$attribute->id}}-{{$locale}}" value="{{$attribute->value[$locale]}}" />

<div id="selectbox-config-<{{$attribute->id}}-{{$locale}}" style="background: #f4f4f4;padding: 15px;border-radius: 3px">
    <p>
        <b id="object-relation-name-{{$attribute->id}}-{{$locale}}">{{ $attribute->value[$locale] ? $attribute->processedValue[$locale]->attributes->name->value[$locale] : "Kein Objekt ausgewählt!" }}</b> 
        <b style="cursor:pointer;color:red; {{ ! $attribute->value[$locale] ? "display:none" : "" }}" class="object-browser-delete" data-input-name="object-relation-name-{{$attribute->id}}-{{$locale}}" data-input-id="object-relation-{{$attribute->id}}-{{$locale}}" >&times;</b>
    </p>
    <a href="javascript:;" class="btn btn-default btn-xs object-browser" data-modal-id="edit-modal-{{$attribute->id}}-{{$locale}}" data-input-id="object-relation-{{$attribute->id}}-{{$locale}}" data-input-name="object-relation-name-{{$attribute->id}}-{{$locale}}">Objekt auswählen...</a>

    <div class="modal fade" id="edit-modal-{{$attribute->id}}-{{$locale}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Objekt auswählen...</h4>
                </div>
                <div class="modal-body">
                    <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav" style="background:#2c3e50">
                        @include("admin/layouts/tree", array("nodes" => $nodeTree, "isRoot" => true, "isModal" => true))
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

