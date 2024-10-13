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

</head>

<!--Opens the part of the document that is displayed to the user-->
<body>

    <!-- Displays the main content -->
    <main>

        <!-- Displays the register content -->
        <div>

            <!-- Displays a heading -->
            <h1>Register here:</h1>

            <!-- creates a form to register a user-->
            <form action="{{ url('/register-submit') }}" method="POST">
                @csrf

                <label for="newUser">Username: </label>
                <input id="newUser" name="newUser" type="text" minlength="4" maxlenght="25" required />

                <br />

                <label for="newEmail">Email: </label>
                <input id="newEmail" name="newEmail" type="text" required />

                <br />

                <label for="newPass">Password: </label>
                <input id="newPass" name="newPass" type="password" minlength="8" maxlenght="60" required />

                <br />

                <label for="confirmPass">Confirm Password:</label>
                <input id="confirmPass" name="newPass_confirmation" type="password" minlength="8" maxlenght="16"
                    required />

                <button type="submit">Register</button>

            </form>
        </div>
    </main>

    <!-- Displays the cookie component -->
    <x-cookie-notice />

    <!-- Displays the footer container -->
    <footer id="footer-container">

        <x-footer />
    </footer>
</body>

</html>