@extends('admin.app')

@section('main')

<!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h3">Lecturer Management</h1>   
        
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <span data-feather="plus" style="margin-bottom: 2px;"></span> Add new Lecturer
    </button>
</div> -->

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
        <h5 class="modal-title" id="exampleModalLabel">Assign Class</h5>
      </div>
      <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="action" value="add_class">
      <input type="hidden" name="lecturer" value="{{ $lecturer->id }}">
        <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label text-right">Academic Year :</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="name" value="{{ $year->year }}" disabled>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="name" value="{{ $year->semester %2==0 ? 'Genap' : 'Ganjil' }}" disabled>
                </div>
        </div>        
        <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label text-right">Region :</label>
                <div class="col-sm-4">
                <select class="custom-select" name="region" id="region" onchange="changeRegion()">
                    <option value="-1"  selected="true" disabled="true">Select Region</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->value }}</option>
                    @endforeach
                </select>
                </div>
        </div>  
        <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label text-right">Class Code :</label>
                <div class="col-sm-4">
                <select class="custom-select" name="class" id="classes" disabled>
                    <option value="-1"  selected="true" disabled="true">Select Class</option>
                </select>
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

<div class="d-flex">
    <img src="https://i.pravatar.cc/125?img=27" alt="Girl in a jacket" class="rounded mt-3 mr-3" height="125">
    <div class="d-flex flex-column flex-wrap flex-md-nowrap mt-3 pb-2 mb-3">
        <h1 class="h4">{{ $lecturer->name }}</h1>   
        <h1 class="h5 font-weight-normal">{{ $lecturer->code }}</h1>   
        <h1 class="h5 font-weight-normal {{ $lecturer->code == $lecturer->nidn ? 'invisible' : ''  }}">{{ $lecturer->nidn }}</h1>   
        <h1 class="h5 font-weight-normal">
            @if(!$lecturer->status)
            <span class="text-danger">Lecturer Inactive</span> 
            @elseif($lecturer->status && sizeof($classes) == 0)
            <span class="text-warning">No Class Assigned</span> 
            <button type="button" class="btn btn-outline-primary btn-sm ml-2" data-toggle="modal" data-target="#exampleModal">
                Assign Class
            </button>
            @else
            <span class="text-success">Class Assigned</span> 
            <button type="button" class="btn btn-outline-primary btn-sm ml-2" data-toggle="modal" data-target="#exampleModal">
                Assign Another Class
            </button>
            @endif
        </h1>   
    </div>
</div>

<h1 class="h4 my-3">Class History</h1> 
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Year</th>
                <th>Semester</th>
                <th>Class Code</th>
                <th>Region</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classes as $key=>$class)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $year->year }}</td>
                    <td>{{ $year->semester%2 == 0 ? 'Genap':'Ganjil'  }}</td>
                    <td>{{ $class->classes()->first()->code }}</td>
                    <td>{{ $regions[$class->classes()->first()->region_id -1]->key }}</td>
                    <td>
                        <form method="POST" action="{{ url('/lecturer/'. $class->id) }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="class" value="{{ $class->id }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm ">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-secondary text-center">No Data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
    <script>
    var users = <?php
    echo '[';
        for($i = 0; $i < sizeof($regions);$i++){
            if(sizeof($regions[$i]->classes()) > 0){
                echo $regions[$i]->classes()->get();
            }
            else{
                echo '{}';
            }
            echo $i == sizeof($regions) - 1 ? '': ',';
        }
        echo ']';
    ?>;

      feather.replace();
      function changeRegion(){
        console.log()
        if(document.getElementById("region").value > 0 ){
            var data = users[document.getElementById("region").value -1];
            document.getElementById("classes").innerHTML = '';
            var option = document.createElement("option");
                option.value = -1;
                option.text = "Select Class";
                option.disabled = true;
                option.selected = true;
                document.getElementById("classes").appendChild(option)
            data.forEach(function(item, index){
                console.log(item)
                var option = document.createElement("option");
                option.value = item.id;
                option.text = item.code;
                document.getElementById("classes").appendChild(option)
            })
            
            document.getElementById("classes").disabled = false;
        }
      }
    </script>