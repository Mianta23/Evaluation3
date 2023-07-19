<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('assets4/Acc_Admin/css/checkbox.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/33.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo asset('assets4/Login/js/test.css'); ?>">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('template2.SideBar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('template2.Header')
                <div class="container-fluid">
                    <form action="{{ url('/ajouterdepense') }}" method="POST">
                        {{ csrf_field() }}


                        {{-- <div class="mb-3">
                <label class="col-sm-2 col-form-label">selection photo</label>
                <div class="col-sm-10" >
                <input type="file" id="selectImage" class="form-control">
                <input type="hidden" id="imageCode"  name="photo"/>
                </div> --}}

                        {{-- </div> --}}
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Type depense:</label>
                            <div class="col-sm-10">
                                <select name="idtypedepense" class="form-select" aria-label="Default select example">
                                    <option value="">Type depense </option>
                                    @foreach ($data as $data)
                                        <option value="{{ $data->idtypedepense }}">{{ $data->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Montant:</label>
                            <input type="number" name="montant" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Nbr:</label>
                            <input type="number" name="nombre" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Date depense:</label>
                            <input type="date" name="datedepense" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>





                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>



                <script>
                    const imageCode = document.getElementById("imageCode");

                    const tobase64 = (file) => {
                        return new Promise((resolve, reject) => {
                            const fileReader = new FileReader();
                            fileReader.readAsDataURL(file);

                            fileReader.onload = () => {
                                resolve(fileReader.result);
                            };

                            fileReader.onerror = (error) => {
                                reject(error);
                            };
                        });
                    };

                    const uploadImage = async (event) => {
                        const file = event.target.files[0];
                        const base64 = await tobase64(file);
                        imageCode.value = base64;
                    }

                    //appel de fonction en change
                    document.getElementById("selectImage").addEventListener("change", (e) => {
                        uploadImage(e);
                    });
                </script>


                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
                    </div>
                </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="<?php echo asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo asset('assets4/Acc_Admin/js/bs-init.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="<?php echo asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js'); ?>"></script>
        <script src="<?php echo asset('assets4/Acc_Admin/js/theme.js'); ?>"></script>
</body>

</html>


</html>
