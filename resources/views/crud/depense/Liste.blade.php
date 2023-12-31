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
                <h2>Depense</h2>
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
                    <br>
                    <a class="btn btn-primary" href="{{ url('/formdepense') }}"
                        style="background: var(--bs-blue);border-style: none;margin-top: 5px;">Ajouter depense</a>
                    <br>
                    <form method="POST" action="{{ route('import.csv') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv">
                        <button class="btn btn-primary" type="submit">Importer</button>
                    </form>

                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Id</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Code</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Type depense</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Type date</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Montant</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nombre</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Date depense</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liste as $rows)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $rows->iddepense }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            {{ $rows->code }}
                                        </td>
                                        <td class="border-bottom-0">
                                            {{ $rows->nom }}
                                        </td>
                                        <td class="border-bottom-0">
                                            {{ $rows->typedate }}
                                        </td>
                                        <td class="border-bottom-0">
                                            {{ number_format($rows->montant, 2, ',', ' ') }}
                                        </td>
                                        <td class="border-bottom-0">
                                            {{ $rows->nombre }}
                                        </td>
                                        <td class="border-bottom-0">
                                            {{ \Carbon\Carbon::parse($rows->datedepense)->locale('fr_FR')->isoFormat('DD MMMM YYYY') }}
                                        </td>



                                        <td class="border-bottom-0">
                                            <a class="btn btn-primary"
                                                href="{{ url('/versmodifdepense') }}/{{ $rows->iddepense }}"
                                                style="background: var(--bs-blue);border-style: none;margin-top: 5px;">Modifier</a>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a class="btn btn-primary"
                                                href="{{ url('/supprimerdepense') }}/{{ $rows->iddepense }}"
                                                style="background: var(--bs-blue);border-style: none;margin-top: 5px;">Supprimer</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Error
                    {{  csrf_field() }}
                    @if(session('erreur'))
                    <div class="alert alert-dimissible fade show" role="alert">
                        {{ session('erreur') }}
                    </div>
                    @endif --}}

                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage == 1 ? '#' : url('/paginationdepense') }}/{{ $currentPage - 1 }}"
                                    aria-label="Précédent">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Précédent</span>
                                </a>
                            </li>
                            @foreach ($listeNumeroPage as $rows)
                                <li class="page-item {{ $rows == $currentPage ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ url('/paginationdepense') }}/{{ $rows }}">{{ $rows }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage == $lastPage ? '#' : url('/paginationdepense') }}/{{ $currentPage + 1 }}"
                                    aria-label="Suivant">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Suivant</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
