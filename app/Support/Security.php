<?php

namespace App\Support;

use App\Models\PasswordReset;

class Security
{
    /**
     * Invalidate reset password token
     *
     * @param string $email
     * @return boolean
     */
    public function invalidateResetPasswordToken($email)
    {
        return PasswordReset::whereEmail($email)->delete();
    }

    /**
     * Logout another session in another device
     *
     * @param string $password
     * @return boolean
     */
    public function logoutOtherDevices($password)
    {
        return \Auth::logoutOtherDevices($password);
    }
}