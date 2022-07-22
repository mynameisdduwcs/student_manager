<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    private $entity;

    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function paginate($number = 5)
    {
        return $this->model->paginate($number);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function upload(StudentRequest $request)
    {

        $data = $request->all();
        if ($request->has('image')) {
            $file = $request->file('image');
            $destinationPath = 'uploads';
            $file_name = $file->move($destinationPath, $file->getClientOriginalName());

        }
    }

    public function pluck($value, $key)
    {
        return $this->model->pluck($value, $key);
    }

    public function findBy($attribute, $value, $shouldThrowException = true)
    {
        $query = $this->entity->where($attribute, $value);

        return $shouldThrowException ? $query->firstOrFail() : $query->first();
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return $this->model->query();
    }
}
