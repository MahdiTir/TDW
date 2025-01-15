<?php 
    if(isset($_POST['submit'])){
        $devenirMembre = new MembreController();
        $devenirMembre->renouvler();
    } else {
        $devenirMembre = new MembreController();
        $types = $devenirMembre->devenirMembre();
    }
?>

<div class="container">
    <div class="row my-4">
        <div class="col-md-6 mx-auto">
            <?php include('./views/includes/alerts.php');?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Renouvler votre Carte</h3>
                </div>
                <div class="card-body bg-light">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_type">Type de carte</label>
                        <select name="id_type" class="form-control" required>
                            <?php foreach($types as $type): ?>
                                <option value="<?php echo $type['id']; ?>">
                                    <?php echo $type['id'] . ' - ' . $type['nom'] . ' : ' . $type['prix'] . ' DA'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recu_paiment">Reçu de paiement</label>
                        <input type="file" name="recu_paiment" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary"> Renouvler </button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>