<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roles();
        $this->attach_roles();
        //
    }


    protected function roles() {
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Director']);
    }


    protected function attach_roles() {
        // example only test
        $user = User::where('email', 'angelzarate@valoran.com.mx')->first();
        if($user) {
            $user->assignRole('Administrador');
        }

        $user = User::where('email', 'sofiasaucedo@valoran.com.mx')->first();
        if ($user) {
            $user->assignRole('Administrador');
        }

        $user = User::where('email', 'oscarortiz@valoran.com.mx')->first();
        if ($user) {
            $user->assignRole('Director');
        }
    }
}
