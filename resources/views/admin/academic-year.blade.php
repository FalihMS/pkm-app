@extends('admin.app')

@section('main')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h3">Academic Year Management</h1>   
        
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <span data-feather="plus" style="margin-bottom: 2px;"></span> Add new Academic Year
    </button>
</div>

@if(\Session::has('success'))
<div class="alert alert-success" role="alert">
  {{ \Session::get('success') }}
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form method="POST" action="{{ url('/academic-year') }}">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Academic Year</h5>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 offset-1 col-form-label">New Academic Year :</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="odd-year" id="odd-year" placeholder="2020" oninput="myFunction()">
            </div>
            <div class="col-sm-1">
                <h3 class="text-center font-weight-normal">/</h3>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="even-year" id="even-year" readonly>
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
                <th>Year</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($years as $keys=>$year)
                <tr>
                    <td>{{ $keys+1 }}</td>
                    <td>{{ $year->year }}</td>
                    <td>{{ $year->semester == 1 ? 'Ganjil' : 'Genap' }}</td>
                    <td class="{{ $year->status ? 'text-success' : 'text-secondary' }}">{{ $year->status ? 'active' : 'inactive' }}</td>
                    <td class="d-flex">
                        <form method="POST" action="{{ url('/academic-year/'. $year->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="mr-3 btn btn-outline-info btn-sm">Generate Report</button>
                        </form>
                        <form method="POST" action="{{ url('/academic-year/'. $year->id) }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-outline-success btn-sm {{$year->status == 1 ? 'invisible' : ''}}">Make Active</button>
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
        function myFunction() {
            var x = document.getElementById("odd-year");
            var y = document.getElementById("even-year");
            if(x.value.length > 4){
                x.value = x.value.substring(0, 4)
            }
            if(x.value.length == 4){
                y.value = parseInt(x.value) + 1;
            }else{
                y.value = '';
            }
        }
    </script>