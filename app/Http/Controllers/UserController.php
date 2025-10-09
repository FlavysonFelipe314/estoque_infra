<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('created_at', 'DESC')->get();

        return view('pages.users.index', compact('users'));
    }
    
    public function store(StoreUserRequest $request){
        $validatedData = $request->validated();
        $defaultPassword = Hash::make("Mudar@123");
        
        $validatedData['password'] = $defaultPassword;

        try{
            User::create($validatedData);

            return Redirect::route('usuario.index')->with('success', 'Usuario criado com sucesso');
        } catch (Exception $err){

            return Redirect::route('usuario.index')->with('error', 'Não foi possível criar usuário');
        }
    }

    public function update(UpdateUserRequest $request, User $user){
        $validatedData = $request->validated();

        try{
            $user->update($validatedData);

            return Redirect::route('usuario.index')->with('success', 'Usuario atualizado com sucesso');
        } catch (Exception $err){

            return Redirect::route('usuario.index')->with('error', 'Não foi possível atualizar usuário');
        }
    }

    public function destroy(User $user){
        try{
            $user->delete();

            return Redirect::route('usuario.index')->with('success', 'Usuario deletado com sucesso');
        } catch (Exception $err){

            return Redirect::route('usuario.index')->with('error', 'Não foi possível deletar usuário');
        }    
    }
}
