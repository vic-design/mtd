<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CarMechanicController extends Controller
{
    /**
     * Summary of __invoke
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request): Response
    {
        return Inertia::render('CarMechanic');
    }
}
