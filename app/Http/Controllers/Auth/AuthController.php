<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function checkLogin(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        if(starts_with($username, ['a-'])){      // admin login

            $user = User::where(array('username' => $username, 'password' => $password, 'user_type' => 'admin'))->first();

            if(isset($user)) {

                Session::put('admin_id', $user->id);

                Session::put('loggedPersonName', $user->name);

                return json_encode(array('message' => 'correct'));
            }
            else
                return json_encode(array('message' => 'wrong'));
        }
        else if(starts_with($username, ['t-'])) {      // teacher login

            $user = User::where(array('username' => $username, 'password' => $password, 'user_type' => 'teacher'))->first();

            if(isset($user)) {

                Session::put('teacher_id', $user->id);

                Session::put('loggedPersonName', $user->name);

                return json_encode(array('message' => 'correct'));
            }
            else
                return json_encode(array('message' => 'wrong'));
        }
        else if(starts_with($username, ['e-'])) {      // employee login

            $user = User::where(array('username' => $username, 'password' => $password, 'user_type' => 'employee'))->first();

            if(isset($user)) {

                Session::put('employee_id', $user->id);

                return json_encode(array('message' => 'correct'));
            }
            else
                return json_encode(array('message' => 'wrong'));
        }
        else if(starts_with($username, ['s-'])) {      // student login

            $user = User::where(array('username' => $username, 'password' => $password, 'user_type' => 'student'))->first();

            if(isset($user)) {

                Session::put('student_id', $user->id);

                return json_encode(array('message' => 'correct'));
            }
            else
                return json_encode(array('message' => 'wrong'));
        }
        else if(starts_with($username, ['p-'])) {      // parent login

            $user = User::where(array('username' => $username, 'password' => $password, 'user_type' => 'parent'))->first();

            if(isset($user)) {

                Session::put('parent_id', $user->id);

                return json_encode(array('message' => 'correct'));
            }
            else
                return json_encode(array('message' => 'wrong'));
        }
        else
            return json_encode(array('message' => 'invalid'));
    }

    public function logout(){
        Session::flush();

        return redirect('/login');
    }
}