<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\PregnantResource;
use App\Models\Pregnant;
use Illuminate\Http\Request;


class PregnantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PregnantResource::collection(Pregnant::paginate(100));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cui' => 'required',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'fecha_de_nacimiento' => 'required|string',
            'ultima_regla' => 'required|string',
            'peso' => 'required|string',
            'altura' => 'required|string',
            'id_user' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $pregnant = Pregnant::create(array_merge(
            $validator->validated(),
        ));

        // return new PregnantResource($pregnant);

        return response()->json([
            'status' => 'ok',
            'pregnant' => $pregnant
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
