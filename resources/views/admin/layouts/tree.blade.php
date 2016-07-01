
@if( $isRoot )
    <ul class="nav nav-pills nav-stacked">
@else 
    <ul class="submenu" style="display:block">
@endif

    @foreach($nodes as $node)
        <li class="open">
            <a href="{{url("/admin/node/edit/". $node->id)}}" class="{{ count($node->children) ? "dropdown-toggle" : "" }}">
               <span>{{$node->name["en"]}}</span>
            </a>

            @include("admin/layouts/tree", array("nodes" => $node->children, "isRoot" => false))
        </li>
    @endforeach

</ul>