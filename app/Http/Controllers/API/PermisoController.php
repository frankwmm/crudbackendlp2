<?php

namespace App\Http\Controllers\API;

use App\Models\Permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\Permiso as PermisoResource;


class PermisoController extends BaseController
{
    
    
    public function index()
    {
        $permiso = Permiso::all();

        return $this->sendResponse(PermisoResource::collection($permiso), 'Permiso retrieved successfully.');

    }




    public function create()
    {
        //
    }

    


    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nom_permiso' => 'required',
            'desc_permiso' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $permiso =  Permiso::create($input);

        return $this->sendResponse(new PermisoResource($permiso), 'Permiso created successfully.');
    }

   
    

   
    public function show($id)
    {
        $permiso = Permiso::find($id);

        if (is_null($permiso)) {
            return $this->sendError('Permiso not found.');
        }

        return $this->sendResponse(new PermisoResource($permiso), 'Permiso retrieved successfully.');


    }
   



    public function edit(Permiso $permiso)
    {
        
    }

  


    public function update(Request $request, Permiso $permiso)
    {
        $input = $request->all();
        //$curso = Curso::findOrFail($id);

        $validator = Validator::make($input, [
            'nom_permiso' => 'required',
            'desc_permiso' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $permiso->nom_permiso = $input['nom_permiso'];
        $permiso->desc_permiso = $input['desc_permiso'];
        $permiso->save();

        return $this->sendResponse(new PermisoResource($permiso), 'Permiso updated successfully.');

    }

    


    
    public function destroy(Permiso $permiso)
    {
        $permiso->delete();

        return $this->sendResponse([], 'Permiso deleted successfully.');

    }
}
