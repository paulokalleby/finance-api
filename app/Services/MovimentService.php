<?php

namespace App\Services;

use App\Repositories\MovimentRepository;

class MovimentService
{
    protected $moviment;

    public function __construct(MovimentRepository $moviment)
    {
        $this->moviment = $moviment;
    }

    public function getAllMoviments(array $filters)
    {
        return $this->moviment->all($filters);
    }

    public function findMovimentById(string $id)
    {
        return $this->moviment->find($id);
    }

    public function createMoviment(array $data)
    {
        return $this->moviment->create($data);
    }

    public function updateMoviment(array $data, string $id)
    {
        return $this->moviment->update($data, $id);
    }

    public function deleteMoviment(string $id)
    {
        return $this->moviment->delete($id);
    }
}
