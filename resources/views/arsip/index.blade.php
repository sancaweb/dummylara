@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-12">

        @include('arsip.cardInput')

    </div>

    <div class="col-12">
        @include('arsip.cardData')
    </div>



</div>
    
@endsection