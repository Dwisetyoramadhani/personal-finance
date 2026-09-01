<?php

namespace App\Services;

use App\Models\User;
use App\Repository\TransactionRepository;

class TransactionService
{
    private TransactionRepository $transactionRepository;
    public function __construct(
        TransactionRepository $transactionRepository
    ) {
        $this->transactionRepository = $transactionRepository;
    }

    public function summary(User $user, int $month, int $year): array
    {
        $summary = $this->transactionRepository->summary($user, $month, $year);

        return [
            'income' => $summary['income'],
            'expense' => $summary['expense'],
            'net' => $summary['income'] - $summary['expense'],
        ];
    }
}
