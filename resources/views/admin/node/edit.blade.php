@extends('admin.layouts.app')

@section('content')

    <h1>{{$node->name["en"]}}</h1>

    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>{{$node->name["en"]}}</h2>
        </header>
        <div class="main-box-body clearfix">


            <form action="{{url("admin/node/save/" . $node->id) }}" enctype="multipart/form-data" method="post">

                {!! csrf_field() !!}

                <div class="form-group">
                	<label>Name</label>
                    <div class="lang-container">
                        <div class="lang-switch-container">
                            @foreach($languages as $i => $language)
                                <div class="lang-switch {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">{{$language->name}}</div>
                            @endforeach
                        </div>

                        @foreach($languages as $i => $language)
                            <div class="lang-content {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">
                                <input type="text" name="translationAttribute[name][{{$language->code}}]" value="{{$node->name[$language->code]}}" class="form-control"/>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                	<label>Slug</label>
                    <div class="lang-container">
                        <div class="lang-switch-container">
                            @foreach($languages as $i => $language)
                                <div class="lang-switch {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">{{$language->name}}</div>
                            @endforeach
                        </div>

                        @foreach($languages as $i => $language)
                            <div class="lang-content {{ $i == 0 ? 'active' : '' }}" data-lang="{{$language->code}}">
                                <input type="text" name="translationAttribute[slug][{{$language->code}}]" value="{{$node->slug[$language->code]}}" class="form-control"/>
                            </div>
                        @endforeach
                    </div>
                </div>

                @foreach($node->attributes as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->classAttribute->name }}</label>
                        
                        @if($attribute->classAttribute->translate)
                            <div class="lang-container">
                                <div class="lang-switch-container">
                                    <div class="lang-switch active" data-lang="de">DE</div>
                                    <div class="lang-switch" data-lang="en">EN</div>
                                </div>
                                <div class="lang-content active" data-lang="de">
                                    < ?= $this->node->get_edit_field($attribute, "de"); ?>
                                </div>
                                <div class="lang-content" data-lang="en">
                                    < ?= $this->node->get_edit_field($attribute, "en"); ?>
                                </div>
                            </div>
                        @else
                            {!! $attribute->class->renderEdit()!!}   
                            <div style="display: none">
                                < ?= $this->node->get_edit_field($attribute, "en"); ?>
                            </div>
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
        $(".lang-switch").click(function(){
            var $parent = $(this).parent().parent(),
                lang = $(this).data("lang");
            
            $parent.find(".lang-switch, .lang-content").removeClass("active");
                
            $parent.find("[data-lang=" + lang + "]").addClass("active");
        });
    </script>
@endsection