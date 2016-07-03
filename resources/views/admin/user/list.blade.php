@extends('admin.layouts.app')

@section('content')

    <h1>
    	Benutzer
        <div class="pull-right">
    		<a href="{{ url("admin/user/add") }}" class="btn btn-xs btn-success">User hinzufügen</a>
        </div>
    </h1>


    <div class="main-box">
        <header class="main-box-header clearfix">
            <h2>
                Benutzer
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
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ url("admin/user/edit/" . $user->id) }}">{{$user->name}}</a>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ url("admin/user/edit/" . $user->id) }}" class="btn btn-info btn-xs">Bearbeiten</a>
                                        <a href="{{ url("admin/user/delete/" . $user->id) }}" onclick="return confirm('Benutzer wirklich löschen?');" class="btn btn-xs btn-danger">Löschen</a>
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