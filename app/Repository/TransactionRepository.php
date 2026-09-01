<?php

namespace App\Repository;

use App\Models\Transaction;

class TransactionRepository
{
    private Transaction $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function getTransaction()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }
}
