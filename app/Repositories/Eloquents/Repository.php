<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 08/11/2017
 * Time: 16:38
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RepositoryInterface;
use Carbon\Carbon;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\InteractsWithTime;
use Mockery\Exception;

abstract class Repository implements RepositoryInterface
{
    const NOT_DELETED = 0;
    const DELETED = 1;

    use InteractsWithTime;

    /**
     * @var
     */
    protected $model;

    /**
     * @var App
     */
    private $app;

    private $conditions;

    /**
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->setConditions();
        $this->makeModel();
        $this->applyConditions();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * Applies the given where conditions to the model.
     *
     * @param array $where
     * @return void
     */
    public function applyConditions()
    {
        if (!empty($this->conditions)) {
            foreach ($this->conditions as $field => $value) {
                if (is_array($value)) {
                    list($field, $condition, $val) = $value;
                    $this->model = $this->model->whereNull($field);
                } else {
                    $this->model = $this->model->where($field, '=', $value);
                }
            }
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function resetModel()
    {
        $this->makeModel();
        $this->applyConditions();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->update(['deleted_at' => Carbon::now()->timestamp], $id);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $filter
     * @param array $columns
     * @return mixed
     */
    public function findBy($filter, $columns = array('*'))
    {
        foreach ($filter as $condition => $value) {
            $breakPos = strpos($condition, ':');
            if (!$breakPos) {
                $relation = '=';
            } else {
                $relation = substr($condition, $breakPos + 1);
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
    public function finds($filter, $columns = array('*'))
    {
        foreach ($filter as $condition => $value) {
            $breakPos = strpos($condition, ':');
            if (!$breakPos) {
                $relation = '=';
            } else {
                $relation = substr($condition, $breakPos + 1);
                $condition = substr($condition, 0, $breakPos);
            }

            $this->model = $this->model->where($condition, $relation, $value);
        }

        return $this->model->get($columns);
    }

    /**
     * @return mixed
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param mixed $conditions
     */
    public function setConditions($conditions = array(array('deleted_at', 'IS', 'NULL')))
    {
        $this->conditions = $conditions;
    }
}