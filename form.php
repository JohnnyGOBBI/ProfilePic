<?php


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $uploadDir = 'public/upload/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $maxFileSize = 1000000;


    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png ou Gif ou Webp !';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1Mo !";
    } else {
        $uniqueName = uniqid('', true);
        $uploadFile = $uniqueName.".".$extension;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

    }
}
    ?>
    <img src="<?php  if(isset($uploadFile)) { echo $uploadFile; } ?>" alt="Ta photo" height="100" width="100">






<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">Mets ta photo Homer!!</label>
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Envoyer</button>
</form>
