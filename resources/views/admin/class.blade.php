@extends('admin.app')

@section('main')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h3">Class Management</h1>   
        
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <span data-feather="plus" style="margin-bottom: 2px;"></span> Add new Class
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
    <form method="POST" action="{{ url('/class') }}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Class</h5>
      </div>
      <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Class Code :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="code" placeholder="SI">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Class Region :</label>
                <div class="col-sm-7">
                <select class="custom-select" name="region">
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{  $region->value }}</option>
                    @endforeach
                </select>
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
                <th>Code</th>
                <th>Region</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classes as $key=>$class)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $class->code }}</td>
                    <td>{{ $regions[$class->region_id -1 ]->key }}</td>
                    <td class="{{ $class->status ? 'text-success' : 'text-secondary' }}">{{ $class->status ? 'active' : 'inactive' }}</td>
                    <td>
                        <form method="POST" action="{{ url('/class/'. $class->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm {{$class->roles == 1 || !$class->status ? 'invisible' : ''}}">Make Inactive</button>
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