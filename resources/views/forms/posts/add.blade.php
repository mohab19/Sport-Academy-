<div id="add-post-popup" class="popup"> <!-- add-player-popup -->
    <i class="fa fa-close gray" data-toggle="tooltip" data-placement="right" title="Close"></i>
    <div class="popup-content">
        <form id="AddPost" method="POST" class="text-center"   enctype="multipart/form-data">
            {!! csrf_field() !!}
                <input type="hidden" value="1" name="post_type_id">
            <div class="col-xs-12">
                <textarea placeholder="What do you want to say ?" name="body"></textarea>
                <label class="alert" id="Post_body"></label>
            </div>
            <div class="col-xs-12 group">
                <select multiple title="Choose Group" name="groups_id[]" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    <option value="">Choose Group</option>
                    @if($user->role->name != "Admin")
                    @foreach($user->user_groups as $user_group)
                    <option value="{{$user_group->group->id}}">{{$user_group->group->name}}</option>
                    @endforeach
                        @else
                        @foreach($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    @endif
                </select>
                <label class="alert" id="Post_group_id"></label>
            </div>
            <div class="col-xs-12 text-left">
                <label >Attachments</label>
                <input type="file" name="picture[]" multiple>
            </div>
            <div class="clearfix"></div>
            <div class="alert"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button type="submit" class="main-button">Publish</button>
            </div>
        </form>
    </div>
</div>