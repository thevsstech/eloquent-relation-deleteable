<?php


namespace TheVss\Eloquent;


use Illuminate\Database\Eloquent\Model;

class RelationDeleteHelper
{

    private function checkMethodExists(Model $model, $relation){
        if (!method_exists($model, $relation)) {
            throw new \Exception(
                sprintf( "%s relation is not exists on %s model", $relation, get_class($model))
            );
        }
    }

    /**
     * @param Model $model
     * @param array $relations
     * @throws \Exception
     */
    public function deleteRelations(Model $model, array $relations)
    {
        foreach ($relations as $relation){
            $this->checkMethodExists($model, $relation);

            // delete the relation
            $model->{$relation}()->delete();
        }
    }

    /**
     * @param Model $model
     * @param array $relations
     * @throws \Exception
     */
    public function deleteForceRelations(Model $model, array $relations)
    {
        foreach ($relations as $relation){
            $this->checkMethodExists($model, $relation);

            $relation = $model->{$relation}();


            // the user may have added these by accident so before proceed check if forceDelete method exists on given table
            if (method_exists($relation, 'forceDelete')) {
                $relation->forceDelete();
            }else{
                $relation->delete();
            }
        }
    }
}
