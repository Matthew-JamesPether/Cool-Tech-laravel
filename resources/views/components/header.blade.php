<!-- displays the header content hoe the selected views -->
<header>

    <!-- Displays the given title -->
    <h1>{{ $title }}</h1>

    <!-- Displays links to views only for guests -->
    @guest
    <div>
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Register</a>
    </div>
    @endguest

    <!-- Displays a links to views only for logged in users and admin -->
    @auth()
    <h2>Wellcome Back {{Auth::user()->name}} !!</h2>

    <div>
        <a href="{{ url('/writer') }}">Would you like to add a new article?</a>
    </div>

    @if(session('isAdmin'))
    <a id="admin" href="{{ url('/admin') }}">Admin Settings</a>
    @endif

    <!-- Displays a logout button if logged in -->
    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @endauth

</header>

<style>
/* Styles the header container */
header {
    display: grid;
    grid-template-rows: 70px 70px;
    grid-template-columns: repeat(6, 1fr);
    align-items: center;
    text-align: center;
}

/*Styles the h1 tag  */
header h1 {
    grid-area: 1 / 2 / 2 / 6;
}

/* Styles the h2 tag */
header h2 {
    grid-area: 2 / 1 / 3 / 3;
    text-align: start;
}

/* Styles the div containers*/
header div {
    grid-area: 2 / 2 / 3 / 6;
    font-size: 25px;
    text-align: center;
}

/* Styles the admin referrence */
header #admin {
    grid-area: 2 / 6 / 3 / 7;
    font-size: 25px;
    color: orange;
}

/* Styles the logout form */
header form {
    grid-area: 1 / 6 / 2 / 7;
    padding-right: 20px;
    text-align: end;
}
</style>