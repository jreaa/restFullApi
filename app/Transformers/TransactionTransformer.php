<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Transaction;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'id' => (int) $transaction->id,
            'quantity' => (int) $transaction->quantiy,
            'buyer' => (int) $transaction->buyer_id,
            'product' => (int) $transaction->product_id,
            'creationDate' => $transaction->created_at,
            'lastChange' => $transaction->updated_at,
            'deletedDate' => isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null ,

            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('transactions.show', $transaction->id)
                ],
                [
                    'rel'  => 'transaction.categories',
                    'href' => route('transactions.categories.index', $transaction->id)
                ],
                [
                    'rel'  => 'transaction.seller',
                    'href' => route('transactions.sellers.index', $transaction->id)
                ],
                [
                    'rel'  => 'buyer',
                    'href' => route('buyers.show', $transaction->buyer_id)
                ],
                [
                    'rel'  => 'product',
                    'href' => route('products.show', $transaction->product_id)
                ],
            ]
        ];
    }
    public static function originalAttribute($index) 
    {
        $attribute = [
            'id' => 'id',
            'quantity' => 'quantiy',
            'buyer' => 'buyer_id',
            'product' => 'product_id',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null;
    }
    public static function transformAttribute($index) 
    {
        $attribute = [
            'id' => 'id',
            'quantity' => 'quantity',
            'buyer_id' => 'buyer',
            'product_id' => 'product',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null;
    }
}
