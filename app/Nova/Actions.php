<?php

namespace App\Nova;

use Laravel\Nova\Actions\Action as NovaAction;

abstract class Action extends NovaAction
{
    public $withoutActionEvents = true;
}
