<?php

namespace App\Enums;

enum Role: string
{
    case Utilisateur = "utilisateur";
    case Employe = "employé";
    case Admin = "administrateur";
}
