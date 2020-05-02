<?php
namespace App\Http\Controllers\WEB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Films;
use Validator;

class FilmsController extends Controller
{
    /**
     * PURPOSE: LISTING FILMS VIA API
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function index(Request $request)
    {

        $page = 1;
        if($request->input('page')){
            $page = $request->input('page');
        }

        /*GETTING RESPONSE FROM API*/
        $films = AuthController::getRequest('films?page='.$page, 'GET');

        return view('films/index', ['films'=>$films]);

    }

    /**
     * PURPOSE: Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param $film
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($film='')
    {
        $film = Films::where('Slug', '=', $film)->first();
        if (!$film) {
            return back()->with('error','Invalid Film Requested');
        }

        return view('films/show', ['film'=>$film]);
    }


}
