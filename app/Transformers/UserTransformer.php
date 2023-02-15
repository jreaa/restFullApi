<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\User;

class UserTransformer extends TransformerAbstract
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
    public function transform(User $user)
    {
        return [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'email' => (string) $user->email,
            'isVerified' => (int) $user->verified,
            'isAdmin' => ($user->admin === 'true'),
            'creationDate' => $user->created_at,
            'lastChange' => $user->updated_at,
            'deletedDate' => isset($user->deleted_at) ? (string) $user->deleted_at : null ,

            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('users.show', $user->id)
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
            'isVerified' => 'verified',
            'isAdmin' => 'admin',
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
            'verified' => 'isVerified',
            'admin' => 'isAdmin',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null;
    }
}
