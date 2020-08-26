<div class="card shadow border-left-primary mb-4">
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="tbl-user">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Created at</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($dataUser as $user)
                    <tr>
                        <td class="text-center align-middle">1</td>
                        <td class="text-center align-middle">
                            <img style="height: 100px; width:100px; object-fit:cover; object-position:center;" src="{{ $user->takeImage() }}"
                alt="{{ $user->username }}" class="rounded img-fluid img-thumbnail">
                </td>
                <td class="text-center align-middle">{{ $user->name }}</td>
                <td class="text-center align-middle">{{ $user->username }}</td>
                <td class="text-center align-middle">{{ $user->email }}</td>
                <td class="text-center align-middle">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-circle ">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('user.delete', $user->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-circle ">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                </td>
                </tr>
                @endforeach --}}

            </tbody>
        </table>
    </div>
</div>
