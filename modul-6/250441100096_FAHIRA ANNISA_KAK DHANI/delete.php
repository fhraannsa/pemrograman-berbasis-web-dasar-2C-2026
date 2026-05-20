<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_kamar = intval($_GET['id']);
    
    $query_delete = "DELETE FROM rooms WHERE id = $id_kamar"; 
    
    if (mysqli_query($conn_buka, $query_delete)) {
        echo "<script>
                alert('Kamar berhasil dihapus!'); 
                window.location.href = 'index_kamar.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Gagal menghapus kamar: " . mysqli_error($conn_buka) . "'); 
                window.location.href = 'index_kamar.php';
              </script>";
        exit;
    }
} else {
    header("Location: index_kamar.php");
    exit;
}

mysqli_close($conn_buka);
?>