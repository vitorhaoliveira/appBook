<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\tbllivros;
class TbllivrosController extends Controller
{
    //construir o crud
    //mostrar todos os registros da tabeka livros
    //crud -> Read(leitura) select/ visualizar
    public function index() {
        $regBook = tbllivros::All();
        $contador = $regBook->count();
        return 'Livros: '.$contador.$regBook.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    //cadastrar registro
    //Crud -> Create(criar/cadastrar)

    public function show (string $id){
        $regBook = tbllivros::find($id);
        if($regBook){
            return 'Livros localizados '.$regBook.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Livros localizados '.$regBook.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    //Alterar registro
    //Crud -> 
    public function store(Request $request){
        $regBook=$request->All();
        
        $regVerifq = Validator::make($regBook,[
            'nomeLivro'=>'required',
            'generoLivro'=>'required',
            'anoLivro'=>'required'
            
        ]);
        if($regVerifq->fails()){
            return 'Registros Invalidos '.Response()->json([],Response::HTTP_NO_CONTENT);;
        }   
        $regBookCad = tbllivros::create($regBook);
        if($regBookCad){
            return 'Livros cadastrados '.Response()->json([],Response::HTTP_NO_CONTENT);

        }
        else{
            'Registros Invalidos '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    //Alterar registros
    //Crud -> update(alterar)
    public function update(Request $request, string $id)
    {
        $regBook = $request->All();

        $regVerifq = Validator::make($regBook,[
            'nomeLivro' => 'required',
            'generoLivro' => 'required',
            'anoLivro' => 'required'  
        ]);  
        if($regVerifq->fails()){
            return'registros não atualizados: '.Response()->json([],Response::HTTP_NO_CONTENT);
        }

        $regBookBanco = tbllivros::find($id);
        $regBookBanco->nomeLivro = $regBook['nomeLivro'];
        $regBookBanco->generoLivro = $regBook['generoLivro'];
        $regBookBanco->anoLivro = $regBook['anoLivro'];

        $retorno = $regBookBanco->save();
        
        if($retorno) {
            return "Livro atualizado com sucesso.".Response()->json([],Response::HTTP_NO_CONTENT);

        } else {
            return "atenção... Erro: livro não atualizado".Response()->json([],Response::HTTP_NO_CONTENT); 
        }

    }

    //Deletar os registros
    //Crud -> delete(apagar)
    public function destroy (string $id){
        $regBook = tbllivros::find($id);

        if($regBook->delete()) {

            return "o livro foi deletado com sucesso".Response()->json([],Response::HTTP_NO_CONTENT);
        }

        return "algo deu errado, o livro não foi deletado".Response()->json([],Response::HTTP_NO_CONTENT);
    }
}
