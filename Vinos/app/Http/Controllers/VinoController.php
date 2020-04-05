<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Vino;

class VinoController extends Controller
{
    public function index(){
        $vinos = \DB::table('vinos')
                        ->select('vinos.*')
                        ->orderBy('id','DESC')
                        ->get();
        return view('vinos')->with('vinos',$vinos);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre'=> 'required|min:3|max:30',
            'edad'=> 'required|min:3',
            'color'=> 'required|min:3',
            'sabor'=> 'required|min:3',
            'alcohol'=> 'required|min:3',
            'precio'=> 'required|numeric',
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('ErrorInsert','Favor de llenar todos los campos')
            ->withErrors($validator);
            dd('Favor de llenar los campos');
        }else{
            $usuario = Vino::create([
                'nombre'=>$request->nombre,
                'img'=>'default.jpg',
                'edad'=> $request->edad,
                'color'=> $request->color,
                'sabor'=> $request->sabor,
                'alcohol'=>$request->alcohol,
                'precio'=> $request->precio,
                'stock'=> '23'
            ]);
            return back()->with('Listo','Se ha insertado correctamente');
        }
        dd($request->nombre);
    }
}
