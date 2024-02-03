<?php

class User extends Controller
{
    function getUsers()
    {
        $this->model('UserModel');
        $list = $this->UserModel->getUsers();
        $this->dd($list);
    }

    function testView()
    {
        $this->view('welcome', ["username" => "sandeep"]);
    }
}
