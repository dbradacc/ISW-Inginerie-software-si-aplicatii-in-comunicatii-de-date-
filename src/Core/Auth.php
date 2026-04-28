<?php

namespace App\Core;



class Auth

{

    private const MAP = [

        'admin'    => ['view','create','update','delete'],

        'secretar' => ['view','create','update'],

        'profesor' => ['view', 'create', 'update'], // Am adăugat create și update

    ];



    public static function can(string $action): bool

    {

        $role = $_SESSION['user']['role'] ?? '';

        return in_array($action, self::MAP[$role] ?? []);

    }

}

