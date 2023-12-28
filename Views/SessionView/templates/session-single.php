<?php include_once 'inc/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card m-2">
                <div class="card-header text-center">
                    <h5 class="card-title">Session Information</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Numero:</strong> <?php echo $session->Numero; ?></li>
                        <li class="list-group-item"><strong>Annee:</strong> <?php echo $session->Annee; ?></li>
                        <li class="list-group-item"><strong>Sem:</strong> <?php echo $session->Sem; ?></li>
                        <li class="list-group-item"><strong>Semab:</strong> <?php echo $session->SemAb; ?></li>
                        <li class="list-group-item"><strong>Debut:</strong> <?php echo $session->Debut; ?></li>
                        <li class="list-group-item"><strong>Fin:</strong> <?php echo $session->Fin; ?></li>
                        <li class="list-group-item"><strong>Debsem:</strong> <?php echo $session->Debsem; ?></li>
                        <li class="list-group-item"><strong>Finsem:</strong> <?php echo $session->Finsem; ?></li>
                        <li class="list-group-item"><strong>Annea:</strong> <?php echo $session->Annea; ?></li>
                        <li class="list-group-item"><strong>Anneab:</strong> <?php echo $session->Anneab; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body text-center">
                    <a href="list_sessions.php" class="btn btn-primary mr-2">Retourner</a>
                    <a href="edit.php?id=<?php echo $session->Numero; ?>" class="btn btn-secondary mr-2">Modifier</a>
                    <form style="display: inline;" method="post" action="vdel.php">
                        <input type="hidden" name="del_id" value="<?php echo $session->Numero; ?>">
                        <input type="submit" class="btn btn-danger" value="Supprimer">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>