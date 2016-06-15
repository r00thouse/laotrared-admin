<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->name = 'Palito Ortega';
        $user1->email = 'foo@bar.ken';
        $user1->password = \Hash::make('12345');
        $user1->save();
    }
}
