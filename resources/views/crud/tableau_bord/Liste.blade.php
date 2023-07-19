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
        @include('template.SideBar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('template.Header')
                <div class="container-fluid">
                    <br>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('suppression'))
                        <div class="alert alert-success">
                            {{ session('suppression') }}
                        </div>
                    @endif
                    @if (session('modification'))
                        <div class="alert alert-info">
                            {{ session('modification') }}
                        </div>
                    @endif
                    <section class="section">
                        <div class="row">
                              <div class="col-lg-6">
                                      <div class="card-body">
                                          <div class="card" style="width: 140vh;">
                                          <form action="{{ url('/filtre') }}" method="post">
                                                  {{ csrf_field() }}
                                          <div class="row mb-12">
                                          <div class="row mb-4">
                                              <select  name="mois" class="form-select" aria-label="Default select example">
                                              <option value="">Mois </option>
                                              <option value="1" >Janvier</option>
                                              <option value="2" >Fevrier</option>
                                              <option value="3" >Mars</option>
                                              <option value="4" >avril</option>
                                              <option value="5" >Mai</option>
                                              <option value="6" >Juin</option>
                                              <option value="7" >Juillet</option>
                                              <option value="8" >Aout</option>
                                              <option value="9" >Septembre</option>
                                              <option value="10" >Octobre</option>
                                              <option value="11" >Novembre</option>
                                              <option value="12" >Decembre</option>

                                            </select>

                                          </div>
                                          <div class="row mb-4">
                                              <select  name="annee" class="form-select" aria-label="Default select example">
                                              <option value="">annee </option>
                                              <?php for($i=2000;$i<2050;$i++){?>

                                                  <option value="{{$i}}" >{{$i}}</option>
                                                  <?php }?>

                                            </select>


                                          </div>
                                          <div class="row mb-4">
                                          <button type="submit" class="btn btn-primary">Afficher</button>

                                          </div>
                                          </div>
                                          </form>

                                                  <?php if(isset($liste)) {?>
                                                    <h3>Tableau recette</h3>
                                                  <table class="table">
                                                      <thead>
                                                          <tr>

                                                              <th scope="col">nom</th>
                                                              <th scope="col">Reel</th>
                                                              <th scope="col">Budget</th>
                                                              <th scope="col">Realisation</th>





                                                          </tr>
                                                      </thead>
                                                      <?php
                                                          $totalrecette=0;
                                                          $totalbudgetrecette=0;
                                                      ?>
                                                      <tbody>
                                                          @foreach($liste as $liste)
                                                          <?php
                                                          $totalrecette=$totalrecette+$liste->reel;
                                                          $totalbudgetrecette=$totalbudgetrecette+$liste->budget;
                                                          ?>
                                                          <tr >
                                                              <td>{{ $liste->nom}}</td>
                                                              <td>{{ number_format($liste->reel, 2, ',',' ')}}</td>
                                                              <td>{{ number_format($liste->budget, 2, ',',' ')}}</td>
                                                              <td>{{ $liste->realisation}}</td>
                                                          </tr>
                                                          @endforeach
                                                          <tr  class="table-primary ">
                                                              <td></td>
                                                              <td>{{ number_format($totalrecette, 2, ',',' ')}}</td>
                                                              <td>{{number_format($totalbudgetrecette, 2, ',', ' ') }}</td>
                                                              <td>{{ round($totalrecette*100/$totalbudgetrecette,0)}}</td>
                                                          </tr>
                                                   </tbody>
                                                   </table>
                                                   <?php }?>
                                                   <?php if(isset($listedepense)) {?>
                                                    <h3>Tableau depense</h3>
                                                  <table class="table">
                                                      <thead>
                                                          <tr>

                                                              <th scope="col">nom</th>
                                                              <th scope="col">Reel</th>
                                                              <th scope="col">Budget</th>
                                                              <th scope="col">Realisation</th>





                                                          </tr>
                                                      </thead>
                                                      <?php
                                                          $totaldepense=0;
                                                          $totalbudgetdepense=0;
                                                      ?>
                                                      <tbody>
                                                          @foreach($listedepense as $liste)
                                                      <?php
                                                          $totaldepense=$totaldepense+$liste->reel;
                                                          $totalbudgetdepense=$totalbudgetdepense+$liste->budget;
                                                      ?>
                                                          <tr>
                                                              <td>{{ $liste->nom}}</td>
                                                              <td>{{ number_format($liste->reel, 2, ',',' ')}}</td>
                                                              <td>{{ number_format($liste->budget, 2, ',',' ')}}</td>
                                                              <td>{{ $liste->realisation}}</td>
                                                          </tr>
                                                          @endforeach
                                                          <tr  class="table-primary ">
                                                              <td></td>
                                                              <td>{{ number_format($totaldepense, 2, ',',' ')}}</td>
                                                              <td>{{ number_format($totalbudgetdepense, 2, ',',' ')}}</td>
                                                              <td>{{ round($totaldepense*100/$totalbudgetdepense,0)}}</td>
                                                          </tr>
                                                   </tbody>
                                                  </table>
                                                  <?php }?>
                                                  <?php if(isset($listebenefice)) {?>
                                                    <h3>Tableau benefice</h3>
                                                  <table class="table">
                                                      <thead>
                                                          <tr>

                                                              <th scope="col"></th>
                                                              <th scope="col">Reel</th>
                                                              <th scope="col">Budget</th>
                                                              <th scope="col">Realisation</th>
                                                          </tr>
                                                      </thead>

                                                      <tbody>

                                                          <tr  >
                                                              <td>Recette</td>
                                                              <td>{{ number_format($listebenefice->recette, 2, ',',' ')}}</td>
                                                              <td>{{ number_format($listebenefice->budget_recette, 2, ',',' ')}}</td>
                                                              <td>{{ $listebenefice->realisation_recette}}</td>
                                                          </tr>
                                                          <tr>
                                                              <td>Depense</td>
                                                              <td>{{ number_format($listebenefice->depense, 2, ',',' ')}}</td>
                                                              <td>{{ number_format($listebenefice->budget_depense, 2, ',',' ')}}</td>
                                                              <td>{{ $listebenefice->realisation_depense}}</td>
                                                          </tr>
                                                          <tr  class="table-primary ">
                                                              <td></td>
                                                              <td>{{ number_format($listebenefice->recette - $listebenefice->depense, 2, ',',' ')}}</td>
                                                              <td>{{ number_format($listebenefice->budget_recette - $listebenefice->budget_depense, 2, ',',' ')}}</td>
                                                              <td>{{ round(($listebenefice->recette - $listebenefice->depense)*100/($listebenefice->budget_recette - $listebenefice->budget_depense),0)}}</td>
                                                          </tr>
                                                   </tbody>
                                                  </table>
                                                  <?php }?>

                                              </div>

                                      </div>
                              </div>


                          </div>


                      </section>





                </div>
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
