<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

// A class that contains methods which main handles login and registration submissions
class LoginController extends Controller
{

    // A function that checks if the user is in the database and return the appropriate view
    public function loginSubmit()
    {

        // uses the Auth method to check if the user is in the database and if so stores boolean logic for later use
        if (Auth::attempt([
            'email' => request()->get('email'),
            'password' => request()->get('pass')
        ])) {

            // If they are then checks if the user is an admin and returns them to the home view with the approprate display
            if (request()->get('pass') === 'adminPass' && request()->get('email') === 'admin@gmail.com') {

                // clears and regenerates new sessions
                request()->session()->regenerate();
                Session::put('isAdmin', true);

                // Stores a publish message in a flash messsage
                session()->flash('message', 'Login Successfull as Admin !!');

                return redirect()->route('home');
            }

            // else redirects them to home view as a signed in user
            // clears and regenerates new sessions
            request()->session()->regenerate();

            // Stores a publish message in a flash messsage
            session()->flash('message', 'Login Successfull !!');

            return redirect()->route('home');
        }

        session()->flash('message', 'No matching user found with the provided username and email.');
        // redirects back to login page if none of the requirements are met
        return redirect()->route('login');
    }

    /*
     * A function that returns the tags and categories for the user to select to the writer view
     * aswell as teh number of tags for later use
     */
    public function writerPage()
    {
        $categories = DB::table('categories')->select('name', 'id')->get();

        $tags = DB::table('tags')->select('id', 'name')->get();

        $countTags = DB::table('tags')->select('id', 'name')->count();

        return view('AuthorisedUsers.writer', [
            'categories' => $categories,
            'tags' => $tags,
            'countTags' => $countTags
        ]);
    }

    // A function that returns data from the database for the admin to change to the admin view
    public function adminPage()
    {
        $articles = DB::table('articles')->select('title', 'id')->get();

        $categories = DB::table('categories')->select('name', 'id')->get();

        $tags = DB::table('tags')->select('id', 'name')->get();

        $countTags = DB::table('tags')->select('id', 'name')->count();

        return view('AuthorisedUsers.admin', [
            'categories' => $categories,
            'tags' => $tags,
            'countTags' => $countTags,
            'articles' => $articles
        ]);
    }

    // A function that registers a new user and redirects to the home view
    public function registerSubmit()
    {
        // validates the users input
        $isValid = request()->validate([
            'newUser' => 'required|max:25|min:4',
            'newEmail' => 'required|email|unique:users,email',
            'newPass' => 'required|confirmed|min:8'
        ]);

        // creates a new user in the database
        User::create([
            'name' => $isValid['newUser'],
            'email' => $isValid['newEmail'],
            'password' => $isValid['newPass']
        ]);

        // Stores a publish message in a flash messsage
        session()->flash('message', 'Your are now registered please login !!');

        return redirect()->route('home');
    }

    // A function that logs the use out and displays the original home view
    public function logout()
    {
        // sets the Auth method to logout
        Auth::logout();

        // clears all sessions and regenerates a token
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        session()->flash('message', 'You have Logout !!');

        return redirect()->route('home');
    }
}
