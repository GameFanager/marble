
<div class="attribute-container" id="attribute-images-{{$attribute->id}}-{{$locale}}">
    <div class="attribute-images-view"></div>
    <div class="clearfix"></div>

    <input type="hidden" name="attributes[{{$attribute->id}}][{{$locale}}]" class="attribute-images-input" value="noop" />
    <input type="file" name="file_{{$attribute->id}}_{{$locale}}" class="form-control" value="" />
</div>
<script>
    ;(function(){

        var container = Attributes.Images.register("attribute-images-{{$attribute->id}}-{{$locale}}");

        @foreach($attribute->value[$locale] as $key => $imagesAttributeItem)
            container.addImage({
                id: '{{$key}}',
                filename: '{{url("/image/200/200/" . $imagesAttributeItem->filename)}}',
                original_filename: '{{$imagesAttributeItem->original_filename}}'
            });
        @endforeach
    })();
</script>