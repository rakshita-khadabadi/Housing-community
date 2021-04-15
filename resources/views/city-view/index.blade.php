@extends('city-view.app')

@section('title', 'Home Page')

@section('content')
    <h1>City View</h1>

    @if($role['id'] == 1)
    <p>{{ $role['id'] ?? '' }}</p>
    <p>{{ $role['role_name'] ?? ''}}</p>
    @endif

@endsection