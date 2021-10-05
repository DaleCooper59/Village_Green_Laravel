<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleGod extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initRolesAndPermissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'give all permission to god role';

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
        Role::create(['name' => 'god']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'supply']);
        Role::create(['name' => 'service commercial']);
        Role::create(['name' => 'sellsman']);
        Role::create(['name' => 'user']);        
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'add']);
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'customer']);
        
        //god
        $role = Role::whereName('god')->first();
        $permissions = Permission::all();
        $role->syncPermissions($permissions);
        
        $roleAll = Role::all();
        $permissionRead = Permission::whereName('read')->first();
        $permissionRead->syncRoles($roleAll);
    }
}
