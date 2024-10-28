<?php

namespace Project\Controllers;

use Project\Exceptions\InvalidArgumentException;
use Project\Models\Users\UserActivationService;
use Project\Controllers\AbstractController;
use Project\Models\Users\UsersAuthService;
use Project\Services\EmailSender;
use Project\Models\Users\User;
use Project\View\View;


class UsersController extends AbstractController
{
    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage(), 'user' => $this->user]);
                return;
            }
        }

        $this->view->renderHtml('users/login.php', ['user' => $this->user]);
    }

    public function logout()
    {
        setcookie('token', '', time() - 3600, '/');

        unset($_COOKIE['token']);
        header('Location: \ ');
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage(), 'user' => $this->user]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);
                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSuccessful.php', ['code' => $code]);
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php', ['user' => $this->user]);
    }

    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);
        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

        if ($isCodeValid) {
            $user->activate();
            echo 'OK!';
        }
    }
}