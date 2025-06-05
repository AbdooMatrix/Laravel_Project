<?php

namespace App\Http\Controllers;

use App\Models\our_users;
use Illuminate\Http\Request;

class OurUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = our_users::latest()->paginate(5);

        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     /** the create() function is used to display the form where the user can enter 
      * details to add a new record — in your case, a new user. */
    public function create()
    {
        return view('create'); // Returns the view called create.blade.php.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate() -> Ensures data is correct before saving
        $request->validate([
            // edit here as you want based on your validations
            'user_name'     =>  'required',
            'email'         =>  'required|email|unique:students',
            'user_image'    =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $file_name = time() . '.' . request()->student_image->getClientOriginalExtension();

        request()->student_image->move(public_path('images'), $file_name);

        $user = new our_users ; //Creates a new model instance


        // edit here as you want these are the main fields
        $user->full_name = $request->student_name;
        $user->user_name = $request->student_email;
        $user->phone = $request->student_gender;
        $user->whatsapp_number = $file_name;
        $user->address = $file_name;
        $user->email = $file_name;
        $user->password = $file_name;
        $user->user_image = $file_name;

        $user->save(); // Saves the record to the database

        return redirect()->route('/')->with('success', 'User Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */

    /**
     * The show() function is responsible for:
     * Displaying the details of a single user
     * It receives a our_users model instance 
     * Then it passes that user data to a Blade view named show.blade.php
     */
    public function show(our_users $user)
    {
        return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\our_users  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * The edit() function is responsible for:
     * Showing a form pre-filled with an existing user’s data, so the user can edit and update it.
     * It receives the specific our_users model instance .
     * Then it loads the edit.blade.php view and passes the user data to it.
     */
    public function edit(our_users $user)
    {
        return view('edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, our_users $user)
    {
        $request->validate([
            'full_name'      =>  'required',
            'email'     =>  'required|email',
            'user_image'     =>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $user_image = $request->hidden_user_image;

        if($request->user_image != '')
        {
            $user_image = time() . '.' . request()->user_image->getClientOriginalExtension();

            request()->user_image->move(public_path('images'), $user_image);
        }

        $user = our_users::find($request->hidden_id);

        $user->student_name = $request->student_name;

        $user->student_email = $request->student_email;

        $user->student_gender = $request->student_gender;

        $user->student_image = $user_image;

        $user->save();

        return redirect()->route('/')->with('success', 'User Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(our_users $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student Data deleted successfully');
    }
}
