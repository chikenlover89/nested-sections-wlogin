<?php

namespace App\Repositories;

use App\Models\Section;

class UserRepository
{
    public function findUser(string $username): array
    {

        $user = query()
            ->select('*')
            ->from('users')
            ->where('user = :user')
            ->setParameter('user', $username)
            ->execute()
            ->fetchAssociative();

        if($user != null) {
            return $user;
        }else {
            return [];
        }
    }

    public function addUser(string $user, string $password): void
    {
        query()
            ->insert('users')
            ->values([
                'user' => ':user',
                'password' => ':password'
            ])
            ->setParameters([
                'user' => $user,
                'password' => password_hash($password,PASSWORD_DEFAULT)
            ])
            ->execute();
    }


}