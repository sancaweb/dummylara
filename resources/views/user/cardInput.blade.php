<div class="card shadow border-left-primary mb-4">
    <div class="card-body">
        <form id="formUser" action="{{ $action }}" class="user" method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($method))
            @method($method)
            @endif
            <div class="form-group">
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
                        class="form-control form-control-user @error('name') is-invalid @enderror" id="nama"
                        placeholder="Nama" autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-sm-6">
                    <input type="text" name="username" value="{{ $user == null ? old('username') : $user->username }}"
                        class="form-control form-control-user @error('username') is-invalid @enderror" id="username"
                        placeholder="Username">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <input type="email" value="{{ $user == null ? old('email') : $user->email }} " name="email"
                    class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                    placeholder="Email Address" autocomplete="off">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password"
                        class="form-control form-control-user @error('password') is-invalid @enderror" id="password"
                        placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="password" name="passconf" class="form-control form-control-user" id="passconf"
                        placeholder="Repeat Password">
                </div>
            </div>

            <button type="button" id="btn-submitUser" class="btn btn-primary btn-user btn-block">
                Save
            </button>
        </form>
    </div>
</div>
