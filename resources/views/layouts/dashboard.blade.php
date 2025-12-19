<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistic 2</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
  <aside id="sidebar">
     <div class="h-100">
      <div class="sidebar-logo">
        <a href="#">Logistic 2 </a>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-header">
              Admin Element
        </li>
         <li class="sidebar-item">
            <a href="#" class="sidebar-link">
            <i class='bx bx-list-ul'></i>
              Dashboard
            </a>
        </li>
      </ul>
     </div>
     </aside>
  <div class="main">
        <nav class="navbar">
          <button class="btn">
            <span class="navbar-toggler-icon"></span>
          </button>
        </nav>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
