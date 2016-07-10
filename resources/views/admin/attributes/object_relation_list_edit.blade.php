<div class="attribute-container" id="attribute-object-relation-list-{{$attribute->id}}-{{$locale}}">
    <div class="attribute-object-relation-list-view"></div>
    <div class="clearfix"></div>

    <div class="attribute-object-relation-list-inputs"></div>
    <a href="javascript:;" class="btn btn-default btn-xs attribute-object-relation-list-add">Objekt auswählen...</a>

</div>
<script>
    ;(function(){

        var container = new Attributes.ObjectRelationList(
            "attribute-object-relation-list-{{$attribute->id}}-{{$locale}}", 
            'attributes[{{$attribute->id}}][{{$locale}}][]'
        );

        @foreach($attribute->processedValue[$locale] as $key => $subNode)
            container.addNode({
                id: '{{$subNode->id}}',
                name: '{{$subNode->name}}'
            });
        @endforeach

    })();
</script>

