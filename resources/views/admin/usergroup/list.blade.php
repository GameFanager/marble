@extends('admin.layouts.app')

@section('content')

    <h1>
    	Benutzergruppen
        @if(App\PermissionHelper::allowed("create_group"))
            <div class="pull-right">
                <a href="{{ url("admin/usergroup/add") }}" class="btn btn-xs btn-success">Benutzergruppe hinzufügen</a>
            </div>
        @endif
    </h1>


    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>
                Benutzergruppen
            </h2>
        </header>
        <div class="main-box-body clearfix">        
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><a href="#"><span>Name</span></a></th>
                            <th class="text-right"><span>&nbsp;</span></th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($groups as $group)
                            <tr>
                                <td>
                                    @if(App\PermissionHelper::allowed("edit_group"))
                                        <a href="{{ url("admin/usergroup/edit/" . $group->id) }}">{{$group->name}}</a>
                                    @else
                                        {{$group->name}}
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        @if(App\PermissionHelper::allowed("edit_group"))
                                            <a href="{{ url("admin/usergroup/edit/" . $group->id) }}" class="btn btn-info btn-xs">Bearbeiten</a>
                                        @endif
                                        @if($group->id != 0 and App\PermissionHelper::allowed("delete_group"))
                                            <a href="{{ url("admin/usergroup/delete/" . $group->id) }}" onclick="return confirm('Benutzergruppe wirklich löschen?');" class="btn btn-xs btn-danger">Löschen</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

@endsection