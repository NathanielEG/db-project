<?php
// authors: Alex Chan, Nathaniel Gonzalez, & Cory Ooten

class ClothingSiteController {

    
    private $command;
    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }

    public function run() {
        switch($this->command) {
            case "homepage":
                $this->homePage();
                break;
            case "mens":
                $this->mensPage();
                break;
            case "womens":
                $this->womensPage();
                break;
            case "kids":
                $this->kidsPage();
                break;
            case "wishlist":
                $this->wishlistPage();
                break;
            case "get_wishlist":
                $this->getWishlist();
                break;
            case "remove_item":
                $this->removeItem();
                break;
            case "update_priority":
                $this->updateRating();
                break;
            case "logout":
                $this->destroySession();
                break;
            case "login":
                $this->login();
                break;
        }
    }

    
    // Destroy current session
    private function destroySession() {
        session_unset();
        session_destroy();

        header("Location: ?command=login");
    }

    // Email Validation Function
    private function validateEmail($email, $regex = "") {
        // echo func_num_args();
        if(preg_match('/^[A-Za-z0-9_\-\+]+[\.A-Za-z0-9_\-\+]*[A-Za-z0-9_\-\+]+[@][A-Za-z0-9\.\-]*(\.[A-Za-z]+)$/', $email)) {
            if($regex != "") {
                if(preg_match($regex, $email)) {
                    return true;
                }
                else {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
    
    // Display the login page (and handle login logic)
    private function login() {
        if (isset($_POST["email"])) {
            if ($this->validateEmail($_POST["email"])) {
                $data = $this->db->query("select * from users where email = ?;", "s", $_POST["email"]);
                if ($data === false) {
                    $error_msg = "Error checking for user";
                } else if (!empty($data)) {
                    if (password_verify($_POST["password"], $data[0]["password"])) {
                        $_SESSION["name"] = $_POST["name"];
                        $_SESSION["email"] = $_POST["email"];
                        $user_id = $this->db->query("select userID from users where email = ?;", "s", $_POST["email"]);
                        $_SESSION["user id"] = $user_id[0]["userID"];
                        header("Location: ?command=homepage");
                    } else {
                        $error_msg = "Wrong password";
                    }
                } else { // empty, no user found
                    $insert = $this->db->query("insert into users (name, email, password) values (?, ?, ?);", 
                    "sss", $_POST["name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));
                    if ($insert === false) {
                        $error_msg = "Error inserting user";
                    } else {
                        $_SESSION["name"] = $_POST["name"];
                        $_SESSION["email"] = $_POST["email"];
                        $user_id = $this->db->query("select userID from users where email = ?;", "s", $_POST["email"]);
                        $_SESSION["user id"] = $user_id[0]["userID"];
                        header("Location: ?command=homepage");
                    }
                }
            }
            else {
                $error_msg = "Error, please enter a valid email address";
            }
        }
        include("templates/login.php");
    }

    // Display homepage (index.html)
    private function homePage() {
        // get list of tops, bottoms, and accessories
        $tops = $this->db->query("select * from tops;");
        $bottoms = $this->db->query("select * from bottoms;");
        $accessories = $this->db->query("select * from accessories;");

        // get list of items that current user has added to wishlist
        $added_tops = $this->db->query("select productID from wishForTops where userID = ?;", "i", $_SESSION["user id"]);
        $added_bottoms = $this->db->query("select productID from wishForBottoms where userID = ?;", "i", $_SESSION["user id"]);
        $added_accessories = $this->db->query("select productID from wishForAccessories where userID = ?;", "i", $_SESSION["user id"]);
        $added = array();
        foreach ($added_tops as $top) {
            array_push($added, $top["productID"]);
        }
        foreach ($added_bottoms as $bottom) {
            array_push($added, $bottom["productID"]);
        }
        foreach ($added_accessories as $accessory) {
            array_push($added, $accessory["productID"]);
        }

        include("templates/home.php");
    }

    // Display men's clothing page (mens.php)
    private function mensPage() {
        // get list of tops, bottoms, and accessories
        $tops = $this->db->query("select * from tops WHERE gender = 'M'");
        $bottoms = $this->db->query("select * from bottoms WHERE gender = 'M'");
        $accessories = $this->db->query("select * from accessories WHERE gender = 'M'");

        // get list of items that current user has added to wishlist
        $added_tops = $this->db->query("select productID from wishForTops where userID = ?;", "i", $_SESSION["user id"]);
        $added_bottoms = $this->db->query("select productID from wishForBottoms where userID = ?;", "i", $_SESSION["user id"]);
        $added_accessories = $this->db->query("select productID from wishForAccessories where userID = ?;", "i", $_SESSION["user id"]);
        $added = array();
        foreach ($added_tops as $top) {
            array_push($added, $top["productID"]);
        }
        foreach ($added_bottoms as $bottom) {
            array_push($added, $bottom["productID"]);
        }
        foreach ($added_accessories as $accessory) {
            array_push($added, $accessory["productID"]);
        }

        include("templates/mens.php");
    }

    // Display women's clothing page (womens.php)
    private function womensPage() {
        // get list of tops, bottoms, and accessories
        $tops = $this->db->query("select * from tops WHERE gender = 'F'");
        $bottoms = $this->db->query("select * from bottoms WHERE gender = 'F'");
        $accessories = $this->db->query("select * from accessories WHERE gender = 'F'");

        // get list of items that current user has added to wishlist
        $added_tops = $this->db->query("select productID from wishForTops where userID = ?;", "i", $_SESSION["user id"]);
        $added_bottoms = $this->db->query("select productID from wishForBottoms where userID = ?;", "i", $_SESSION["user id"]);
        $added_accessories = $this->db->query("select productID from wishForAccessories where userID = ?;", "i", $_SESSION["user id"]);
        $added = array();
        foreach ($added_tops as $top) {
            array_push($added, $top["productID"]);
        }
        foreach ($added_bottoms as $bottom) {
            array_push($added, $bottom["productID"]);
        }
        foreach ($added_accessories as $accessory) {
            array_push($added, $accessory["productID"]);
        }

        include("templates/womens.php");
    }

    // Display men's clothing page (mens.php)
    private function kidsPage() {
        // get list of tops, bottoms, and accessories
        $tops = $this->db->query("select * from tops WHERE gender = 'K'");
        $bottoms = $this->db->query("select * from bottoms WHERE gender = 'K'");
        $accessories = $this->db->query("select * from accessories WHERE gender = 'K'");

        // get list of items that current user has added to wishlist
        $added_tops = $this->db->query("select productID from wishForTops where userID = ?;", "i", $_SESSION["user id"]);
        $added_bottoms = $this->db->query("select productID from wishForBottoms where userID = ?;", "i", $_SESSION["user id"]);
        $added_accessories = $this->db->query("select productID from wishForAccessories where userID = ?;", "i", $_SESSION["user id"]);
        $added = array();
        foreach ($added_tops as $top) {
            array_push($added, $top["productID"]);
        }
        foreach ($added_bottoms as $bottom) {
            array_push($added, $bottom["productID"]);
        }
        foreach ($added_accessories as $accessory) {
            array_push($added, $accessory["productID"]);
        }
        
        include("templates/kids.php");
    }

    private function wishlistPage() {

        $my_wishlist_accessories_data = $this->db->query("select productID, name, imageID, gender, price, userID, priority from wishForAccessories natural join accessories where userID = ?;", "i", $_SESSION["user id"]);
        $my_wishlist_bottoms_data = $this->db->query("select productID, name, imageID, gender, price, userID, priority from wishForBottoms natural join bottoms where userID = ?;", "i", $_SESSION["user id"]);
        $my_wishlist_tops_data = $this->db->query("select productID, name, imageID, gender, price, userID, priority from wishForTops natural join tops where userID = ?;", "i", $_SESSION["user id"]);

        include("templates/wishlist.php"); 
    }

    public function getWishlist(){
        $json_variable = json_encode($this->db->query("select productID, name, imageID, gender, price, userID, priority from wishForAccessories natural join accessories where userID = ?
                                                union select productID, name, imageID, gender, price, userID, priority from wishForBottoms natural join bottoms where userID = ?
                                                union select productID, name, imageID, gender, price, userID, priority from wishForTops natural join tops where userID = ?;", 
                                                "iii", $_SESSION["user id"], $_SESSION["user id"], $_SESSION["user id"]), JSON_PRETTY_PRINT);

        header("Content-type: application/json");
        echo $json_variable;
    }

    public function removeItem(){
        if(isset($_POST["btnValue"]) && !empty($_POST["btnValue"]) ) {
            $this->db->query("delete from wishForAccessories where userID = ? and productID = ?;", "is", $_SESSION["user id"], $_POST["btnValue"]);
            $this->db->query("delete from wishForBottoms where userID = ? and productID = ?;", "is", $_SESSION["user id"], $_POST["btnValue"]);
            $this->db->query("delete from wishForTops where userID = ? and productID = ?;", "is", $_SESSION["user id"], $_POST["btnValue"]);

        }
    }

    public function updateRating(){
        if(isset($_POST["selValue"]) && !empty($_POST["selValue"])){
            $this->db->query("update wishForAccessories set priority = ? where userID = ? and productID = ?;", "iis", $_POST["selValue"], $_SESSION["user id"], $_POST["option_id"]);
            $this->db->query("update wishForBottoms set priority = ? where userID = ? and productID = ?;", "iis", $_POST["selValue"], $_SESSION["user id"], $_POST["option_id"]);
            $this->db->query("update wishForTops set priority = ? where userID = ? and productID = ?;", "iis", $_POST["selValue"], $_SESSION["user id"], $_POST["option_id"]);

        }
    }


}
