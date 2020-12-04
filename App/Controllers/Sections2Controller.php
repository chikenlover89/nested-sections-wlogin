<?php

namespace App\Controllers;

use App\Models\Section;
use App\Repositories\SectionsRepository;
use App\Repositories\UserRepository;
use App\Services\CheckIfLogged;


class Sections2Controller
{
    public function show(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $masterSection1 = $repository->getOne($vars['id1'],'sections1');
        $allSections = $repository->getMany($vars['id1'],'sections2');

        return require_once __DIR__ . '/../Views/Section2View.php';
    }

    public function add(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = new Section($_POST['name'], $_POST['content'], null, $_POST['masterId']);
        $repository->storeOne($section, 'sections2');
        header('Location: /sections/'.$vars['id1']);
    }

    public function delete(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $repository->deleteByMastersId($vars['id2'], 'sections3');
        $repository->deleteById($vars['id2'], 'sections2');
        header('Location: /sections/'.$vars['id1']);
    }

    public function editView(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = $repository->getOne($vars['id2'], 'sections2');
        return require_once __DIR__ . '/../Views/EditView.php';
    }

    public function editSave(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = new Section($_POST['name'], $_POST['content'], $vars['id2'], $_POST['masterId']);
        $repository->updateStored($section, 'sections2');
        header('Location: /sections/'.$vars['id1']);
    }

}