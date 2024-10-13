<!--Defines the html version-->
<!DOCTYPE html>

<!--Opens the web page and "en" declares english as the primary language-->
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--Opens and displays Name and CV at the head section-->
<head>
    <title>Search</title>

    <!--Links to a css style sheet -->
    <link href="/css/search.css" rel="stylesheet">

</head>

<!--Opens the part of the document that is displayed to the user-->
<body>

    <!-- Displays the main content -->
    <main>

        <!-- Displays the search content -->
        <div>
            <h1>Search Here:</h1>

            <!-- Creates a form to search the article ID -->
            <form action="{{ url('/submit-id') }}" method="GET">
                <label for="articleSelect">Articles: </label> <select id="articleSelect" name="articleSelect">

                    @foreach($idArticles as $idArticle)

                    <option value="{{$idArticle->id}}">{{$idArticle->title}}</option>

                    @endforeach

                </select>
                <button type="submit" name="submit">Search</button>
            </form>

            <br />

            <!-- Creates a form to search the category -->
            <form action="{{ url('/submit-slug') }}" method="GET">
                <label for="slugSelect">Categories: </label> <select id="slugSelect" name="slugSelect">

                    @foreach($categories as $category)

                    <option value="{{$category->slug}}">{{$category->name}}</option>

                    @endforeach

                </select>
                <button type="submit" name="submit">Search</button>
            </form>

            <br />

            <!-- Creates a form to search the tag -->
            <form action="{{ url('/submit-tag') }}" method="GET">
                <label for="tagSelect">Tags: </label> <select id="tagSelect" name="tagSelect">

                    @foreach($tags as $tag)

                    <option value="{{$tag->id}}">{{$tag->name}}</option>

                    @endforeach

                </select>
                <button type="submit" name="submit">Search</button>
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

<?php
// Parse POST data about a person's job
function error($msg){
    echo '<p class="err">'.$msg.'</p>';
}

// Checks to see if the declared variables are null
if (isset($_GET['articleSelect'])){
    
    $article = $_GET['articleSelect'];
    
    if (!$article){ // (!$var) checks if $var is defined. In the next task we'll look at better ways of doing this.
        error("Full name not specified!");
    }else{
        echo 'hi';
    }
}
?>
</html>