<div id="add-employee-popup" class="popup"> <!-- add-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>

    <div class="popup-content"> <!-- start popup-content -->
        <form id="AddEmployee" enctype="multipart/form-data" method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <div class="col-md-12"> <!-- Employee name -->
                <input type="text" name="full_name" placeholder="Full Name"/>
                <label class="alert" id="Employee_fullname"></label>
            </div>
            <div class="col-md-6 col-xs-12">
                <select multiple title="Choose Place" name="places_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                    @foreach($Places as $Place)
                        <option value="{{$Place->id}}">{{$Place->name}}</option>
                    @endforeach
                </select>
                <label class="alert" id="Employee_place"></label>
            </div>
            <div class="col-md-6">
                <input type="text" name="email" placeholder="Email"/>
                <label class="alert" id="Employee_email"></label>
            </div>
            <div class="col-md-12">
                <label class="text-left">Birthdate</label>
                <input type="date" name="birthdate" placeholder="Birthdate"/>
                <label class="alert" id="Employee_birthdate"></label>
            </div>
            <div class="col-md-6">
                <input type="text" name="phone" placeholder="Phone"/>
                <label class="alert" id="Employee_phone"></label>
            </div>
            <div class="col-md-6">
                <input type="text" name="address" placeholder="Address"/>
                <label class="alert" id="Employee_address"></label>
            </div>
            <div class="col-md-12">
                <input type="text" name="salary" placeholder="Salary"/>
                <label class="alert" id="Employee_salary"></label>
            </div>
            <div class="col-md-6">
                <select multiple title="Reports Permissions" name="reports_id[]" class="selectpicker" data-show-subtext="false" data-live-search="true">
                    @foreach($reports as $report)
                        <option value="{{$report->id}}">{{$report->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select title="Employee Type" name="role_id" class="selectpicker" data-show-subtext="false" data-live-search="true">
                    <option selected disabled value="">Employee Type</option>
                    <option value="5">Super Employee</option>
                        <option value="3">Basic Employee</option>
                </select>
                <label class="alert" id="Employee_role_id"></label>
            </div>
            <div class="col-xs-12 text-left">
                <label >Profile Picture</label>
                <input type="file" name="picture" id="Picture">
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add Employee</button>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>

        </form>
    </div> <!-- end popup content -->

</div> <!-- add-Employee-popup -->