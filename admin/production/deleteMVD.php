<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/mvdRepository.php");
    $mvdRepository = new MaVanDonRepository();
//    echo(print_r($arrayList, true));
//echo(print_r($arr_unserialize1, true));
//    echo(print_r($arr_unserialize1, true));

    $mvdRepository->deleteById($_GET['id']);
    $urlStr = "mvd.php";

    echo "<script>alert('Xóa thành công');
        window.location.href='$urlStr';
        </script>";
?>