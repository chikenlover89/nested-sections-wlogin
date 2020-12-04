<?php

namespace App\Controllers;

use App\Models\Section;
use App\Repositories\SectionsRepository;
use App\Repositories\UserRepository;
use App\Services\CheckIfLogged;


class Sections1Controller
{

    public function show(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $allSections = $repository->getAll('sections1');

        return require_once __DIR__ . '/../Views/Section1View.php';
    }

    public function add()
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = new Section($_POST['name'], $_POST['content'], null, $_POST['masterId']);
        $repository->storeOne($section, 'sections1');
        header('Location: /sections');
    }

    public function delete(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();

        $toDelete = $repository->getMany($vars['id1'], 'sections2');

        foreach ($toDelete as $item) {
            $repository->deleteByMastersId($item->getId(), 'sections3');
        }
        $repository->deleteByMastersId($vars['id1'], 'sections2');
        $repository->deleteById($vars['id1'], 'sections1');

        header('Location: /sections');
    }

    public function editView(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = $repository->getOne($vars['id1'], 'sections1');
        return require_once __DIR__ . '/../Views/EditView.php';
    }

    public function editSave(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = new Section($_POST['name'], $_POST['content'], $vars['id1'], $_POST['masterId']);
        $repository->updateStored($section, 'sections1');
        header('Location: /sections');
    }

}