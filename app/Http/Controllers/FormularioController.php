<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    protected function sendForm (Request $request){
        try {
            dd($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
}
