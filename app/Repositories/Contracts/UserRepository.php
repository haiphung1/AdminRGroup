<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface UserRepository extends AbstractRepository
{
    public function getData(array $dataSelect = ['*']) : Collection;

    public function createData(array $data) : Collection ;

    public function find(int $id) : collection ;

    public function updateData(int $id, array $data) : bool;

    public function destroy(int $id) : bool ;
}