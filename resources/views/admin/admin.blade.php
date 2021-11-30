@extends('admin.app')

@section('main')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h3">Admin Management</h1>   
    @if(Auth::user()->roles == 1)
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <span data-feather="plus" style="margin-bottom: 2px;"></span> Add new Admin
        </button>
    @endif   

</div>

@if(\Session::has('success'))
<div class="alert alert-success " role="alert">
  {{ \Session::get('success') }}
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form method="POST" action="{{ url('/admin') }}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
      </div>
      <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Admin Full Name :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" placeholder="admin name">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Admin Email :</label>
                <div class="col-sm-7">
                    <input type="email" class="form-control" name="email" placeholder="admin@admin.com">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Admin Password :</label>
                <div class="col-sm-7">
                    <input type="Password" class="form-control" name="password" placeholder="password">
                </div>
            </div>
        

      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button  type="submit" class="btn btn-success" >Submit</button>
        </div>
    </form>
    </div>
  </div>
</div> 


<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $key=>$user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td colspan="{{ Auth::user()->roles == 1 ? '0':'2' }}" class="{{ $user->status ? 'text-success' : 'text-secondary' }}">{{ $user->status ? 'active' : 'inactive' }}</td>
                    @if(Auth::user()->roles == 1)
                    <td>
                        <form method="POST" action="{{ url('/admin/'. $user->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm {{$user->roles == 1 || !$user->status ? 'invisible' : ''}}">Make Inactive</button>
                        </form>
                    </td>
                    @endif
                   
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-secondary text-center">No Data Found</td>
                </tr>
            @endforelse
           
           
        </tbody>
    </table>
</div>
@endsection
    <script>
      feather.replace();
    </script>