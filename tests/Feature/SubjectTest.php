<?php

use App\Models\Subject;

describe("Test Subject", function () {
    it('it can create a subject using a factory', function () {
        $subject = $this->createSubject();
        expect($subject)->toBeInstanceOf(Subject::class);
        expect($subject->name)->not->toBeEmpty()->toBeString();
        expect($subject->version)->not->toBeEmpty();
        expect($subject->id)->not->toBeNull();
    });

    it("it can create a subject via API", function () {
        $subjectData = [
            "name" => "Bangla",
            "version" => "v2"
        ];
        $response = $this->post("api/subjects", $subjectData);
        $response->assertStatus(201);

        $subject = json_decode($response->getContent());

        expect($subject->version)->toBe("v2");
        expect($subject->name)->toBe("Bangla");
    });

    it("it can get all subject via API", function () {
        $subjects = $this->get("api/subjects");
        $subjects->assertStatus(200);
    });

    it("it can show subject base on id via API", function () {
        $subject = $this->createSubject();
        $response = $this->get("api/subjects/{$subject->id}");
        $response->assertStatus(200);
    });

    it("it can update subject via API", function () {
        $subject = $this->createSubject();
        $updateField = [
            "name" => "English",
            "version" => "v2"
        ];

        $response = $this->put("api/subjects/{$subject->id}", $updateField);
        $response->assertStatus(200);

        $updatedSubject = json_decode($response->getContent());

        expect($updatedSubject->name)->not->toBe($subject->name)->toBe("English");
        expect($updatedSubject->version)->not->toBe($subject->version)->toBe("v2");

    });
    it("it can delete subject via APi", function () {
        $subject = $this->createSubject();
        $response = $this->delete("api/subjects/{$subject->id}");
        $response->assertStatus(200);
    });
});
