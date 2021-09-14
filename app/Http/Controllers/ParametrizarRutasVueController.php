<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RutasVue;
use App\Helpers\Equivalencias;
use DB;

class ParametrizarRutasVueController extends Controller
{
    function __construct()
    {
        $this->nameDbCent = config('database.connections.centralizado.schema');
        // $this->nameDbCent = Equivalencias::nameDbCentralizado();
    }

    public function index(Request $request)
    {

    	if (!$request->ajax()) return redirect('/');

        $buscar   = $request->buscar;
        $criterio = $request->criterio;

        $rutas  = RutasVue::select('rutas_vue.*')->orderBy('id', 'desc');

        if (!$buscar=='')
        {
            $rutas->where('rutas_vue.'.$criterio, 'like', '%'. $buscar . '%');
        }

        return [
            'pagination' => [
                'total'        => $rutas->paginate(10)->total(),
                'current_page' => $rutas->paginate(10)->currentPage(),
                'per_page'     => $rutas->paginate(10)->perPage(),
                'last_page'    => $rutas->paginate(10)->lastPage(),
                'from'         => $rutas->paginate(10)->firstItem(),
                'to'           => $rutas->paginate(10)->lastItem(),
            ],
            'rutas' => $rutas->paginate(10)
        ];
    }

    public function store(Request $request)
    {
        $response = [
            'status'  => 'success',
            'mensaje' => ''
        ];

        $messages = [
            'path.required' => 'Path es requerido.',
            'path.unique' =>'El Path debe ser unico.',
            'name.required' => 'El Nombre es requerido.',
            'name.unique' => 'El Nombre debe ser único',
            'component.required' => 'El Componente es requerido.',
        ];

        $validated = $request->validate([
            'name' => 'required|unique:centralizado.rutas_vue',
            'path' => 'required|unique:centralizado.rutas_vue',
            'component' => 'required',
        ],$messages);

        $pos = strpos($request->path, '/', 0);

        if($pos === 0)
        {
            $rutaPath = $request->path;
        }else{
            $rutaPath = '/'.$request->path;
        }

        $validacion2 = RutasVue::where('path',$rutaPath)->first();

        if(is_object($validacion2)){
            return response()->json(['status' => false]);
        }

        try{
            DB::beginTransaction();

            $ruta = new RutasVue();
            $ruta->name       = str_replace(" ","_",$request->name);
            $ruta->path       = $rutaPath;
            $ruta->component  = $request->component;
            $ruta->save();

            DB::commit();

        } catch(\Exception $e){
            DB::rollBack();
        }

        return response()->json(['status' => true]);
    }

    public function update(Request $request)
    {
        $messages = [
            'path.required' => 'Path es requerido.',
            'path.unique' =>'El Path debe ser unico.',
            'name.required' => 'El Nombre es requerido.',
            'name.unique' => 'El Nombre debe ser único',
            'component.required' => 'El Componente es requerido.',
        ];

        $validated = $request->validate([
            'name' => 'required|unique:centralizado.rutas_vue,name,'.$request->id,
            'path' => 'required|unique:centralizado.rutas_vue,path,'.$request->id,
            'component' => 'required',
        ],$messages);

        $pos = strpos($request->path, '/', 0);

        if($pos === 0)
        {
            $rutaPath = $request->path;
        }else{
            $rutaPath = '/'.$request->path;
        }

        try{
            DB::beginTransaction();

            $ruta = RutasVue::findOrFail($request->id);
            $ruta->name       = $request->name;
            $ruta->path       = $rutaPath;
            $ruta->component  = $request->component;
            $ruta->save();

            DB::commit();

        } catch(Exception $e){
            DB::rollBack();
        }

        return response()->json(['status' => true]);
    }

    public function cambiarEstado(Request $request)
    {
    	if (!$request->ajax()) return redirect('/');

        try
        {
            DB::beginTransaction();

            $pedido = RutasVue::where('id', $request->id)->first();
            $pedido->estado = $request->estado;
            $pedido->save();

            DB::commit();

            echo json_encode('ok');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            echo json_encode('no');

        }
    }
}
