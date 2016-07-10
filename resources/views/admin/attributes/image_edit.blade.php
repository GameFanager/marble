
<div class="attribute-container" id="attribute-image-{{$attribute->id}}-{{$locale}}">
    <div class="attribute-image-view"></div>
    <div class="clearfix"></div>
    
    <input type="hidden" name="attributes[{{$attribute->id}}][{{$locale}}]" class="attribute-image-input" value="noop" />
    <input type="file" name="file_{{$attribute->id}}_{{$locale}}" class="form-control" value="" />
</div>
<script>
    ;(function(){

        var container = Attributes.Image.register("attribute-image-{{$attribute->id}}-{{$locale}}");

        @if($attribute->value[$locale])
            container.setImage({
                filename: '{{url("/image/200/200/" . $attribute->value[$locale]->filename)}}',
                original_filename: '{{$attribute->value[$locale]->original_filename}}'
            });
        @endif

    })();
</script>
