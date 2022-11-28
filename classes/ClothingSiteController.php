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
                        $_SESSION["user id"] = $user_id[0]["id"];
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
                        $_SESSION["user id"] = $user_id[0]["id"];
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
        $added_tops = $this->db->query("select productID from wishfortops where userID = ?;", "i", $_SESSION["user id"]);
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


        include("templates/mens.php");
    }

    // Display women's clothing page (womens.php)
    private function womensPage() {
        // get list of tops, bottoms, and accessories
        $tops = $this->db->query("select * from tops WHERE gender = 'F'");
        $bottoms = $this->db->query("select * from bottoms WHERE gender = 'F'");
        $accessories = $this->db->query("select * from accessories WHERE gender = 'F'");


        include("templates/womens.php");
    }

    // Display men's clothing page (mens.php)
    private function kidsPage() {
        // get list of tops, bottoms, and accessories
        $tops = $this->db->query("select * from tops WHERE gender = 'K'");
        $bottoms = $this->db->query("select * from bottoms WHERE gender = 'K'");
        $accessories = $this->db->query("select * from accessories WHERE gender = 'K'");

        include("templates/kids.php");
    }


}
