<?php 
if ($_GET) {
    if ($_GET['target']) {
        $target = $_GET["target"];
        if (isset($_GET['delete'])) {
            $removeTarget = $target . '/' . $_GET['delete'];
            removeFiles($removeTarget);
            header('location : index.php');
        } 
    }
} else {
    $target = 'files';
}

function removeFiles($removeTarget)
{
    if (file_exists($removeTarget)) {
        if (is_file($removeTarget)) {
            echo "File removed : " . $removeTarget . "<br />";
            unlink($removeTarget);
        } elseif (is_dir($removeTarget)) {
            drainFolder($removeTarget);
            rmdir($removeTarget);
            echo "Remove folder : " . $removeTarget . "<br />";
        }
    }
}

function drainFolder($folderTarget)
{

    $filesToRemove = scandir($folderTarget);

    foreach ($filesToRemove as $fileToRemove) {
        if ($fileToRemove != "." && $fileToRemove != "..") {
            $target = $folderTarget . '/' . $fileToRemove;
            if (is_file($target)) {
                unlink($target);
                echo "File removed : " . $target . "<br />";
            } elseif (is_dir($target)) {
                if (count(scandir($target)) < 3) {
                    rmdir($target);
                    echo "Remove folder : " . $target . "<br />";
                } else {
                    removeFiles($target);
                }

            }
        }
    }
}

$files = scandir($target); ?>

<ul>
<?php foreach ($files as $file) {
    ?>
   <li>
       <?php if (is_dir($target . '/' . $file)) { ?>
            <a href="index.php?target=<?= $target . '/' . $file ?>">
                <?= $file; ?>
            </a>
       <?php } elseif (is_file($target . '/' . $file)) { ?>
        <a href="fileEdit.php?target=<?= $target . '/' . $file ?>&type=text">
                <?= $file; ?>
            </a>
    <?php } ?>
    <?php if ($file != '.' && $file != '..') { ?>
    <a href="index.php?target=<?= $target ?>&delete=<?= $file ?>">X</a>
    <?php 
} ?>
    </li>
<?php 
} ?>
</ul>