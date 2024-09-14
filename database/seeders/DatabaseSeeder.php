<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Passport;
use App\Models\Educational;
use App\Models\Seniority;
use App\Models\StudentsParentFather;
use App\Models\StudentsParentMother;
use App\Models\Enrollment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $studentMax = config('factories.studentsCount');

        /**
         * Таблицы категорий
         */
        $this->call(CategoriesSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(EducationalInstitutionTypesSeeder::class);
        $this->call(EducationalDocTypesSeeder::class);
        $this->call(FinancingTypesSeeder::class);
        $this->call(FacultiesSeeder::class);
        $this->call(DecreesSeeder::class);
        $this->call(SpecialCircumstancesSeeder::class);
        $this->call(UsersSeeder::class);

        /**
         * Главная и второстепенные таблицы
         */
        /*Passport::factory($studentMax)->create();
        Student::factory($studentMax)->create();
        Educational::factory($studentMax)->create();
        Seniority::factory($studentMax)->create();
        StudentsParentFather::factory($studentMax)->create();
        StudentsParentMother::factory($studentMax)->create();
        Enrollment::factory($studentMax)->create();*/

        /**
         * Сводные таблицы
         */
        /*$this->call(InformationForAdmissionSeeder::class);
        $this->call(StudentSpecialCircumstanceSeeder::class);*/
    }
}
