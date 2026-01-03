

<aside id="sidebar">
      <div class="sidebar-title">
       <div class="sidebar-brand">
  <img src="{{ asset('image/imarket1.png') }}" alt="Logo" class="sidebar-logo">
  <p>Logistic - 2</p>
</div>

        <span class="material-icons-outlined close-icon" onclick="closeSidebar()">close</span>
      </div>


      <ul class="sidebar-list">
        <li class="sidebar-list-item dash">
          <a href="{{route('dashboard')}}">
            <i class='bx bxs-dashboard '></i> Dashboard
          </a>
        </li>
        <p class="module-title">Vehicle Management</p>
       <li class="sidebar-list-item module">


  <a href="#" class="dropdown-toggle">
    <i class='bx bxs-truck'></i> Management
    <i class='bx bx-chevron-right arrow'></i>
  </a>

  <ul class="sidebar-submenu">
    <li><a href="{{route('vehicleslist.index')}}">Vehicle List</a></li>
    <li><a href="{{route('vehiclestatus.index')}}">Vehicle Status</a></li>
    <li><a href="#">Pendings</a></li>
  </ul>
</li>

        <li class="sidebar-list-item">
          <a href="#" >
           <i class='bx bxs-checkbox-minus'></i>Availability
          </a>
        </li>
        <p class="module-title">Vehicle Management</p>
        <li class="sidebar-list-item">
          <a href="#" >
         <i class='bx bxs-checkbox-minus'></i>performance
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="#">
           <i class='bx bxs-checkbox-minus'></i>dispatch
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="#" >
           <i class='bx bxs-checkbox-minus'></i>reservation
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="#" class="dropdown-toggle">
            <i class='bx bx-cog'></i> Settings
            <i class='bx bx-chevron-right arrow'></i>
          </a>
          <ul class="sidebar-submenu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Security</a></li>
            <li><a href="#">Notifications</a></li>
          </ul>
        </li>

      </ul>
     <div class="sidebar-profile">
  <div class="profile-box">
    <div class="profile-avatar">
      <i class="bx bx-user"></i>
    </div>

    <div class="profile-info">
      <!-- Display the authenticated user's name -->
      <span class="profile-name" >{{ Auth::check() ? Auth::user()->email : 'Guest' }}</span>
      <!-- Optionally display role -->
      <span class="profile-role">{{ Auth::check() ? (Auth::user()->role ?? 'Admin') : 'Guest' }}</span>
    </div>

    @auth
    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
      @csrf
      <button type="submit" class="profile-action">
        <i class="bx bx-log-out"></i>
      </button>
    </form>
    @endauth
  </div>
</div>


    </aside>

