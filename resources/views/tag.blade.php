<!--Defines the html version-->
<!DOCTYPE html>

<!--Opens the web page and "en" declares english as the primary language-->
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--Opens and displays Name and CV at the head section-->
<head>
    <title>Tag</title>

    <!--Links to a css style sheet -->
    <link href="/css/main.css" rel="stylesheet">

    <style>
    main {
        display: flex;
        flex-wrap: wrap;
        align-content: space-evenly;
        gap: 1em;
    }
    </style>

</head>

<!--Opens the part of the document that is displayed to the user-->
@if(!$isTag)
<body onload="displayMessage('{{$errorMessage}}')">
</body>

@else
<body>

    <!-- Displays a header component -->
    <x-header title="{{$tag->name}}" />

    <!-- Displays the main content -->
    <main>

        <!-- Displays the selected articles -->
        @foreach($articles as $article)
        <div class="articles">
            <a href="{{ url('/article/' . $article->id) }}">
                <h3>{{$article->title}}</h3>
                <p>{{ Str::limit($article->content, 150) }}</p>
                <a />
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
@endif

<script>
//Displays an alert message if no content is found and redirects to the home view
function displayMessage(message) {
    alert(message);

    window.location.href = '/';
}
</script>

</html>