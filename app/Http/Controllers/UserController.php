<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Jetstream\Contracts\DeletesTeams;
use App\Models\Team;
use Laravel\Jetstream\Jetstream;
use Jetstream\Actions\DeleteTeam;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public $user;

    public function __construct(){
        $this->user = DB::table('users')->get();
    }

    public function users(){
        return view('users',['user' => $this->user]);
    }


    public function deleteUser(Request $request){
        //ne fonctionne pas
        $id=(int)$request->id;
        // $user = User::find($id);
        // $deleteTeamAction = new DeleteTeam();
        // $deleteTeamAction->delete($user);
        
        if(DB::table('users')->where('id', '=', $id)->delete()){
            return redirect('/users?msg=userdeleted');
        }else{
            return redirect('/users?error=userNotDeleted');
        }
        
    }

    public function CreateUser(){
        return view('CreateUser');
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'matricule' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required','string','confirmed','min:8'],
        ]);
            
        if ($validator->fails()) {
            response()->json(['errors' => $validator->errors()], 422);
            return redirect('/users?error={$validator->errors}');
        }

        if(User::create([
            'name' => $request['name'],
            'prenom' => $request['prenom'],
            'matricule' => $request['matricule'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
        ]))

        return redirect('/users?msg=userCreated');
         


    }

    
}
