<form id="UpdateEmployee" enctype="multipart/form-data" method="POST">
    <table class="table">
        <thead>
        <tr class="info">
            <th>Title</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>

        {!! csrf_field() !!}
        <tr class="danger">
            <td>Photo</td>
            <td>
                <div class="col-md-12" style="margin-bottom:20px;">
                    <img src="@if($employee->user->picture){{$employee->user->picture}}@else {{asset('images/Users/default.gif')}} @endif" width="300">
                </div>
                <div class="col-md-12">

                    <input type="file" name="picture" id="Picture">
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Name</td>
            <td>
                <div class="col-md-12">
                    <input class="sm" type="text" name="full_name" value="{{$employee->user->full_name}}">
                    <label class="alert" id="Employee_fullname"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Birthdate</td>
            <td>
                <div class="col-md-12">
                    <input class="sm" type="date" name="birthdate" value="{{date('Y-m-d',strtotime($employee->user->birth))}}">
                    <label class="alert" id="Employee_birthdate"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Place</td>
            <td>
                <div class="col-md-12"> <!-- place -->
                    <select multiple title="Choose Place" data-width="100%" name="places_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                        @foreach($places as $place)
                            <option
                                    @foreach($employee->employee_places as $employee_place)
                                    @if($employee_place->place->id == $place->id)
                                    selected
                                    @endif
                                    @endforeach
                                    value="{{$place->id}}">{{$place->name}}</option>
                        @endforeach
                    </select>
                    <label class="alert" id="Employee_place"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Reports</td>
            <td>
                <div class="col-md-12"> <!-- place -->
                    <select multiple title="Reports Permissions" data-width="100%" name="reports_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                        @foreach($reports as $report)
                            <option
                                    @foreach($employee->user->reports as $employee_report)
                                    @if($employee_report->report->id == $report->id)
                                    selected
                                    @endif
                                    @endforeach
                                    value="{{$report->id}}">{{$report->title}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Address</td>
            <td>
                <div class="col-md-12">
                    <input type="text" class="sm" name="address" value="{{$employee->user->address}}">
                    <label class="alert" id="Employee_address"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Phone</td>
            <td>
                <div class="col-md-12">
                    <input type="text" class="sm" name="phone" value="{{$employee->user->phone}}">
                    <label class="alert" id="Employee_phone"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Email</td>
            <td>
                <div class="col-md-12">
                    <input type="text" class="sm" name="email" value="{{$employee->user->email}}">
                    <label class="alert" id="Employee_email"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Username</td>
            <td>
                <div class="col-md-12">
                    <input type="text" class="sm" name="username" value="{{$employee->user->username}}">
                    <label class="alert" id="Employee_username"></label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Default Password</td>
            <td>
                <div class="col-md-12">
                    <label>employee{{$employee->user->id}}</label>
                </div>
            </td>
        </tr>
        <tr class="danger">
            <td>Salary</td>
            <td>
                <div class="col-md-12">
                    <input type="text" class="sm" name="salary" value="{{$employee->salary}}">
                    <label class="alert" id="Employee_salary"></label>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="clearfix"></div>
    <div class="alert text-center"></div>
    <div class="clearfix"></div>
    <div class="text-center">
        <button class="main-button" type="submit">Update</button>
    </div>
</form>