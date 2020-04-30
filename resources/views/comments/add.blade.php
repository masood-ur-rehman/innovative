@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header"><b><a href="{{ route('films.show', ['film'=>$film->Slug]) }}">{{$film->Name}}</a></b> - Add New Comment</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('comments.store') }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="{{'post'}}">
                            <input type="hidden" name="film_id" value="{{ $film->id }}">
                            <input type="hidden" name="Slug" value="{{$film->Slug}}">
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
                                <label for="Comment"
                                       class="col-md-4 col-form-label text-md-right">Comment</label>

                                <div class="col-md-6">
                                    <textarea name="Comment"
                                              class="form-control @error('Comment') is-invalid @enderror">{{ old('Comment') }}</textarea>

                                    @error('Comment')
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
