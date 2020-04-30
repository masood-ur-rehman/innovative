<?php
namespace App\Http\Controllers\WEB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use Validator;

class CommentsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $film=null)
    {
        $film = \App\Models\Films::where('Slug', '=', $film)->first();

        if (!$film) {
            return back()->with('error','Invalid Film Requested');
        }
        return view('comments.add')
            ->with(['film'=>$film]);
    }

    /**
     * @param \App\Http\Requests\Films\Store $request
     * @return array
     * @throws \Exception
     */
    public function store(\App\Http\Requests\Comments\Store $request)
    {
        return $request->process();
    }

}
