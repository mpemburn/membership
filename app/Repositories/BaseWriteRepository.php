<?php


namespace App\Repositories;


use App\Interfaces\Repositories\BaseWriteRepositoryInterface;
use App\Models\AbstractEloquentModel;

class BaseWriteRepository implements BaseWriteRepositoryInterface
{
    public function store(AbstractEloquentModel $model, array $data)
    {
        // TODO: Implement store() method.
    }

    public function update(AbstractEloquentModel $model, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(AbstractEloquentModel $model)
    {
        // TODO: Implement delete() method.
    }

}
