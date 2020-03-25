<?php

namespace App\Services\Staff;


use App\Models\Product;

interface StaffServiceInterface
{


    public function index();
    public function store($data);
    public function update($model, $data);
    public function destroy($model, $data);
    public function create();
    public function edit();
}
