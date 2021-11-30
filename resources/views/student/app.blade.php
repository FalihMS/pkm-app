
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
          <div class="card px-3 card-pkm border-success">
            <div class="card-body ">
              <h3 class="h3 text-success pb-3">PKM Info</h3>
              <div class="d-flex flex-row bd-highlight mx-1 flex-column">
                <div class="bd-highlight pb-md-0 pb-3 font-italic font-weight-bold">{{ ucwords($pkm_file->title) }}</div>
                <div class="bd-highlight pb-md-0 pb-3">{{ $class_lecturer->lecturer()->first()->name }}</div>
                <div class="bd-highlight pb-md-0 pb-3">{{ ucwords($leader->name) }} </div>
                <div class="bd-highlight pb-md-0 pb-3">{{ $class_lecturer->classes()->first()->code }}</div>
                <div class="bd-highlight mt-3">
                  <!-- <a href="#" class="mr-3" data-toggle="modal" data-target="#exampleModal3"><u>View More</u></a> -->
                  <a href="#" class="mr-3" data-toggle="modal" data-target="#exampleModal2"><u>Change Title</u></a>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
      @foreach($collection_sessions as $deadline)
      <div class="row">
        <div class="col-md p-3">
          <div class="card px-3 card-pkm border-secondary">
            <div class="card-body ">
              <h3 class="h3 text-secondary pb-3">Collection Session</h3>
              <div class="d-flex flex-row bd-highlight mx-1 flex-column">
                <div class="bd-highlight pb-md-0 pb-3 font-italic">{{ $deadline->title }}</div>
                <!-- <div class="bd-highlight"></div> -->
                <div class="bd-highlight">{{ $deadline->deadline }}</div>
                <div class="bd-highlight mt-3">
                  <a href="#" class="mr-3" data-toggle="modal" data-target="#exampleModal"><u>Upload File</u></a>
                  <a href="#" class="mr-3"><u>Download File</u></a>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>  
    

    
    <!-- Modal Upload-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <form action="/student/upload" method="post" enctype="multipart/form-data" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="leader" value="{{ $leader }}">
          <input type="hidden" name="title" value="{{ $pkm_file }}">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload File PKM</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-3 p-md-4">
            <p class="text-danger mb-3">
              Catatan Penting..! <br>
              1. Pastikan kembali file sebelum di upload <br>
              2. PKM yang diupload adalah file PKM <span class="font-weight-bold">Final</span> <br>
              3. Extension file merupakan <span class="font-weight-bold">.doc</span> atau <span class="font-weight-bold">.docx</span><br>
              4. Maksimal ukuran file adalah <span class="font-weight-bold">5 MB</span><br>
              5. Mahasiswa hanya dapat mengupload <span class="font-weight-bold">5 Kali</span><br>
            </p>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="file" id="inputGroupFile02">
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>

      <!-- Modal Change Title-->
      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('/student/rename') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change PKM Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body p-3 p-md-4">
                <p class="text-info mb-3">
                  Mohon Pastikan kembali judul yang ingin diubah sudah benar <br>
                </p>
                <div class="input-group py-3">
                    <input type="text" class="form-control" name="title" placeholder="Your New Title">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <!-- Modal Upload-->
      <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
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
      </div>

          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="{{ asset('/dist/js/bootstrap.bundle.min.js') }}"></script>     
          <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
          <script src="dashboard.js"></script>
  </body>
</html>
