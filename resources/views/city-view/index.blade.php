@extends('city-view.app')

@section('title', 'Home Page')

@section('content')
    <h1>City View</h1>

    {{-- @foreach ($roleList as $key => $role)
    <p>{{ $key }}</p>
    <p>{{ $role['id'] ?? '' }}</p>
    <p>{{ $role['role_name'] ?? ''}}</p>   
    <p>----------------</p> 
    @endforeach --}}

    @forelse ($roleList as $key => $role)

    {{-- @break($key == 1)
    @continue($key == 1) --}}

        @include('city-view.test')

    @empty
    <p>This is blank</p>
    @endforelse

    {{-- This is how if and else is used in blade --}}
    {{-- @if($role['id'] == 2)                   
    <p>{{ $role['id'] ?? '' }}</p>
    <p>{{ $role['role_name'] ?? ''}}</p>
    @else
    <p>This is the ELSE block</p>

    @endif --}}

    {{-- This is how unless is used -> if the condition is false, then the code is rendered --}}

    {{-- @unless ($role['id'] == 2)
    <p>Unless works if the condition is false</p>
        
    @endunless

    @isset($role['id'])
    <p>id variable isset</p>
        
    @endisset --}}

@endsection