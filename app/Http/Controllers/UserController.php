<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        try {
            $response = [
                'status' => 200,
                'data' => []
            ];

            $user = User::where([
                ['username', $username],
                ['password', $password]
            ])->first();

            if($user){
                $response = [
                    'status' => 200,
                    'data' => $user
                ];
            }

            return response()->json($response);
        }catch (\Exception $error){
            return response()->json([
                'status' => 400,
                'error' => $error->getMessage()
            ], 400);
        }
    }

    public function register(Request $request) {
        $username = $request->input('username', false);
        $password = $request->input('password', false);
        $firstname = $request->input('firstname', false);
        $lastname = $request->input('lastname', false);
        $picture = $request->input('user_picture', false);

        $check_obj = [$username, $password, $firstname, $lastname, $picture];

        foreach ($check_obj as $key => $value) {
            if($value === false){
                return response()->json([
                    'status' => 400,
                    'error' => 'Please fill in all parameters.'
                ], 400);
            }
        }
        
        try {
            $insert_object = [
                'username' => $username,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'user_picture' => $picture
            ];

            User::insert($insert_object);

            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => 'Successful Registration.'
            ], 200);
        }catch (\Exception $error){
            return response()->json([
                'status' => 400,
                'error' => $error->getMessage()
            ], 400);
        }
    }
}
