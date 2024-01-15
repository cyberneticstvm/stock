@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Update User</h1>
                <small class="text-muted">User / Update User</small>
            </div>
        </div>
    </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-lg-4 py-3">
    <div class="container-fluid">
        <div class="row g-3 clearfix">
            <div class="card mb-2">
                <div class="card-body p-4">
                    @include("sections.message")
                    <form action="{{ route('update.user', $user->id) }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label req">Full Name</label>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control form-control-lg" placeholder="Full Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Username</label>
                                <input type="text" value="{{ $user->username }}" name="username" class="form-control form-control-lg" placeholder="Userame">
                                @error('username')
                                <small class="text-danger">{{ $errors->first('username') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Email</label>
                                <input type="email" value="{{ $user->email }}" name="email" class="form-control form-control-lg" placeholder="Email">
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label req">Role</label>
                                <select class="form-control form-control-lg select2" name="role">
                                    <option value="admin" {{ ($user->role == 'admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{ ($user->role == 'manager') ? 'selected' : '' }}>Manager</option>
                                    <option value="staff" {{ ($user->role == 'staff') ? 'selected' : '' }}>Staff</option>
                                </select>
                                @error('role')
                                <small class="text-danger">{{ $errors->first('role') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Password</label>
                                <input type="password" value="" name="password" class="form-control form-control-lg" placeholder="******">
                                @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-12 text-end">
                                <button type="button" onClick="history.back()" class="btn btn-danger">Cancel</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary btn-submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
@endsection