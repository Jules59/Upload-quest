<!DOCTYPE html>
<html>
<head>
    <title>FORMULAIRE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<form action="upload.php" enctype="multipart/form-data" method="post">

    <div>
        <label for='upload'>Add Attachments:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input id='upload' name="upload[]" type="file" multiple="multiple" />
    </div>

    <input type="submit" name="submit" value="Submit">

</form>
<?php
if (!empty($_GET['image'])) {
    if (file_exists('upload/'.$_GET['image'])) {
        $deleteResult = unlink('upload/'.$_GET['image']);
        header('Location: file.php');
    }
}
?>
<?php
    $images = scandir('upload');
    $images = array_diff($images, array('.', '..'));

?>
<div class="row">
    <?php foreach ($images as $image) : ?>
    <div class="col-md-2">
        <div class="thumbnail">
            <img src="upload/<?php echo $image ?>" class="img-thumbnail">
            <a href="?image=<?php echo $image ?>" class="btn btn-danger" role="button">Supprimer</a>
        </div>
    </div>
    <?php endforeach?>
</div>
</body>
</html>
