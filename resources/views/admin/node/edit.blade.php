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
        
        $(".object-browser-delete").click(function(){
            var inputId = $(this).data("input-id"),
                nameId = $(this).data("input-name");
            
            $("#" + inputId).val("");
            $("#" + nameId).text("Kein Objekt ausgewählt!");
            $(this).hide();
        });
        
        $(".lang-switch").click(function(){
            var $parent = $(this).parent().parent(),
                lang = $(this).data("lang");
            
            $parent.find(".lang-switch, .lang-content").removeClass("active");
                
            $parent.find("[data-lang=" + lang + "]").addClass("active");
        });
    </script>
@endsection