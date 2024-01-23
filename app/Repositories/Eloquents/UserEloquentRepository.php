<?php

namespace App\Repositories\Eloquents;

use Illuminate\Support\Collection;
use App\Repositories\Contracts\UserRepository;
use App\Models\User;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepository
{
    public function model()
    {
        return new User;
    }

    public function getData($dataSelect = ['*']) : Collection
    {
        return $this->model()->select($dataSelect)->get();
    }

    public function createData($data) : Collection
    {
        return $this->model()->create($data);
    }

    public function find(int $id) : Collection
    {
        return $this->model()->find($id);
    }

    public function updateData(int $id, array $data) : bool
    {
        return $this->model()->where('id', $id)->update($data);
    }

    public function destroy(int $id) : bool
    {
        return $this->model()->destroy($id);
    }
}