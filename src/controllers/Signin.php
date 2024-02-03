<?php

class Signin extends Controller
{
    function index()
    {
        $this->view('signin/index', ["username" => "sandeep"]);
    }
}
