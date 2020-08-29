@extends('layouts.app')

@section('content')
@if ($message = Session::get('message'))
<div class="alert alert-{{ Session::get('alertClass') }} alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $message }}</strong>
</div>

@endif

<div class="row">

    <div class="col-12">

        @include('user.cardInput')

    </div>

    <div class="col-12">
        @include('user.cardData')
    </div>



</div>
@endsection
