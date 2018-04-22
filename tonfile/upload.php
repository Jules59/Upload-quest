<?php
if(isset($_POST['submit'])) {
    if (count($_FILES['upload']['name']) > 0) {
        //Loop through each file
        for ($i = 0; $i < count($_FILES['upload']['name']); $i++) { //contient le nom d'origine du fichier

            $tmpFilePath = $_FILES['upload']['tmp_name'][$i]; //Nom temporaire du fichier  dans le dossier temporaire
            $types = ['image/png', 'image/gif', 'image/jpeg'];

            if ($_FILES['upload']['size'][$i] > 1000000) { //Contient la taille du fichier en octets
                $errors['size'] = 'La taille est superieur à 1Mo';

            } elseif (!in_array($_FILES['upload']['type'][$i], $types)) { //Contient le type MIME du fichier
                $errors['type'] = 'Le MINE est incorrect';
 
            } else {
                // on recupere l'extension
                $extension = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);

                // on concatène le nom de fichier unique avec l'extension récupérée
                $fileName = uniqid('image') . '.' . $extension;

                //là où sera enregistré l'image
                $uploadDir = 'upload/'  . $fileName;

                // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur
                $uploadResult = move_uploaded_file($_FILES['upload']['tmp_name'][$i], $uploadDir);
            }
        }
    }
}
header('Location: file.php');

