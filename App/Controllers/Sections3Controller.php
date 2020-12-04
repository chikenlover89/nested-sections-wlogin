<?php

namespace App\Controllers;

use App\Models\Section;
use App\Repositories\SectionsRepository;
use App\Repositories\UserRepository;
use App\Services\CheckIfLogged;


class Sections3Controller
{
    public function show(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $masterSection1 = $repository->getOne($vars['id1'],'sections1');
        $masterSection2 = $repository->getOne($vars['id2'],'sections2');
        $allSections = $repository->getMany($vars['id2'],'sections3');

        return require_once __DIR__ . '/../Views/Section3View.php';
    }

    public function add(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = new Section($_POST['name'], $_POST['content'], null, $_POST['masterId']);
        $repository->storeOne($section, 'sections3');
        header('Location: /sections/'.$vars['id1'].'/'.$vars['id2']);
    }

    public function delete(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $repository->deleteById($vars['id3'], 'sections3');
        header('Location: /sections/'.$vars['id1'].'/'.$vars['id2']);
    }

    public function editView(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = $repository->getOne($vars['id3'], 'sections3');
        return require_once __DIR__ . '/../Views/EditView.php';
    }

    public function editSave(array $vars)
    {
        CheckIfLogged::execute();
        $repository = new SectionsRepository();
        $section = new Section($_POST['name'], $_POST['content'], $vars['id3'], $_POST['masterId']);
        $repository->updateStored($section, 'sections3');
        header('Location: /sections/'.$vars['id1'].'/'.$vars['id2']);
    }

}