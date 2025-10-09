<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Exception;
use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('created_at', 'DESC')->get();

        return view('pages.categorias.index', compact('categorias'));
    }

    public function store(StoreCategoriaRequest $request)
    {
        $validatedData = $request->validated();

        try{
            Categoria::create($validatedData);

            return Redirect::route('categoria.index')->with('success', 'Categoria criada com sucesso');
        } catch (Exception $err){

            return Redirect::route('categoria.index')->with('error', 'Não foi possível criar a categoria');
        }
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $validatedData = $request->validated();

        try{
            $categoria->update($validatedData);

            return Redirect::route('categoria.index')->with('success', 'Categoria atualizada com sucesso');
        } catch (Exception $err){

            return Redirect::route('categoria.index')->with('error', 'Não foi atualizar criar a categoria');
        }
    }

    public function destroy(Categoria $categoria)
    {
        try{
            $categoria->delete();

            return Redirect::route('categoria.index')->with('success', 'Categoria deletada com sucesso');
        } catch (Exception $err){

            return Redirect::route('categoria.index')->with('error', 'Não foi possível deletar a categoria');
        }    
    }
}
