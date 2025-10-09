<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use Exception;
use Illuminate\Support\Facades\Redirect;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fornecedores = Fornecedor::orderBy('created_at', 'DESC')->get();

        return view('pages.fornecedores.index', compact('fornecedores'));
    }

    public function store(StoreFornecedorRequest $request)
    {
        $validatedData = $request->validated();

        try{
            Fornecedor::create($validatedData);

            return Redirect::route('fornecedor.index')->with('success', 'Fornecedor criado com sucesso');
        } catch (Exception $err){

            return Redirect::route('fornecedor.index')->with('error', 'Não foi possível criar o fornecedor');
        }
    }

    public function update(UpdateFornecedorRequest $request, Fornecedor $fornecedor)
    {
        $validatedData = $request->validated();

        try{
            $fornecedor->update($validatedData);

            return Redirect::route('fornecedor.index')->with('success', 'Fornecedor atualizado com sucesso');
        } catch (Exception $err){

            return Redirect::route('fornecedor.index')->with('error', 'Não foi atualizar criar o fornecedor');
        }
    }

    public function destroy(Fornecedor $fornecedor)
    {
        try{
            $fornecedor->delete();

            return Redirect::route('fornecedor.index')->with('success', 'Fornecedor deletado com sucesso');
        } catch (Exception $err){

            return Redirect::route('fornecedor.index')->with('error', 'Não foi possível deletar o fornecedor');
        }    
    }
}
