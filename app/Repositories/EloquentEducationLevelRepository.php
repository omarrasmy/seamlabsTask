<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentEducationLevelRepository extends EloquentRepository
{
    private string $defaultSort = '-created_at';

    private array $defaultSelect = [
        'id',
        'title',
        'description',
        'updated_at',
        'created_at'
    ];

    private array $allowedFilters = [

    ];

    private array $allowedSorts = [
        'updated_at',
        'created_at',
    ];

    private array $allowedIncludes = [
    ];


    public function findAll(): mixed
    {
        $perPage = (int)request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 1000000;
        $this->defaultSort = request()->get('sortDirection') == 'asc' ? 'created_at' : $this->defaultSort;
        //BackOffice use Query for search
        // sort direction for sort asc or desc
        return QueryBuilder::for(EducationLevel::class)
            ->select($this->defaultSelect)
            ->allowedFilters(array_merge($this->allowedFilters,[AllowedFilter::exact('partner'),AllowedFilter::scope('query')]))
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->paginate($perPage);

    }
    public function findByIds(array $ids):mixed{
        return EducationLevel::select($this->defaultSelect)->whereIn('id',$ids)->get();
    }
    // public function update(Model $model, array $data): Model
    // {
    //     // if (isset($data['password'])) {
    //     //     $data['password'] = bcrypt($data['password']);

    //     //     event(new PasswordReset(auth()->user()));
    //     // }

    //     return parent::update($model, $data);
    // }
    /**
     * @param array $file
     * @return mixed
     */
    public function create(array $education): mixed
    {
        return EducationLevel::create($education);
    }
    public function deleteOne(int $id)
    {
        return EducationLevel::where('id',$id)->delete();
    }

    /**
     * @param array $ids of ids
     */
    public function deleteMany(array $ids)
    {
        return EducationLevel::destroy($ids);
    }
    public function update(Model $updated, array $education) :Model
    {
        foreach ($education as $key=> $value){
            if (str_contains($key, 'title') || str_contains($key, 'description')) {
                foreach ($value as $local=>$v) {
                    //activate only if they want to not add any new language from update
//                    if(property_exists($k,$updated[$key]) ||property_exists($k,$updated[$key])){
//                        $updated[$key][$k]=$v;
//                    }
                    $updated->setTranslation($key, $local, $v);
                }
            }
            if (array_key_exists($key, $updated->getAttributes())) {
                $updated[$key] = $value;
            }
        }
        $updated->save();
        return $updated;
    }
}
