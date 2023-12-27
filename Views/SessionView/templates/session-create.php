<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Session</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php include_once 'inc/header.php'; ?>

<style>
    .error-message {
        display: none;
        color: red;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="p-4">
                <h2 class="page-header text-center">Créer une session</h2>
                <form action="create.php" method="post" onsubmit="{return validateForm()}">
                    <div class="form-group">
                        <label for="Annee">Année</label>
                        <input type="number" min="1992" class="form-control" id="Annee" name="Annee">
                        <span class="error-message" id="AnneeError"></span>
                    </div>
                    <div class="form-group">
                        <label for="Sem">Semestre</label>
                        <select class="form-control" id="Sem" name="Sem">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                        <span class="error-message" id="SemError"></span>
                    </div>
                    <div class="form-group" style="display : none;">
                        <label for="SemAb">SemestreAb</label>
                        <select class="form-control" id="SemAb" name="SemAb" hidden>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                        <span class="error-message" id="SemAbError"></span>
                    </div>
                    <div class="form-group">
                        <label for="Debut">Debut</label>
                        <input type="date" class="form-control" id="Debut" name="Debut">
                        <span class="error-message" id="DebutError"></span>
                    </div>
                    <div class="form-group">
                        <label for="Fin">Fin</label>
                        <input type="date" class="form-control" id="Fin" name="Fin">
                        <span class="error-message" id="FinError"></span>
                    </div>
                    <div class="form-group" id="debsemdiv">
                        <label for="Debsem">Debut semestre</label>
                        <input type="date" class="form-control" id="Debsem" name="Debsem">
                        <span class="error-message" id="DebsemError"></span>
                    </div>
                    <div class="form-group" id="finsemdiv">
                        <label for="Finsem">Fin semestre</label>
                        <input type="date" class="form-control" id="Finsem" name="Finsem">
                        <span class="error-message" id="FinsemError"></span>
                    </div>
                    <div class="form-group">
                        <label for="Annea">Anneea</label>
                        <input type="number" min="1992" class="form-control" id="Annea" name="Annea">
                        <span class="error-message" id="AnneaError"></span>
                    </div>
                    <div class="form-group">
                        <label for="Anneab">Anneeab</label>
                        <input type="number" min="1992" class="form-control" id="Anneab" name="Anneab">
                        <span class="error-message" id="AnneabError"></span>
                    </div>
                    <input type="submit" class="btn btn-primary m-2" value="Créer" name="submit">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to update fields based on selected values
    function updateFields() {
        var Annee = getInputValue('Annee');
        var Sem = getInputValue('Sem');

        // Check if Annee is empty and disable Sem
        if (!Annee) {
            document.getElementById('Sem').hidden = true;
            return;
        } else {
            document.getElementById('Sem').hidden = false;
        }

        // Case: Sem = 1
        if (Sem === '1') {
            var isSem1 = true;
            document.getElementById('SemAb').value = '2';
            document.getElementById('debsemdiv').style.display = 'none';
            document.getElementById('finsemdiv').style.display = 'block';

            // Update date fields
            document.getElementById('Debut').min = `${Annee}-01-01`;
            document.getElementById('Debut').max = `${Annee}-12-31`;
            document.getElementById('Debut').value = formatDate(parseInt(Annee));

            document.getElementById('Fin').min = `${parseInt(Annee) + 1}-01-01`;
            document.getElementById('Fin').max = `${parseInt(Annee) + 1}-12-31`;
            document.getElementById('Fin').value = formatDate(parseInt(Annee) + 1);

            document.getElementById('Debsem').min = `${Annee}-01-01`;
            document.getElementById('Debsem').max = `${Annee}-12-31`;
            document.getElementById('Debsem').value = formatDate(parseInt(Annee));

            var debsem = document.getElementById('Debsem').value;
            var fin = document.getElementById('Fin').value;
            document.getElementById('Finsem').min = debsem;
            document.getElementById('Finsem').max = fin;
        }
        // Case: Sem = 2
        else if (Sem === '2') {
            var isSem1 = false;
            document.getElementById('SemAb').value = '1';
            document.getElementById('debsemdiv').style.display = 'block';
            document.getElementById('finsemdiv').style.display = 'none';

            // Update date fields
            document.getElementById('Debut').min = `${parseInt(Annee) - 1}-01-01`;
            document.getElementById('Debut').max = `${parseInt(Annee) - 1}-12-31`;
            document.getElementById('Debut').value = formatDate(parseInt(Annee) - 1);

            document.getElementById('Fin').min = `${Annee}-01-01`;
            document.getElementById('Fin').max = `${Annee}-12-31`;
            document.getElementById('Fin').value = formatDate(parseInt(Annee));

            var debut = document.getElementById('Debut').value;
            var fin = document.getElementById('Fin').value;

            // Format the dates to "YYYY-MM-DD"
            //var formattedDebut = new Date(debut).toISOString().split('T')[0];
            //var formattedFin = new Date(fin).toISOString().split('T')[0];
            var debut_date = new Date(debut);
            monthmin = debut_date.getMonth() + 1;
            var fin_date = new Date(fin);
            monthmax = fin_date.getMonth() + 1;
            console.log(monthmin);
            console.log(monthmax);
            document.getElementById('Debsem').min = `${Annee}-01-01`;
            document.getElementById('Debsem').max = `${Annee}-03-31`;
            //document.getElementById('Debsem').setAttribute('max', formattedFin);
            /*document.getElementById('Debsem').min = formattedDebut;
            document.getElementById('Debsem').max = formattedFin;
            */
            //document.getElementById('Debsem').value = formatDate(parseInt(Annee) - 1);

            document.getElementById('Finsem').min = `${Annee}-01-01`;
            document.getElementById('Finsem').max = `${Annee}-12-31`;
            document.getElementById('Finsem').value = formatDate(parseInt(Annee));
        }

        // Update Annea and Anneab values
        var AnneeValue = isSem1 ? Annee : parseInt(Annee) - 1;
        var AnneabValue = isSem1 ? parseInt(Annee) + 1 : parseInt(Annee);

        document.getElementById('Annea').value = AnneeValue;
        document.getElementById('Annea').min = AnneeValue;
        document.getElementById('Annea').max = AnneeValue;
        document.getElementById('Anneab').value = AnneabValue;
        document.getElementById('Anneab').min = AnneabValue;
        document.getElementById('Anneab').max = AnneabValue;
    }

    // Function to update Debsem value for Sem = 1
    function updateSemDates1() {
        var Sem = getInputValue('Sem');
        if (Sem === '1') {
            document.getElementById('Debsem').value = this.value;
        }
    }

    // Function to update Finsem value for Sem = 2
    function updateSemDates2() {
        var Sem = getInputValue('Sem');
        if (Sem === '2') {
            document.getElementById('Finsem').value = this.value;
        }
    }

    //get the month from the date
    function getMonth(date) {
        var month = date.getMonth() + 1;
        return month;
    }

    // Function to format a given year
    function formatDate(year) {
        return new Date(year, 1, 1).toISOString().split('T')[0];
    }

      // Function to format a given year and month
      function formatYearMonth(year, month) {
        return new Date(year, month - 1, 1).toISOString().split('T')[0];
    }
    // Function to get input value by ID
    function getInputValue(id) {
        return document.getElementById(id).value;
    }

    // Form validation function
    function validateForm() {
        clearErrors();
        var inputIds = ['Annee', 'Sem', 'SemAb', 'Debut', 'Fin', 'Debsem', 'Finsem', 'Annea', 'Anneab'];

        for (var i = 0; i < inputIds.length; i++) {
            var inputId = inputIds[i];
            var inputValue = getInputValue(inputId);
            if (!inputValue) {
                document.getElementById(inputId + 'Error').textContent = 'Champ obligatoire.';
                document.getElementById(inputId + 'Error').style.display = 'block';
            }
        }

        return !inputIds.some(function (id) {
            return getInputValue(id) === '';
        });
    }

    // Function to clear error messages
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(function (element) {
            element.textContent = '';
            element.style.display = 'none';
        });
    }

    // Event listeners for input changes
    document.getElementById('Sem').addEventListener('change', updateFields);
    document.getElementById('Annee').addEventListener('change', updateFields);
    document.getElementById('Debut').addEventListener('change', updateSemDates1);
    document.getElementById('Fin').addEventListener('change', updateSemDates2);

    // Validation for Debsem < Finsem < Fin
    document.getElementById('Finsem').addEventListener('change', function () {
        clearErrors();
        var debsem = document.getElementById('Debsem').value;
        var fin = document.getElementById('Fin').value;
        var Finsem = this.value;
        if (debsem >= Finsem && Finsem < fin) {
            document.getElementById('FinsemError').textContent = 'condition : Debsem < Finsem < fin.';
            document.getElementById('FinsemError').style.display = 'block';
        } else {
            document.getElementById('FinsemError').textContent = '';
            document.getElementById('FinsemError').style.display = 'none';
        }
    });

    // Validation for debut < Debsem < Fin
    document.getElementById('Debsem').addEventListener('change', function () {
        clearErrors();
        var fin = document.getElementById('Fin').value;
        var debut = document.getElementById('Debut').value;
        var debsem = this.value;
        if (debut < debsem && debsem < fin) {
            document.getElementById('FinsemError').textContent = 'condition : debut < Debsem < Fin.';
            document.getElementById('FinsemError').style.display = 'block';
        } else {
            document.getElementById('FinsemError').textContent = '';
            document.getElementById('FinsemError').style.display = 'none';
        }
    });
</script>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
<?php include_once 'inc/footer.php'; ?>