<?php


namespace TheVss\Eloquent;



trait RelationDeleteableTrait
{

    /**
     * return deleteable relations
     *
     * @return array
     */
    public function getDeleteableRelations()
    {
        return $this->deleteable ?? [];
    }


    /**
     * @return array
     */
    public function getForceDeleteableRelations()
    {
        return $this->forceDeleteable ?? [];
    }

    /**
     * Boot the Blameable service by attaching
     * a new observer into the current model object.
     *
     * @return
     */
    public static function bootRelationDeleteableTrait()
    {
        static::observe(RelationDeleteObserver::class);
    }
}
