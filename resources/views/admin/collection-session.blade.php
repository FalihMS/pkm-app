@extends('admin.app')

@section('main')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h3">Collection Session Management</h1>   
        
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <span data-feather="plus" style="margin-bottom: 2px;"></span> Add new Collection Session
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
    <form method="POST" action="{{ url('/session') }}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Collection Session</h5>
      </div>
      <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Session title :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="title" placeholder="Pengumpulan PKM-GT Final">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">PKM Type :</label>
                <div class="col-sm-7">
                    <select class="custom-select" name="type">
                        <option value="-1"  selected="true" disabled="true">Select Pkm Type</option>
                        @foreach($pkmTypes as $type)
                            <option value="{{ $type->id }}">{{  $type->value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Session deadline :</label>
                <div class="col-sm-7">
                    <input type="date" class="form-control" name="deadline">
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
                <th>Title</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sessions as $key=>$session)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $session->title }}</td>
                    <td>{{ $session->deadline }}</td>
                    <td>
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="{{ '#exampleModal'. $session->id }}" data-whatever="@mdo">
                            Extend Deadline
                        </button>
                        <!-- <form method="POST" action="{{ url('/session/'. $session->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm {{$session->roles == 1 || !$session->status ? 'invisible' : ''}}">Make Inactive</button>
                        </form> -->
                        <!-- Modal -->
                        <div class="modal fade" id="{{ 'exampleModal'. $session->id }}" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <form method="POST" action="{{ url('/session/'. $session->id) }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Extend Deadline </h5>
                                </div>
                                <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">    
                                    <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label" >New Session title :</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" value="{{ $session->title }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">PKM Type :</label>
                                            <div class="col-sm-7">
                                                <select class="custom-select" name="type" disabled>
                                                    @foreach($pkmTypes as $type)
                                                        <option value="{{ $type->id }}" {{ $type->id == $session->pkm_type_id ? 'selected' : '' }} >{{ $type->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Session deadline :</label>
                                            <div class="col-sm-7">
                                                <input type="date" class="form-control" name="deadline" value="{{ $session->deadline }}">
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
                    </td>
                </tr> 
            @empty
                <tr>
                    <td colspan="4" class="text-secondary text-center">No Data Found</td>
                </tr>
            @endforelse          
        </tbody>
    </table>


</div>
@endsection
    <script>
      feather.replace();

    </script>
