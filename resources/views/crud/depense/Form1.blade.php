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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('assets4/Login/js/test.css'); ?>">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('template2.SideBar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('template2.Header')
                <div class="container-fluid">
                    <form action="{{ url('/ajouterdepense1') }}" method="POST">
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


                        {{-- <div class="mb-3">
                            <label for="" class="form-label">Date depense:</label>
                            <input type="date" name="datedepense" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div> --}}

                        <div class="col-md-12">
                            <div class="form-floating">
                            <input type="number" name="jour" class="form-control" id="floatingZip" placeholder="jour"  min="1" max="31" required />
                                <label for="floatingZip">jour</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                            <input type="number" name="annee" class="form-control" id="floatingZip" placeholder="annee"  required />
                                <label for="floatingZip">annee</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="1">Janvier
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="2">Fevrier
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="3">Mars
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  name="mois[]"id="gridCheck1" value="4">Avril
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="5">Mai
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="6">Juin
                        </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="7">Juillet
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="8">Aout
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="9">Septemmbre
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="10">Octobre
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="11">Novembre
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="mois[]" id="gridCheck1" value="12">Decembre
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Inserer</button>

                    </form>
                    {{-- Error --}}
                    {{  csrf_field() }}
                    @if(session('erreur'))
                    <div class="alert alert-dimissible fade show" role="alert">
                        {{ session('erreur') }}
                    </div>
                    @endif


                <script>
                    // Lorsque la date est changée, exécutez la fonction de séparation
                    $('input[name="datedepense"]').on('change', function() {
                        var dateValue = $(this).val();
                        separateDate(dateValue);
                    });

                    // Fonction pour séparer la date en jour, mois et année
                    function separateDate(dateStr) {
                        var date = new Date(dateStr);
                        var jour = date.getDate();
                        var mois = date.getMonth();
                        var annee = date.getFullYear();

                        // Remplir la liste déroulante pour le jour
                        var selectJour = document.getElementById("jour");
                        selectJour.innerHTML = "";
                        for (var i = 1; i <= 31; i++) {
                            var option = document.createElement("option");
                            option.text = i;
                            option.value = i;
                            selectJour.add(option);
                        }

                        // Cocher les mois correspondants
                        var moisArray = document.getElementsByName("mois");
                        for (var i = 0; i < moisArray.length; i++) {
                            moisArray[i].checked = false;
                        }
                        moisArray[mois].checked = true;

                        // Remplir l'année
                        document.getElementById("annee").value = annee;
                    }

                    // Initialiser la séparation de la date avec la valeur actuelle du champ de date
                    separateDate($('input[name="datedepense"]').val());
                </script>



                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
                    </div>
                </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i
                    class="fas fa-angle-up"></i></a>
        </div>
        <script src="<?php echo asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo asset('assets4/Acc_Admin/js/bs-init.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="<?php echo asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js'); ?>"></script>
        <script src="<?php echo asset('assets4/Acc_Admin/js/theme.js'); ?>"></script>
</body>

</html>


</html>
