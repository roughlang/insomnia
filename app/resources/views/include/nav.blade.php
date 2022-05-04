<nav class="navbar navbar-expand-lg navbar-light">
	<div class="container-fluid">
		<div class="sitename">
			<img src="/assets/img/icon/favicon/android-chrome-36x36.png" alt="Roughlang" class="logo">
			<h1 class="navbar-brand-h1"><a class="navbar-brand" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a></h1>
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Product
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="/product">Product top</a></li>
            <li><a class="dropdown-item" href="/product/archives">Archives</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/product/gallery">Gallery</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Documents
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="/ac">Documents top</a></li>
            <li><a class="dropdown-item" href="/ac/category">Categories</a></li>
            <li><a class="dropdown-item" href="/ac/archives">Archives</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/ac/gallery">Gallery</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item"><a  class="nav-link active" href="/ac/about">About</a></li> -->
        @guest
          @if (Route::has('login'))
            @auth
            <li class="nav-item"><a class="nav-link active" href="{{ url('/home') }}">Home</a></li>
            @else
            <li class="nav-item"><a class="nav-link active" href="{{ route('login') }}">Log in</a></li>
              @if (Route::has('register'))
              <li class="nav-item"><a class="nav-link active" href="{{ route('register') }}">Register</a></li>
              @endif
            @endauth
          @endif
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="/vue">vue.js</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/home">Home</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link active" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        @endguest
      </ul>
      <div class="icon-menu-box">
        <!-- Button trigger modal -->
        <div class="menu-icon" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: #c1c1c1;font-size: 12px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
          </svg>
        </div>
      </div>

      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn" type="submit">
          <img src="/assets/img/item/search.svg" width="24" height="24" alt="search">
        </button>
      </form>

       
			</div>
  	</div>
  </nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container large-menu">
          <div class="row">
            <div class="col-md-4">
              <h5>Products</h5>
              <ul>
                <li><a href="/contact">お問い合わせ</a></li>
                <li><a href="#">利用規約</a></li>
                <li><a href="#">プライバシーポリシー</a></li>
                <li><a href="#">特定商取引法に基づく表記</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h5>Documents</h5>
              <ul>
                <li><a href="#">当サイトについて</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h5>Tools</h5>
              <ul>
                <li><a href="/tools/serializer">シリアライザー</a></li>
                <li><a href="/tools/">Document Top</a></li>
                <li><a href="/tools/">Archives</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
