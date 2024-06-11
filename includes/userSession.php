<?php

class userSession
{
    function __Construct()
    {
        session_start();
    }
    function SetCurrentF_num($f_num)
    {
        $_SESSION['f_num'] = $f_num;
    }
    function GetCurrentF_num()
    {
        return $_SESSION['f_num'];
    }

    function CloseSession()
    {
        session_unset();
        session_destroy();
    }
}
