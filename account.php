<?php
include_once "connect.php";
$sql = "SELECT username, balance
FROM users
WHERE id = (:id)";

$query = $conn->prepare($sql);
$query->bindParam(":id",$_SESSION["account"]);
$query->execute();
$result = $query->fetchALL();

echo "<div class='account'>";
    echo $result[0]["username"];
    echo "<div class='balance'>". $result[0]["balance"]."</div>";
echo "</div>";
?>