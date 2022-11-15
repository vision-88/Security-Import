<?php
include "koneksi.php";
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
    echo "Koneksi Gagal</br>";
    die( print_r( sqlsrv_errors(), true));
}

$id = $_POST['id'];
$site = $_POST['site'];
$tgl = $_POST['tgl'];
$event_type = $_POST['event_type'];
$event_details = $_POST['event_details'];
$check_point = $_POST['check_point'];
$tour_id = $_POST['tour_id'];
$guard_name = $_POST['guard_name'];
$img = $_POST['img'];
$audio = $_POST['audio'];
$video = $_POST['video'];




$tsql = "Update tblsecurity set site ='$site',
tgl = '$tgl', event_type = '$event_type', event_details = '$event_details',
check_point = '$check_point', tour_id = '$tour_id', guard_name = '$guard_name',
img = '$img', audio = '$audio', video = '$video' where id = '$id'";
$stmt = sqlsrv_query( $conn, $tsql);
echo "<script type='text/javascript'>alert('Data Berhasil Di Ubah');window.location.href ='index.php';</script>";
if( $stmt === false ) {

    echo "Error in executing query.</br>";
    die( print_r( sqlsrv_errors(), true));
}


header('location:index.php');
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);

?>

