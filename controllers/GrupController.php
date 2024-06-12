<?php

namespace PHPMaker2024\prj_accounting;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\prj_accounting\Attributes\Delete;
use PHPMaker2024\prj_accounting\Attributes\Get;
use PHPMaker2024\prj_accounting\Attributes\Map;
use PHPMaker2024\prj_accounting\Attributes\Options;
use PHPMaker2024\prj_accounting\Attributes\Patch;
use PHPMaker2024\prj_accounting\Attributes\Post;
use PHPMaker2024\prj_accounting\Attributes\Put;

class GrupController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/gruplist[/{id}]", [PermissionMiddleware::class], "list.grup")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "GrupList");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/grupedit[/{id}]", [PermissionMiddleware::class], "edit.grup")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "GrupEdit");
    }
}
