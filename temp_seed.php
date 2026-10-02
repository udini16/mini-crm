for ($i=0; $i<20; $i++) {
    $company = \App\Models\Company::inRandomOrder()->first();
    if (!$company) {
        echo "No companies found.\n";
        break;
    }
    \App\Models\Employee::create([
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'company_id' => $company->id,
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->phoneNumber()
    ]);
}
echo "20 employees added.\n";
