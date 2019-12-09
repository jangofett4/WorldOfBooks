<?php

class WUserSession
{
    public $username = "";
    public $password = "";
    public $userID = 0;
    
    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    function login()
    {
        $this->userID = -1;
        return true; // TODO: this is mock, add real login function
    }
}


?>