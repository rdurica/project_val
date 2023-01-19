<?php

declare(strict_types=1);

namespace App\Component\Grid\Project;

use App\Component\AbstractComponent;
use App\Entity\Project;
use App\Entity\User;
use Contributte\Translation\Translator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Nette;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\DataSource\DoctrineDataSource;
use Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation;

class ProjectGrid extends AbstractComponent
{
    public EntityManagerInterface $em;

    public function __construct(Translator $translator, EntityManagerInterface $em)
    {
        parent::__construct($translator);
        $this->em = $em;
    }

    public function createComponentProjectGrid(): DataGrid
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select("p")->from(Project::class, "p");

        $grid = new DataGrid();
        $grid->setDataSource(new DoctrineDataSource($qb, "id"));
        $grid->addColumnText("id", "id")->setFilterText();
        $grid->addColumnText("title", "title")->setFilterText();
        $grid->addColumnDateTime("projectStartDate", "projectStartDate")->setFilterDate();
        $grid->addColumnDateTime("projectEndDate", "projectEndDate")->setFilterDate();
        $grid->addColumnText("expectedCost", "expectedCost")->setRenderer(function (Project $project) {
            return "$" . $project->getExpectedCost();
        })->setFilterText();
        $grid->addAction("detail", "Detail", "Projects:detail")
            ->setIcon("eye")
            ->setClass("btn btn-xs btn-primary");
        $grid->addAction("delete", "Delete", "delete!")
            ->setIcon("trash")
            ->setTitle("Delete")
            ->setClass("btn btn-xs btn-danger")
            ->setConfirmation(
                new StringConfirmation("Do you really want to delete project: %s?", "title")
            );
        $grid->addExportCsv('Csv export (all)', 'projects.csv')
            ->setIcon("file")
            ->setTitle('Csv export');
        $grid->addExportCsvFiltered('Csv export (filtered)', 'projects-filter.csv')
            ->setIcon("file")
            ->setTitle('Csv export (filtered)');

        return $grid;
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__ . "/default.latte");
        $this->getTemplate()->render();
    }

    public function handleDelete(int $id)
    {
        $project = $this->em->getPartialReference(Project::class, ["id" => $id]);
        $this->em->remove($project);
        $this->em->flush();
    }


}