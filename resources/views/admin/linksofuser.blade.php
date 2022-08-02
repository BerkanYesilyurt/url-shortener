@extends('index')

@section('content')

    <h1 class="cover-heading">Links of</h1>

    <p class="lead">
        <b>{{$userInfo->email}}</b>
    </p>
    <br>
    @if(count($LinksOfUser) > 0)
        <table class="table table-striped">
            <thead>
            <tr class="table-danger" style="text-shadow: none;">
                <th scope="col">Link Path</th>
                <th scope="col">Date</th>
                <th scope="col">Link</th>
                <th scope="col">Stats</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($LinksOfUser as $LinkOfUser)
                <tr class="table-warning" style="text-shadow: none;">
                    <th scope="row">{{$LinkOfUser->short_path}}</th>
                    <td>{{str_replace('minutes', 'min', $LinkOfUser->created_at->diffForHumans())}}</td>
                    <td><a target="_blank" href="{{url('/') . '/' . $LinkOfUser->short_path}}" class="btn btn-info">Go To Link</a></td>
                    <td><a target="_blank" href="{{url('/') . '/stats/' . $LinkOfUser->short_path}}" class="btn btn-info">Stats</a></td>
                    <form method="POST" action="/delete/{{$LinkOfUser->id}}">
                        @csrf
                        @method('DELETE')
                        <td><button type="submit" class="btn btn-danger" style="color: white;">Delete</button></td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
        <style>
            .bg-white { background-color: transparent!important; }
        </style>
        <br>
        {{ $LinksOfUser->links() }}
    @else
        <font size="5"><center>No links found.</center></font>
    @endif
@endsection
