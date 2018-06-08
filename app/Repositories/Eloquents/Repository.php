<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 08/11/2017
 * Time: 16:38
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Mockery\Exception;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute="id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->update(['del_flg' => 1], $id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $filter
     * @param array $columns
     * @return mixed
     */
    public function findBy($filter, $columns = array('*')) {
        foreach ($filter as $condition => $value) {
            $breakPos = strpos($condition, ':');
            if (!$breakPos) {
                $relation = '=';
            } else {
                $relation  = substr($condition, $breakPos + 1);
                $condition = substr($condition, 0, $breakPos);
            }

            $this->model = $this->model->where($condition, $relation, $value);
        }

        return $this->model->first($columns);
    }

    /**
     * @param $filter
     * @param array $columns
     * @return mixed
     */
    public function finds($filter, $columns = array('*')) {
        foreach ($filter as $condition => $value) {
            $breakPos = strpos($condition, ':');
            if (!$breakPos) {
                $relation = '=';
            } else {
                $relation  = substr($condition, $breakPos + 1);
                $condition = substr($condition, 0, $breakPos);
            }

            $this->model = $this->model->where($condition, $relation, $value);
        }

        return $this->model->get($columns);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function makeModel() {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model)
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model->newQuery()->where('del_flg', '=', 0);
    }
}