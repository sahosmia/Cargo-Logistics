<?php

namespace App\Actions\Auth;

class GenerateOTPAction
{
    public function execute(): string
    {
        return (string) rand(100000, 999999);
    }
}
