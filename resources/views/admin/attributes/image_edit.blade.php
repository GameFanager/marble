
<div style="background: #f4f4f4;padding: 15px;border-radius: 3px">
    <p>
        @if($attribute->value[$locale])
            <p>
                <b id="object-relation-name-{{$attribute->id}}-{{$locale}}">{{$attribute->value[$locale]->original_filename}}</b> 
                <b style="cursor:pointer;color:red;" class="image-delete">&times;</b>
            </p>
        @else
            <p>
                Kein Bild ausgewählt...
            </p>
        @endif
        
        
        <input type="file" name="file_{{$attribute->id}}_{{$locale}}" class="form-control" value="" />
        <input type="hidden" name="attributes[{{$attribute->id}}][{{$locale}}]" class="form-control" value="noop" />
    </p>
</div>

