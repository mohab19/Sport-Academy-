<div id="add-user-popup" class="popup"> <!-- add-Employee-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content"> <!-- start popup-content -->
        <form id="AddUserGroup"  method="POST" class="text-center" action="">
            {!! csrf_field() !!}
            <input type="hidden" name="group_id" value="{{$group->id}}">
            <div class="col-xs-12">
                <select title="Choose Type" name="type" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    <option value="">Choose Type</option>
                    <option value="levels">By Levels</option>
                    <option value="places">By Places</option>
                    <option value="users">By Users</option>
                </select>
                <label class="alert" id="Player_level"></label>
            </div>
            <div class="col-xs-12 type" id="levels">
                <select title="Choose Level" multiple name="levels_id[]" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    @foreach($levels as $level)
                        <option value="{{$level->id}}">{{$level->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 type" id="places">
                <select title="Choose Place" multiple name="places_id[]" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    @foreach($places as $place)
                        <option value="{{$place->id}}">{{$place->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 type" id="users">
                <select title="Choose User" multiple name="users_id[]" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    @foreach($users as $user)
                        <option value="{{$user->id}}" data-subtext="{{$user->role->name}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Add User</button>
            </div>
        </form>
    </div> <!-- end popup content -->

</div> <!-- add-Employee-popup -->