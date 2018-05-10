<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist"> <!-- start Nav -->
      @if(Gate::allows('admin',$role))
          <li role="presentation"
              @if($page == "home")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('adminpanel') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-home fa-2x" aria-hidden="true"></i></span>
                  <p>Home</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role))
          <li role="presentation"
              @if($page == "admins")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('admins') }}" class="text-center" aria-controls="home" >
                  <span><i class="glyphicon glyphicon-lock fa-2x" aria-hidden="true"></i></span>
                  <p>Admins</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "players")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('players') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-star fa-2x" aria-hidden="true"></i></span>
                  <p>Players</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "coaches")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('coaches') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
                  <p>Coaches</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "employees")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('employees') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
                  <p>Employees</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "schedules")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('schedules') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></span>
                  <p>Schedules</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "teams_schedules")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('teams_schedules') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></span>
                  <p>Teams Schedule</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "subscriptions")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('subscriptions') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-area-chart fa-2x" aria-hidden="true"></i></span>
                  <p>Subscriptions</p>
              </a>
          </li>
      @endif
      {{--@if(Gate::allows('admin',$role))--}}
          {{--<li role="presentation"--}}
              {{--@if($page == "pricelist")--}}
              {{--class="active"--}}
                  {{--@endif--}}
          {{-->--}}
              {{--<a href="{{ URL::route('pricelist') }}" class="text-center" aria-controls="home" >--}}
                  {{--<span><i class="fa fa-home fa-2x" aria-hidden="true"></i></span>--}}
                  {{--<p>PriceList</p>--}}
              {{--</a>--}}
          {{--</li>--}}
      {{--@endif--}}
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "attendances")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('attendances') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-calendar-check-o fa-2x" aria-hidden="true"></i></span>
                  <p>Attendance</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "structure")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('structure') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-sitemap fa-2x" aria-hidden="true"></i></span>
                  <p>Structure</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "products")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('products') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-circle fa-2x" aria-hidden="true"></i></span>
                  <p>Products</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role))
          <li role="presentation"
              @if($page == "sponsors")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('sponsors') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-tags fa-2x" aria-hidden="true"></i></span>
                  <p>Sponsors</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role))
          <li role="presentation"
              @if($page == "news")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('news') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-newspaper-o fa-2x" aria-hidden="true"></i></span>
                  <p>News</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "outcomes")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('outcomes') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></span>
                  <p>Extra Outcomes</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "incomes")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('incomes') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-sign-in fa-2x" aria-hidden="true"></i></span>
                  <p>Extra Incomes</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "invoices")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('invoices') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-bank fa-2x" aria-hidden="true"></i></span>
                  <p>Invoices</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "groups")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('groups') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-group fa-2x" aria-hidden="true"></i></span>
                  <p>Groups</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "posts")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('posts') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-th-list fa-2x" aria-hidden="true"></i></span>
                  <p>Posts</p>
              </a>
          </li>
      @endif
      @if(Gate::allows('admin',$role))
          <li role="presentation"
              @if($page == "reports")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('reports') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-file-o fa-2x" aria-hidden="true"></i></span>
                  <p>Reports</p>
              </a>
          </li>
      @endif
      {{--@if(Gate::allows('admin',$role))--}}
          {{--<li role="presentation"--}}
              {{--@if($page == "posts")--}}
              {{--class="active"--}}
                  {{--@endif--}}
          {{-->--}}
              {{--<a href="{{ URL::route('posts') }}" class="text-center" aria-controls="home" >--}}
                  {{--<span><i class="fa fa-dashboard fa-2x" aria-hidden="true"></i></span>--}}
                  {{--<p>Posts</p>--}}
              {{--</a>--}}
          {{--</li>--}}
      {{--@endif--}}
      @if(Gate::allows('admin',$role)||Gate::allows('employee',$role))
          <li role="presentation"
              @if($page == "settings")
              class="active"
                  @endif
          >
              <a href="{{ URL::route('settings') }}" class="text-center" aria-controls="home" >
                  <span><i class="fa fa-gear fa-2x" aria-hidden="true"></i></span>
                  <p>Settings</p>
              </a>
          </li>
      @endif


  </ul> <!-- End Nav -->