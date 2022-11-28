<?php

namespace App\Http\Controllers\API;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Security\Profile;
use App\Models\Permission;
use Illuminate\Support\Arr;
class UserController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
        } else {
            $success = false;
            $message = 'Unauthorised';
        }
        $response = [
            'success' => $success,
            'message' => $message,
            'name_user' => auth()->user()->name,
            'perfil_user'=>auth()->user()->profile_id,
        ];
        return response()->json($response);
    }
    public function getModules($id,Request $request)
    {
        $modules = Profile::select(
            'profiles.id  as profile_id',
            'profiles.description as description_perfil',
            'permissions.id as permission_id',
            'modules.id as module_id',
            'modules.description  as description_module',
            'sub_modules.id  as sub_module_id',
            'modules.icon',
            'sub_modules.url',
            'sub_modules.description  as description_sub_module',
            'modules.parent_module',

        )
        ->where('profiles.id','=',$id)
            ->join('permissions', 'permissions.profile_id', '=', 'profiles.id')
            ->join('modules', 'permissions.module_id', '=', 'modules.id')
            ->join('modules as  sub_modules', 'modules.id', '=', 'sub_modules.parent_module')
            ->orderBy('modules.id', 'desc')
            ->get();
            $list_module = array();
            $flag="";
            $sub_modules = array();
            foreach($modules as $row) {
                  if($flag!=$row->description_module){
                     $sub_modules = array();
                     $flag=$row->description_module;
                  }
                    array_push($sub_modules, array('sub_module_id' => $row->sub_module_id, 'description_sub_module' => $row->description_sub_module,'icon'=>$row->icon,'url'=>$row->url));
                    $list_module[$row->description_module]= $sub_modules;
            }
        return response()->json(['modules' => $list_module]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}