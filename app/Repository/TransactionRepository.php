<?php

namespace App\Repository;

use App\Models\Transaction;
use App\Models\User;

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

    public function summary(User $user, int $month, int $year): array
    {
        $result = $this->model
            ->where('user_id', $user->id)
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as income")
            ->selectRaw("SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as expense")
            ->first();

        return [
            'income' => (float) ($result->income ?? 0),
            'expense' => (float) ($result->expense ?? 0),
        ];
    }
}
