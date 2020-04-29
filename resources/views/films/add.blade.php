@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Add New Film</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('films.store') }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="{{'post'}}">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="Name" type="text"
                                           class="form-control @error('Name') is-invalid @enderror" name="Name"
                                           value="{{ old('Name') }}" required autocomplete="name" autofocus>

                                    @error('Name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Description"
                                       class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea name="Description"
                                              class="form-control @error('Description') is-invalid @enderror">{{ old('Description') }}</textarea>

                                    @error('Description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ReleaseDate" class="col-md-4 col-form-label text-md-right">Release
                                    Date</label>

                                <div class="col-md-6">
                                    <input id="ReleaseDate" type="date"
                                           class="form-control @error('ReleaseDate') is-invalid @enderror"
                                           name="ReleaseDate" value="{{ old('ReleaseDate') }}">

                                    @error('ReleaseDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Rating" class="col-md-4 col-form-label text-md-right">Rating</label>

                                <div class="col-md-6">
                                    <select id="Rating" name="Rating"
                                            class="form-control @error('Rating') is-invalid @enderror">
                                        @foreach(range(1, 5) as $y)
                                            <option value="{{$y}}"
                                                    @if(old('Rating') == $y) selected @endif>{{$y}}</option>
                                        @endforeach
                                    </select>

                                    @error('Rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="TicketPrice" class="col-md-4 col-form-label text-md-right">Ticket
                                    Price</label>

                                <div class="col-md-6">
                                    <input id="TicketPrice" type="number" min="0" max="1000"
                                           class="form-control @error('TicketPrice') is-invalid @enderror"
                                           name="TicketPrice" value="{{ old('TicketPrice') }}">

                                    @error('TicketPrice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Country" class="col-md-4 col-form-label text-md-right">Country</label>

                                <div class="col-md-6">
                                    <select id="Country" name="Country"
                                            class="form-control @error('Country') is-invalid @enderror">
                                        @foreach(['USA','PK','IN'] as $country)
                                            <option value="{{$country}}"
                                                    @if(old('Country') == $country) selected @endif>{{$country}}</option>
                                        @endforeach
                                    </select>

                                    @error('Country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Genre" class="col-md-4 col-form-label text-md-right">Genre</label>

                                <div class="col-md-6">
                                    <select id="Genre" name="Genre"
                                            class="form-control @error('Genre') is-invalid @enderror">
                                        @foreach(['Action','Drama','Animation'] as $genre)
                                            <option value="{{$genre}}"
                                                    @if(old('Genre') == $genre) selected @endif>{{$genre}}</option>
                                        @endforeach
                                    </select>

                                    @error('Genre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Photo</label>

                                <div class="col-md-6">
                                    <input type="file" name="Photo" id="Photo"
                                           class="form-control @error('Photo') is-invalid @enderror">
                                    @error('Photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
