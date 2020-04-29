@extends('layouts.default')
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <a href="{{ route('films.index') }}">Go Back to Films</a>
            <div class="card">

                <div class="card-header"><b>{{ $film->Name }}</b></div>

                <div class="card-body">
                    <img src="{{ url("storage/$film->Photo") }}" width="20%"/>
                    <br />
                    <p><b>Name:</b> {{ $film->Name }}</p>
                    <p><b>Description:</b> {{ $film->Description }}</p>
                    <p><b>ReleaseDate: </b>{{ $film->ReleaseDate }}</p>
                    <p><b>Rating: </b>{{ $film->Rating }}</p>
                    <p><b>TicketPrice: </b>{{ $film->TicketPrice }}</p>
                    <p><b>Country: </b>{{ $film->Country }}</p>
                    <p><b>Genre: </b>{{ $film->Genre }}</p>
                    <p><b>Photo: </b><a href="{{ url("storage/$film->Photo") }}" target="_blank">{{ url("storage/$film->Photo") }}</a></p>
                    <p><b>Created At: </b>{{ $film->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
