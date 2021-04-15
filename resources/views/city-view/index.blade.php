@extends('city-view.app')

@section('title', 'Home Page')

@section('content')
    <h1>City View</h1>

    @foreach ($roleList as $role)
    <p>{{ $role['id'] ?? '' }}</p>
    <p>{{ $role['role_name'] ?? ''}}</p>    
    @endforeach

    {{-- This is how if and else is used in blade --}}
    {{-- @if($role['id'] == 2)                   
    <p>{{ $role['id'] ?? '' }}</p>
    <p>{{ $role['role_name'] ?? ''}}</p>
    @else
    <p>This is the ELSE block</p>

    @endif --}}

    {{-- This is how unless is used -> if the condition is false, then the code is rendered --}}

    @unless ($role['id'] == 2)
    <p>Unless works if the condition is false</p>
        
    @endunless

    @isset($role['id'])
    <p>id variable isset</p>
        
    @endisset

@endsection