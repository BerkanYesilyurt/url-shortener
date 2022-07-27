@extends('index')

@section('content')

    <h1 class="cover-heading">Stats</h1>
    <br>
    <p class="lead">{{str_replace('stats/', '', url()->current())}}</p>
    <br>
        <p class="lead">
    <div class="alert alert-warning" role="alert" style="text-shadow: none;">
        <b>Total visitors of this link: {{count($visitors)}}</b>
    </div>
        </p>




        @if(count($visitors) > 0)
            <table class="table" style="text-shadow: none;">
                <thead>
                <tr class="table-primary">
                    <th scope="col">IP Address</th>
                    <th scope="col">Browser</th>
                    <th scope="col">Device</th>
                    <th scope="col">Referer</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
            <tbody>
        @foreach($visitors as $visitor)
        <tr class="table-secondary">
            <td>{{$visitor->ip_address}}</td>
            <td>{{$visitor->browser}}</td>
            <td>{{$visitor->device}}</td>
            <td>@php
                if($visitor->referer == 'Direct'){
                    echo 'Direct';
                }else{
                    echo '<b><a href="' . $visitor->referer .  '" target="_blank"><font color="black">Click</font></a></b>';
                }
                @endphp
                </td>
            <td>{{$visitor->created_at->diffForHumans()}}</td>
        </tr>
        @endforeach
            </tbody>
         </table>
            <style>
                .bg-white { background-color: transparent!important; }
            </style>
          <br>
           {{ $visitors->links() }}
        @else
            <font size="5"><center>No visitors found.</center></font>
        @endif



@endsection
