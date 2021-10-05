   
<?php

class Securite {
    /*
    public static function secureHtml($string){
        return htmlentities($string) ;
    }
    */
    public static function secureHtml($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        $data = htmlentities($data) ;
        return $data;
    }

    public static function genereCookiePassword(){
        $ticket = session_id().microtime().rand(0,9999999);
        $ticket = hash("sha512", $ticket);
        setcookie(COOKIE_PROTECT, $ticket);
        $_SESSION[COOKIE_PROTECT] = $ticket;
    }

    public static function verificationCookie(){
        if($_COOKIE[COOKIE_PROTECT] === $_SESSION[COOKIE_PROTECT]) {
            Securite::genereCookiePassword();
            return true ;
        } else {
            session_destroy();
            throw new Exception("Vous ne pouvez pas accéder à ce site") ;
        }
    }

    public static function verificationAccess(){
        return (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user'] === "connecté") ;
    }
}

