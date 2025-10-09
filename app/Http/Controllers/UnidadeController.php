<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Http\Requests\StoreUnidadeRequest;
use App\Http\Requests\UpdateUnidadeRequest;
use Exception;
use Illuminate\Support\Facades\Redirect;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidade::orderBy('created_at', 'DESC')->get();

        return view('pages.unidades.index', compact('unidades'));
    }


    public function store(StoreUnidadeRequest $request)
    {
        $validatedData = $request->validated();

        try{
            Unidade::create($validatedData);

            return Redirect::route('unidade.index')->with('success', 'Unidade criada com sucesso');
        } catch (Exception $err){

            return Redirect::route('unidade.index')->with('error', 'Não foi possível criar a unidade');
        }
    }


    public function update(UpdateUnidadeRequest $request, Unidade $unidade)
    {
        $validatedData = $request->validated();

        try{
            $unidade->update($validatedData);

            return Redirect::route('unidade.index')->with('success', 'Unidade atualizada com sucesso');
        } catch (Exception $err){

            return Redirect::route('unidade.index')->with('error', 'Não foi possível atualizar a unidade');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unidade $unidade)
    {
        try{
            $unidade->delete();

            return Redirect::route('unidade.index')->with('success', 'Unidade deletada com sucesso');
        } catch (Exception $err){

            return Redirect::route('unidade.index')->with('error', 'Não foi possível deletar a Unidade');
        }    
    }
}
