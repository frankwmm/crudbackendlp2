<?php

namespace App\Http\Controllers\API;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\Curso as CursoResource;


class CursoController extends BaseController
{
    


    public function index()
    {
        $curso = Curso::all();

        return $this->sendResponse(CursoResource::collection($curso), 'Curse retrieved successfully.');


    }

  

    public function create()
    {
       




    }




    public function store(Request $request)
    {
        
        $input = $request->all();

        $validator = Validator::make($input, [
            'nombre' => 'required',
            'detalle' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $curso = Curso::create($input);

        return $this->sendResponse(new CursoResource($curso), 'Curse created successfully.');


    }

  



    public function show($id)
    {
        $curso = Curso::find($id);

        if (is_null($curso)) {
            return $this->sendError('Curse not found.');
        }

        return $this->sendResponse(new CursoResource($curso), 'Curse retrieved successfully.');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
       

    }

  


    
    public function update(Request $request, Curso $curso) {
       
        $input = $request->all();
        //$curso = Curso::findOrFail($id);

        $validator = Validator::make($input, [
            'nombre' => 'required',
            'detalle' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $curso->nombre = $input['nombre'];
        $curso->detalle = $input['detalle'];
        $curso->save();

        return $this->sendResponse(new CursoResource($curso), 'Curso updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();

        return $this->sendResponse([], 'Curse deleted successfully.');
    }
}
