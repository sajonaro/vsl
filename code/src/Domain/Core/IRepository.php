<?php

declare(strict_types=1);

namespace Domain\Core;

interface IRepository{

    public function getAll(): array;
    public function getById(int $id);
    public function create(array $data): bool;
    public function update(array $data): bool;

}
