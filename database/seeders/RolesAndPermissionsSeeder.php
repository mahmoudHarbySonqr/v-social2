<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder {

    public function run( ) {

        app( )[ PermissionRegistrar::class ] -> forgetCachedPermissions( );

        Permission::create( [ 'name' => 'edit'      ] ) ;
        Permission::create( [ 'name' => 'delete'    ] ) ;
        Permission::create( [ 'name' => 'publish'   ] ) ;
        Permission::create( [ 'name' => 'unpublish' ] ) ;

        Role::create( [ 'name' => 'writer'      ] ) -> givePermissionTo( 'edit'                      ) ;
        Role::create( [ 'name' => 'moderator'   ] ) -> givePermissionTo( [ 'publish' , 'unpublish' ] ) ;
        Role::create( [ 'name' => 'super-admin' ] ) -> givePermissionTo( Permission::all( )          ) ;

    }

}
