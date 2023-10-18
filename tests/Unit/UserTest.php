<?php
use App\Models\User;

describe("it is a practice test for user", function () {
    it('sum function', function (int $a, int $b, int $result) {
        expect($a + $b)->toBe($result);
    })->with(['positive numbers' => [1, 2, 3]]);

    it('test user api', function () {
        $response = $this->get("api/user");
        $response->assertStatus(200);
    });
    // it('user create', function() {
    //     $user = User::factory()->create();
    // });
});
