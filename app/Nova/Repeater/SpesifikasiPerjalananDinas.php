<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SpesifikasiPerjalananDinas extends Repeatable
{
    public static function label()
    {
        return 'Item';
    }

    /**
     * Get the fields displayed by the repeatable.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Item', 'item')
                ->help('Misal: Uang Harian, Penginapan, Transportasi, dll')
                ->rules('required'),
            Number::make('Jumlah', 'jumlah')
                ->step(1)
                ->rules('required', 'integer', 'gt:0'),
            Text::make('Satuan', 'satuan')
                ->help('Misal: O-H, malam, O-P, dll')
                ->rules('required'),
            Currency::make('Harga Satuan', 'harga_satuan')
                ->step(1)
                ->rules('required', 'integer', 'gt:0'),
        ];
    }
}
