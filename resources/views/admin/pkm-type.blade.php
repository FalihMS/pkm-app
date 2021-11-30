@extends('admin.app')

@section('main')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h3">PKM Type Management</h1>   
        
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <span data-feather="plus" style="margin-bottom: 2px;"></span> Add New PKM Type
    </button>
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
    <form method="POST" action="{{ url('/types') }}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New PKM Type</h5>
      </div>
      <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New PKM Type Key :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="key" placeholder="PKM-">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New PKM Type Value :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="value" placeholder="PKM ">
                </div>
            </div>

      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button  type="submit" class="btn btn-success">Submit</button>
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
                <th>Key</th>
                <th>Value</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pkmTypes as $key=>$pkmType)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $pkmType->key }}</td>
                    <td>{{ $pkmType->value }}</td>
                    <td class="{{ $pkmType->status ? 'text-success' : 'text-secondary' }}">{{ $pkmType->status ? 'active' : 'inactive' }}</td>
                    <td>
                        <form method="POST" action="{{ url('/types/'. $pkmType->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm {{$pkmType->roles == 1 || !$pkmType->status ? 'invisible' : ''}}">Make Inactive</button>
                        </form>
                    </td>
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