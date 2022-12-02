<?php
include "headeradmin.php" ;
    $th1688Repository->updateTyGia($_POST['tygia']);
    echo "<script>window.location.href='configpage.php';</script>";
?>
<?php include 'footeradmin.php' ?>
