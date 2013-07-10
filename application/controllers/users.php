<?php

class Users_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        //This is already overwritten in routes.php
        //return View::make('user.index');
        return 'Users index';

    }    

	public function post_index()
    {
        $email = e(Input::get('email'));
        $password = e(Input::get('pass'));
        $password_conf = e(Input::get('confirm'));
        $captchat = e(Input::get('captchatest'));
        // Validate 
        $v = User::validate(array(
                'email' => $email,
                'pass' => $password,
                'confirm' => $password_conf,
                'captchatest' => $captchat
            ));
        if ( $v !== true ) {
        return Redirect::to('/users/new')->with_errors($v->errors);
        }

        // If email is already in the table, return text
        $record = User::where_email($email)->first();

        if ( $record ) {
        return 'Email already exists';
        }
        
        // Otherwise, add a new row, and return the user's profile page
        $row = User::create(array(
        'email' => $email,
        'random' => User::get_unique_string(),
        'password' => Hash::make($password)
        ));

        if ( $row ) {
        Auth::logout();
        return 'Registration Successful! Please Go back to ' . HTML::link('/', 'login' ) . ' page';
        }
    }    

	public function get_profile()
    {


            

        // this controller only runs when the user is authenticated
        // This is responsible for showing the user's information
        $user = Auth::user(); // Set all user object information
        
        //update a user to put notes in
        // $old_user = User::find(1);
        // $old_user->note = 'This is where I keep my values.';
        // $old_user->save();
        // return 'done updating';
        
        //insert websites to work with
        // User::find(1)->websites()->insert(array(
        //      'url' => 'http://yahoo.ca'
        //      ));
        //     return 'done inserting';

        if ($user) 
        {
            ## First query all the data 
            
            //user websites
            $u_id = $user->id;

            $websites = Website::where('user_id', '=', $u_id)->get(); //this gives an array of site objects

            // notes            
            $specific_user = User::find($u_id); // returns just the object
            $note = $specific_user->note;

            //tbd
            $tbd = $specific_user->tbd;
            //images

             ##Count the number of elements a user has stored to be used for generating default inputs
            $num_sites = count($websites);

            ## return the view to show the data
            return View::make('user.profile')->with(array(
                'email' => $user->email,
                'note' => $note,
                'tbd' => $tbd,
                'websites' => $websites
            ));
        }
        
    }    

	public function get_edit()
    {
        $user = Auth::user(); // Set all user object information
        if ($user) 
        {
            ## First query all the data 
            
            //user websites
            $u_id = $user->id;
            $websites = Website::where('user_id', '=', $u_id)->get(); //this gives an array of site objects
            
            // notes            
            $specific_user = User::find($u_id); // returns just the object
            $note = $specific_user->note;

            //tbd
            $tbd = $specific_user->tbd;
            //images

             ##Count the number of elements a user has stored to be used for generating default inputs
            $num_sites = count($websites);

            ## return the view to show the data
            return View::make('user.edit')->with(array(
                'email' => $user->email,
                'note' => $note,
                'tbd' => $tbd,
                'websites' => $websites,
                'num_sites' => $num_sites   
            ));
        }
        
    }    

	public function get_new()
    {
        return View::make('user.new');
    }    

	public function put_profile()
    {
        ## First get user information
        $user = Auth::user(); // Set all user object information
        
        ## If a user is logged in
        if ($user) {
        // update the notes based on user input
        $u_id = $user->id;
        $old_user = User::find($u_id);
        $old_user->note =  e(Input::get('notes'));
        $old_user->save();

        //update the tbd
        $old_user->tbd =  e(Input::get('tbd'));
        $old_user->save();

        // check if user has some websites saved
        $websites = Website::where('user_id', '=', $u_id)->get(); //this gives an array of site objects
        if (empty($websites))
        {
            User::find($u_id)->websites()->insert(array(
                    'url' =>    e(Input::get('websites0'))
                ));

            User::find($u_id)->websites()->insert(array(
                    'url' =>    e(Input::get('websites1'))
                ));

            User::find($u_id)->websites()->insert(array(
                    'url' =>    e(Input::get('websites2'))
                ));

            User::find($u_id)->websites()->insert(array(
                    'url' =>    e(Input::get('websites3'))
                ));

            User::find($u_id)->websites()->insert(array(
                    'url' =>    e(Input::get('websites4'))
                ));

            User::find($u_id)->websites()->insert(array(
                    'url' =>    e(Input::get('websites5'))
                ));

        }
        else   //update the websites table
        {
            $user_websites = array(
                array('url' => e(Input::get('websites0'))),
                array('url' => e(Input::get('websites1'))),
                array('url' => e(Input::get('websites2'))),
                array('url' => e(Input::get('websites3'))),
                array('url' => e(Input::get('websites4'))),
                array('url' => e(Input::get('websites5')))
            );

            $site = User::find($u_id);
            $site->websites()->save($user_websites);
        }

            // if user has websites update the table


        // create websites if user has never created any

        ## return to profile page
            
        //runs the query again so after saving in edit the sites will show right away
        $websites = Website::where('user_id', '=', $u_id)->get();
            
            // notes            
            $specific_user = User::find($u_id); // returns just the object
            $note = $specific_user->note;

            //tbd
            $tbd = $specific_user->tbd;
            //images

             ##Count the number of elements a user has stored to be used for generating default inputs
            $num_sites = count($websites);

            ## return the view to show the data
            return View::make('user.profile')->with(array(
                'email' => $user->email,
                'note' => $note,
                'tbd' => $tbd,
                'websites' => $websites,

            ));
        }
        
    }    

	public function delete_profile()
    {

    }

}