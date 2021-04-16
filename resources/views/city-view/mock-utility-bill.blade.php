@extends('city-view.app')

@section('title', 'Mock Utility Bill')

@section('content')

<h1>Mock Utility Bill</h1>

@isset($outputResponse)
<div>
    <p>outputResponse</p>
    <p>{{ $outputResponse['statusCode'] }}</p>
    <p>{{ $outputResponse['message'] }}</p>
</div>

@endisset

<form method="POST">
    @csrf
    <div>
        <!-- <label for="fname"></label> -->
        <input type="text" id="fname" name="apartmentId" value="" placeholder="apartmentId"> <br><br>
        <!-- <label for="lname"></label> -->
        <input type="text" id="lname" name="electricityBill" value="" placeholder="electricity"> <br><br>
        <!-- <label for="email"></label> -->
        <input type="text" id="w-bill" name="waterBill" value="" placeholder="water"> <br><br>
        <!-- <label for="password"></label> -->
        <input type="text" id="g-bill" name="gasBill" value="" placeholder="gas"> <br><br>

        <input type="text" id="i-bill" name="internetBill" value="" placeholder="internet"> <br><br>

        <input type="text" id="month" name="month" value="" placeholder="month"> <br><br>

        <input type="text" id="year" name="year" value="" placeholder="year"> <br><br>

        <input id="btnSubmit" type="submit" value="Submit">

    </div>
</form>


@endsection
