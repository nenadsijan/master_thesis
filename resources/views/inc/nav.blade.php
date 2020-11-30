

<nav id="navbar" class="navbar  navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->


              @if (!Sentinel::guest())
               <ul class="nav navbar-nav">
                  <li><a href="/home">Clients</a></li>
                   <li><a href="/charts">Charts</a></li>

               </ul>

            @endif  
            @if (Sentinel::guest())
               <ul class="nav navbar-nav">

               <li><a href="/">Home</a></li>

               </ul>

            @endif   
       @if(!Sentinel::guest())
         @if(Sentinel::inRole('admin'))
           <ul class="nav navbar-nav">
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Admin Panel  <span class="caret"></span>  </a>

                  <ul class="dropdown-menu" role="menu">
                        <li><a href="/adminsProfiles">Admins List</a></li>
           
                        <li><a href="/viewersProfiles">Users List</a></li>
                  </ul>
                     
                 </li>

            </ul>
          @endif
        @endif

       @if(!Sentinel::guest())
          @if(Sentinel::inRole('viewer'))
              <ul class="nav navbar-nav">       
            <li> <a href="{{ route('show.viewer.profile', ['first_name' => Sentinel::getUser()->first_name]) }}">Profile</a></li>

            </ul>
           @endif
       @endif

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Sentinel::guest())
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                @else
                         <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{Sentinel::getUser()->first_name}}  <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            <li>
                                <a href="{{ URL::to('/logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ URL::to('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


