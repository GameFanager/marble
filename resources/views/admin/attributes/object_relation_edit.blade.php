<div class="attribute-container" id="attribute-object-relation-{{$attribute->id}}-{{$locale}}">
    <div class="attribute-object-relation-view"></div>
    <div class="clearfix"></div>
    
    <input type="hidden" name="attributes[{{$attribute->id}}][{{$locale}}]" class="attribute-object-relation-input" value="{{$attribute->value[$locale]}}" />
    <a href="javascript:;" class="btn btn-default btn-xs attribute-object-relation-add">Objekt auswählen...</a>

</div>
<script>
    ;(function(){

        var container = new Attributes.ObjectRelation("attribute-object-relation-{{$attribute->id}}-{{$locale}}");

        @if($attribute->value[$locale])
            container.setNode({
                id: '{{$attribute->processedValue[$locale]->id}}',
                name: '{{$attribute->processedValue[$locale]->name}}'
            });
        @endif

    })();
</script>
