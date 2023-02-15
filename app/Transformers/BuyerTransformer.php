<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Buyer;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
            'id' => (int) $buyer->id,
            'name' => (string) $buyer->name,
            'email' => (string) $buyer->email,
            'isVerified' => (int) $buyer->verified,
            'creationDate' => $buyer->created_at,
            'lastChange' => $buyer->updated_at,
            'deletedDate' => isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null ,

            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('buyers.show', $buyer->id)
                ],
                [
                    'rel'  => 'buyer.categories',
                    'href' => route('buyers.categories.index', $buyer->id)
                ],
                [
                    'rel'  => 'buyer.products',
                    'href' => route('buyers.products.index', $buyer->id)
                ],
                [
                    'rel'  => 'buyer.sellers',
                    'href' => route('buyers.sellers.index', $buyer->id)
                ],
                [
                    'rel'  => 'user',
                    'href' => route('users.show', $buyer->id)
                ],
            ]
        ];
    }

    public static function originalAttribute($index) 
    {
        $attribute = [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
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
            'name' => 'name',
            'email' => 'email',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null;
    }
}
