<?php

namespace Tests\Unit;

use App\Category;
use App\Repository\CategoryRelation\InsertCategoryRelation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InsertCategoryRelationTest extends TestCase
{
    use WithFaker, RefreshDatabase;
}
