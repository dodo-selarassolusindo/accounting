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

class NoteController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/notelist[/{NoteID}]", [PermissionMiddleware::class], "list.note")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "NoteList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/noteadd[/{NoteID}]", [PermissionMiddleware::class], "add.note")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "NoteAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/noteview[/{NoteID}]", [PermissionMiddleware::class], "view.note")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "NoteView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/noteedit[/{NoteID}]", [PermissionMiddleware::class], "edit.note")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "NoteEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/notedelete[/{NoteID}]", [PermissionMiddleware::class], "delete.note")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "NoteDelete");
    }
}
