<!--Defines the html version-->
<!DOCTYPE html>

<!--Opens the web page and "en" declares english as the primary language-->
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--Opens and displays Name and CV at the head section-->
<head>
    <title>Writer</title>

    <!--Links to a css style sheet -->
    <link href="/css/writer.css" rel="stylesheet">
</head>

<!--Opens the part of the document that is displayed to the user-->
<body>
    <!-- Displays the main content -->
    <main>
        <!-- Displays a heading -->
        <h1>Writer</h1>
        <br />

        <!-- Creates a form to submit a new article -->
        <form action="{{url('/submit-article/' . $countTags)}}" method="POST">
            @csrf
            <div>
                <label for="title">Title: </label> <input type="text" id="title" name="title" required />
                <br />
                <label class="label-textarea" for="content">Content: </label>
                <textarea type="textarea" id="content" name="content" required></textarea>

                <br /> <label for="categoryId">Category: </label> <select id="categoryId" name="categoryId">

                    @foreach($categories as $category)

                    <option value="{{$category->id}}">{{$category->name}}</option>

                    @endforeach

                </select>
                <br />
                <button type="submit">Submit</button>
            </div>
            <div>
                <h2>Tags:</h2>

                @foreach($tags as $tag) <label for="{{$tag->name}}">{{$tag->name}} : </label>
                <input type="radio" id="{{$tag->name}}" name="{{$tag->id}}" value="{{$tag->id}}"
                    onclick="toggleRadio(this)"> <br /> @endforeach

            </div>

        </form>
    </main>

    <!-- Displays cookie component -->
    <x-cookie-notice />

    <!-- Displays the footer container -->
    <footer id="footer-container">
        <x-footer />
    </footer>
    <script>
    //A script that allows users to unselect a radio button
    let lastChecked;

    function toggleRadio(radio) {
        if (lastChecked === radio) {
            radio.checked = false;
            lastChecked = null;
        } else {
            lastChecked = radio;
        }
    }
    </script>
</body>

</html>