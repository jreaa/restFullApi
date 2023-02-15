<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Category;
class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'id' => (int) $category->id,
            'title' => (string) $category->name,
            'details' => (string) $category->description,
            'creationDate' => $category->created_at,
            'lastChange' => $category->updated_at,
            'deletedDate' => isset($category->deleted_at) ? (string) $category->deleted_at : null ,

            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('categories.show', $category->id)
                ],
                [
                    'rel'  => 'category.buyers',
                    'href' => route('categories.buyers.index', $category->id)
                ],
                [
                    'rel'  => 'category.products',
                    'href' => route('categories.products.index', $category->id)
                ],
                [
                    'rel'  => 'category.seller',
                    'href' => route('categories.sellers.index', $category->id)
                ],
                [
                    'rel'  => 'category.transactions',
                    'href' => route('categories.transactions.index', $category->id)
                ],
            ]
        ];
    }

    public static function originalAttribute($index) 
    {
        $attribute = [
            'id' => 'id',
            'title' => 'name',
            'details' => 'description',
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
            'name' => 'title',
            'description' => 'details',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null;
    }
}
