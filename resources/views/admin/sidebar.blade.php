<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
    <div class="sidebar-sticky pt-3 flex">

        <ul class="nav flex-column">



          <li class="nav-item">
            <a class="nav-link {{Route::is('admin.*') ? 'active': ''}}" href="/admin">
              <span data-feather="tool"></span>
              Admin
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{Route::is('lecturer.*') ? 'active': ''}}" href="/lecturer">
              <span data-feather="users"></span>
              Lecturer
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{Route::is('class.*') ? 'active': ''}}" href="/class">
              <span data-feather="clipboard"></span>
              Class
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{Route::is('academic-year.*') ? 'active': ''}}" href="/academic-year">
              <span data-feather="calendar"></span>
              Academic Year
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{Route::is('session.*') ? 'active': ''}}" href="/session">
              <span data-feather="clock"></span>
              Collection Session
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{Route::is('types.*') ? 'active': ''}}" href="/types">
              <span data-feather="folder"></span>
              PKM Type
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{Route::is('region.*') ? 'active': ''}}" href="/region">
              <span data-feather="map"></span>
              Region
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{Route::is('major.*') ? 'active': ''}}" href="/major">
              <span data-feather="book"></span>
              Major
            </a>
          </li>

          
        </ul>
        <ul class="nav flex-column" style="margin-top:50vh">



          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auth/logout') }}">
              <span data-feather="log-out"></span>
              Logout
            </a>
          </li>

          
        </ul>
      </div>
    </nav>
    <script>
      feather.replace();
    </script>