<?php

use App\Models\Volunteer;

test('volunteer factory creates valid volunteer instance', function () {
    $volunteer = Volunteer::factory()->make();

    expect($volunteer)->toBeInstanceOf(Volunteer::class);
    expect($volunteer->first_name)->toBeString()->not()->toBeEmpty();
    expect($volunteer->last_name)->toBeString()->not()->toBeEmpty();
    expect($volunteer->email)->toBeString()->not()->toBeEmpty();
    expect($volunteer->phone_number)->toBeString()->not()->toBeEmpty();
});

test('volunteer factory generates multiple valid volunteers with unique emails', function () {
    $volunteers = collect();
    for ($i = 0; $i < 5; $i++) {
        $volunteers->push(Volunteer::factory()->make());
    }

    expect($volunteers)->toHaveCount(5);

    // Extract emails to verify uniqueness
    $emails = $volunteers->pluck('email')->toArray();
    $uniqueEmails = array_unique($emails);

    expect(count($uniqueEmails))->toBe(5);

    // Verify each record has valid data
    $volunteers->each(function ($volunteer) {
        expect($volunteer->first_name)->toBeString()->not()->toBeEmpty();
        expect($volunteer->last_name)->toBeString()->not()->toBeEmpty();
        expect($volunteer->email)->toMatch('/^[a-zA-Z0-9._%+-]+@example\.(com|net|org)$/');
        expect($volunteer->phone_number)->toBeString()->not()->toBeEmpty();
    });
});

test('volunteer factory uses correct faker methods', function () {
    $volunteer = Volunteer::factory()->make();

    // Verify firstName() produces valid first names
    expect($volunteer->first_name)->toBeString()->not()->toBeEmpty();

    // Verify lastName() produces valid last names
    expect($volunteer->last_name)->toBeString()->not()->toBeEmpty();

    // Verify unique()->safeEmail() produces valid email
    expect($volunteer->email)->toMatch('/^[a-zA-Z0-9._%+-]+@example\.(com|net|org)$/');

    // Verify phoneNumber() produces valid format
    expect($volunteer->phone_number)->toBeString()->not()->toBeEmpty();
});
