@extends('admin.layouts.app')

@section('content')

    <h1>Klasse Editieren - {{$nodeClass->name}}</h1>

    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>Klasse Editieren</h2>
        </header>
        <div class="main-box-body clearfix">
            <form action="{{ url("admin/nodeclass/save/" . $nodeClass->id) }}" method="post">
                {!! csrf_field() !!}
            
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$nodeClass->name}}" class="form-control"/>
                </div>
            
                <div class="form-group">
                    <label>Identifier</label>
                    <input type="text" name="named_identifier" value="{{$nodeClass->named_identifier}}" class="form-control"/>
                </div>   

                <div class="form-group">
                    <label>Icon <span><i class="fa" id="icon-preview"></i></span></label>
                    <input id="icon-input" autocomplete="off" type="text" name="icon" value="{{$nodeClass->icon}}" class="form-control" />
                    <div id="icon-suggestion" style="max-height: 130px;overflow: scroll; padding: 10px; border: 1px solid #ddd"></div>
                    <script>
                        ;(function(){
                            
                            var classes = "fa-automobile,fa-bank,fa-behance,fa-behance-square,fa-bomb,fa-building,fa-cab,fa-car,fa-child,fa-circle-o-notch,fa-circle-thin,fa-codepen,fa-cube,fa-cubes,fa-database,fa-delicious,fa-deviantart,fa-digg,fa-drupal,fa-empire,fa-envelope-square,fa-fax,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,fa-file-movie-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-ge,fa-git,fa-git-square,fa-google,fa-graduation-cap,fa-hacker-news,fa-header,fa-history,fa-institution,fa-joomla,fa-jsfiddle,fa-language,fa-life-bouy,fa-life-ring,fa-life-saver,fa-mortar-board,fa-openid,fa-paper-plane,fa-paper-plane-o,fa-paragraph,fa-paw,fa-pied-piper,fa-pied-piper-alt,fa-pied-piper-square,fa-qq,fa-ra,fa-rebel,fa-recycle,fa-reddit,fa-reddit-square,fa-send,fa-send-o,fa-share-alt,fa-share-alt-square,fa-slack,fa-sliders,fa-soundcloud,fa-space-shuttle,fa-spoon,fa-spotify,fa-steam,fa-steam-square,fa-stumbleupon,fa-stumbleupon-circle,fa-support,fa-taxi,fa-tencent-weibo,fa-tree,fa-university,fa-vine,fa-wechat,fa-weixin,fa-wordpress,fa-yahoo,fa-adjust,fa-anchor,fa-archive,fa-arrows,fa-arrows-h,fa-arrows-v,fa-asterisk,fa-automobile,fa-ban,fa-bank,fa-bar-chart-o,fa-barcode,fa-bars,fa-beer,fa-bell,fa-bell-o,fa-bolt,fa-bomb,fa-book,fa-bookmark,fa-bookmark-o,fa-briefcase,fa-bug,fa-building,fa-building-o,fa-bullhorn,fa-bullseye,fa-cab,fa-calendar,fa-calendar-o,fa-camera,fa-camera-retro,fa-car,fa-caret-square-o-down,fa-caret-square-o-left,fa-caret-square-o-right,fa-caret-square-o-up,fa-certificate,fa-check,fa-check-circle,fa-check-circle-o,fa-check-square,fa-check-square-o,fa-child,fa-circle,fa-circle-o,fa-circle-o-notch,fa-circle-thin,fa-clock-o,fa-cloud,fa-cloud-download,fa-cloud-upload,fa-code,fa-code-fork,fa-coffee,fa-cog,fa-cogs,fa-comment,fa-comment-o,fa-comments,fa-comments-o,fa-compass,fa-credit-card,fa-crop,fa-crosshairs,fa-cube,fa-cubes,fa-cutlery,fa-dashboard,fa-database,fa-desktop,fa-dot-circle-o,fa-download,fa-edit,fa-ellipsis-h,fa-ellipsis-v,fa-envelope,fa-envelope-o,fa-envelope-square,fa-eraser,fa-exchange,fa-exclamation,fa-exclamation-circle,fa-exclamation-triangle,fa-external-link,fa-external-link-square,fa-eye,fa-eye-slash,fa-fax,fa-female,fa-fighter-jet,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,fa-file-movie-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-film,fa-filter,fa-fire,fa-fire-extinguisher,fa-flag,fa-flag-checkered,fa-flag-o,fa-flash,fa-flask,fa-folder,fa-folder-o,fa-folder-open,fa-folder-open-o,fa-frown-o,fa-gamepad,fa-gavel,fa-gear,fa-gears,fa-gift,fa-glass,fa-globe,fa-graduation-cap,fa-group,fa-hdd-o,fa-headphones,fa-heart,fa-heart-o,fa-history,fa-home,fa-image,fa-inbox,fa-info,fa-info-circle,fa-institution,fa-key,fa-keyboard-o,fa-language,fa-laptop,fa-leaf,fa-legal,fa-lemon-o,fa-level-down,fa-level-up,fa-life-bouy,fa-life-ring,fa-life-saver,fa-lightbulb-o,fa-location-arrow,fa-lock,fa-magic,fa-magnet,fa-mail-forward,fa-mail-reply,fa-mail-reply-all,fa-male,fa-map-marker,fa-meh-o,fa-microphone,fa-microphone-slash,fa-minus,fa-minus-circle,fa-minus-square,fa-minus-square-o,fa-mobile,fa-mobile-phone,fa-money,fa-moon-o,fa-mortar-board,fa-music,fa-navicon,fa-paper-plane,fa-paper-plane-o,fa-paw,fa-pencil,fa-pencil-square,fa-pencil-square-o,fa-phone,fa-phone-square,fa-photo,fa-picture-o,fa-plane,fa-plus,fa-plus-circle,fa-plus-square,fa-plus-square-o,fa-power-off,fa-print,fa-puzzle-piece,fa-qrcode,fa-question,fa-question-circle,fa-quote-left,fa-quote-right,fa-random,fa-recycle,fa-refresh,fa-reorder,fa-reply,fa-reply-all,fa-retweet,fa-road,fa-rocket,fa-rss,fa-rss-square,fa-search,fa-search-minus,fa-search-plus,fa-send,fa-send-o,fa-share,fa-share-alt,fa-share-alt-square,fa-share-square,fa-share-square-o,fa-shield,fa-shopping-cart,fa-sign-in,fa-sign-out,fa-signal,fa-sitemap,fa-sliders,fa-smile-o,fa-sort,fa-sort-alpha-asc,fa-sort-alpha-desc,fa-sort-amount-asc,fa-sort-amount-desc,fa-sort-asc,fa-sort-desc,fa-sort-down,fa-sort-numeric-asc,fa-sort-numeric-desc,fa-sort-up,fa-space-shuttle,fa-spinner,fa-spoon,fa-square,fa-square-o,fa-star,fa-star-half,fa-star-half-empty,fa-star-half-full,fa-star-half-o,fa-star-o,fa-suitcase,fa-sun-o,fa-support,fa-tablet,fa-tachometer,fa-tag,fa-tags,fa-tasks,fa-taxi,fa-terminal,fa-thumb-tack,fa-thumbs-down,fa-thumbs-o-down,fa-thumbs-o-up,fa-thumbs-up,fa-ticket,fa-times,fa-times-circle,fa-times-circle-o,fa-tint,fa-toggle-down,fa-toggle-left,fa-toggle-right,fa-toggle-up,fa-trash-o,fa-tree,fa-trophy,fa-truck,fa-umbrella,fa-university,fa-unlock,fa-unlock-alt,fa-unsorted,fa-upload,fa-user,fa-users,fa-video-camera,fa-volume-down,fa-volume-off,fa-volume-up,fa-warning,fa-wheelchair,fa-wrench,fa-file,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,fa-file-movie-o,fa-file-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-text,fa-file-text-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-info-circle fa-lg fa-li,fa-circle-o-notch,fa-cog,fa-gear,fa-refresh,fa-spinner,fa-check-square,fa-check-square-o,fa-circle,fa-circle-o,fa-dot-circle-o,fa-minus-square,fa-minus-square-o,fa-plus-square,fa-plus-square-o,fa-square,fa-square-o,fa-bitcoin,fa-btc,fa-cny,fa-dollar,fa-eur,fa-euro,fa-gbp,fa-inr,fa-jpy,fa-krw,fa-money,fa-rmb,fa-rouble,fa-rub,fa-ruble,fa-rupee,fa-try,fa-turkish-lira,fa-usd,fa-won,fa-yen,fa-align-center,fa-align-justify,fa-align-left,fa-align-right,fa-bold,fa-chain,fa-chain-broken,fa-clipboard,fa-columns,fa-copy,fa-cut,fa-dedent,fa-eraser,fa-file,fa-file-o,fa-file-text,fa-file-text-o,fa-files-o,fa-floppy-o,fa-font,fa-header,fa-indent,fa-italic,fa-link,fa-list,fa-list-alt,fa-list-ol,fa-list-ul,fa-outdent,fa-paperclip,fa-paragraph,fa-paste,fa-repeat,fa-rotate-left,fa-rotate-right,fa-save,fa-scissors,fa-strikethrough,fa-subscript,fa-superscript,fa-table,fa-text-height,fa-text-width,fa-th,fa-th-large,fa-th-list,fa-underline,fa-undo,fa-unlink,fa-angle-double-down,fa-angle-double-left,fa-angle-double-right,fa-angle-double-up,fa-angle-down,fa-angle-left,fa-angle-right,fa-angle-up,fa-arrow-circle-down,fa-arrow-circle-left,fa-arrow-circle-o-down,fa-arrow-circle-o-left,fa-arrow-circle-o-right,fa-arrow-circle-o-up,fa-arrow-circle-right,fa-arrow-circle-up,fa-arrow-down,fa-arrow-left,fa-arrow-right,fa-arrow-up,fa-arrows,fa-arrows-alt,fa-arrows-h,fa-arrows-v,fa-caret-down,fa-caret-left,fa-caret-right,fa-caret-square-o-down,fa-caret-square-o-left,fa-caret-square-o-right,fa-caret-square-o-up,fa-caret-up,fa-chevron-circle-down,fa-chevron-circle-left,fa-chevron-circle-right,fa-chevron-circle-up,fa-chevron-down,fa-chevron-left,fa-chevron-right,fa-chevron-up,fa-hand-o-down,fa-hand-o-left,fa-hand-o-right,fa-hand-o-up,fa-long-arrow-down,fa-long-arrow-left,fa-long-arrow-right,fa-long-arrow-up,fa-toggle-down,fa-toggle-left,fa-toggle-right,fa-toggle-up,fa-arrows-alt,fa-backward,fa-compress,fa-eject,fa-expand,fa-fast-backward,fa-fast-forward,fa-forward,fa-pause,fa-play,fa-play-circle,fa-play-circle-o,fa-step-backward,fa-step-forward,fa-stop,fa-youtube-play,fa-warning,fa-adn,fa-android,fa-apple,fa-behance,fa-behance-square,fa-bitbucket,fa-bitbucket-square,fa-bitcoin,fa-btc,fa-codepen,fa-css3,fa-delicious,fa-deviantart,fa-digg,fa-dribbble,fa-dropbox,fa-drupal,fa-empire,fa-facebook,fa-facebook-square,fa-flickr,fa-foursquare,fa-ge,fa-git,fa-git-square,fa-github,fa-github-alt,fa-github-square,fa-gittip,fa-google,fa-google-plus,fa-google-plus-square,fa-hacker-news,fa-html5,fa-instagram,fa-joomla,fa-jsfiddle,fa-linkedin,fa-linkedin-square,fa-linux,fa-maxcdn,fa-openid,fa-pagelines,fa-pied-piper,fa-pied-piper-alt,fa-pied-piper-square,fa-pinterest,fa-pinterest-square,fa-qq,fa-ra,fa-rebel,fa-reddit,fa-reddit-square,fa-renren,fa-share-alt,fa-share-alt-square,fa-skype,fa-slack,fa-soundcloud,fa-spotify,fa-stack-exchange,fa-stack-overflow,fa-steam,fa-steam-square,fa-stumbleupon,fa-stumbleupon-circle,fa-tencent-weibo,fa-trello,fa-tumblr,fa-tumblr-square,fa-twitter,fa-twitter-square,fa-vimeo-square,fa-vine,fa-vk,fa-wechat,fa-weibo,fa-weixin,fa-windows,fa-wordpress,fa-xing,fa-xing-square,fa-yahoo,fa-youtube,fa-youtube-play,fa-youtube-square,fa-ambulance,fa-h-square,fa-hospital-o,fa-medkit,fa-plus-square,fa-stethoscope,fa-user-md,fa-wheelchair".split(",");
                            
                            var iconPreview = function(){
                                
                                var val = $("#icon-input").val(),
                                    suggestions = [];
                                $("#icon-preview").attr("class", "fa fa-" + val);
                                
                                $(classes).each(function(k, v){
                                    if( v.indexOf(val) !== -1 ){
                                        suggestions.push('<div style="cursor:pointer; display: inline-block; background: #eee; padding: 5px 10px; border-radius: 3px; margin: 0 5px 5px 0;" onclick="$(\'#icon-input\').val(\'' + v.split("fa-").join("") + '\');"><i class="fa ' + v + '"></i> ' + v + '</div>');
                                    }
                                });
                                
                                $("#icon-suggestion").html( suggestions.join("") );
                            };
                            
                            
                            $("#icon-input").keyup(iconPreview);
                            iconPreview();
                            
                        })();
                    </script>
                </div>
            
                <div class="form-group">
                    <label>Kinder erlaubt</label>
                    <select name="allow_children" class="form-control">
                        <option value="1" {{ $nodeClass->allow_children == 1 ? 'selected="selected"' : '' }}>ja</option>
                        <option value="0" {{ $nodeClass->allow_children == 0 ? 'selected="selected"' : '' }}>nein</option>
                    </select>
                </div>
            
                <div class="form-group">
                    <label>Gruppe</label>
                    <select name="group_id" class="form-control">
                        @foreach($nodeClassGroups as $nodeClassGroup)
                            <option value="{{$nodeClassGroup->id}}" {{ $nodeClassGroup->id == $nodeClass->group_id ? 'selected="selected"' : '' }}>{{$nodeClassGroup->name}}</option>
                        @endforeach
                    </select>
                </div>
            
            
                <div class="form-group">
                    <a class="btn btn-danger" href="admin/dashboard">Abbrechen</a>
                    <input type="submit" class="btn btn-success" value="Speichern" />
                </div>
            </form>
        </div>
    </div>
    

@endsection