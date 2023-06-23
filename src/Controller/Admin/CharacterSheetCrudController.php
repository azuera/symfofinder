<?php

namespace App\Controller\Admin;

use App\Entity\CharacterSheet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CharacterSheetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CharacterSheet::class;
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
