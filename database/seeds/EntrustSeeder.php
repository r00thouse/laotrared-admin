<?php


use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();
        try {
            /*
             * Resources will be like create, read, update, delete
             * Network, Nodes, Users
             */
            $createNetwork = new Permission();
            $createNetwork->name = 'create_network';
            $createNetwork->display_name = 'create_network';
            $createNetwork->save();
            $readNetwork = new Permission();
            $readNetwork->name = 'read_network';
            $readNetwork->display_name = 'read_network';
            $readNetwork->save();
            $updateNetwork = new Permission();
            $updateNetwork->name = 'update_network';
            $updateNetwork->display_name = 'update_network';
            $updateNetwork->save();
            $deleteNetwork = new Permission();
            $deleteNetwork->name = 'delete_network';
            $deleteNetwork->display_name = 'delete_network';
            $deleteNetwork->save();

            $createNode = new Permission();
            $createNode->name = 'create_node';
            $createNode->display_name = 'create_node';
            $createNode->save();
            $readNode = new Permission();
            $readNode->name = 'read_node';
            $readNode->display_name = 'read_node';
            $readNode->save();
            $updateNode = new Permission();
            $updateNode->name = 'update_node';
            $updateNode->display_name = 'update_node';
            $updateNode->save();
            $deleteNode = new Permission();
            $deleteNode->name = 'delete_node';
            $deleteNode->display_name = 'delete_node';
            $deleteNode->save();

            $createUser = new Permission();
            $createUser->name = 'create_user';
            $createUser->display_name = 'create_user';
            $createUser->save();
            $readUser = new Permission();
            $readUser->name = 'read_user';
            $readUser->display_name = 'read_user';
            $readUser->save();
            $updateUser = new Permission();
            $updateUser->name = 'update_user';
            $updateUser->display_name = 'update_user';
            $updateUser->save();
            $deleteUser = new Permission();
            $deleteUser->name = 'delete_user';
            $deleteUser->display_name = 'delete_user';
            $deleteUser->save();

            $adminRole = new Role();
            $adminRole->name = 'admin';
            $adminRole->display_name = 'Admin';
            $adminRole->description = 'System admin';
            $adminRole->save();
            $adminRole->attachPermissions([$createNetwork, $readNetwork, $updateNetwork, $deleteNetwork]);
            $adminRole->attachPermissions([$createNode, $readNode, $updateNode, $deleteNode]);
            $adminRole->attachPermissions([$createUser, $readUser, $updateUser, $deleteUser]);

            $managerRole = new Role();
            $managerRole->name = 'manager';
            $managerRole->display_name = 'Manager';
            $managerRole->description = 'Manager';
            $managerRole->save();
            $managerRole->attachPermissions([$readNetwork, $updateNetwork, $deleteNetwork]);
            $managerRole->attachPermissions([$createNode, $readNode, $updateNode, $deleteNode]);

            $commonRole = new Role();
            $commonRole->name = 'common';
            $commonRole->display_name = 'Common User';
            $commonRole->description = 'Default role for all users';
            $commonRole->save();
            $commonRole->attachPermissions([$createNode, $readNode, $updateNode, $deleteNode]);


            $adminUser = new User();
            $adminUser->name = 'Le administrador';
            $adminUser->email = 'admin@foo.com';
            $adminUser->password = bcrypt('12345');
            $adminUser->save();
            $adminUser->attachRole($adminRole);

            $managerUser = new User();
            $managerUser->name = 'El mero';
            $managerUser->email = 'manager@foo.com';
            $managerUser->password = bcrypt('12345');
            $managerUser->save();
            $managerUser->attachRole($managerRole);

            $commonUser = new User();
            $commonUser->name = 'Foo';
            $commonUser->email = 'foo@foo.com';
            $commonUser->password = bcrypt('12345');
            $commonUser->save();
            $commonUser->attachRole($commonRole);

            echo 'Finished ';
            DB::commit();
        } catch(Exception $e) {
            echo 'Rollback\n';
            DB::rollback();
        }
    }
}
