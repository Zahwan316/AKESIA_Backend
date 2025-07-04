<?php

namespace App\Http\Controllers\Auth;

use App\apiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Google_Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    use apiResponse;
    //
    public function Login(Request $request){
        $credentials = $request->only('email', 'password');

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['message' => 'Username atau password salah', 'error' => 'invalid_credentials', 'status_code' => 401], 401);
            }

            $user = auth()->guard()->user();

            $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

            if($user->role != $request->selectedUser){
                return response()->json(['message' => 'Username atau password salah', 'status_code' => 401], 401);
            }
            else{
                return response()->json(['success'=> true,'token'=> $token, 'message' => 'Login Berhasil', 'statusCode' => 200],200);
            }

        }catch(JWTException $e){
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }


    public function Register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => 'user'
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['success'=> true,'token'=> $token, 'message' => 'Registrasi Berhasil', 'statusCode' => 200],200);
    }

    public function checkIsCompleteProfile(Request $request){
        $logedInUser = User::find(auth()->guard()->user()->id);

        if($logedInUser->role == 'user'){
            $data = User::with('ibu')->find(auth()->guard()->user()->id);

            if($logedInUser && $logedInUser->ibu){
                return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data,'isCompleteProfile' => true ,'status_code' => 200, 'error' => false], 200);
            }
            else{
                return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data,'isCompleteProfile' => false ,'status_code' => 200, 'error' => false], 200);
            }
        }
        else {
            $data = User::with('bidan')->find(auth()->guard()->user()->id);

            if($logedInUser && $logedInUser->bidan){
                return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data,'isCompleteProfile' => true ,'status_code' => 200, 'error' => false], 200);
            }
            else{
                return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data,'isCompleteProfile' => false ,'status_code' => 200, 'error' => false], 200);
            }
        }

    }

    public function checkToken(Request $request)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Token valid',
                'user' => $user,
                'error' => false,
                'statusCode' => 200,
                'isValid' => true,
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Token tidak valid atau expired',
                'message' => $e->getMessage(),
                'statusCode' => 401,
                'isValid' => false,
            ], 401);
        }
    }

    public function googleLogin(Request $request){
        $idToken = $request->input('idToken');

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]); // Web Client ID kamu
        $payload = $client->verifyIdToken($idToken);

        if ($payload) {
            $email = $payload['email'];
            $name = $payload['name'];

            // Cek apakah user sudah ada, kalau tidak buat
            $user = User::firstOrCreate(
                ['email' => $email],
                ['nama_lengkap' => $name, 'password' => bcrypt(str()->random(12)), 'role' => 'user']
            );

            $token = JWTAuth::claims(['role' => $user->email])->fromUser($user);

            // Buat token Laravel Sanctum atau JWT terserah
            //$token = $user->createToken('google')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user,
                'message' => 'Login Berhasil',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Token tidak valid.',
            ], 401);
        }
    }
}
