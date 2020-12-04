<?php

namespace App\Repositories;

use App\Models\Section;

class SectionsRepository
{
    public function getAll(string $table): array
    {

        $allSections = query()
            ->select('*')
            ->from($table)
            ->execute()
            ->fetchAllAssociative();

        foreach ($allSections as $section) {
            $allSectionModels[] = new Section($section['name'], $section['content'], $section['id'], $section['master_id']);
        }

        if($allSectionModels == null){
            $allSectionModels = [];
        }

        return $allSectionModels;
    }

    public function getMany(string $id, string $table): array
    {

        $allSections = query()
            ->select('*')
            ->from($table)
            ->where('master_id = :id')
            ->setParameter('id', (int)$id)
            ->execute()
            ->fetchAllAssociative();

        foreach ($allSections as $section) {
            $allSectionModels[] = new Section($section['name'], $section['content'], $section['id'], $section['master_id']);
        }

        if($allSectionModels == null){
            $allSectionModels = [];
        }

        return $allSectionModels;
    }

    public function storeOne(Section $section, string $table): void
    {

        query()
            ->insert($table)
            ->values([
                'name' => ':name',
                'content' => ':content',
                'master_id' => ':masterId',
            ])
            ->setParameters([
                'name' => $section->getName(),
                'content' => $section->getContent(),
                'masterId' => $section->getMasterId()
            ])
            ->execute();
    }


    public function deleteById(string $id, string $table): void
    {
        $id = (int)$id;
        $statement = database()->prepare("DELETE FROM " . $table . " WHERE id = '$id'");
        $statement->execute();
    }

    public function deleteByMastersId(string $id, string $table): void
    {
        $id = (int)$id;
        $statement = database()->prepare("DELETE FROM " . $table . " WHERE master_id = '$id'");
        $statement->execute();
    }

    public function updateStored(Section $section, string $table): void
    {
        query()
            ->update($table)
            ->set('name', ':name')
            ->set('content', ':content')
            ->where('id = :id')
            ->setParameter(':name', $section->getName())
            ->setParameter(':content', $section->getContent())
            ->setParameter(':id', $section->getId())
            ->execute();

    }

    public function getOne(string $id, string $table): Section
    {
        $section = query()
            ->select('*')
            ->from($table)
            ->where('id = :id')
            ->setParameter('id', (int)$id)
            ->execute()
            ->fetchAssociative();

        $sectionModel = new Section($section['name'], $section['content'], $section['id'], $section['master_id']);
        return $sectionModel;
    }


}