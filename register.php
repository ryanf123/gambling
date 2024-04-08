<?php
$_SESSION["currentpage"] = "register.php";
include_once "connect.php";
?>
<div class="register">
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Username" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <input type="password" name="confirmPassword" placeholder="Confirm Password" required/>
        <input type="submit" value="Create Account"/><br>
    </form>
</div>
<?php
    if (isset($_SESSION["error"])) {
        echo $_SESSION["error"];
        unset($_SESSION["error"]);
    }

    if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["confirmPassword"]){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        if(trim($password) == trim($confirmPassword)) {
            try{
                $sql = "SELECT Username
                        FROM users
                        WHERE Username=(:username)";
                $query = $conn->prepare($sql);
                $query->bindParam(":username",$username);
                $query->execute();
                $result = $query->fetchAll();
                if(isset($result[0])) {
                    $_SESSION["error"] = "Account already exists";
                    header("Location: index.php");
                } else {
                    $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
                    $sql = "INSERT INTO users (Username, Password)
                            VALUES (:username, :password)";
                    $query = $conn->prepare($sql);
                    $query->bindParam(":username",$username);
                    $query->bindParam(":password",$hashedPassword);
                    $query->execute();
                    
                    $sql = "SELECT id FROM users
                            WHERE username =(:username)";
                    $query = $conn->prepare($sql);
                    $query->bindParam(":username",$username);
                    $query->execute();
                    $result = $query->fetchAll();
                    $_SESSION["account"] = $result[0]["id"];
                    header("Location: index.php");
                }
            } catch(PDOException $e) {
                echo $e;
            }
        } else {
            $_SESSION["register"] = TRUE;
            $_SESSION["error"] = "Passwords do not match";
            header("Location: index.php");
        }
        unset($_POST);
    }
?>