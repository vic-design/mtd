<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\StoreEngineRequest;
use App\Http\Requests\Car\UpdateEngineRequest;
use App\Models\Engine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EngineController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Engine::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Car\StoreEngineRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEngineRequest $request): JsonResponse
    {
        $model = new Engine();
        $model->name = $request->get('name');
        $model->hp = $request->get('hp');
        $model->moment = $request->get('moment');
        $model->save();

        return response()->json(['result' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Engine $engine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEngineRequest $request, Engine $engine)
    {
        $engine->update($request->all());

        return response()->json(['result' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Engine $engine
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Engine $engine): JsonResponse
    {
        $engine->delete();

        return response()->json(['result' => true]);
    }

    /**
     * Show filtered list
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse|mixed
     */
    public function filter(string $filter): JsonResponse
    {
        return response()->json(
            Engine::query()->filter($filter)->get()
        );
    }
}
