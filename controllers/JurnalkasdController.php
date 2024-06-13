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

class JurnalkasdController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasdlist[/{id}]", [PermissionMiddleware::class], "list.jurnalkasd")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasdList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasdadd[/{id}]", [PermissionMiddleware::class], "add.jurnalkasd")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasdAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasdview[/{id}]", [PermissionMiddleware::class], "view.jurnalkasd")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasdView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasdedit[/{id}]", [PermissionMiddleware::class], "edit.jurnalkasd")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasdEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jurnalkasddelete[/{id}]", [PermissionMiddleware::class], "delete.jurnalkasd")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JurnalkasdDelete");
    }
}
