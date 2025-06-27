<!-- Navbar -->
<style>
  .navbar-school {
      background: linear-gradient(to right, #3e8ed0, #72c8ef);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }

  .navbar-school .nav-link {
      color: #ffffff !important;
      font-weight: 500;
      transition: background-color 0.3s ease;
  }

  .navbar-school .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 5px;
  }

  .navbar-school .dropdown-menu {
      background-color: #f9f9f9;
      border: none;
      border-radius: 0 0 8px 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .navbar-school .dropdown-item:hover {
      background-color: #e3f2fd;
      color: #0d47a1;
  }
</style>

<nav class="main-header navbar navbar-expand navbar-school fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Fullscreen -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Fullscreen">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" title="User Menu">
                <i class="far fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Akun Profile</span>
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile.index', encrypt(auth()->user()->id)) }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <div class="d-flex justify-content-end px-2 pb-2">
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger" type="submit">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
