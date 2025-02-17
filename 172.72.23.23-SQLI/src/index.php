<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "123456";
$db_name = "ctf";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

if (!isset($_GET['id'])) {
    echo "SQLServer is Running, Please provide the parameters.(eg.id)";
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = $id";

try {
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        echo "查询错误: " . mysqli_error($conn);
    }
} catch (Exception $e) {
    echo "发生错误: " . $e->getMessage();
}

mysqli_close($conn);
?>