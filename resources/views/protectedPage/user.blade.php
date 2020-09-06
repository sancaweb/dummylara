@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-12">

        <div class="card shadow mb-4 border-left-primary">
            <!-- Card Header - Accordion -->
            <a id="linkCardCollapse" href="#cardFormUser" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="cardFormUser">
                <h6 class="m-0 font-weight-bold text-primary titleForm">
                    <i class="fas fa-user-plus"></i> Halaman User
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="cardFormUser" style="">
                <div class="card-body">
                    Halaman User
                </div>
            </div>
        </div>


    </div>




</div>

@endsection
