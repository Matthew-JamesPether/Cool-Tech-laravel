<!--Defines the html version-->
<!DOCTYPE html>

<!--Opens the web page and "en" declares english as the primary language-->
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--Opens and displays Name and CV at the head section-->
<head>
    <title>Admin</title>

    <!--Links to a css style sheet -->
    <link href="/css/admin.css" rel="stylesheet">

</head>

<!--Opens the part of the document that is displayed to the user-->
<body>
    <!-- if there is a message session it displays the message -->
    @if (session('message'))
    <x-success-message />
    @endif

    <!-- Displays a heading -->
    <h1>Admin</h1>
    <br />

    <!-- Displays the main content -->
    <main>
        <!-- Displays the create content -->
        <div id="form-create">

            <!-- Displays the create category content and form -->
            <div>
                <h3>Whould you like to create a New Category?</h3>

                <form action="{{url('/submit-category')}}" method="POST">
                    @csrf <label for="newCategory">Enter a new Category: </label> <input type="text" id="newCategory"
                        name="newCategory" /> <br />

                    <button class="submit-btn" type="submit">Submit</button>
                </form>
            </div>

            <!-- Displays the create tag content and form -->
            <div>
                <h3>Whould you like to create a New Tag?</h3>

                <form action="{{url('/submit-tag')}}" method="POST">
                    @csrf <label for="newTag">Enter a new Tag: </label> <input type="text" id="newTag" name="newTag" />
                    <br />

                    <button class="submit-btn" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <br />

        <!-- Displays the delete content -->
        <div id="form-delete-container">
            <div id="form-delete">
                <h3>Whould your like to delete an Article?</h3>

                <!-- Displays the delete form -->
                <form action="{{url('/delete-article')}}" method="POST">
                    @csrf <label for="articleId">Please select a article: </label> <select id="articleId"
                        name="articleId"> @foreach($articles as $article)

                        <option value="{{$article->id}}">{{$article->title}}</option>

                        @endforeach

                    </select> <br />
                    <button class="delete-btn" type="submit">Delete</button>
                </form>
            </div>
        </div>
        <br />

        <!-- Displays the updatecontent -->
        <div id="form-update">
            <h3>Would you like to update the Article Types:</h3>

            <!-- Displays the update category form -->
            <form action="{{url('/update-category')}}" method="POST">
                @csrf <label for="categoryType">Please select the category: </label> <select id="categoryType"
                    name="categoryType"> @foreach($categories as $category)

                    <option value="{{$category->id}}">{{$category->name}}</option>

                    @endforeach
                </select> <label for="categoryNew">Enter new Category: </label> <input type="text" id="categoryNew"
                    name="categoryNew" /> <br />
                <button class="update-btn" type="submit">Update</button>
            </form>
            <br />

            <!-- Displays the update tag form -->
            <form action="{{url('/update-tag')}}" method="POST">
                @csrf <label for="tagType">Please select the Tag: </label> <select id="tagType" name="tagType">
                    @foreach($tags as $tag)

                    <option value="{{$tag->id}}">{{$tag->name}}</option> @endforeach
                </select> <label for="tagNew">Enter new Tag: </label> <input type="text" id="tagNew" name="tagNew" />
                <br />

                <button class="update-btn" type="submit">Update</button>
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