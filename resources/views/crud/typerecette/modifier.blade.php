
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css');?>">
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/css/checkbox.css');?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/33.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo asset('assets4/Login/js/test.css') ?>">
</head>
<body id="page-top">
  <div id="wrapper">
       @include('template.SideBar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        @include('template.Header')
        <div class="container-fluid">
            <!-- General Form Elements -->
            <form action="{{ url('/modifiertyperecette') }}" method="post">
                {{ csrf_field() }}

                <input type="hidden" name="idtyperecette" value="{{ $data->idtyperecette }}">

                      <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Nom du type</label>
                          <div class="col-sm-10" >
                          <input type="text" name="nom" class="form-control">
                          </div>
                      </div>

                      <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Type de la date</label>
                          <div class="col-sm-10" >
                          <input type="text" name="typedate" class="form-control">
                          </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Budget</label>
                        <div class="col-sm-10" >
                        <input type="text" name="budget" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10" >
                        <input type="text" name="code" class="form-control">
                        </div>
                    </div>


                    <div class="row mb-3">
                       <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                  </div>


              <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
                </div>
              </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
    <script src="<?php echo asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo asset('assets4/Acc_Admin/js/bs-init.js');?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="<?php echo asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js');?>"></script>
    <script src="<?php echo asset('assets4/Acc_Admin/js/theme.js');?>"></script>
</body>
</html>


</html>




