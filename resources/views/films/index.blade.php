@extends('layouts.default')
@section('content')
<div class="container">
    <h2>Films</h2>
    <a href="{{route('films.create')}}" class="btn btn-outline-primary" role="button" aria-pressed="true" style="float:right;margin-bottom: 10px;">Add New</a>

    <table class="table table-bordered" id="laravel">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($films['data'] as $k=>$film)
            <tr>
                <td>{{ $film['id'] }}</td>
                <td>{{ $film['Name'] }}</td>
                <td>{{ $film['Description'] }}</td>
                <td>{{ date('d F, Y', strtotime($film['created_at'])) }}</td>
                <td><a href="{{ route('films.show', ['film'=>$film['Slug']]) }}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a class="btn btn-primary" href="{{route('films.index')}}?page=1">First Page</a>
    @if($films['prev_page_url'])
    <a class="btn btn-primary" href="{{route('films.index')}}?page={{app('request')->input('page')-1}}">Prev Page</a>
    @endif
    @if($films['next_page_url'])
    <a class="btn btn-primary" href="{{route('films.index')}}?page={{app('request')->input('page')+1}}">Next Page</a>
    @endif
    @for($page = 1; $page<=$films['last_page']; $page++)
        <a class="btn btn-light" href="{{route('films.index')}}?page={{$page}}">{{ $page }}</a>
    @endfor
    <a class="btn btn-primary" href="{{route('films.index')}}?page={{$films['last_page']}}">Last Page</a>

</div>
@endsection
