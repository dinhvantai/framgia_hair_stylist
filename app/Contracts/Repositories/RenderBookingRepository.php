<?php

namespace App\Contracts\Repositories;

interface RenderBookingRepository extends AbstractRepository
{
    public function create($data = []);
}