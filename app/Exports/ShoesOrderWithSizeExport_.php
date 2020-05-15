<?php


namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShoesOrderWithSizeExport_ implements FromCollection
{
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        //return User::all();
        return $this->query->get();
    }
}
