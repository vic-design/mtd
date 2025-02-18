<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TestController extends Controller
{
    /**
     * Summary of index
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('Test');
    }

    /**
     * Summary of list
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(): JsonResponse
    {
        // dd(Test::paginate(10));
        return response()->json(Test::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
