<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddHasManyModel extends Action
{
    use InteractsWithQueue, Queueable;

    protected $resourceId;
    protected $fields;
    protected $modelName;
    protected $parentModel;

    public function __construct($modelName, $parentModel, $resourceId)
    {
        $this->resourceId = $resourceId;
        $this->modelName = $modelName;
        $this->parentModel = $parentModel;
    }

    public $name = 'Tambah';

    public function addFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
            $model = app('App\Models\\'.Str::studly($this->modelName));
            foreach ($this->fields as $field) {
                if (($field->resourceClass ?? null) == null)
                    $model->{$field->attribute} = $fields->{$field->attribute};
            }
            $model->{Str::snake($this->parentModel. " id")} = $this->resourceId;
            $model->save();        
    }
    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return $this->fields;
    }

    
}