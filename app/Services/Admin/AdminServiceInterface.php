<?php

namespace App\Services\Admin;


use App\Models\Product;

interface AdminServiceInterface
{


    public function index();
    public function store($data);
    public function update($model, $data);
    public function destroy($model, $data);
    public function create();
    public function edit();
}
