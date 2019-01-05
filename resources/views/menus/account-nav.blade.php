<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Login</a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Register <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ url('/register/mentor') }}">
                        Mentor
                    </a>
                </li>
                <li>
                    <a href="{{ url('/register/parent') }}">
                        Parent
                    </a>
                </li>
            </ul>
        </li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ url('/account') }}">
                        Account
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}">
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>