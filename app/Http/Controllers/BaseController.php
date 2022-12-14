<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController{

    protected string $classe;

    public function index(Request $request){
        return $this->classe::paginate($request->per_page);
    }

    public function store(Request $request){
        return  response()->json($this->classe::create($request->all()), 201);
    }

    public function show(int $id){
        $recurso =  $this->classe::find($id);
        if(is_null($recurso))
            return response('',204);

        return response()->json($recurso, 200);
    }
    public function update(int $id, Request $request){
        $recurso =  $this->classe::find($id);
        if(is_null($recurso))
        return response('',204);

        $recurso->fill($request->all());
        $recurso->save();
        return ($recurso);
    }

    public function destroy(int $id){
        $recurso =  $this->classe::find($id);

        if(is_null($recurso))
            return response('',204);
        $recurso->destroy($id);
        return response('Deletado com sucesso!');
    }

}
