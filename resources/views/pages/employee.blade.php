@extends('layouts.master')

@section('style')


@endsection

@section('title')
    {{$employee->name}}
@endsection

@section('contents')

    @include('forms.users.penalties.add')
    @include('forms.users.penalties.update')
    @include('forms.users.penalties.delete')
    @include('forms.users.extras.add')
    @include('forms.users.extras.update')
    @include('forms.users.extras.delete')
    @include('forms.users.attachments.add')

    <section class="header">
        <div class="container">
            <h5 class="fl-left">Employee : {{$employee->name}}</h5>
            <h5 class="fl-right"><a href="{{URL::route('employees')}}">Back To Employees</a> </h5>
        </div>
    </section>
    <div id="private">
        <input type="hidden" id="EmployeeID" value="{{$employee->id}}">
        <input type="hidden" id="UserID" value="{{$employee->user_id}}">
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="box box-lg info">
                <h3 class="title rose">Info</h3>
                    @include('forms.employees.update')
        </div>
        <div class="box text-center">
            <h3 class="title rose text-left">Penalties</h3>
            <div class="text-right">
                <button class="main-button" data-popup="add-penalty-popup">Add Penalty</button>
            </div>
            <table id="penalties-table" class="table text-center list-view">
                <thead>
                <tr class="info">
                    <th>Reason</th>
                    <th>Value</th>
                    <th>Date</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($employee->user->outcomes)
                @foreach($employee->user->outcomes as $outcome)
                    @if($outcome->outcomes_type_id == 4)
                    <tr class="danger">
                        <td id="title">{{$outcome->title}}</td>
                        <td id="value">{{$outcome->value}}</td>
                        <td>{{$outcome->date}}</td>
                        <td>
                            <i data-id="{{$outcome->id}}" class="fa fa-pencil white UpdatePenaltyButton" data-popup="update-penalty-popup"></i>
                            <i data-id="{{$outcome->id}}" class="fa fa-close white DeletePenaltyButton" data-popup="delete-penalty-popup"></i>

                        </td>
                    </tr>
                    @endif
                @endforeach
                    @endif
                </tbody>
            </table>
        </div>
            <div class="box text-center">
                <h3 class="title rose text-left">Extras</h3>
                <div class="text-right">
                    <button class="main-button" data-popup="add-extra-popup">Add Extra</button>
                </div>
                <table id="extras-table" class="table text-center list-view">
                    <thead>
                    <tr class="info">
                        <th>Reason</th>
                        <th>Value</th>
                        <th>Date</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($employee->user->outcomes)
                        @foreach($employee->user->outcomes as $outcome)
                            @if($outcome->outcomes_type_id == 5)
                                <tr class="danger">
                                    <td id="title">{{$outcome->title}}</td>
                                    <td id="value">{{$outcome->value}}</td>
                                    <td>{{$outcome->date}}</td>
                                    <td>
                                        <i data-id="{{$outcome->id}}" class="fa fa-pencil white UpdateExtraButton" data-popup="update-extra-popup"></i>
                                        <i data-id="{{$outcome->id}}" class="fa fa-close white DeleteExtraButton" data-popup="delete-extra-popup"></i>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="box box-lg text-center">
                <h3 class="title rose text-left">Attachments</h3>
                <div class="text-right">
                    <button class="main-button" data-popup="add-attachment-popup">Add Attachment</button>
                </div>
                <table id="attachments-table" class="table text-center list-view">
                    <thead>
                    <tr class="info">
                        <th>Title</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($employee->user->attachments)
                        @foreach($employee->user->attachments as $attachment)
                            <?php $pictures = explode("||",$attachment->value) ?>
                                <tr class="danger">
                                    <td id="title">{{$attachment->title}}</td>
                                    <td id="value" class="text-center">
                                        @foreach($pictures as $picture)
                                        <div class="image text-center" style="display: inline-block">
                                            <div>
                                        <img src="{{$picture}}" width="200" height="100">
                                            </div>
                                            <div style="margin-top:5px;">
                                                <a href="{{$picture}}" download><button class="main-button sm-button">Download</button></a>
                                            </div>
                                        </div>
                                            @endforeach
                                    </td>
                                </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
    </div>
    </div>
    <div class="clearfix"></div>
@endsection
@section('script')
    <script src="{{ asset('Ajax/Employee.js')}}"></script>
    <script src="{{ asset('Ajax/Penalties_Extras.js')}}"></script>
    <script src="{{ asset('Ajax/Attachments.js')}}"></script>
@endsection
