<?php

namespace TheVss\Eloquent;

use Illuminate\Database\Eloquent\Model;

class RelationDeleteObserver
{
    private $helper;

    public function __construct()
    {
        $this->helper = new RelationDeleteHelper();
    }

    public function deleted(Model $model){
        if (in_array(RelationDeleteableTrait::class, class_uses(get_class($model)))) {
            try {
                $this->helper->deleteRelations($model, $model->getDeleteableRelations());
                $this->helper->deleteForceRelations($model, $model->getForceDeleteableRelations());

            } catch (\Exception $e) {
            }
        }
    }
}
