<?php

namespace App\Controller\Admin;

use App\Entity\GameMaster;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GameMasterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GameMaster::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
