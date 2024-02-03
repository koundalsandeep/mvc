<?php

class UserModel extends Model
{

    function getUsers()
    {
        return $this->select(array('users'))->fetchAssocAll();
    }
}
