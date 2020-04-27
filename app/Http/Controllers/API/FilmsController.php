<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Films;
use Illuminate\Support\Facades\Auth;
use Validator;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function index()
    {
        $films =  Films::paginate(1);

        return $films;
    }

    /**
     * @param \App\Http\Requests\Films\Store $request
     * @return array
     * @throws \Exception
     */
    public function store(\App\Http\Requests\Films\Store $request)
    {
        return $request->process();
    }

}
