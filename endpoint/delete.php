<?php
include ('../conn/conn.php');

if (isset($_GET['list'])) {
    $list = $_GET['list'];

    try {

        $query = "DELETE FROM tbl_register WHERE tbl_register_id = '$list'";

        $stmt = $conn->prepare(query: $query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
                <script>
                    alert('list Deleted Successfully');
                    window.location.href = 'http://localhost/profile-registration-ajax/admin.php';
                </script>
            ";
        } else {
            header("Location: http://localhost/profile-registration-ajax/admin.php");
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>