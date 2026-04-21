<?php

namespace App\Models;

use App\Models\User;

class SessionGuard
{
    protected $user;

    public function login(User $user, array $credentials)
    {
        $verified = password_verify($credentials['password'], $user->password);
        if ($verified) {
            $_SESSION['user_id'] = $user->id;
        }
        return $verified;
    }

    public function user()
    {
        if (!$this->user && $this->isUserLoggedIn()) {


            $this->user = (new User(PDO()))->where('admin_id', $_SESSION['user_id']);


            if (empty($this->user->name)) {
                $this->user->name = $this->user->email;
            }
        }
        return $this->user;
    }

    public function logout()
    {
        $this->user = null;
        session_unset();
        session_destroy();
    }

    public function isUserLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function is_admin()
    {
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }
}
