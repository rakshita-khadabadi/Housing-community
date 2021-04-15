@extends('city-view.app')

@section('title', 'Home Page')

@section('content')
    <h1>City View</h1>

    <p>{{ $role['id'] }}</p>
    <p>{{ $role['role_name'] }}</p>
@endsection