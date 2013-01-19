<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author Admin
 */
class WebUser extends CWebUser {
    
    public function getIsAdmin(){
        return ($this->getName() == 'admin');
    }
    
    public function isRegistered(){
        return (!$this->isGuest() && !$this->isAdmin() );
    }
}

?>
