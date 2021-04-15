@extends('city-view.app')

@section('title', 'Home Page')

@section('content')
    <h1>City View</h1>

    @if($role['id'] == 2)
    <p>{{ $role['id'] ?? '' }}</p>
    <p>{{ $role['role_name'] ?? ''}}</p>
    @else
    <p>This is the ELSE block</p>

    @endif

@endsection