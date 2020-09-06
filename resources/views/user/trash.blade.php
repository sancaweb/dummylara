@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow border-left-primary mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a id="linkCardDataCollapseTrash" href="#cardUserDataTrash" class="d-block card-header py-3"
                    data-toggle="collapse" role="button" aria-expanded="true" aria-controls="cardUserDataTrash">
                    <h6 class="m-0 font-weight-bold text-primary">Trashed Users</h6>
                </a>
                <div>
                    <button type="button" id="btn-userReloadTrash" class="btn btn-success btn-icon-split ">
                        <span class="icon text-white-50">
                            <i class="fas fa-sync"></i>
                        </span>
                        <span class="text">Reload Data</span>
                    </button>

                    <a href="{{ route('user') }}" class="btn btn-primary     btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-users"></i>
                        </span>
                        <span class="text">Data User</span>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive collapse show" id="cardUserDataTrash">
                <table class="table table-bordered" id="tbl-userTrash" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Restore</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
