<?php


namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use function config;

class ShoesOrderWithSizeExport implements FromView
{
    public function __construct($query, $size_oders)
    {
        $this->query = $query;
        $this->size_oders = $size_oders;
    }

    public function view(): View
    {
        return view(config('theme.staff.view').'mh.export.shoes_order_with_size',
            [
                'shoes_orders' => $this->query->get(),
                'size_oders' => $this->size_oders
            ]);
    }
}
