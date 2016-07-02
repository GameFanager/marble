@extends('admin.layouts.app')

@section('content')

    <h1>{{$node->name}}</h1>

    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>{{$node->name}}</h2>
        </header>
        <div class="main-box-body clearfix">


            <form action="{{url("admin/node/save/" . $node->id) }}" enctype="multipart/form-data" method="post">

                {!! csrf_field() !!}


                @foreach($node->attributes as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->classAttribute->name }}</label>
                        
                        @if($attribute->classAttribute->translate)
                            <div class="lang-container">
                                <div class="lang-switch-container">
                                    @foreach($languages as $i => $language)
                                        <div class="lang-switch {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">{{$language->name}}</div>
                                    @endforeach
                                </div>

                                @foreach($languages as $i => $language)
                                    <div class="lang-content {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">
                                        {!! $attribute->class->renderEdit($language->id)!!} 
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {!! $attribute->class->renderEdit($locale_id)!!}
                        @endif
                    </div>
                @endforeach
                
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Speichern" />
                </div>
            </form>

        </div>
    </div>

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
        
        $(".object-browser-list").click(function(){
            var attributeId = $(this).data("attribute-id"),
                locale = $(this).data("locale"),
                $modal = $("#edit-modal-" + attributeId + "-" + locale);
                
            $modal.modal("show");
        });

        $(".object-browser-list").each(function(){
            var attributeId = $(this).data("attribute-id"),
                locale = $(this).data("locale"),
                $modal = $("#edit-modal-" + attributeId + "-" + locale),
                $inputContainer = $("#object-relation-list-inputs-" + attributeId + "-" + locale),
                $nameContainer = $("#object-relation-list-names-" + attributeId + "-" + locale);
                
            $modal.find("[data-node-id]").on("click", function(){
                var nodeId = $(this).data("node-id"),
                    nodeName = $(this).data("node-name"),
                    index = $inputContainer.find("input").length + 1;
                
                $("#object-relation-list-empty-input-" + attributeId + "-" + locale).remove();
                $("#object-relation-list-no-items-" + attributeId + "-" + locale).hide();

                
                $inputContainer.append(
                    '<input type="hidden" name="attributes[' + attributeId + '][' + locale + '][]" id="object-relation-list-input-' + attributeId + '-' + locale + '-' + index + '" value="' + nodeId + '" />'
                );
                $nameContainer.append(
                    '<p id="object-relation-list-name-' + attributeId + '-' + locale + '-' + index + '">' +
                        '<b>' + nodeName + '</b> ' +
                        ' &nbsp; ' +
                        '<b style="cursor:pointer;color:red;" class="object-browser-list-delete" data-attribute-id="' + attributeId + '" data-locale="' + locale + '" data-index="' + index + '">&times;</b>' +
                    '</p>'
                );
                
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
        
        $(document.body).on("click", ".object-browser-list-delete", function(){
            var attributeId = $(this).data("attribute-id"),
                locale = $(this).data("locale"),
                index = $(this).data("index"),
                $input = $("#object-relation-list-input-" + attributeId + "-" + locale + "-" + index),
                $name = $("#object-relation-list-name-" + attributeId + "-" + locale + "-" + index),
                $parent = $input.parent();
            
            if( $parent.find("input").length == 1 ){
                $("#object-relation-list-no-items-" + attributeId + "-" + locale).show();
                $parent.append('<input id="object-relation-list-empty-input-' + attributeId + '-' + locale + '" type="hidden" name="attributes[' + attributeId + '][' + locale + ']" value="" />');
            }

            $input.remove();
            $name.remove();
        });

        $(".lang-switch").click(function(){
            var $parent = $(this).parent().parent(),
                lang = $(this).data("lang");
            
            $parent.find(".lang-switch, .lang-content").removeClass("active");
                
            $parent.find("[data-lang=" + lang + "]").addClass("active");
        });
    </script>
@endsection