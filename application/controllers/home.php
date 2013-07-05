<?php

class Home_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
    {
        Auth::logout();
        return View::make('home.index');

    }    

	public function post_index()
    {
        

        $credentials = array(
                        'username' => e(Input::get('email')),  // Input::get('email')
                        'password' => e(Input::get('pass')) // Input::get('password')
        );
     
        $record = User::where_email($credentials['username'])->first();
        // Validation
        $v = User::validate(array(
                'email' => $credentials['username'],
                'pass' => $credentials['password']
            ));

        if ( $v ) 
        {
            //Check Creds
            if ( Auth::attempt($credentials) )
            {
                $user = Auth::user();
                if($user)
                {
                    $u_id = $user->id;
                    return Redirect::to('/users/profile');
                }
            }
            return Redirect::to('/')->with_errors($v->errors);
        }

        //TO DO - Show the error
        return Redirect::to('/');
    }    

    public function get_new()
    {
        return View::make('user.new');
    }  

}