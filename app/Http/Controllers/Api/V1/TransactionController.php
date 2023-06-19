<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return TransactionResource::collection($transaction);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());
        $transaction->save();

        return new TransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return new TransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json(["message" => "Data has been deleted"]);
    }

    public function getTransactionSummary()
    {
        $transaction = Transaction::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'deleted_at' => null
                    ]
                ],
                [
                    '$group' => [
                       "_id" => [
                            '$dateToString' =>  [
                                'format' => '%Y-%m-%d',
                                'date' => '$created_at'
                            ]
                        ],
                        'count' => [
                            '$sum' => 1
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        '_id' => -1
                    ]
                ],
                [
                    '$limit' => 10
                ]
            ]);
        });

        return new TransactionResource($transaction);
    }
}
