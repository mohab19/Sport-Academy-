<?php
use Illuminate\Support\Facades\DB;
Route::get('trial',function (){
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
Route::get('/','RouteController@index');
Route::post('/signup','PlayersController@signup');
Route::get('/email',function(){
    Mail::send('emails.test',['name'=>'Karim'],function($message){
        $message->to('karim.khamiss@gmail.com','Some One')->from('another@domain.com')->subject('Hello');
    });
});
Route::get('home','RouteController@index');
Route::get('/password/email','Auth\PasswordController@getEmail');
Route::post('/password/email','Auth\PasswordController@postEmail');
Route::get('/password/reset/{token}','Auth\PasswordController@getReset');
Route::post('/password/reset','Auth\PasswordController@getReset');
Route::post('/user/login','HomeController@PostLogin');
Route::get('/android/login','HomeController@AndroidLogin');
Route::post('/user/register/{role}','HomeController@RegisterUsers')->middleware(['RegisterPermitter']);
Route::post('/contact','HomeController@Contact');
Route::group(['middleware' => 'auth'],function (){
    Route::get('/logout',array('as' => 'logout' ,'uses' => 'HomeController@LogOut'));
    Route::get('/dashboard',array('as' => 'dashboard' , 'uses' => 'RouteController@Dashboard') );
    Route::get('/adminpanel',array('as' => 'adminpanel' , 'uses' => 'PanelController@adminpanel' ))->middleware(['RoleChecker:adminpanel']);
    Route::get('/playerpanel',array('as' => 'playerpanel' , 'uses' => 'PanelController@playerpanel' ))->middleware(['RoleChecker:playerpanel']);
    Route::get('/coachpanel',array('as' => 'coachpanel' , 'uses' => 'PanelController@coachpanel' ))->middleware(['RoleChecker:coachpanel']);
    Route::get('/employeepanel',array('as' => 'employeepanel' , 'uses' => 'PanelController@employeepanel' ))->middleware(['RoleChecker:employeepanel']);
    Route::get('/admins',array('as' => 'admins' , 'uses' => 'PanelController@admins' ))->middleware(['RoleChecker:admins']);
    Route::get('/player',array('as' => 'player' , 'uses' => 'PanelController@player' ))->middleware(['RoleChecker:player']);
    Route::get('/coach',array('as' => 'coach' , 'uses' => 'PanelController@coach' ))->middleware(['RoleChecker:coach']);
    Route::get('/employee',array('as' => 'employee' , 'uses' => 'PanelController@employee' ))->middleware(['RoleChecker:employee']);
    Route::get('/players', array('as' => 'players', 'uses' => 'PanelController@players'))->middleware(['RoleChecker:players']);
    Route::get('/employees', array('as' => 'employees', 'uses' => 'PanelController@employees'))->middleware(['RoleChecker:employees']);
    Route::get('/coaches', array('as' => 'coaches', 'uses' => 'PanelController@coaches'))->middleware(['RoleChecker:coaches']);
    Route::get('/schedules', array('as' => 'schedules', 'uses' => 'PanelController@schedules'))->middleware(['RoleChecker:schedules']);
    Route::get('/teams_schedules', array('as' => 'teams_schedules', 'uses' => 'PanelController@teams_schedules'))->middleware(['RoleChecker:teams_schedules']);
    Route::get('/subscriptions', array('as' => 'subscriptions', 'uses' => 'PanelController@subscriptions'))->middleware(['RoleChecker:subscriptions']);
    Route::get('/attendances', array('as' => 'attendances', 'uses' => 'PanelController@attendances'))->middleware(['RoleChecker:attendances']);
    Route::get('/structure', array('as' => 'structure', 'uses' => 'PanelController@structure'))->middleware(['RoleChecker:structure']);
    Route::get('/products', array('as' => 'products', 'uses' => 'PanelController@products'))->middleware(['RoleChecker:products']);
    Route::get('/settings',array('as' => 'settings' , 'uses' => 'PanelController@settings' ))->middleware(['RoleChecker:settings']);
    Route::get('/invoices', array('as' => 'invoices', 'uses' => 'PanelController@invoices'))->middleware(['RoleChecker:invoices']);
    Route::get('/reports', array('as' => 'reports', 'uses' => 'PanelController@reports'))->middleware(['RoleChecker:reports']);
    Route::get('/groups', array('as' => 'groups', 'uses' => 'PanelController@groups'))->middleware(['RoleChecker:groups']);
    Route::get('/posts', array('as' => 'posts', 'uses' => 'PanelController@posts'))->middleware(['RoleChecker:posts']);
    Route::get('/sponsors', array('as' => 'sponsors', 'uses' => 'PanelController@sponsors'))->middleware(['RoleChecker:sponsors']);
    Route::get('/news', array('as' => 'news', 'uses' => 'PanelController@news'))->middleware(['RoleChecker:news']);
    Route::get('/outcomes', array('as' => 'outcomes', 'uses' => 'PanelController@outcomes'))->middleware(['RoleChecker:outcomes']);
    Route::get('/incomes', array('as' => 'incomes', 'uses' => 'PanelController@incomes'))->middleware(['RoleChecker:incomes']);
    Route::post('/level/add','LevelsController@add');
    Route::post('/level/update','LevelsController@update');
    Route::post('/level/delete','LevelsController@delete');
    Route::post('/playground/add','PlaygroundController@add');
    Route::post('/playground/update','PlaygroundController@update');
    Route::post('/playground/delete','PlaygroundController@delete');
    Route::post('/place/add','PlacesController@add');
    Route::post('/place/update','PlacesController@update');
    Route::post('/place/delete','PlacesController@delete');
    Route::post('/extra/add','ExtraController@add');
    Route::post('/extra/update','ExtraController@update');
    Route::post('/extra/delete','ExtraController@delete');
    Route::post('/user/{id}/penalty/add','UsersController@AddPenalty');
    Route::post('/user/penalty/{id}/update','UsersController@UpdatePenalty');
    Route::post('/user/penalty/{id}/delete','UsersController@DeletePenalty');
    Route::post('/user/{id}/extra/add','UsersController@AddExtra');
    Route::post('/user/extra/{id}/update','UsersController@UpdateExtra');
    Route::post('/user/extra/{id}/delete','UsersController@DeleteExtra');
    Route::post('/user/{user_id}/attachment/add','UsersController@AddAttachment');
    Route::post('/admin/add','AdminsController@add');
    Route::post('/admin/delete','AdminsController@delete');
    Route::post('/coach/type/add','CoachesController@addType');
    Route::post('/coach/type/delete','CoachesController@deleteType');
    Route::post('/coach/add','CoachesController@add');
    Route::get('/coach/{id}/{name}','CoachesController@Profile');
    Route::post('/coach/update','CoachesController@update');
    Route::post('/coach/delete','CoachesController@delete');
    Route::post('/player/add','PlayersController@add');
    Route::post('/player/update','PlayersController@update');
    Route::post('/player/delete','PlayersController@delete');
    Route::get('/player/{id}/{name}','PlayersController@Profile');
    Route::get('/schedule/place/{name}','SchedulesController@ScheduleDetailed');
    Route::get('/schedule/place/{id}/fulltimetable','SchedulesController@FullTimeTable');
    Route::get('/schedule/place/coach/{id}/timetable','SchedulesController@CoachTimeTable');
    Route::post('/schedule/add','SchedulesController@add');
    Route::post('/schedule/{id}/update','SchedulesController@update');
    Route::post('/schedule/{id}/delete','SchedulesController@delete');
    Route::get('/team/schedule/place/{name}','TeamSchedulesController@ScheduleDetailed');
    Route::get('/team/schedule/place/{id}/fulltimetable','TeamSchedulesController@FullTimeTable');
    Route::get('/team/schedule/place/coach/{id}/timetable','TeamSchedulesController@CoachTimeTable');
    Route::post('/team/schedule/add','TeamSchedulesController@add');
    Route::post('/team/schedule/{id}/update','TeamSchedulesController@update');
    Route::post('/team/schedule/{id}/delete','TeamSchedulesController@delete');
    Route::get('/schedule/{id}','SchedulesController@Profile');
    Route::get('/team/schedule/{id}','TeamSchedulesController@Profile');
    Route::post('/employee/add','EmployeesController@add');
    Route::post('/employee/{id}/update','EmployeesController@update');
    Route::post('/employee/delete','EmployeesController@delete');
    Route::get('/employee/{id}/{username}','EmployeesController@Profile');
    Route::get('/subscription/add','SubscriptionsController@GetAdd');
    Route::post('/subscription/add','SubscriptionsController@PostAdd');
    Route::post('/subscription/player_info','SubscriptionsController@GetPlayerInfo');
    Route::post('/subscription/calculate','SubscriptionsController@GetPrice');
    Route::post('/subscription/schedules','SubscriptionsController@GetSchedules');
    Route::post('/subscription/team_schedules','SubscriptionsController@GetTeamsSchedules');
    Route::post('/subscription/{id}/update','SubscriptionsController@update');
    Route::post('/subscription/renew','SubscriptionsController@renew');
    Route::post('/subscription/{id}/debt','SubscriptionsController@pay');
    Route::post('/subscription/{id}/delete','SubscriptionsController@delete');
    Route::post('/product/calculate','ProductsController@calculate');
    Route::post('/product/add','ProductsController@add');
    Route::post('/product/sell','ProductsController@sell');
    Route::get('/product/{id}/{name}','ProductsController@profile');
    Route::post('/product/update/information','ProductsController@UpdateInformation');
    Route::post('/product/update/picture','ProductsController@UpdatePicture');
    Route::post('/product/update/quantity','ProductsController@UpdateQuantity');
    Route::post('/product/delete','ProductsController@delete');
    Route::post('/product/debt/{income_id}/pay','ProductsController@PayDebt');

    Route::post('/settings/update/info','SettingsController@UpdateInfo');
    Route::post('/settings/update/picture','SettingsController@UpdatePicture');
    Route::post('/settings/update/password','SettingsController@UpdatePassword');
    Route::post('/reports/GetMonths','ReportsController@GetMonths');
    Route::post('/reports/GetYears','ReportsController@GetYears');
    Route::post('/reports/FinalReport','ReportsController@FinalReport');
    Route::get('/reports/get','ReportsController@FinalReport');
    Route::post('/group/add','GroupController@add');
    Route::post('/group/update','GroupController@update');
    Route::post('/group/delete','GroupController@delete');
    Route::post('/group/user/add','GroupController@addUser');
    Route::post('/group/user/{id}/delete','GroupController@deleteUser');
    Route::get('/group/{id}/{title}','GroupController@profile');
    Route::get('/posts/getfeed/private','PostsController@getPrivatePosts');
    Route::get('/posts/getfeed/public','PostsController@getPublicPosts');
    Route::get('/post/getfeed/{id}','PostsController@getFeedPost');
    Route::get('/post/{id}','PostsController@Profile');
    Route::post('/post/add','PostsController@add');
    Route::post('/post/update','PostsController@update');
    Route::post('/post/delete','PostsController@delete');
    Route::post('/comment/add','CommentsController@add');
    Route::post('/comment/update','CommentsController@update');
    Route::post('/comment/delete','CommentsController@delete');
    Route::get('/notifications/getfeed','NotificationsController@getFeed');
    Route::get('/notifications/getCount','NotificationsController@getCount');
    Route::post('/notifications/read','NotificationsController@read');
    Route::post('/like/add','LikesController@add');
    Route::post('/like/delete','LikesController@delete');

    Route::post('/attendance/{id}/{attend}','AttendancesController@attend');

    Route::post('/sponsor/add','SponsorsController@add');
    Route::post('/sponsor/{id}/delete','SponsorsController@delete');
    Route::post('/news/add','NewsController@add');
    Route::post('/news/{id}/update','NewsController@update');
    Route::post('/news/{id}/delete','NewsController@delete');
    Route::get('/news/{id}/{title}','NewsController@profile');

    Route::post('/outcome/add','OutComesController@add');
    Route::post('/outcome/{id}/update','OutComesController@update');
    Route::post('/outcome/{id}/delete','OutComesController@delete');
    Route::post('/income/add','InComesController@add');
    Route::post('/income/{id}/update','InComesController@update');
    Route::post('/income/{id}/delete','InComesController@delete');
    Route::post('/event/add','EventsController@add');
    Route::post('/event/{id}/update','EventsController@update');
    Route::post('/event/{id}/delete','EventsController@delete');

    Route::get('/invoice/{type}/{id}','InvoiceController@add');
    Route::post('/invoice/search','InvoiceController@search');

});