<?php
namespace App\Http\Controllers\WEB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Films;
use Validator;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function index(Request $request)
    {
        $page = 1;
        if($request->input('page')){
            $page = $request->input('page');
        }
        $films = AuthController::getRequest('films?page='.$page, 'GET');

        return view('films/index', ['films'=>$films]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('films.add')
            ->with([]);
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($film)
    {
        $film = Films::where('Slug', '=', $film)->first();

        if (!$film) {
            return back()->with('error','Invalid Film Requested');
        }

        return view('films/show', ['film'=>$film]);
    }


}
