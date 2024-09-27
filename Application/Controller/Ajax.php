<?php

namespace Application\Controller;

use Application\Model\User;
use Core\Controller;

class Ajax extends Controller
{
    protected $view = 'json';

    public function addAction() {
        if($user = User::getCurrentUser()) {
            $this->output(['data' => [
                    'number' => $user->addNumber()
                ]
            ]);
            User::resetCurrentUser();
            return;
        }

        $this->output(['error' => true]);
    }
}