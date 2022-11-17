<?php

namespace App\Http\Controllers;

use App\Models\Episodio;

class EpisodiosController extends BaseController{

    public function __construct(){
        $this->classe = Episodio::class;
    }

    public function showSerie(int $serie_id){
        $episodios = Episodio::query()
        ->where('serie_id',$serie_id)
        ->get();

        return $episodios;
    }
}
