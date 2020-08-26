@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data User</h1>
</div>
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
