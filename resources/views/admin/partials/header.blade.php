<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand fw-bold" href="#">Deliveboo</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            @if(Auth::user()->restaurant)
              <li class="nav-item">
                <a class="nav-link active fw-bold" aria-current="page" href="{{ route('admin.home') }}"><i class="fa-solid fa-chart-line"></i> Statistics</a>
              </li>
            @endif
            </ul>
          </div>
        </div>
      </nav>
</header>
