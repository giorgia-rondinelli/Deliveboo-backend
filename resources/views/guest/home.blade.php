@extends('layouts.guest')

@section('content')

<body>
    <header>
        <nav class="d-flex justify-content-around">
            <div class="logo">DeliveBoo</div>
            <ul>
                <li class="mt-4"><a href="{{route('login')}}">Login</a></li>
                <li class="mt-4"><a href="{{route('register')}}">Register</a></li>
            </ul>
        </nav>
    </header>
    <main>
      <section class="hero">
            <h1>DeliveBoo <span class="business">Business</span>
            </h1>
            <p>We deliver the best dishes from your favorite restaurants straight to your door.</p>
            <a href="{{route('login')}}" class="btn">Get Started</a>
        </section>



    </main>
    <footer>
        <p>&copy; 2024 DeliveBoo. Tutti i diritti riservati.</p>
    </footer>
</body>


@endsection

<style lang="scss"  scoped>
* {
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: Arial, sans-serif;
}

body {
    line-height: 1.6;
}

header {
    background: #ffffff;
    color: rgb(255, 0, 0);
    padding: 1rem 0;
}

main{
    background-color: #e0454d;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1100px;
    margin: auto;
    padding: 0 1rem;
}

nav .logo {
    font-size: 1.5rem;
    font-weight: bold;
}

nav ul {
    list-style: none;
    display: flex;
}

nav ul li {
    margin-left: 1rem;
}

nav ul li a {
    color: rgb(255, 0, 0);
    text-decoration: none;
    padding: 0.5rem 1rem;
}

nav ul li a:hover {
    background: rgb(255, 82, 82);
    color: #ffffff;
    border-radius: 5px;
}

.hero {
    background: url('hero-image.jpg') no-repeat center center/cover;
    color: white;
    height: 85vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 1rem;
}

.hero h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.business{
    font-size: 1.4rem;
    color: rgb(255, 177, 141)
}


.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.hero .btn {
    background: #ffffff;
    color: rgb(255, 0, 0);
    padding: 0.7rem 1.5rem;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.2rem;
}

.hero .btn:hover {
    background: #ff9172;
}




footer {
    background: #333;
    color: white;
    text-align: center;
    padding: 1rem 0;
}

footer p {
    margin: 0;
}

</style>
