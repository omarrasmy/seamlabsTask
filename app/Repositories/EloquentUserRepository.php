<?php

namespace App\Repositories;

use App\Contracts\UserRepository;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{
    private string $defaultSort = '-created_at';

    private array $defaultSelect = [
        'id',
        'email',
        'is_active',
        'email_verified_at',
        'created_at',
        'updated_at',
        'name',
        'phone',
        'date_of_birth'
    ];

    private array $allowedFilters = [
        'is_active',
        'date_of_birth'
    ];

    private array $allowedSorts = [
        'updated_at',
        'created_at',
    ];

    private array $allowedIncludes = [
        'profile',
        'authorizeddevices',
        'loginhistories',
        'notifications',
        'unreadnotifications',
    ];

    public function findByFilters(): LengthAwarePaginator
    {
        $perPage = (int)request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 20;
        $user=request()->user;
        $query= QueryBuilder::for(User::class)
            ->select($this->defaultSelect)
            ->allowedFilters(array_merge($this->allowedFilters,[AllowedFilter::scope('query')]))
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort);
        return $query->paginate($perPage);
    }

    public function update(Model $model, array $data): Model
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);

//            event(new PasswordReset(auth()->user()));
        }

        return parent::update($model, $data);
    }

    public function setNewEmailTokenConfirmation($userId)
    {
        $this->withoutGlobalScopes()
            ->findOneById($userId)
            ->update([
                'email_token_confirmation' => Uuid::uuid4()->toString(),
            ]);
    }
}
