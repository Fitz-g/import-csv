<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ONCECI - FORMULAIRE DE PAIEMENT</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="" id="conteneur">
            <div class="col-lg-12">
<!-- <img src="{{asset('assets/img/logo.png')}}" id="logo" alt="Logo ONECI">-->
            </div>
            <div class="contenu col-lg-10 col-lg-offset-1">
                <form action="import.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Importer fichier</label>
                        <input accept=".csv" type="file" name="file" id="file" class="form-control">
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" style="float:right;" name="import" class="btn btn-success text-white">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th width="200px">Nombre de ligne</th>
                    <th>Fichier</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Connect to database
                include("db_connect.php");

                $sql = $db->query("SELECT * FROM files");
                $results = $sql->fetchAll();

                foreach ($results as $result):
                    ?>
                    <tr>
                        <td><?php echo $result['name'] ?></td>
                        <td><?= $result['rows_number'] ?></td>
                        <td><a href="<?= "uploads/".$result['name'] ?>"><?= $result['name'] ?></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Nom</th>
                    <th>Nombre de ligne</th>
                    <th>Fichier</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
</body>
</html>
