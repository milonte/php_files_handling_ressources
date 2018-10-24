<?php include('inc/head.php'); ?>

<?php 
if (isset($_GET['type']) && ($_GET['type'] === 'text') && isset($_GET['target'])) {
    $file = fread(fopen($_GET['target'], 'r+'), filesize($_GET['target']));
}
if ($_POST) {
    fwrite(fopen($_GET['target'], 'r+'), $_POST['file_content']);
    header('Location: index.php');
}
?>

<form action="fileEdit.php?target=<?= $_GET['target'] ?>" method="post">
    <div class="form-group">
        <textarea name="file_content" id="fileContent" class="form-control" rows="20">
            <?= $file ?>
        </textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>

<?php include('inc/foot.php'); ?>