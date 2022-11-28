<?php
// authors: Alex Chan and Nathaniel Gonzalez

include "ClothingSiteController.php";
include "Config.php";
class Database {
    private $mysqli;

    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->mysqli = new mysqli(Config::$db["host"], 
                Config::$db["user"], Config::$db["pass"], 
                Config::$db["database"]);
    }

    public function query($query, $bparam=null, ...$params) {
        $stmt = $this->mysqli->prepare($query);

        if ($bparam != null)
            $stmt->bind_param($bparam, ...$params);

        if (!$stmt->execute()) {
            return false;
        }

        if (($res = $stmt->get_result()) !== false) {
            return $res->fetch_all(MYSQLI_ASSOC);
        }

        return true;
    }
}

$db = new Database();
if ($_POST["productID"][0] == "t") {
    $added_item = $db->query("select * from tops where productID = ?;", "s", $_POST["productID"]);
    $insert = $db->query("insert into wishForTops (productID, userID, priority) values (?, ?, ?);", 
        "sii", $added_item[0]["productID"], $_POST["userID"], 1); 
}
else if ($_POST["productID"][0] == "b") {
    $added_item = $db->query("select * from bottoms where productID = ?;", "s", $_POST["productID"]);
    $insert = $db->query("insert into wishForBottoms (productID, userID, priority) values (?, ?, ?);", 
        "sii", $added_item[0]["productID"], $_POST["userID"], 1); 
}
else if ($_POST["productID"][0] == "a") {
    $added_item = $db->query("select * from accessories where productID = ?;", "s", $_POST["productID"]);
    $insert = $db->query("insert into wishForAccessories (productID, userID, priority) values (?, ?, ?);", 
        "sii", $added_item[0]["productID"], $_POST["userID"], 1); 
}

include("templates/home.php");

?>