<?php

namespace Application\Controller;

use Application\Model\User;
use Core\Controller;
use Core\Request;
use Core\Helper\Url;

class Index extends Controller
{
    protected $view = 'Index';

    public function indexAction()
    {
        $username = Request::post('username');
        $password = Request::post('password');
        $params = [];
        if ($username && $password) {
            if (!User::login($username, $password)) {
                if (!User::exists($username)) {
                    //create new one
                    User::create($username, $password);
                    User::login($username, $password);
                } else {
                    //user exists, password is wrong
                    $params['username'] = $username;
                    $params['error'] = 'Password is wrong';
                }
            }
        }

        if ($user = User::getCurrentUser()) {
            $params['user'] = $user;
        }

        $this->output($params);
    }

    public function logoutAction()
    {
        User::logOut();

        Header('Location:' . Url::build());
    }
}