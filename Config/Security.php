<?php session_start();
    // Session Start

/**
  | -------------------------------------------------------------------------
  | Security Helper for in house projects
  | -------------------------------------------------------------------------
  | This helper library lets you to create security functions with highly
  | costomized layouts.
 * 
 * @package     identimark
 * @author      THILAN PATHIRAGE
 * @version     0.1
 * @copyright (c) 2020, ICLICK ONLINE TECHNOLOGIES
 */

abstract class Security {

    // Constructor
    public function __construct() {
        
    }

    /**
     * get_csrf_token
     * 
     * CSRF Protection for the framework
     * 
     * Recommend: PLEASE USE THIS FUNCTION FOR EVERY FORM SUBMISSION
     * 
     * @return String html output of the csrf token
     */
    public function get_csrf_token($israw=false) {
        $token = "";
        if (!isset($_SESSION['csrf_token'])) {
            if (function_exists('mcrypt_create_iv')) {
                $token = @bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
            } else {
                $token = @bin2hex(openssl_random_pseudo_bytes(32));
            }

            $_SESSION['csrf_token'] = $token;
        }
        if($israw){
            return $_SESSION['csrf_token'];
        }else{
            return '<input type="hidden" value="' . $_SESSION['csrf_token'] . '" name="csrf_token" />';
        }
        
    }

    /**
     * csrf_verify
     * 
     * CSRF Protection for the framework
     * 
     * Recommend: PLEASE USE THIS FUNCTION FOR EVERY CONTROLLER 
     * 
     */
    public function csrf_verify() {
        if (isset($_POST['csrf_token'])) {
            if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $this->add_flash_msg("Oops! Somthing went wrong! Please submit again.", self::MSG_ERR);
                header("Location:" . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            if (isset($_GET['csrf_token'])) {
                if (!hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])) {
                    $this->add_flash_msg("Oops! Somthing went wrong! Please submit again.", self::MSG_ERR);
                    header("Location:" . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } else {
                $this->add_flash_msg("Oops! Somthing went wrong! Please submit again.", self::MSG_ERR);
                header("Location:" . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    /**
     * xss_clean
     * 
     * XSS Protection for the requests on the framework 
     *  
     */
    protected function xss_clean($data) {

        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');


        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);


        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);


        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);


        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);

        return $data;
    }

}
