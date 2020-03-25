<?php

namespace App\Services\Member;


use App\Models\Product;

interface MemberServiceInterface
{


    public function index();
    public function store($data);
    public function update($model, $data);
    public function destroy($model, $data);
    public function create();
    public function edit();
}
