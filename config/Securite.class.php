   
<?php

class Securite {
    public static function secureHtml($string){
        return htmlentities(trim($string)) ;
    }

    public static function genereCookiePassword(){
        $ticket = session_id().microtime().rand(0,9999999);
        $ticket = hash("sha512", $ticket);
        setcookie(COOKIE_PROTECT, $ticket, time() + (60*20));
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

