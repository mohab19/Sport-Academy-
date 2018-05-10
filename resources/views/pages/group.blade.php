@extends('layouts.master')

@section('style')
    <style>
        .type{
            display: none;
        }
    </style>

@endsection

@section('title')
    {{$group->name}}
@endsection

@section('contents')
    @include('forms.groups.update')
    @include('forms.groups.delete')
    @include('forms.groups.users.add')
    @include('forms.groups.users.delete')
    <section class="header">
        <div class="container">
            <h5 class="fl-left">Group : {{$group->name}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('groups')}}">Back To Groups</a> </h5>
        </div>
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="text-center" style="padding-top:20px;">
                <button class="main-button" data-popup="update-group-popup">Update Group</button>
                <button class="main-button"  data-popup="delete-group-popup">Delete Group</button>
            </div>
            <div class="box box-lg text-center">
                <h3 class="title rose text-left">Users</h3>
                <div class="text-right">
                    <button class="main-button" data-popup="add-user-popup">Add User</button>
                </div>
                <table id="attachments-table" class="table text-center">
                    <thead>
                    <tr class="info">
                        <th>User</th>
                        <th>Role</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            {{$group->owner->name}}
                        </td>
                        <td>
                            Owner
                        </td>
                        <td>

                        </td>
                    </tr>
                    @foreach($group->group_users as $group_user)
                    <tr>
                        <td>
                            {{$group_user->user->name}}
                        </td>
                        <td>
                            {{$group_user->user->role->name}}
                        </td>
                        <td>
                            <i data-id="{{$group_user->id}}" class="fa fa-close white DeleteUserGroupButton" data-popup="delete-user-popup"></i>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('Ajax/Group.js')}}"></script>
@endsection
