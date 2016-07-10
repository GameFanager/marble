
<div style="background: #f4f4f4;padding: 15px;border-radius: 3px">
    
    <div id="images-items-{{$attribute->id}}-{{$locale}}">
        @if($attribute->value[$locale])
            <div class="sortable-images-{{$attribute->id}}-{{$locale}}">
                @foreach($attribute->value[$locale] as $key => $imagesAttributeItem)
                    <p>
                        <b id="object-relation-name-{{$attribute->id}}-{{$locale}}-{{$key}}">{{$imagesAttributeItem->original_filename}}</b> 
                        <b style="cursor:pointer;color:red;" data-key="{{$key}}" class="images-delete">&times;</b>
                    </p>
                @endforeach
            </div>
        @else
            <p>
                Keine Bilder Ausgewählt...
            </p>
        @endif
        <input type="hidden" name="attributes[{{$attribute->id}}][{{$locale}}]" class="form-control" value="noop" />
    </div>
        
    <input type="file" name="file_{{$attribute->id}}_{{$locale}}" class="form-control" value="" />
</div>