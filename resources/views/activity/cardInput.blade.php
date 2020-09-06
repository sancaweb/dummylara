<div class="card shadow mb-4 border-left-primary">
    <!-- Card Header - Accordion -->
    <a id="linkCardCollapse" href="#cardFormUser" class="d-block card-header py-3 collapsed" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="cardFormUser">
        <h6 class="m-0 font-weight-bold text-primary titleForm">
            <i class="fas fa-filter"></i> Filter Data
        </h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse " id="cardFormUser" style="">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <select name="userAct" id="userAct" class="form-control form-control-lg">
                        <option value="">-= Select User =-</option>
                        @foreach ($userAct as $act)
                        <option value="{{ $act->causer_id }}">{{ $act->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <select name="logNameAct" id="logNameAct" class="form-control form-control-lg">
                        <option value="">-= Select Log Name =-</option>
                        @foreach ($logNameAct as $log)
                        <option value="{{ $log->log_name }}">{{ $log->log_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button type="button" id="btn-resetFilter" class="btn btn-success btn-user btn-block">
                    <i class="fas fa-sync"></i> Reset
                </button>
                <button type="button" id="btn-filter" class="btn btn-primary btn-user btn-block">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>

        </div>
    </div>
</div>
