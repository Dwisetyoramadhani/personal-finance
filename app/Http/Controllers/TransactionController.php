<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Repository\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        try {
            $data = $this->transactionRepository->getTransaction();
            return response()->json([
                'message' => 'berhasil mengambil data',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    public function store(TransactionRequest $request)
    {
        try {
            $data = $this->transactionRepository->store($request->validated());
            return response()->json([
                'message' => 'berhasil menambah data',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
