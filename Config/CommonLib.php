<?php

ob_start();
include "Security.php";
//27032020 - Modified session opening-Pasindu
// session open
//session_start(); Already started from header.php

/**
  | -------------------------------------------------------------------------
  | Customisable Library for in house projects
  | -------------------------------------------------------------------------
  | This library lets you to create the most commonly used Functions with highly
  | costomized layouts.
 * 
 * @package     identimark
 * @author      THILAN PATHIRAGE
 * @version     0.1
 * @copyright (c) 2020, ICLICK ONLINE TECHNOLOGIES
 */
class CommonLib extends Security {

    // Const Variables
    const MSG_OK = 1;
    const MSG_ERR = 0;
    const SES_NAME_ADMIN = "loginreqadmin";
    const SES_NAME_CLIENT = "loginreqclient";
    const SES_NAME_SUP = "loginreqSup";
    const SES_NAME_SALES = "loginreqSales";
    const LOGIN_VIEW_SERVICE_ADMIN = "../View/Admin/admin_login.php";
    const LOGIN_VIEW_ADMIN = "../Admin/admin_login.php";
    const LOGIN_VIEW_SERVICE_CLIENT = "../View/Client/client_login.php";
    const LOGIN_VIEW_CLIENT = "../Client/client_login.php";
    const LOGIN_VIEW_SUP = "../Supplier/sup_login.php";
    const LOGIN_VIEW_SALES = "../Sales/sales_login.php";
    const COUNTRY_NZ = "New Zealand";
    const COUNTRY_AU = "Australia";
    //Modules
    const ADMIN_MODULE = "Admin";
    const SALES_MODULE = "Sales";
    const CLIENT_MODULE = "Client";
    const SUPPLIER_MODULE = "Sup";
    const OPERATION_MODULE = "Operations";

    // Constructor
    public function __construct() {
        //parent::__construct();
    }

    /**
     * render_flash_msg
     * 
     * This Function will render the Flash data on the message.
     * You can always customize this when ever you need.
     * 
     * 
     * @return String Rendered Message 
     */
    public static function render_flash_msg() {
        if (!isset($_SESSION['messages'])) {
            return null;
        }
        $messages = $_SESSION['messages'];
        unset($_SESSION['messages']);
        return $messages;
    }

    /**
     * add_flash_msg
     * 
     * This Function will create the Flash data message.
     * You can always customize this when ever you need.
     *  
     * @param String $message Message String
     */
    public static function add_flash_msg($message, $type) {
        if (!isset($_SESSION['messages'])) {

            $_SESSION['messages'] = array();
        }
        $_SESSION['messages']['msg'] = $message;
        $_SESSION['messages']['type'] = $type;
    }

    /**
     * generateRandomString
     * 
     * This Function will generate random sting according to the given length.
     * You can always customize this when ever you need.
     * 
     * @param Integer $length Character Length
     * @return String Rendered Message 
     */
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * get_SystemGen_Password
     * 
     * System Generated Password algorithm
     * 
     * @return Array Gives an Array of encrypted password along with the raw password
     */
    public function get_SystemGen_Password() {
        $password = $this->generateRandomString();
        $encrypt = password_hash($password, PASSWORD_DEFAULT);
        return array("password" => $password, "encrypt" => $encrypt);
    }

    /**
     * input
     * 
     * input handler for the all requests
     *  
     * @return String XSS cleaned output data
     */
    public function input($name) {
        $data = "";
        if (isset($_POST[$name])) {
            $data = $this->xss_clean($_POST[$name]);
        }
        if (isset($_GET[$name])) {
            $data = $this->xss_clean($_GET[$name]);
        }
        return $data;
    }

    /**
     * time_elapsed_string
     * 
     * Time calculation for Last Login like functions
     * 
     * @param String $datetime Date and time
     * @param Boolean $full the return date String in full or not
     * @return String Date in Word format
     */
    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /**
     * login_reqired
     * 
     * Login check functionality for the framework
     * 
     * @param Boolean $isview Checks whether the login required from a view or not
     */
    public function login_reqired($isview = false, $viewcat = "ADMIN") {

        if ($isview) {
            if (!isset($_SESSION['username'])) {
                header("Location:../../index.php");
            }
        }

//        if ($viewcat === CommonLib::ADMIN_MODULE) {
//            if (!isset($_SESSION[self::SES_NAME_ADMIN])) {
//                $this->add_flash_msg("Session expired! Please Login", self::MSG_ERR);
//                if ($isview) {
//                    header("Location:" . self::LOGIN_VIEW_ADMIN);
//                    ob_end_flush();
//                } else {
//                    header("Location:" . self::LOGIN_VIEW_SERVICE_ADMIN);
//                    ob_end_flush();
//                }
//            }
////        }
////        if ($viewcat === CommonLib::SALES_MODULE) {
////            if (!isset($_SESSION[self::SES_NAME_SALES])) {
////                $this->add_flash_msg("Session expired! Please Login", self::MSG_ERR);
////                if ($isview) {
////                    header("Location:" . self::LOGIN_VIEW_SALES);
////                    ob_end_flush();
////                } else {
////                    header("Location:" . self::LOGIN_VIEW_SALES);
////                    ob_end_flush();
////                }
////            }
////        }if ($viewcat === CommonLib::SUPPLIER_MODULE) {
////            if (!isset($_SESSION[self::SES_NAME_SUP])) {
////                $this->add_flash_msg("Session expired! Please Login", self::MSG_ERR);
////                if ($isview) {
////                    header("Location:" . self::LOGIN_VIEW_SUP);
////                    ob_end_flush();
////                } else {
////                    header("Location:" . self::LOGIN_VIEW_SUP);
////                    ob_end_flush();
////                }
////            }
//        } else {
//            if (!isset($_SESSION[self::SES_NAME_CLIENT])) {
//                if ($isview) {
//                    header("Location:" . self::LOGIN_VIEW_CLIENT);
//                    ob_end_flush();
//                } else {
//                    header("Location:" . self::LOGIN_VIEW_SERVICE_CLIENT);
//                    ob_end_flush();
//                }
//            }
//        }
    }

}

?>