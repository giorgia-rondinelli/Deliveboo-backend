<aside>
    <div class="d-flex flex-column justify-content-between h-100">
        <ul>

            <li>
                <a href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-house-chimney"></i>
                    <span>Home</span>
                </a>
            </li>

            {{-- tolgo la lista dei piatti se non ho il ristorante, facendo riferimento al metodo restaurant( ) dello user di auth --}}
            @if(Auth::user()->restaurant)
            <li>
                <a href="{{ route('admin.dishes.index') }}">
                    <i class="fa-solid fa-utensils"></i>
                    <span>Dishes</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('admin.orders.index') }}">
                    <i class="fa-solid fa-list-ul"></i>
                    <span>Orders</span>
                </a>
            </li>

        </ul>
        <ul class="navbar-nav d-flex justify-content-center align-items-center pb-4">
            <li class="nav-item">
                <a class="nav-link text-capitalize fs-3 fw-bold" href="#">{{ Auth::user()->name }}</a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-dark p_log-out text-light"><i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
            </li>
        </ul>
    </div>
</aside>
