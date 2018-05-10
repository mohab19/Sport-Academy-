    $(function () {
        function GetDataToSend() {
            return {
                _token: $('#AddAttendance input[name="_token"]').val(),
            };
        }

        var ID;
        $("#AddAttendance input[name='attend']").change(function(){
            $(this).attr("checked", !$(this).attr("checked"));
            waiting();
            ID = $(this).attr("data-id");
            var Attend;
            if ($(this).attr("checked")) {
                Attend = 1;
                $.ajax({
                    url:"/attendance/"+ID+"/"+Attend,
                    type:"POST",
                    data:GetDataToSend(),
                    success:function(data){
                        finish();
                       // alert(data);
                    },
                    error:function(data){reload(data); //tellme(data)
                        //
                        //
                        //
                    }
                });
            }
            else
            {
                Attend = 0;
                $.ajax({
                    url:"/attendance/"+ID+"/"+Attend,
                    type:"POST",
                    data:GetDataToSend(),
                    success:function(data){
                        finish()
                        // alert(data);
                    },
                    error:function(data){
                       reload(data);
                        //tellme(data)

                    }
                });
            }
            //     $($this).("checked")
            //     ID = $(this).attr('data-id');
            // alert(ID);
            // alert($(this).val());
            // var button = $('#AddAttendance>div>button[type="submit"]');
            // button_waiting(button);
            // e.preventDefault();

        })
    });