<div class="card shadow mb-4 border-left-primary">
    <!-- Card Header - Accordion -->
    <a id="linkCardCollapse" href="#cardFormUser" class="d-block card-header py-3 collapsed" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="cardFormUser">
        <h6 class="m-0 font-weight-bold text-primary titleForm">
            <i class="fas fa-user-plus"></i> Add User
        </h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse " id="cardFormUser" style="">
        <div class="card-body">
            <form id="formUser" action="{{ $action }}" class="user" method="post" enctype="multipart/form-data">
                @csrf
                @if (isset($method))
                @method($method)
                @endif
                <div class="form-group">
                    <img id="imgReview" src="{{ asset('images/no-image.png') }}" class="card-img-top mt-2"
                        style="width:230px;height:230px;object-fit:cover; object-position:center;">
                    <hr>
                    <label for="foto"> Foto :</label>
                    <input type="file" value="" name="foto" class="is-invalid" id="foto">
                    @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="name" value="{{ $user == null ? old('name') : $user->name }}"
                            class="form-control form-control-lg @error('name') is-invalid @enderror" id="nama"
                            placeholder="Nama" autofocus>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="username"
                            value="{{ $user == null ? old('username') : $user->username }}"
                            class="form-control form-control-lg @error('username') is-invalid @enderror" id="username"
                            placeholder="Username">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="email" value="{{ $user == null ? old('email') : $user->email }} " name="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                            placeholder="Email Address" autocomplete="off">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <select name="role" id="role" class="form-control form-control-lg">
                            <option value="">Silahkan Pilih Roles</option>
                            @foreach ($roles as $key=>$role)
                            <option value="{{ $role }}">{{ ucwords($role) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" name="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" id="password"
                            placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="password" name="passconf" class="form-control form-control-lg" id="passconf"
                            placeholder="Repeat Password">
                    </div>
                </div>

                <button type="submit" id="btn-submitUser" class="btn btn-primary btn-user btn-block">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>
