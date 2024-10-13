<!--Defines the html version-->
<!DOCTYPE html>

<!--Opens the web page and "en" declares english as the primary language-->
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--Opens and displays Name and CV at the head section-->

<head>
    <title>Homepage</title>

    <!--Links to a css style sheet -->
    <link href="/css/main.css" rel="stylesheet">

</head>

<!--A container that displays the content of the page  -->
<body>

    <!-- Displays a message if the message session is deteced -->
    @if (session('message'))
    <x-success-message />
    @endif

    <!-- Displays a header component -->
    <x-header title="See New Articles!!" />

    <!-- Displays the main content -->
    <main>
        <!-- Loops through each post that was returned from the database -->
        @foreach($articles as $article)
        <!-- links to the blog route and sends the approriate id parameter when selected-->
        <div class="articles">
            <a href="{{ url('/article/' . $article->id) }}">
                <h3>{{$article->title}}</h3>
                <p>{{ Str::limit($article->content, 150) }}</p>
            </a>
        </div>
        @endforeach
    </main>

    <!-- Displays cookie component -->
    <x-cookie-notice />

    <!-- Displays the footer container -->
    <footer id="footer-container">
        <x-footer />
    </footer>

</body>

</html>