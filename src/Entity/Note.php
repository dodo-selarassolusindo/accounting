<?php

namespace PHPMaker2024\prj_accounting\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2024\prj_accounting\AbstractEntity;
use PHPMaker2024\prj_accounting\AdvancedSecurity;
use PHPMaker2024\prj_accounting\UserProfile;
use function PHPMaker2024\prj_accounting\Config;
use function PHPMaker2024\prj_accounting\EntityManager;
use function PHPMaker2024\prj_accounting\RemoveXss;
use function PHPMaker2024\prj_accounting\HtmlDecode;
use function PHPMaker2024\prj_accounting\EncryptPassword;

/**
 * Entity class for "note" table
 */
#[Entity]
#[Table(name: "note")]
class Note extends AbstractEntity
{
    #[Id]
    #[Column(name: "NoteID", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $noteId;

    #[Column(name: "Tanggal", type: "datetime")]
    private DateTime $tanggal;

    #[Column(name: "Catatan", type: "text")]
    private string $catatan;

    public function getNoteId(): int
    {
        return $this->noteId;
    }

    public function setNoteId(int $value): static
    {
        $this->noteId = $value;
        return $this;
    }

    public function getTanggal(): DateTime
    {
        return $this->tanggal;
    }

    public function setTanggal(DateTime $value): static
    {
        $this->tanggal = $value;
        return $this;
    }

    public function getCatatan(): string
    {
        return HtmlDecode($this->catatan);
    }

    public function setCatatan(string $value): static
    {
        $this->catatan = RemoveXss($value);
        return $this;
    }
}
