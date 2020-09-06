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
        @include('activity.cardInput')
    </div>

    <div class="col-12">
        <div class="card shadow border-left-primary mb-4">

            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a id="linkCardDataCollapse" href="#cardActivityData" class="d-block card-header py-3"
                    data-toggle="collapse" role="button" aria-expanded="true" aria-controls="cardActivityData">
                    <h6 class="m-0 font-weight-bold text-primary">Activity Log</h6>
                </a>
                <div>
                    <button type="button" id="btn-reload" class="btn btn-success btn-icon-split ">
                        <span class="icon text-white-50">
                            <i class="fas fa-sync"></i>
                        </span>
                        <span class="text">Reload Data</span>
                    </button>
                </div>

            </div>
            <div class="card-body table-responsive collapse show" id="cardActivityData">
                <table class="table table-bordered" id="tbl-activity" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">User</th>
                            <th class="text-center">Log Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">DateTime</th>
                            <th class="text-center">View Detail</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailAct" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="detailActLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailActLabel">Detail Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txt_user">User Log</label>
                        <input readonly disabled type="text" class="form-control" id="txt_user" placeholder="Log Name">
                    </div>

                    <div class="form-group">
                        <label for="txt_logName">Log Name</label>
                        <input readonly disabled type="text" class="form-control" id="txt_logName"
                            placeholder="Log Name">
                    </div>

                    <div class="form-group">
                        <label for="txt_desc">Keterangan</label>
                        <input readonly disabled type="text" class="form-control" id="txt_desc"
                            placeholder="Keterangan">
                    </div>

                    <div class="form-group">
                        <label for="txt_data">Data</label>
                        <textarea readonly disabled id="txt_data" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txt_created">Created at</label>
                        <input readonly disabled type="text" class="form-control" id="txt_created"
                            placeholder="Keterangan">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
