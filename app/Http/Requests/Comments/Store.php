<?php

namespace App\Http\Requests\Comments;
use Storage;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'film_id' => 'required|exists:films,id',
            'Slug' => 'required|exists:films,Slug',
            'Name' => 'required|max:32',
            'Comment' => 'required|max:1024',
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function process()
    {
        try {
            /* SAVING COMMENTS */
            $comments = Comments::create([
                'film_id' => $this->input('film_id'),
                'user_id' => $this->user()->id,
                'Name' => $this->input('Name'),
                'Comment' => $this->input('Comment'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            //FOR API USAGE
            if ($this->expectsJson()) {
                return ['status'=>true, 'message'=>'Comment Saved Successfully'];
            }else{
                return redirect()->route('films.show',['film'=>$this->input('Slug')])->with('success', 'Record successfully added.');
            }

        } catch (\Exception  $e) {
            throw $e;
        }

    }

}
