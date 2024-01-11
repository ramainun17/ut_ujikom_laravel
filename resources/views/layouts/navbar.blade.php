<nav id="navbar" class="navbar navbar-expand-sm navbar-light shadow-lg" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
  <div class="container">
  <div class="h2 d-flex align-items-center" style="padding-right: 30px;"><img src="{{ asset('img/icon/tools.svg') }}" alt="Bootstrap" width="32" height="32"></div>
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse h5" id="navbarButtonsExample">  
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="/#produk">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/#layanan">Layanan</a>
        </li>
        @auth
        <li class="nav-item">
          <a class="nav-link " href="/#riwayat">Riwayat Pemesanan</a>
        </li>
        @endauth
      </ul>
      <ul class="navbar-nav ml-auto">
        @guest
          <li class="nav-item px-3">
              <a class="btn btn-dark" href="{{ route('login') }}">{{ __('Sign In') }}</a>
          </li>
          <li class="nav-item">
              <a class="btn btn-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @endguest
        
        @auth
          <li class="nav-item px-3">
            <a class="nav-link bi-person-circle fa-lg nav-link" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <small class="ml-1" >{{ Auth::user()->name }}</small>
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
<div class="sticky-top bg-white hidden-spacer"> </div>