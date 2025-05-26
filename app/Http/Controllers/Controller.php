<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // Aquí se incluyen los tres traits útiles en la mayoría de controladores Laravel:
    // - Validación de datos
    // - Autorización de acciones del usuario
    // - Envío de tareas asincrónicas (jobs)
}

