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

class JurnalkasController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jurnalkaslist[/{id}]", [PermissionMiddleware::class], "list.jurnalkas")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasadd[/{id}]", [PermissionMiddleware::class], "add.jurnalkas")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasview[/{id}]", [PermissionMiddleware::class], "view.jurnalkas")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasedit[/{id}]", [PermissionMiddleware::class], "edit.jurnalkas")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasdelete[/{id}]", [PermissionMiddleware::class], "delete.jurnalkas")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasDelete");
    }
}
