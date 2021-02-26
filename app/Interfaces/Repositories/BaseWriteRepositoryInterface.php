<?php


namespace App\Interfaces\Repositories;

use App\Models\AbstractEloquentModel;

interface BaseWriteRepositoryInterface
{
    public function store(AbstractEloquentModel $model, array $data);
    public function update(AbstractEloquentModel $model, array $data);
    public function delete(AbstractEloquentModel $model);
}
