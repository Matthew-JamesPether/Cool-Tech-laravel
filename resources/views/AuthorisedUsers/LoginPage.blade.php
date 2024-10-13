<!--Defines the html version-->
<!DOCTYPE html>

<!--Opens the web page and "en" declares english as the primary language-->
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--Opens and displays Name and CV at the head section-->
<head>
    <title>Login</title>

    <!--Links to a css style sheet -->
    <link href="/css/registration.css" rel="stylesheet">

	<!-- Styles the main tag -->
    <style>
    main {
        padding-bottom: 250px;
    }
    </style>
</head>

<!--Opens the part of the document that is displayed to the user-->
<body>

    <!-- if there is a message session it displays the message -->
    @if (session('message'))
    <x-success-message />
    @endif

    <!-- Displays the main content -->
    <main>
        <div>
            <!-- Displays a heading -->
            <h1>Please enter login details:</h1>

            <!-- Displays a form to login -->
            <form action="{{ url('/login-submit') }}" method="POST">
                @csrf

                <label for="email">Email: </label>
                <input id="email" name="email" type="text" required />

                <br />

                <label for="pass">Password: </label>
                <input id="pass" name="pass" type="password" minlength="8" maxlength="60" required />

                <button type="submit">Login</button>

            </form>

        </div>
    </main>

    <!-- Displays cookie component -->
    <x-cookie-notice />

    <!-- Displays the footer container -->
    <footer id="footer-container">
        <x-footer />
    </footer>
</body>

</html>