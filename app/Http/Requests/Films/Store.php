<?php

namespace App\Http\Requests\Films;
use Storage;
use App\Models\Films;
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
            'Name' => 'required|max:32',
            'Description' => 'required|max:1024',
            'ReleaseDate' => 'required|date_format:Y-m-d',
            'Rating' => 'required|integer|gt:0|lte:5',
            'TicketPrice' => 'required|gt:0|lte:1000',
            'Country' => 'required|in:USA,PK,IN',
            'Genre' => 'required|in:Action,Drama,Animation',
            'Photo' => 'required',
        ];
    }

    public function messages()
    {
        /*VALIDATION MESSAGES*/
        return [

        ];
    }

    public function process()
    {
        try {

            /*CREATING UNIQUE & CHECKING SLUG FROM NAME*/
            $slug = urlencode(preg_replace('/\s+/', '-', $this->input('Name')));
            $filmBySlug = Films::where('Slug', '=',  $slug)->first();
            if($filmBySlug){
                $slug .= '-'.rand(1,999);
            }

            /*PROCESS FILE UPLOAD*/
            $filename = null;
            if($this->file('Photo')){
                $Photo = $this->file('Photo');

                $filename = time().'.'. $Photo->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('films', $Photo, $filename);
                $filename = 'films/'.$filename;
            }

            $films = Films::create([
                'Name' => $this->input('Name'),
                'Slug' => strtolower($slug),
                'Description' => $this->input('Description'),
                'ReleaseDate' => $this->input('ReleaseDate'),
                'Rating' => $this->input('Rating'),
                'TicketPrice' => $this->input('TicketPrice'),
                'Country' => $this->input('Country'),
                'Genre' => $this->input('Genre'),
                'Photo' => $filename,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            /*RESPONSE FOR API USAGE*/

            if ($this->expectsJson()) {

                return ['status'=>true, 'message'=>'Film Saved Successfully'];
            }else{
                return redirect()->route('films.show',['film'=>$films->Slug])
                    ->with('success', 'Record successfully added.');

            }

        } catch (\Exception  $e) {
            throw $e;
        }

    }

}
