<!--Defines the html version-->
<!DOCTYPE html>

<!--Opens the web page and "en" declares english as the primary language-->
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--Opens and displays Name and CV at the head section-->

<head>
    <title>Article</title>

    <!--Links to a css style sheet -->
    <link href="/css/article.css" rel="stylesheet">

</head>

<!--Opens the part of the document that is displayed to the user-->

<body>

    <!-- Displays a header component -->
    <x-header title="{{$article->title}}" />

    <!-- Displays the main content -->
    <main>

        <p id="content">{{$article->content}}</p>

        <div id="date">
            <h4>Date Published:</h4>
            <p>{{$article->created}}</p>
        </div>

        <div id="category">
            <h3>Category:</h3>
            <a href="{{ url('/category/' . $category->slug) }}">{{$category->name}}</a>
        </div>

        <div id="tags">
            <h3>Tags</h3>
            @foreach($tagsData as $tag)
            <a href="{{ url('/tag/' . $tag->id) }}">{{$tag->name}}</a>
            <br />
            @endforeach
        </div>

    </main>

    <!-- Displays the cookie container -->
    <x-cookie-notice />

    <!-- Displays the footer container -->
    <footer id="footer-container">
        <x-footer />
    </footer>
</body>

</html>