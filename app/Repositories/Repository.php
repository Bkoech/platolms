<?php 

namespace App\Repositories;

class Repository
{

	/**
	 * Retrieve a single entity
	 */
    public function find($model, $idOrIds)
    {
    	return $model::find($idOrIds);
    }

	/**
	 * Retrieve a single entity by values
	 */
    public function findOneBy($model, $field, $value)
    {
    	return $model::where($field, $value)->first();
    }

	/**
	 * Retrieve a collection of records
	 */
    public function findAll($model)
    {
        return $model::all();
    }

	/**
	 * Retrieve a collection of records by 
	 */
    public function findAllBy($model, $scopes)
    {
        return $model::where($scopes)->get();
    }

	/**
	 * Retrieve paginated records
	 */
    public function paginate($model, $scopes, $perPage, $withTrashed)
    {
    	if ($withTrashed)
    	{
	    	return $model::where($scopes)->withTrashed()->paginate($perPage);
    	}

    	return $model::where($scopes)->paginate($perPage);
    }
 
	/**
	 * Create a record
	 */
    public function create($table, array $data)
    {
        unset($data['_token']);
        unset($data['_method']);
    	return \DB::table($table)->insertGetId($data);
    }
 
	/**
	 * Update the record
	 */
    public function update($model, $id, array $data)
    {
        unset($data['_token']);
        unset($data['_method']);
    	return $model::where('id', $id)->update($data);
    }

	/**
	 * Delete the record
	 */
    public function delete($model, $idOrIds)
    {
    	return $model::destroy($idOrIds);
    }

}
