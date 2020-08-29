<div class="card shadow border-left-primary mb-4">

    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <a id="linkCardDataCollapse" href="#cardUserData" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="cardUserData">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
        </a>
        <a href="{{ route('user.trash') }}" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-trash"></i>
            </span>
            <span class="text">User Trash</span>
        </a>
    </div>
    <div class="card-body table-responsive collapse show" id="cardUserData">
        <table class="table table-bordered" id="tbl-user" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Created at</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div>
</div>
