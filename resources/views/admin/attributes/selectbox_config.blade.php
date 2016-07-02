
<div class="form-group">
    <label>Konfiguration</label>
    <div id="selectbox-config-{{$attribute->id}}" style="background: #f4f4f4;padding: 15px;border-radius: 3px">

        <div style="width: 120px; display:inline-block;">Key</div>
        <div style="width: 300px; display:inline-block;">Value</div>
        <br />
        <div class="rows">
            @if($attribute->configuration)
                @foreach($attribute->configuration as $key => $row)
                    <div style="padding-bottom: 3px">
                        <input type="text" name="configuration[{{$attribute->id}}][{{$key}}][key]" value="{{$row["key"]}}" class="form-control" style="display: inline-block; width:100px; margin-right:10px" />
                        <input type="text" name="configuration[{{$attribute->id}}][{{$key}}][value]" value="{{$row["value"]}}" class="form-control" style="display: inline-block; width:300px" />
                        <a href="javascript:;" class="cancel remove-row">&times;</a>
                    </div>
                @endforeach
            @endif
        </div>
    
        <br />
        <a href="javascript:;" class="add-row btn btn-primary">neue zeile</a>
    </div>
</div>
<script>
    ;(function(){
        
        var container = $("#selectbox-config-{{$attribute->id}}"),
            i = container.find(".rows > div").length - 1;

        container.find(".add-row").click(function(){
            
            i++;
            
            container.find(".rows").append(
                '<div style="padding-bottom: 3px">' +
                    '<input type="text" name="configuration[{{$attribute->id}}][' + i + '][key]" value="" class="form-control" style="display: inline-block; width:100px; margin-right:10px" /> ' +
                    '<input type="text" name="configuration[{{$attribute->id}}][' + i + '][value]" value="" class="form-control" style="display: inline-block; width:300px" /> ' +
                    '<a href="javascript:;" class="cancel remove-row">&times;</a>' +
                '</div>'
            );
        });
        
        container.find(".remove-row").on("click", function(){
            $(this).parent().remove();
        });
        
    })();
</script>