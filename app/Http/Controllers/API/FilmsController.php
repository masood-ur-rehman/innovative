<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Films;
use Validator;

class FilmsController extends Controller
{
    /**
     * Purpose: Listing FILMS
     * Display a listing of the resource.
     * @return mixed
     */
    public function index()
    {
        $films =  Films::paginate(1);

        return $films;
    }

    /**
     * Purpose: SAVING FILM
     * @param \App\Http\Requests\Films\Store $request
     * @return array
     * @throws \Exception
     */
    public function store(\App\Http\Requests\Films\Store $request)
    {
        return $request->process();
    }

}
