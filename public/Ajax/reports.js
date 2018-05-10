$(function () {

    function GetMonths() {
        waiting();
        $.ajax({
            url:"/reports/GetMonths",
            type:"POST",
            data:$("#Report").serialize(),
            dataType: "html",   //expect html to be returned
            success:function(data){
              // alert(data);
                $("#Report label.alert").fadeOut();
                $("#Report select[name='month'] option[value!=''][value!='all'] ").remove();
                $("#Report div.months select").append(data);
                finish();
            },
            error:function(data){reload(data); //tellme(data)
                // alert(data['responseText']);
                //
                //
                //
                var error = data.responseJSON;
                $("#Report label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#Report #Report_type',
                    ],
                    [   'type',
                    ]
                );
            }
        });
    }
    function GetYears () {
        waiting();
        $.ajax({
            url:"/reports/GetYears",
            type:"POST",
            data:$("#Report").serialize(),
            dataType: "html",   //expect html to be returned
            success:function(data){
                // alert(data);
                $("#Report label.alert").fadeOut();
                $("#Report select[name='year'] option[value!=''][value!='all'] ").remove();
                $("#Report div.years select").append(data);
                finish();
            },
            error:function(data){reload(data); //tellme(data)
                // alert(data['responseText']);
                //
                //
                //
                var error = data.responseJSON;
                $("#Report label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [   '#Report #Report_type',
                        '#Report #Report_month',
                    ],
                    [   'type',
                        'month',
                    ]
                );
            }
        });
    }
    $("#Report select[name='place_id']").change(function () {
            GetMonths();
        GetYears();
    });
    $("#Report").submit(function(e){
waiting();
        var button = $('#Report button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/reports/FinalReport",
            type:"POST",
            data:$("#Report").serialize(),
            success:function(data){
                alert(data);
                button_done(button);
                w = window.open('','newtab'); d = w.document.open("text/html","replace");
                d.writeln(data);
                // location.reload();
                // $(".results *").remove();
                // $("#Report label.alert").fadeOut();
                // $("div.box>.results").html('<div class="col-md-12"><div class="col-md-2 col-xs-4" id="Players-Length"></div> <div class="col-md-10 col-xs-8 filter" id="Players-Filter"></div> </div><table id="Results" class="table text-center"></table>');
                // $("table#Results").html(data);
                // $("div.box>.results").prepend('<div class="text-right"><button class="print main-button">Print</button></div>');
                // $("div.box").fadeIn(600);
                // $('#Results').DataTable({
                //     "paging": false,
                //     "lengthChange": false,
                //     "searching": true,
                //     "ordering": true,
                //     "info": false,
                //     "autoWidth": false
                // });
                // $(".dataTables_filter input").removeClass("form-control input-sm").
                // appendTo("#Players-Filter");
                // $(".dataTables_length select").removeClass("form-control input-sm").
                // appendTo("#Players-Length");
                // $("div.dataTables_length label , div.dataTables_filter label").remove();
                // $("div.filter input").attr('placeholder','Search ...');
                //
                // $(".dataTables_paginate").detach().appendTo(".pagination");
                finish();
            },
            error:function(data){reload(data);
            tellme(data)
                   // alert(data['responseText']);
                //
                //
                //
                var error = data.responseJSON;
                button_done(button);
                $("#Report label.alert").addClass("alert-danger").fadeIn();
                error_handler(
                    error,
                    [
                        '#Report #Report_type',
                        '#Report #Report_place',
                       '#Report #Report_month',
                        '#Report #Report_year'
                    ],
                    [
                        'type',
                        'place_id',
                       'month',
                        'year'
                    ]
                );
            }
        });
    })

});
