<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Class\CustomSoftDeletingScope;

trait CustomSoftDeletes
{
    use SoftDeletes;

    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new CustomSoftDeletingScope);
    }

    protected function runSoftDelete()
    {
        $query = $this->setKeysForSaveQuery($this->newModelQuery());

        $time = $this->freshTimestamp();

        $columns = [$this->getDeletedAtColumn() => 0];

        $this->{$this->getDeletedAtColumn()} = 0;

        if ($this->usesTimestamps() && ! is_null($this->getUpdatedAtColumn())) {
            $this->{$this->getUpdatedAtColumn()} = $time;

            $columns[$this->getUpdatedAtColumn()] = $this->fromDateTime($time);
        }

        $query->update($columns);

        $this->syncOriginalAttributes(array_keys($columns));

        $this->fireModelEvent('trashed', false);
    }

    public function getDeletedAtColumn()
    {
        return 'enable';
    }
}