<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

// A class that contains methods which main handles the database
class DatabaseController extends Controller
{

    // A function that returns the latest 5 articles
    public function getArticles()
    {
        $articles = DB::table('articles')->orderBy('created', 'DESC')
            ->take(5)
            ->get();

        return view('home', [
            'articles' => $articles
        ]);
    }

    // A function that uses an article id to return its related content
    public function getArticle($idNum)
    {
        $article = DB::table('articles')->find($idNum);

        $category = DB::table('categories')->find($article->category_id);

        $tagsData = DB::table('article_tags')->join('tags', 'article_tags.tag_id', '=', 'tags.id')
            ->where('article_tags.article_id', '=', $idNum)
            ->get();

        return view('article', [
            'article' => $article,
            'category' => $category,
            'tagsData' => $tagsData
        ]);
    }

    // A function that uses a category slug to return the related articles
    public function useCategorySlug($slug)
    {
        $articles = DB::table('articles')->join('categories', 'articles.category_id', '=', 'categories.id')
            ->where('categories.slug', '=', $slug)
            ->get();

        $category = DB::table('categories')->where('slug', '=', $slug)->first();

        // if no category can be found it returns an error message
        if ($category == null) {

            $errorMessage = 'This category does not exist';

            return view('category', [
                'errorMessage' => $errorMessage,
                'isCategory' => false
            ]);
        }

        return view('category', [
            'articles' => $articles,
            'category' => $category,
            'isCategory' => true
        ]);
    }

    // A function that uses a tag id to return thge related articles
    public function useTagId($tagId)
    {
        $articles = DB::table('article_tags')->join('articles', 'article_tags.article_id', '=', 'articles.id')
            ->where('article_tags.tag_id', '=', $tagId)
            ->get();

        $tag = DB::table('tags')->where('id', '=', $tagId)->first();

        // if no tag can be found it returns an error message;
        if ($tag == null) {

            $errorMessage = 'This tag does not exist';

            return view('tag', [
                'errorMessage' => $errorMessage,
                'isTag' => false
            ]);
        }

        return view('tag', [
            'articles' => $articles,
            'tag' => $tag,
            'isTag' => true
        ]);
    }

    // A function that returns variables that that can be used to search for their related content
    public function databaseSearch()
    {
        $idArticles = DB::table('articles')->select('title', 'id')->get();

        $categories = DB::table('categories')->select('name', 'slug')->get();

        $tags = DB::table('tags')->select('id', 'name')->get();

        return view('search', [
            'idArticles' => $idArticles,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /*
     * A function that inserts the new articles data into the corresponding tables while
     * usings countTags to store the approriate tags and returns to home view
     */
    public function submitArticle($countTags)
    {
        $title = request()->get('title', '');
        $content = request()->get('content', '');
        $category = request()->get('categoryId', '');
        $tagsArray = [];

        // loops through the number of tags to see which ones were selected
        for ($i = 1; $i < $countTags + 1; $i ++) {

            if (request()->get($i, '') != '') {
                array_push($tagsArray, request()->get($i));
            }
        }

        if ($title == '') {
            session()->flash('message', 'Please enter a title!');

            return redirect()->route('writerPage');
        }

        // || $content=='' || $category=='' || )

        // A function that insert the data into the database
        $this->insertArticle($title, $content, $category, $tagsArray);

        // Stores a publish message in a flash messsage
        session()->flash('message', 'Article has been published !');

        return redirect()->route('home');
    }

    // A function that inserts the data into the database
    function insertArticle($title, $content, $category, $tagsArray)
    {
        // a insert query into articles table
        DB::table('articles')->insert([
            'title' => $title,
            'content' => $content,
            'category_id' => $category
        ]);

        // stores the new articles ID number
        $articleId = DB::table('articles')->select('id')
            ->where('title', '=', $title, 'AND', 'content', '=', $content, 'AND', 'category_id', '=', $category)
            ->get();

        // Loops through the array and stores the corresponding tags with the article id
        for ($i = 0; $i < count($tagsArray); $i ++) {

            DB::table('article_tags')->insert([
                'article_id' => $articleId->first()->id,
                'tag_id' => $tagsArray[$i]
            ]);
        }
    }

    // A function that deletes an article starting with the foreign keys and redirects to the adminPage
    public function deleteArticle()
    {
        $articleId = request()->get('articleId');

        DB::table('article_tags')->where('article_id', $articleId)->delete();

        DB::table('articles')->where('id', $articleId)->delete();

        // Stores a publish message in a flash messsage
        session()->flash('message', 'Article has been Deleted !');

        return redirect()->route('adminPage');
    }

    // A function that inserts a new category and redirects to the adminPage
    public function submitCategory()
    {
        $category = request()->get('newCategory');

        $slug = Str::of($category)->words(5)->slug('-');

        DB::table('categories')->insert([
            'name' => $category,
            'slug' => $slug
        ]);

        // Stores a publish message in a flash messsage
        session()->flash('message', 'Category has been added !');

        return redirect()->route('adminPage');
    }

    // A function that inserts a new tag and redirects to the adminPag
    public function submitTag()
    {
        $tag = request()->get('newTag');

        DB::table('tags')->insert([
            'name' => $tag
        ]);

        // Stores a publish message in a flash messsage
        session()->flash('message', 'Tag has been added !');

        return redirect()->route('adminPage');
    }

    // A function that updates a category
    public function updateCategory()
    {
        $categoryId = request()->get('categoryType');

        $newCategory = request()->get('categoryNew');

        $newSlug = Str::of($newCategory)->words(5)->slug('-');

        DB::table('categories')->where('id', $categoryId)->update([
            'name' => $newCategory,
            'slug' => $newSlug
        ]);

        // Stores a publish message in a flash messsage
        session()->flash('message', 'Category has been updated !');

        return redirect()->route('adminPage');
    }

    // A function that updates a tag and redirects to the adminPage
    public function updateTag()
    {
        $tagId = request()->get('tagType');

        $newTag = request()->get('tagNew');

        DB::table('tags')->where('id', $tagId)->update([
            'name' => $newTag
        ]);

        // Stores a publish message in a flash messsage
        session()->flash('message', 'Tag has been updated !');

        return redirect()->route('adminPage');
    }
}
