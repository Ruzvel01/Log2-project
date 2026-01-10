

<aside id="sidebar">
      <div class="sidebar-title">
       <div class="sidebar-brand">
    <img src="{{ asset('image/imarket1.png') }}" alt="Logo" class="sidebar-logo">

    <div class="sidebar-brand-text">
        <span class="brand-title">IMARKET</span>
        <span class="brand-subtitle">Transport System</span>
    </div>
   
</div>


        <span class="material-icons-outlined close-icon" onclick="closeSidebar()">close</span>
      </div>
       


      <ul class="sidebar-list">
            <p class="module-title">Main</p>
        <li class="sidebar-list-item dash">
          <a href="{{route('dashboard')}}">
            <i class='bx bxs-dashboard '></i> Dashboard
          </a>
        </li>
            <hr>
        <p class="module-title">Vehicle Management</p>
       <li class="sidebar-list-item module">


  <a href="#" class="dropdown-toggle">
    <i class='bx bxs-truck'></i> Management
    <i class='bx bx-chevron-right arrow'></i>
  </a>

  <ul class="sidebar-submenu">
    <li><a href="{{route('vehicleslist.index')}}">Vehicle List</a></li>
    <li><a href="{{ route('vehicles.status') }}">Vehicle Status</a></li>
  </ul>
</li>

        <li class="sidebar-list-item">
          <a href="#" >
           <i class='bx bxs-checkbox-minus'></i>Availability
          </a>
        </li>
           <hr>
        <p class="module-title">Dispatch & Reservation</p>
        <li class="sidebar-list-item">
       <a href="{{ route('reservations.index') }}">
   <i class='bx bxs-checkbox-minus'></i>Reservation
</a>

        </li>
        <li class="sidebar-list-item">
          <a href="{{ route('dispatch.index') }}" >
           <i class='bx bxs-checkbox-minus'></i>Dispatch
          </a>
        </li>

            <hr>
        <p class="module-title">Driver & Trip Performance</p>
        <li class="sidebar-list-item">
          <a href="#" >
         <i class='bx bxs-checkbox-minus'></i>Driver Profile
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="#">
           <i class='bx bxs-checkbox-minus'></i>Trip Performance
          </a>
        </li>
         <li class="sidebar-list-item">
          <a href="#">
           <i class='bx bxs-checkbox-minus'></i>Reports
          </a>
        </li>

          <p class="module-title">Transport Cost Anaylist Optimaztion</p>
        <li class="sidebar-list-item">
          <a href="#" >
         <i class='bx bxs-checkbox-minus'></i>Cost Analysis
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="#">
           <i class='bx bxs-checkbox-minus'></i>Optimazation
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

