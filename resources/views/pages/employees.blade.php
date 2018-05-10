@extends('layouts.dashboard')

@section('style')


@endsection

@section('title')
    Employees
@endsection

@section('tab')
    @include('forms.employees.add')
    @include('forms.employees.delete')
    <button class="main-button AddButton" data-popup="add-employee-popup">+</button>
    <div role="tabpanel" class="tab-pane text-center active in" id="Employees"> <!-- Start tab Employees -->
        <div class="col-md-12"> <!-- search Employee -->
            <div class="col-xs-12 filter" id="Players-Filter"></div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 box-lg"> <!-- start Employees table -->
            <table id="Players-table" class="table text-center list-view">
                <thead> <!-- main row -->
                <tr class="info">
                    @foreach($employeesFields as $employeesField)
                        <th>{{$employeesField}}</th>
                    @endforeach
                    <th>Options</th>
                </tr>
                </thead> <!-- main row -->
                <tbody>
                @foreach($employees as $employee)
                    <tr class="danger">
                        @if($employee->user->picture)
                            <td><img src="{{$employee->user->picture}}" width="60" height="60" class="img-rounded"/></td>
                        @else
                            <td><img src="images/Users/default.gif" width="60" height="60" class="img-rounded"/></td>
                        @endif
                        <td>{{$employee->name}}</td>
                            <td>
                                @foreach($employee->employee_places as $employee_place)
                                    <div>{{$employee_place->place->name}}</div>
                                @endforeach
                            </td>
                        <td>{{$employee->user->birth}}</td>
                        <td>{{$employee->user->phone}}</td>
                        <td>{{$employee->user->address}}</td>
                        <td>{{$employee->salary}}</td>
                        <td>
                            <a href="{{"/employee/$employee->id/$employee->name"}}"><i class="fa fa-info"></i></a>
                            <i data-id="{{$employee->id}}" class="fa fa-close white DeleteEmployeeButton" data-id="{{$employee->id}}" data-popup="delete-employee-popup"></i>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table> <!-- table -->
        </div> <!-- end Employees table -->
        <div class="text-center pagination">

        </div>

    </div> <!-- End tab Employees -->
@endsection
@section('script')

    <script src="{{ asset('Ajax/Employees.js')}}"></script>

@endsection