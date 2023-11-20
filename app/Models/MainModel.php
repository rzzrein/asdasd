<?php

namespace App\Models;

use DB;

trait MainModel
{
	/**
     * [createNew description]
     * @param  array   $data
     * @param  boolean $log
     * @return Object
     */
    public function createNew($data=[], $log=false)
    {
        $model = $this->create($data);
        return $model;
    }

    /**
     * Update Row by ID
     * @param  integer $id
     * @param  array  $data
     * @return Object
     */
    public function updateById($id, $data=[], $log=false)
    {
        $model = $this->findOrFail($id);
        $model->update($data);
        $changes = $model->getChanges();
        return $model;
    }

    /**
     * Delete Row by ID
     * @param  Int $id
     * @return Boolean
     */
    public function deleteById($id, $log=false)
    {
        $model = $this->findOrFail($id);
        return $model->delete();
    }

    /**
     * Find By Column
     * @param  string $key
     * @param  string $value
     * @return Object
     */
    public function findByColumn($key, $value)
    {
        return $this->where($key, $value)->first();
    }

	/**
     * [firstOrCreateWithLog description]
     * @param  array   $data
     * @param  boolean $log
     * @return Object
     */
    public function firstOrCreateWithLog($data=[], $log=false)
    {
        $model = $this->firstOrCreate($data);
        return $model;
    }

    /**
     * Find combine with where
     * @param  integer $id
     * @param  array  $where
     * @return Object
     */
    public function findWhere($id, $where=[])
    {
        $model = $this->where('id', $id);
        if (!empty($where)) {
            $model->where($where);
        }
        return $model->first();
    }
    



    /**
     * Query scope nPerGroup
     * 
     * @return void
     */
    public function scopeNPerGroup($query, $group, $n = 10)
    {
        // queried table
        $table = ($this->getTable());
 
        // initialize MySQL variables inline
        $query->from( DB::raw("(SELECT @rank:=0, @group:=0) as vars, {$table}") );
 
        // if no columns already selected, let's select *
        if ( ! $query->getQuery()->columns) 
        { 
            $query->select("{$table}.*"); 
        }
 
        // make sure column aliases are unique
        $groupAlias = 'group_'.md5(time());
        $rankAlias  = 'rank_'.md5(time());
 
        // apply mysql variables
        $query->addSelect(DB::raw(
            "@rank := IF(@group = {$group}, @rank+1, 1) as {$rankAlias}, @group := {$group} as {$groupAlias}"
        ));
 
        // make sure first order clause is the group order
        $query->getQuery()->orders = (array) $query->getQuery()->orders;
        array_unshift($query->getQuery()->orders, ['column' => $group, 'direction' => 'asc']);
 
        // prepare subquery
        $subQuery = $query->toSql();
 
        // prepare new main base Query\Builder
        $newBase = $this->newQuery()
            ->from(DB::raw("({$subQuery}) as {$table}"))
            ->mergeBindings($query->getQuery())
            ->where($rankAlias, '<=', $n)
            ->getQuery();
 
        // replace underlying builder to get rid of previous clauses
        $query->setQuery($newBase);
    }

}
