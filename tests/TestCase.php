<?php

namespace Tests;

use App\Models\Product;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createUser()
    {
        $user = User::factory()->create();
        return $user;
    }
    public function createProduct()
    {
        $product = Product::factory()->create();
        return $product;
    }
    public function createSubject()
    {
        $subject = Subject::factory()->create();
        return $subject;
    }
}
