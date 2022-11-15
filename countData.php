<?php
include 'koneksi.php';
$sql = sqlsrv_connect($conn, "SELECT count(*) FROM tblsecurity");
$result = sqlsrv_fetch_array($sql);
echo json_encode($result[0]);
?>