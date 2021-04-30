<?php

namespace Tadcms\Lararepo\Repositories;

abstract class EloquentRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    public function __construct()
    {
        $this->model = app()->make($this->model());
    }
    
    abstract public function model();
    
    public function newModel()
    {
        return (new $this->model());
    }
    
    /**
     * Get one Collection model
     * Or false if not exists
     *
     * @param int|\Illuminate\Database\Eloquent\Model $id
     * @param array $columns
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*'])
    {
        return is_numeric($id) ? $this->model->find($id, $columns) : $id;
    }
    
    /**
     * Get one Collection model
     * Or fail if not exists
     *
     * @param int|\Illuminate\Database\Eloquent\Model $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return is_numeric($id) ? $this->model->findOrFail($id, $columns) :
            $id;
    }
    
    /**
     * Get one Collection model
     * Or New model if not exists
     *
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrNew(array $conditions)
    {
        return $this->model->firstOrNew($conditions);
    }
    
    /**
     * Create model by attributes
     * You must add fillable to model
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
    
    /**
     * Update model by id
     * You must add fillable to model
     *
     * @param int $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        
        return false;
    }
    
    public function updateOrCreate(array $conditions, array $values = [])
    {
        $model = $this->getWhereFirst($conditions, ['id']);
        if ($model) {
            return $this->update($model->id,
                array_merge($conditions, $values));
        }
        
        return $this->create(array_merge($conditions, $values));
    }
    
    /**
     * Delete model by id
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        
        return false;
    }
    
    public function getWhere(array $conditions, $columns = ['*'], $with = [])
    {
        return $this->model->with($with)
            ->where($conditions)
            ->get($columns);
    }
    
    public function getWhereFirst(array $conditions, $columns = ['*'], $with = [])
    {
        return $this->model->with($with)
            ->where($conditions)
            ->first($columns);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * */
    public function query()
    {
        return $this->model;
    }
    
    public function exists(array $conditions)
    {
        return $this->model
            ->where($conditions)
            ->exists();
    }
}