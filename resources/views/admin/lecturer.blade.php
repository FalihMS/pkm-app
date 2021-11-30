@extends('admin.app')

@section('main')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h3">Lecturer Management</h1>   
        
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <span data-feather="plus" style="margin-bottom: 2px;"></span> Add new Lecturer
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
    <form method="POST" action="{{ url('/lecturer') }}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Lecturer</h5>
      </div>
      <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Lecturer Full Name :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" placeholder="Lecturer name">
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Lecturer Email :</label>
                <div class="col-sm-7">
                    <input type="email" class="form-control" name="email" placeholder="admin@admin.com">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Lecturer Code :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="code" id="code_lecturer" placeholder="D1234" oninput="haveNidnChange()">
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Lecturer NIDN :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="nidn" id="nidn_lecturer" placeholder="0007016101" >
                </div>
            </div>
            <div class="form-group row custom-control custom-switch">
                <div class="col-sm-7 offset-3 pl-5">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="have_nidn" onclick="haveNidnChange()">
                        <label class="custom-control-label" for="have_nidn">Lecturer Doesn't have NIDN</label>
                    </div>
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
                <th>Kode</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lecturers as $key=>$lecturer)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $lecturer->name }}</td>
                    <td>{{ $lecturer->code }}</td>
                    <td class="{{ $lecturer->status ? 'text-success' : 'text-secondary' }}">{{ $lecturer->status ? 'active' : 'inactive' }}</td>
                    <td class="d-flex">
                        <form method="GET" action="{{ url('/lecturer/'. $lecturer->id) }}">
                            <a href="{{ url('/lecturer/'. $lecturer->id) }}" class="btn btn-outline-info btn-sm">View Detail</a>
                            <a href="{{ url('/lecturer/'. $lecturer->id) }}" class="btn btn-outline-success btn-sm">Generate Report</a>
                        </form>
                        
                        <form method="POST" action="{{ url('/lecturer/'. $lecturer->id) }}" class="ml-1">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm {{$lecturer->roles == 1 || !$lecturer->status ? 'invisible' : ''}}">Make Inactive</button>
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
      function haveNidnChange(){
        if(document.getElementById("code_lecturer").value.length > 5){
            document.getElementById("code_lecturer").value = document.getElementById("code_lecturer").value.substring(0,5) 
        }

        if (document.getElementById('have_nidn').checked) 
        {
            document.getElementById("nidn_lecturer").value = document.getElementById("code_lecturer").value;
            document.getElementById('nidn_lecturer').readOnly = true;

        } else {
            document.getElementById('nidn_lecturer').readOnly = false;
        }

       
      }
    </script>