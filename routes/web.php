<?php
// imports Route and DB scripts
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Facades\Auth;

// A route that calls the getArticles method for the main view and is called home
Route::get('/', [
    DatabaseController::class,
    'getArticles'
])->name('home');

// A route that calls the getArticle method with the corresponing id
Route::get('/article/{idNum}', [
    DatabaseController::class,
    'getArticle'
]);

// A route that calls the useCategorySlug method with the corresponing slug
Route::get('/category/{slug}', [
    DatabaseController::class,
    'useCategorySlug'
]);

// A route that calls the useTagId method with the corresponing tag id
Route::get('/tag/{idNum}', [
    DatabaseController::class,
    'useTagId'
]);

// A route that calls the dataSearch method
Route::get('/search', [
    DatabaseController::class,
    'databaseSearch'
]);

// A route that calls the submitArticle method with the corresponing tags
Route::post('submit-article/{countTags}', [
    DatabaseController::class,
    'submitArticle'
]);

// A route that calls the loginSubmit method
Route::post('/login-submit', [
    LoginController::class,
    'loginSubmit'
]);

// A route that calls the registerSubmit method
Route::post('/register-submit', [
    LoginController::class,
    'registerSubmit'
]);

// A route that returns the loginPage view using a function and is called login
Route::get('/login', function () {
    return view('AuthorisedUsers.LoginPage');
})->name('login');

// A route that calls the writerPage method and checks if user is logged in
Route::get('/writer', [
    LoginController::class,
    'writerPage'
])->name('writerPage')->middleware('auth');

// A route that calls the adminPage method which is named adminPage and checks if the user is logged in and is an Admin
Route::get('/admin', [
    LoginController::class,
    'adminPage'
])->name('adminPage')->middleware([
    'auth',
    'admin'
]);

// A route that calls the logout method
Route::post('/logout', [
    LoginController::class,
    'logout'
]);

// A route that returns the register view using a function which is named registerPage
Route::get('/register', function () {
    return view('AuthorisedUsers.register');
})->name('registerPage');

// A route that call a deleteArticle method
Route::post('/delete-article', [
    DatabaseController::class,
    'deleteArticle'
]);

// A route that calls a submitCategory method
Route::post('/submit-category', [
    DatabaseController::class,
    'submitCategory'
]);

// A route that calls a submitTag method
Route::post('/submit-tag', [
    DatabaseController::class,
    'submitTag'
]);

// A route that calls a updateCategory method
Route::post('/update-category', [
    DatabaseController::class,
    'updateCategory'
]);

// A route that calls a updateTag method
Route::post('/update-tag', [
    DatabaseController::class,
    'updateTag'
]);

// A route that uses a function to redirect the id selected to the article route
Route::get('/submit-id', function () {

    $id = $_GET['articleSelect'];

    return redirect('/article/' . $id);
});

// A route that uses a function to redirect the slug selected to the category route
Route::get('/submit-slug', function () {

    $slug = $_GET['slugSelect'];

    return redirect('/category/' . $slug);
});

// A route that uses a function to redirect the id tag selected to the tag route
Route::get('/submit-tag', function () {

    $idTag = $_GET['tagSelect'];

    return redirect('/tag/' . $idTag);
});

// A route that uses a function to return the legal view
Route::get('/legal', function () {
    return view('legal');
});

