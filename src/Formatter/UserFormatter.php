<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Entity\User;

final class UserFormatter
{
    public function format(User $user): array
    {
        return [
            'login' => $user->getLogin(),
            'created_at' => $user->getCreatedAt()->format('d.m.Y H:i:s')
        ];
    }
}
