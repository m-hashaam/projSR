<?php
/*************************************************************************
    class.passwd.php

    Password Hasher - Interface for phpass bcrypt hasher.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/

require_once(INCLUDE_DIR.'PasswordHash.php'); //helper class - will be removed then we move to php5

define('DEFAULT_WORK_FACTOR',8);

class Passwd {

    function cmp($passwd,$hash,$work_factor=0){
        
        if($work_factor < 4 || $work_factor > 31)
            $work_factor=DEFAULT_WORK_FACTOR;

        $hasher = new PasswordHash($work_factor,FALSE);
        //echo ($hasher && $hasher->CheckPassword($passwd,$hash));
        //return ($hasher && $hasher->CheckPassword($passwd,$hash));
        //echo "<script>console.log('".$hash."')</script>";
        //echo "<script>console.log('".$passwd."')</script>";
        //echo "<script>console.log('".md5($passwd)."')</script>";
        //return false;
        if(md5($passwd) == $hash){
            return true;
        }
        else return false;
    }

    function hash($passwd, $work_factor=0){
       
        if($work_factor < 4 || $work_factor > 31)
            $work_factor=DEFAULT_WORK_FACTOR;

        $hasher = new PasswordHash($work_factor,FALSE);
        //echo ($hasher && ($hash=$hasher->HashPassword($passwd)))?$hash:null;
        //return ($hasher && ($hash=$hasher->HashPassword($passwd)))?$hash:null;
        return md5($passwd);
    }
}
?>
