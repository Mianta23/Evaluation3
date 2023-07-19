<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: var(--bs-blue);">
    <style>
      .submenu {
        display: none;
      }
    </style>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Récupérer l'élément à cliquer
        var afficherCrud = document.getElementById('afficherCrud');

        // Récupérer les sous-menus
        var submenus = document.getElementsByClassName('submenu');

        // Ajouter un gestionnaire d'événement au clic de l'élément
        afficherCrud.addEventListener('click', function() {
          // Parcourir les sous-menus et basculer leur visibilité
          for (var i = 0; i < submenus.length; i++) {
            if (submenus[i].style.display === 'none') {
              submenus[i].style.display = 'block';
            } else {
              submenus[i].style.display = 'none';
            }
          }
        });
      });
    </script>
    <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
      <div class="sidebar-brand-text mx-3"><span>HJRA Utilisateur</span></div>
      </a>
      <hr class="sidebar-divider my-0">
      <ul class="navbar-nav text-light" id="accordionSidebar">
    {{-- <li  id="afficherCrud" class="nav-item"><a class="nav-link"><i class="fas fa-align-justify"></i><span>Gestion patient&nbsp;</span></a></li> --}}
    <li class="nav-item"><a class="nav-link" href="{{ url('/listeDepense') }}"><i class="fas fa-book-reader"></i><span>Saisi depense&nbsp;</span></a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/listeFacturerecette') }}"><i class="fas fa-book-reader"></i><span>Ajout patient_facture&nbsp;</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ url('/listeRecette') }}"><i class="fas fa-book-reader"></i><span>Saisi acte patient&nbsp;</span></a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/listeTypedepense') }}"><i class="fas fa-chalkboard-teacher"></i><span>Gestion Typedepense&nbsp;</span></a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/listePcRecu') }}"><i class="fas fa-chart-line"></i><span>Reception des laptops&nbsp;</span></a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/listeRenvoiAdmin') }}"><i class="fas fa-chart-line"></i><span>Renvoie des Laptops&nbsp;</span></a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/stockmagasin') }}"><i class="fas fa-home"></i><span>Verification du stock&nbsp;</span></a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/benefice') }}"><i class="fas fa-comment-dollar"></i><span>Statistiques du benefice par mois&nbsp;</span></a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/statistiqueVenteGlobal') }}"><i class="fas fa-poll"></i><span>Statistiques des ventes globals&nbsp;</span></a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/statistiqueVenteNonGlobal') }}"><i class="fas fa-poll"></i><span>Statistiques des ventes par Point Vente&nbsp;</span></a></li> --}}

      </div>
  </nav>
