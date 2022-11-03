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


        include("templates/home.php");
    }


}
