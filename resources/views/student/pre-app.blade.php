
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
      <script src="https://unpkg.com/feather-icons"></script>
    <link href="{{ asset('/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <style>
      .card-pkm{
        border-width:0;
        border-left-width: 5px;
      }
    </style>
  </head>

  <body class="bg-light">
      
    <nav class="navbar navbar-light bg-white">
      <span class="navbar-brand mb-0 h1">PKM Collection System</span>
      <a href="/auth/logout" class="navbar-brand mb-0 h1">Logout</a>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md p-3">
          <div class="card px-1 card-pkm {{ $pkm ? 'border-success' : 'border-secondary' }}">
            <div class="card-body ">
              <h5 class="h5 {{ $pkm ? 'text-success' : 'text-secondary' }} pb-1">PKM Info</h5>
              <div class="d-flex flex-row bd-highlight mx-1 flex-column">
                <div class="bd-highlight font-italic">
                  {{ !$pkm ?
                     'Masukkan Informasi terkait data PKM yang ingin dikumpulkan' : 
                     'Informasi PKM Sudah Dimasukkan' 
                  }}
                  
                </div>
                <div class="bd-highlight mt-2">
                  <a href="#" class="mr-3 {{ $pkm ? 'invisible' : '' }}" data-toggle="modal" data-target="#exampleModal2"><u>Masukkan Data PKM</u></a>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md p-3">
          <div class="card px-1 card-pkm {{ $leader ? 'border-success' : 'border-secondary' }} ">
            <div class="card-body ">
              <h5 class="h5 {{ $leader ? 'text-success' : 'text-secondary' }}  pb-1">Leader Information</h5>
              <div class="d-flex flex-row bd-highlight mx-1 flex-column">
                <div class="bd-highlight font-italic">
                  {{ !$leader ?
                     'Masukkan Informasi terkait data Ketua' : 
                     'Informasi Ketua Sudah Dimasukkan' 
                  }}
                </div>
                <div class="bd-highlight mt-2">
                  <a href="#" class="mr-3 {{ $leader ? 'invisible' : '' }}" data-toggle="modal" data-target="#exampleModal"><u>Masukkan Data Ketua</u></a>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md p-3">
        <div class="card px-1 card-pkm {{ $member[0] ? 'border-success' : 'border-secondary' }}">
            <div class="card-body ">
              <h5 class="h5 {{ $member[0] ? 'text-success' : 'text-secondary' }} pb-1">Member 1 Info</h5>
              <div class="d-flex flex-row bd-highlight mx-1 flex-column">
              <div class="bd-highlight font-italic">
                  {{ !$member[0] ?
                     'Masukkan Informasi terkait data Mahasiswa sebagai Anggota 1 dalam PKM' : 
                     'Informasi Anggota 1 Sudah Dimasukkan' 
                  }}
                </div>
                <div class="bd-highlight mt-2">
                  <a href="#" class="mr-3 {{ $member[0] ? 'invisible' : '' }}" data-toggle="modal" data-target="#exampleModal3"><u>Masukkan Data Anggota 1</u></a>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md p-3">
        <div class="card px-1 card-pkm {{ $member[1] ? 'border-success' : 'border-secondary' }}">
            <div class="card-body ">
              <h5 class="h5 {{ $member[1] ? 'text-success' : 'text-secondary' }} pb-1">Member 2 Info</h5>
              <div class="d-flex flex-row bd-highlight mx-1 flex-column">
              <div class="bd-highlight font-italic">
                  {{ !$member[1] ?
                     'Masukkan Informasi terkait data Mahasiswa sebagai Anggota 1 dalam PKM' : 
                     'Informasi Anggota 2 Sudah Dimasukkan' 
                  }}
                </div>
                <div class="bd-highlight mt-2">
                  <a href="#" class="mr-3 {{ $member[1] ? 'invisible' : '' }}" data-toggle="modal" data-target="#exampleModal4"><u>Masukkan Data Anggota 2</u></a>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>  
    


      <!-- Modal PKM-->
      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content"> 
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data PKM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-3 p-md-4">
              <form method="POST" action="{{ url('/student/insert-pkm-file') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Judul PKM :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="title" placeholder="Rancangan Pembuatan Barang Berupa ...">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Jenis PKM :</label>
                <div class="col-sm-7">
                  <select name="type" class="form-control" id="type">
                    <option value="-1" selected="true" disabled="true">Select PKM Type</option>
                    @foreach($pkmTypes as $pkmType)
                      <option value="{{ $pkmType->id }}">{{ $pkmType->value }}</option>  
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Tipe PKM :</label>
                <div class="col-sm-7">
                    <select name="region" onchange="changeRegion()" class="form-control" id="region">
                      <option value="-1" selected="true" disabled="true">Select Region</option>
                    </select>
                  </div>
              </div>
              <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Kelas :</label>
                  <div class="col-sm-7">
                    <select name="class" onchange="changeClasses()" class="form-control" id="classes">
                        <option value="-1" selected="true" disabled="true">Select Class</option>
                    </select>
                  </div>
              </div>
              <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Dosen Pembimbing :</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" name="lecturer" id="lecturer" placeholder="" readonly>
                    <input type="hidden" class="form-control" name="class_lecturer" id="class_lecturer" placeholder="" >
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    
    <!-- Modal Upload-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content"> 
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data PKM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-3 p-md-4">
              <form method="POST" action="{{ url('/student/insert-leader') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">NIM :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="nim" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Nama Lengkap :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Jurusan :</label>
                <div class="col-sm-7">
                  <select name="major" class="form-control" id="type">
                    <option value="-1" selected="true" disabled="true">Pilih Jurusan</option>
                    @foreach($majors as $major)
                      <option value="{{ $major->id }}">{{ $major->value }}</option>  
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Nomor Telefon :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="phone" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Alamat :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="address" placeholder="2101603213">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
          </form>
        </div>
    </div>

    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content"> 
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel3">Data PKM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-3 p-md-4">
              <form method="POST" action="{{ url('/student/insert-member') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="roles" value="2">
        
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">NIM :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="nim" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Nama Lengkap :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Jurusan :</label>
                <div class="col-sm-7">
                  <select name="major" class="form-control" id="type">
                    <option value="-1" selected="true" disabled="true">Pilih Jurusan</option>
                    @foreach($majors as $major)
                      <option value="{{ $major->id }}">{{ $major->value }}</option>  
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Nomor Telefon :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="phone" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Email :</label>
                <div class="col-sm-7">
                    <input type="email" class="form-control" name="email" placeholder="2101603213">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
          </form>
        </div>
    </div>

    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content"> 
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel4">Data PKM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-3 p-md-4">
              <form method="POST" action="{{ url('/student/insert-member') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="roles" value="3">

        
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">NIM :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="nim" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Nama Lengkap :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Jurusan :</label>
                <div class="col-sm-7">
                  <select name="major" class="form-control" id="type">
                    <option value="-1" selected="true" disabled="true">Pilih Jurusan</option>
                    @foreach($majors as $major)
                      <option value="{{ $major->id }}">{{ $major->value }}</option>  
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Nomor Telefon :</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="phone" placeholder="2101603213">
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 offset-md-1 col-form-label text-md-right">Email :</label>
                <div class="col-sm-7">
                    <input type="email" class="form-control" name="email" placeholder="2101603213">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
          </form>
        </div>
    </div>

      <!-- Modal Upload-->
      <!-- <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail PKM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-3 p-md-4">
            <p class="text-info mb-3">
                Mohon Pastikan kembali judul yang ingin diubah sudah benar <br>
              </p>
              <div class="input-group py-3">
                  <input type="text" class="form-control" placeholder="Your New Title">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success">Submit</button>
            </div>
          </div>
        </div>
      </div> -->

      <script>
      var data = <?php echo $regions ?>;
      regionSelect = document.getElementById("region");
      classSelect = document.getElementById("classes");
      lecturerField = document.getElementById("lecturer");
      classLecturerField = document.getElementById("class_lecturer");

      classSelect.disabled = true;

      data.forEach(function(item, index){
        var option = document.createElement("option");
        option.value = index;
        option.text = item.value;
        regionSelect.appendChild(option)
      })

      function changeRegion(){
        
        if(regionSelect.value >= 0 ){
          var classes = data[regionSelect.value].classes;

          //clear option
          classSelect.innerHTML = '';
          var option = document.createElement("option");
          option.value = -1;
          option.text = "Select Class";
          option.disabled = true;
          option.selected = true;
          classSelect.appendChild(option)
 
          classes.forEach(function(item, index){
              var option = document.createElement("option");
              option.value = index;
              option.text = item.code;
              classSelect.appendChild(option)
          })            
          classSelect.disabled = false;
        }else{
          classSelect.disabled = true;
        }
      }
      function changeClasses(){
        
        if(regionSelect.value >= 0 && classSelect.value >= 0){
          var class_lecturer = data[regionSelect.value].classes[classSelect.value].class_lecturer[0];
          lecturerField.value = class_lecturer.lecturer.name;
          classLecturerField.value = class_lecturer.id;
        }
      }
    </script>
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="{{ asset('/dist/js/bootstrap.bundle.min.js') }}"></script>     
          <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  </body>
</html>
