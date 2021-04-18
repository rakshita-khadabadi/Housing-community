@extends('city-view.app')

@section('title', 'Mock Community Bill')

@section('content')

<h1>Mock Community Bill</h1>

@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST">
    @csrf
    <div>

        <input type="text" id="fname" name="apartmentId" value="" placeholder="apartmentId"> <br><br>

        <input type="text" id="lname" name="maintenanceBill" value="" placeholder="maintenanceFeeBill"> <br><br>

        <input type="text" id="w-bill" name="poolBill" value="" placeholder="poolBill"> <br><br>

        <input type="text" id="g-bill" name="gymBill" value="" placeholder="gymBill"> <br><br>

        <input type="text" id="month" name="month" value="" placeholder="month"> <br><br>

        <input type="text" id="year" name="year" value="" placeholder="year"> <br><br>

        <input id="btnSubmit" type="submit" value="Submit">

    </div>
</form>


@endsection
