<?php
require 'vendor/autoload.php';
use League\Csv\Reader;
use League\Csv\Statement;

include("db_connect.php");

if(isset($_POST['import']) && isset($_FILES["file"])) {
    $target_dir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $fileName = str_replace(" ", "-", $fileName);
    $target_file = $target_dir . $fileName;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(file_exists($target_file)) {
        die('Un fichier contenant le même nom existe déjà');
    }

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $req1 = $db->prepare('INSERT INTO files (name,rows_number) VALUES (:name,:rows_number)');
        $req1->execute(array(
            'name' => $fileName,
            'rows_number' => 0
        ));
        $id = $db->lastInsertId();

        $req = $db->prepare("INSERT INTO data (id_transaction,site_id,payment_result,operator_id,payment_date,payment_hour,file_id)
                VALUES(:id_transaction,:site_id,:payment_result,:operator_id,:payment_date,:payment_hour,:file_id)");

        $csv = Reader::createFromPath($target_file)->setHeaderOffset(0);

        $csv->setDelimiter(';');

        $reader = Reader::createFromPath($target_file, 'r');
        $records = (new Statement())->process($reader);

        $nbInsert = count($records);

        foreach ($csv as $record) {
            //Do not forget to validate your data before inserting it in your database
            $req->bindValue(':id_transaction', $record['ID transaction'], PDO::PARAM_STR);
            $req->bindValue(':site_id', $record['Site ID'], PDO::PARAM_STR);
            $req->bindValue(':payment_result', $record['Resultat Paiement'], PDO::PARAM_STR);
            $req->bindValue(':operator_id', $record['Operateur Transaction ID'], PDO::PARAM_STR);
            $req->bindValue(':payment_date', $record['Date Paiement'], PDO::PARAM_STR);
            $req->bindValue(':payment_hour', $record['Heure Paiement'], PDO::PARAM_STR);
            $req->bindValue(':file_id', $id, PDO::PARAM_INT);

            $req->execute();
        }

        $req3 = $db->prepare('UPDATE files set rows_number=:rows_number WHERE id=:id');
        $req3->execute(array(
            'rows_number' => $nbInsert,
            'id' => $id
        ));

        echo "Les données ont été ajouté.";
        header("Refresh:5; url=index.php", true, 303);
    }
}

