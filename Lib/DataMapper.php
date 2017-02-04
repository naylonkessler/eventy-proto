<?php

namespace Lib;

use Lib\App;

/**
 * Data mapper class.
 */
class DataMapper
{
    /**
     * PDO adapter.
     *
     * @var \PDO
     */
    protected $pdo;

    /**
     * Single instance of class.
     *
     * @var \Lib\PubSub
     */
    private static $instance;

    /**
     * Hidden constructor. Initilize the the PDO adapter.
     */
    private function __construct()
    {
        $databasePath = ROOT.'/database/database.sqlite3';

        $this->pdo = new \PDO("sqlite:{$databasePath}");
    }

    /**
     * Return all row from database table.
     *
     * @param  \Lib\Model  $model
     * @return \Lib\Model[]
     */
    public function all(Model $model)
    {
        $sql = "SELECT * FROM {$model->table};";
        $results = [];

        $query = $this->pdo->prepare($sql);
        $query->execute();

        while ($result = $query->fetchObject(get_class($model))) {
            $results[] = $result;

            $this->publish('read', $result);
        }

        $this->publish('read-all', $model, $results);

        return $results;
    }

    /**
     * Delete a row from database.
     *
     * @param  \Lib\Model  $model
     * @return boolean
     */
    public function delete(Model $model)
    {
        $sql = "DELETE FROM {$model->table} WHERE id = ?";

        $this->publish('delete', $model);

        $deleted = $this->pdo->prepare($sql)
                            ->execute([$model->id]);

        if ($deleted) {
            $this->publish('deleted', $model);
        }

        return $deleted;
    }

    /**
     * Return filtered rows from database table.
     *
     * @param  array  $criteria
     * @param  \Lib\Model  $model
     * @return \Lib\Model[]
     */
    public function filter(array $criteria, Model $model)
    {
        extract($this->filterBindings($criteria));

        $sql = "SELECT * FROM {$model->table} WHERE {$where};";
        $results = [];

        $query = $this->pdo->prepare($sql);
        $query->execute($values);

        while ($result = $query->fetchObject(get_class($model))) {
            $results[] = $result;

            $this->publish('read', $result);
        }

        $this->publish('read-filter', $model, $results);

        return $results;
    }

    /**
     * Return all row from database table.
     *
     * @param  integer  $id
     * @param  \Lib\Model  $model
     * @return \Lib\Model
     */
    public function find($id, Model $model)
    {
        $sql = "SELECT * FROM {$model->table} WHERE id = ?;";

        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);

        $result = $query->fetchObject(get_class($model));

        if ($result) {
            $this->publish('read', $result);
        }

        return $result;
    }

    /**
     * Insert a row on database.
     *
     * @param  \Lib\Model  $model
     * @return boolean
     */
    public function insert(Model $model)
    {
        extract($this->insertBindings($model->toArray()));

        $sql = "INSERT INTO {$model->table}({$fields}) VALUES({$holders});";

        $this->publish('insert', $model);

        $inserted = (boolean)$this->pdo->prepare($sql)
                                    ->execute($values);

        if ($inserted) {
            $model->id = $this->pdo->lastInsertId();

            $this->publish('inserted', $model);
        }

        return $inserted;
    }

    /**
     * Singleton method. Return a single instance of class.
     *
     * @return \Lib\DataMapper
     */
    public static function instance()
    {
        if ( ! static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Update a row on database.
     *
     * @param  \Lib\Model  $model
     * @return boolean
     */
    public function update(Model $model)
    {
        extract($this->updateBindings($model->toArray()));

        $sql = "UPDATE {$model->table} SET {$fields} WHERE id = ?;";

        $this->publish('update', $model);

        $updated = (boolean)$this->pdo->prepare($sql)
                                    ->execute($values);

        if ($updated) {
            $this->publish('updated', $model);
        }

        return $updated;
    }

    /**
     * Generate and return the bindings to filter.
     *
     * @param  array  $criteria
     * @return array
     */
    protected function filterBindings(array $criteria)
    {
        $where = implode(' = ? AND ', array_keys($criteria)).' = ?';
        $values = array_values($criteria);

        return compact('where', 'values');
    }

    /**
     * Generate and return the bindings to insert.
     *
     * @param  array  $data
     * @return array
     */
    protected function insertBindings(array $data)
    {
        $fields = implode(', ', array_keys($data));
        $holders = implode(', ', array_fill(0, count($data), '?'));
        $values = array_values($data);

        return compact('fields', 'holders', 'values');
    }

    /**
     * Publish an event.
     *
     * @param  string  $event
     * @param  \Lib\Model  $model
     * @param  \Lib\Model[]  $models
     * @return mixed
     */
    protected function publish($event, Model $model, array $models = [])
    {
        $class = get_class($model);

        return App::$pubSub->publish("model.{$event}: {$class}", $model, $models);
    }

    /**
     * Generate and return the bindings to update.
     *
     * @param  array  $data
     * @return array
     */
    protected function updateBindings(array $data)
    {
        $id = $data['id'];

        unset($data['id']);
        $fields = implode(' = ?, ', array_keys($data)).' = ?';
        $values = array_values($data);
        array_push($values, $id);

        return compact('fields', 'values');
    }
}
