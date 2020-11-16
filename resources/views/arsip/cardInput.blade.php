<div class="card shadow mb-4 border-left-primary">
    <!-- Card Header - Accordion -->
    <a id="linkCardCollapse" href="#cardFormArsip" class="d-block card-header py-3 collapsed" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="cardFormArsip">
        <h6 class="m-0 font-weight-bold text-primary titleForm">
            <i class="far fa-file-pdf"></i> Add Arsip
        </h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse " id="cardFormArsip" style="">
        <div class="card-body">
            <form id="formArsip" action="{{ $action }}" class="user" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="code" value=""
                            class="form-control id="code"
                            placeholder="Code" autofocus>
                        
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="nama"
                            value=""
                            class="form-control id="nama"
                            placeholder="Nama">
                        
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-sm-6">
                        <select name="bidang" id="bidang" class="form-control">
                            <option value=""></option>
                            
                            
                        </select>
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="email" value="" name="email"
                            class="form-control id="email"
                            placeholder="Email Address" autocomplete="off">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="password" name="passconf" class="form-control" id="passconf"
                            placeholder="Repeat Password">
                    </div>
                </div>

                <button type="submit" id="btn-submitArsip" class="btn btn-primary btn-user btn-block">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>
