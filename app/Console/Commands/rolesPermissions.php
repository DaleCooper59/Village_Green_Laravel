<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class rolesPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grant:role {user} {--role=} {--permission=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grant role to a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('username',$this->argument('user'))->first();
       
        $role = Role::where('name', $this->option('role'))->first();
        
        if ($role === null && $this->option('role')) {
            $role = Role::create([
                'name' => $this->option('role'),
                ]);
        }
        if ($role !== null && $user !== null) {
            $user->assignRole($role->id);
        }
        $permission = Permission::where('name',  $this->option('permission'))->first();
        if ($permission === null &&  $this->option('permission')) {
            $permission = Permission::create([
                'name' => $this->option('permission'),
            ]);
        }

        if ($permission!== null && $user !== null) {
            $user->givePermissionTo(  $this->option('permission'));
        }

    }
}
