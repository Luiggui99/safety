<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cliente;
use App\Models\Footer;
use App\Models\Formulario;
use App\Models\Menu;
use App\Models\RedesSociale;
use App\Models\Section;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function store(){
        $menus = Menu::where('activo', 1)->orderBy('orden')->get();
        $banners = Banner::where('activo', 1)->get();
        $redesSociales = RedesSociale::where('activo', 1)->get();
        $sections = Section::with(['section_items', 'menu'])->where('activo', 1)->orderBy('orden')->get();
        $clientes = Cliente::where('activo', 1)->get();
        $formulario = Formulario::where('activo', 1)->orderBy('orden')->get();
        $footer = Footer::where('activo', 1)->first();
        return view('welcome', [
            'menus' => $menus,
            'banners' => $banners,
            'redesSociales' => $redesSociales,
            'sections' => $sections,
            'clientes' => $clientes,
            'formulario' => $formulario,
            'footer' => $footer,
        ]);
    }
}
