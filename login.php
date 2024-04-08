<?php
    include_once "connect.php";
?>
<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Username" required autocomplete="username"/>
    <input type="password" name="password" placeholder="Password" required autocomplete="off"/>
    <input type="submit" value="login" />
</form>
<button onclick="loadlogin('register.php')">Register</button>
<?php
    if (isset($_SESSION["error"])) {
        echo $_SESSION["error"];
        unset($_SESSION["error"]);
    }

    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        echo "<br>";

        $sql = "SELECT Password
                FROM users
                WHERE username = (:username)";

        $query = $conn->prepare($sql);
        $query->bindParam(":username",$username);
        $query->execute();
        $result = $query->fetchALL();
        if(count($result)){
            if(password_verify($password,$result[0]["Password"])){
                $sql = "SELECT id FROM users
                    WHERE username =(:username)";
                $query = $conn->prepare($sql);
                $query->bindParam(":username",$username);
                $query->execute();
                $result = $query->fetchAll();
                $_SESSION["account"] = $result[0]["id"];
                header("Location: index.php");
            } else {
                $_SESSION["error"] = "Wrong password";
                header("Location: index.php");
            }
        } else {
            $_SESSION["error"] = "Account doesn't exist";
            header("Location: index.php");
        }
    }
?>