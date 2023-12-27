<?php include 'inc/header.php'; ?>

<!-- Frontpage Section -->

<div class="container mt-3">
    <h1 class="page-title">Sessions</h1>
    <div id="filter1" class="row mb-4">
        <div class="col-md-6">
            <h5>1er filtre: </h5>
            <div class="form-row">
                <div class="col-md-6 mb-2">
                    <select id="filter-column" class="form-control">
                        <!--option value="" disabled selected>--</option-->
                        <option value="Numero">Numero</option>
                        <option value="Annee">Annee</option>
                        <option value="Sem">Sem</option>
                        <option value="Semab">Semab</option>
                        <option value="Debut">Debut</option>
                        <option value="Fin">Fin</option>
                        <option value="Debsem">Debsem</option>
                        <option value="Finsem">Finsem</option>
                        <option value="Annea">Annea</option>
                        <option value="Anneab">Anneab</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" id="filter-value" class="form-control" placeholder="Entrer une valeur">
                </div>
            </div>
        </div>
    </div>

    <div id="filter2" class="row mb-4">
        <div class="col-md-6">
            <h5>2eme filtre: </h5>
            <div class="form-row">
                <div class="col-md-6 mb-2">
                    <select id="filter-column2" class="form-control">
                        <!--option value="" disabled selected>--</option-->
                        <option value="Numero">Numero</option>
                        <option value="Annee">Annee</option>
                        <option value="Sem">Sem</option>
                        <option value="Semab">Semab</option>
                        <option value="Debut">Debut</option>
                        <option value="Fin">Fin</option>
                        <option value="Debsem">Debsem</option>
                        <option value="Finsem">Finsem</option>
                        <option value="Annea">Annea</option>
                        <option value="Anneab">Anneab</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" id="filter-value2" class="form-control" placeholder="Entrer une valeur">
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Annee</th>
                    <th>Sem</th>
                    <th>Semab</th>
                    <th>Debut</th>
                    <th>Fin</th>
                    <th>Debsem</th>
                    <th>Finsem</th>
                    <th>Annea</th>
                    <th>Anneab</th>
                    <th id="HeaderAction1">Voir</th>
                    <th id="HeaderAction2">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sessions as $session): ?>
                    <tr>
                        <td>
                            <?php echo $session->Numero; ?>
                        </td>
                        <td>
                            <?php echo $session->Annee; ?>
                        </td>
                        <td>
                            <?php echo $session->Sem; ?>
                        </td>
                        <td>
                            <?php echo $session->SemAb; ?>
                        </td>
                        <td>
                            <?php echo $session->Debut; ?>
                        </td>
                        <td>
                            <?php echo $session->Fin; ?>
                        </td>
                        <td>
                            <?php echo $session->Debsem; ?>
                        </td>
                        <td>
                            <?php echo $session->Finsem; ?>
                        </td>
                        <td>
                            <?php echo $session->Annea; ?>
                        </td>
                        <td>
                            <?php echo $session->Anneab; ?>
                        </td>
                        <td class="HeaderColumn" id="view<?php echo $session->Numero ?>">
                            <a class="btn btn-primary" href="vdel.php?id=<?php echo $session->Numero; ?>">voir</a>
                        </td>
                        <td class="HeaderColumn2">
                            <form style="display: inline;" method="post" action="vdel.php">
                                <input type="hidden" name="del_id" value="<?php echo $session->Numero; ?>">
                                <input type="submit" class="btn btn-danger" value="Supprimer">
                        </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <button id="print-data" class="btn btn-primary m-3">Print</button>
</div>

<!-- Add Bootstrap CSS and JavaScript -->


<script>
    const tableRows = document.querySelectorAll('.table tbody tr');
    const printButton = document.getElementById('print-data');
    const theader = document.getElementById('HeaderAction1');
    const theader2 = document.getElementById('HeaderAction2');
    const HeaderColumn = document.querySelectorAll('.HeaderColumn');

    //filter functions
    function addFilterListener(columnId, valueId) {
        const filterColumn = document.getElementById(columnId);
        const filterValue = document.getElementById(valueId);

        const filterFunction = () => {
            filterData();
        };

        filterColumn.addEventListener('change', filterFunction);
        filterValue.addEventListener('input', filterFunction);
    }

    addFilterListener('filter-column', 'filter-value');
    addFilterListener('filter-column2', 'filter-value2');

    function filterData() {
        const column1 = document.getElementById('filter-column').value;
        const value1 = document.getElementById('filter-value').value;
        const column2 = document.getElementById('filter-column2').value;
        const value2 = document.getElementById('filter-value2').value;

        const filterRegex1 = new RegExp(value1, 'i');
        const filterRegex2 = new RegExp(value2, 'i');

        tableRows.forEach(row => {
            const cell1 = row.querySelector(`td:nth-child(${getColumnIndex(column1)})`);
            const cell2 = row.querySelector(`td:nth-child(${getColumnIndex(column2)})`);

            if (cell1 && cell2) {
                if (filterRegex1.test(cell1.textContent) && filterRegex2.test(cell2.textContent)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }

    function getColumnIndex(columnName) {
        const headers = document.querySelectorAll('.table thead th');
        for (let i = 0; i < headers.length; i++) {
            if (headers[i].textContent.trim() === columnName) {
                return i + 1;
            }
        }
        return -1;
    }

    printButton.addEventListener('click', () => {
        // Print the document
        window.print();
    });
    /*
      // Hide the print button before printing
      printButton.style.display = 'none';
      theader.style.display = 'none';
      HeaderColumn.forEach(element => {
          element.style.display = 'none';
      });

      // Restore the print button after printing (optional)
      printButton.style.display = 'block';
      theader.style.display = 'block';
      HeaderColumn.forEach(element => {
          element.style.display = 'block';
      });*/
</script>


<!-- Footer Section -->
<?php include 'inc/footer.php'; ?>