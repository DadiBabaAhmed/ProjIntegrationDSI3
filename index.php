<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #007bff;
        }

        .card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Scolarité</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
    </nav>

    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Welcome, Admin</h5>
                <input type="text" id="searchInput" onkeyup="filterItems()" placeholder="Search for items..."
                    class="form-control mt-3">
                <div class="list-group">
                    <a href="Views/Classe/list_classes.php" class="list-group-item list-group-item-action">Classe</a>
                    <a href="Views/DepartementView/list_departements.php"
                        class="list-group-item list-group-item-action">Departement</a>
                    <a href="Views/DossierEtudPieceView/affichage.php"
                        class="list-group-item list-group-item-action">Dossier Etud Piece</a>
                    <a href="Views/EtudiantView/list_etudiants.php"
                        class="list-group-item list-group-item-action">Etudiant</a>
                    <a href="Views/SessionView/list_sessions.php"
                        class="list-group-item list-group-item-action">Session</a>
                    <a href="Views/GouvernoratView/list_gouvernorats.php"
                        class="list-group-item list-group-item-action">Gouvernorats</a>
                    <a href="Views/OptionView/mainpage.php" class="list-group-item list-group-item-action">Option</a>
                    <a href="Views/OptionNivView/mainpage.php" class="list-group-item list-group-item-action">OptionNiveau  </a>
                    <a href="Views/GradesView/list_grades.php"
                        class="list-group-item list-group-item-action">Grades</a>
                    <a href="Views/InscriptionView/afficher.php"
                        class="list-group-item list-group-item-action">Inscription</a>
                    <a href="Views/JourView/list_jours.php" class="list-group-item list-group-item-action">Jours</a>
                    <a href="Views/MatiereView/list_matieres.php"
                        class="list-group-item list-group-item-action">Matieres</a>
                    <a href="Views/ProfsituationView/list_profsituations.php"
                        class="list-group-item list-group-item-action">Profsituations</a>
                    <a href="Views/ProfView/list_profs.php" class="list-group-item list-group-item-action">Profs</a>
                    <a href="Views/RepartitionView/list_repartitions.php"
                        class="list-group-item list-group-item-action">Repartitions</a>
                    <a href="Views/SalleView/"
                        class="list-group-item list-group-item-action">Salles</a>
                    <a href="Views/SeanceView/list_seances.php"
                        class="list-group-item list-group-item-action">Seances</a>
                    <a href="Views/SemaineView/list_semaines.php"
                        class="list-group-item list-group-item-action">Semaines</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function filterItems() {
            // Declare variables
            var input, filter, list, items, a, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            list = document.querySelector('.list-group');
            items = list.querySelectorAll('.list-group-item');

            // Loop through all list items and hide those that don't match the search query
            for (i = 0; i < items.length; i++) {
                a = items[i];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    items[i].style.display = '';
                } else {
                    items[i].style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>
