<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CepController extends Controller
{
    public function obterEndereco($cep)
    {

        if ((strlen($cep)<8) || (strlen($cep)<8)){
            return response()->json(['error'=>'CEP deverá ter 8 números'], 400);
        }

        $url = "http://viacep.com.br/ws/{$cep}/json/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return response($result);

    }

    public function obterListaEndereco($estado, $cidade, $rua)
    {
        if (strlen($estado)==0){
            return response()->json(['erro'=>'O campo estado é obrigatório'], 400);
        }

        if (strlen($cidade)==0){
            return response()->json(['erro'=>'O campo cidade é obrigatório'], 400);
        }

        if (strlen($rua)==0){
            return response()->json(['erro'=>'O campo rua é obrigatório'], 400);
        }

        $url = "https://viacep.com.br/ws/$estado/$cidade/$rua/json/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return response($result);
    }
}
