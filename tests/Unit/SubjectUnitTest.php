<?php
use App\Http\Controllers\SubjectController;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

describe("Subject Controller Unit Test", function () {
    test("get method ", function () {
        $controller = new SubjectController();

        $response = $controller->index();
        expect($response->status())->toBe(200);
    });

    test('store method processes request data', function () {
        $request = [
            'name' => 'Test subject',
            'version' => 'v5',
        ];
    
        $controller = new SubjectController();
    
        $response = $controller->store(new Request($request));
    
        expect($response->getStatusCode())->toBe(201);
        expect(Subject::where($request)->exists())->toBeTrue();
    });

    test('show method process request data', function () {
        $controller = new SubjectController();
        $subject = $this->createSubject();

        $response = $controller->show($subject->id);

        expect($response->status())->toBe(200);
        expect($response->getData()->id)->toBe($subject->id);
        expect($response->getData()->name)->toBe($subject->name);

    });

    test('update method process request data', function () {
        $controller = new SubjectController();
        $subject = $this->createSubject();
        $request = [
            'name' => 'update subject',
            'version' => 'v5',
        ];

        $response = $controller->update(new Request($request), $subject->id);

        expect($response->status())->toBe(200);

        $updatedSubject = Subject::find($subject->id);

    // Assert that the product's name and price have been updated
    expect($updatedSubject->name)->toBe('update subject');
    expect($updatedSubject->version)->toBe('v5');
    });

    test('delete method ', function () {
        $controller = new SubjectController();
        $subject = $this->createSubject();
        $response = $controller->destroy($subject->id);

        expect($response->status())->toBe(200);
        expect(Subject::find($subject->id))->toBeNull();
    });
});