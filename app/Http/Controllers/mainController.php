<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class mainController extends Controller
{   
    
    //main interface
    public function main_view()
    {
        
        //set view 
        if(Auth::check())
        {   
            $user_data['username']='Jondoe';
            $view=view('logged_in',$user_data);
        }else
        {
            $view=view('index');
        }

        return $view;
    }

    //login interface
    public function login_view()
    {   
        if(Auth::guest())
        {  
            return view('auth.login');
        }else
        {
            redirect('index');
        }
    }

    //register interface    
    public function register_view()
    {   
        if(Auth::guest())
        {  
            return view('auth.register');
        }else
        {
            redirect('index');
        }
    } 

}
