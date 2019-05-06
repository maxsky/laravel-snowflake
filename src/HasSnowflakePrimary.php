<?php

namespace Snowflake;

trait HasSnowflakePrimary {

    public static function bootHasSnowflakePrimary() {
        static::saving(function ($model) {
            if (is_null($model->getKey())) {
                $keyName = $model->getKeyName();
                $id = app(Snowflake::class)->next();
                $model->setAttribute($keyName, $id);
            }
        });
    }

}
