<?php
require_once(APPPATH . 'core/Rafeed_controller.php');
class Permissions extends Rafeed_Controller {

    public function create_permissions_table()
    {
        $permissions = array(
            array(
                "name"=>"user_view",
                "display_name"=>"user_view",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"user_edit",
                "display_name"=>"user_edit",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"user_create",
                "display_name"=>"user_create",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"role_view",
                "display_name"=>"role_view",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"role_add",
                "display_name"=>"role_add",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"role_edit",
                "display_name"=>"role_edit",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"employee_view",
                "display_name"=>"employee_view",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"employee_add",
                "display_name"=>"employee_add",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"employee_edit",
                "display_name"=>"role_add",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"customer_view",
                "display_name"=>"employee_view",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"customer_add",
                "display_name"=>"Add Customer ",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"customer_edit",
                "display_name"=>"customer_edit",
                "description"=>"",
                "status"=>"1"
            )  ,
            array(
                "name"=>"regulation_view",
                "display_name"=>"Regulation",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"certification_edit",
                "display_name"=>"Certiication",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"service_edit",
                "display_name"=>"Service",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"order_view",
                "display_name"=>"View order",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"order_add",
                "display_name"=>"Add Order",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"order_edit",
                "display_name"=>"Edit order",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"invoice_view",
                "display_name"=>"View invoice",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"invoice_add",
                "display_name"=>"Add invoice",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"invoice_edit",
                "display_name"=>"Edit invoice",
                "description"=>"",
                "status"=>"1"
            ),
            array(
                "name"=>"activity_view",
                "display_name"=>"View order activity",
                "description"=>"",
                "status"=>"1"
            )
            ,
            array(
                "name"=>"activity_add",
                "display_name"=>"Add order activity",
                "description"=>"",
                "status"=>"1"
            )
        );
        $role_id=null;
        $role = $this->db->get_where('role',['name'=>'adminstrator'])->row(0);
        if($role)
        {
            $role_id = $role->id;
        }else{
            $role = array(
                'name'=>'adminstrator',
                'display_name'=>'Super Admin',
                'status'=>'1',
                'description'=>'adminstrator has full permission'
            );
            $role_id = $this->db->insert("role",$role)==true?$this->db->insert_id():null;
        }
        foreach($permissions as $permission)
        {
            if($this->db->get_where('permission',['name'=>$permission['name']])->row(0)==null)
            {
                $this->db->insert('permission',$permission);
                $role_permission = array(
                    'permission_id'=>$this->db->insert_id(),
                    'role_id'=>$role_id
                );
                $this->db->insert('role_permission',$role_permission);
            }
        }
        $user = $this->db->get_where('user',['Username'=>'administrator'])->row(0);
        $user_id = null;
        if($user)
        {
            $user_id = $user->ID;
        }
        else  {
            $user = array(
                'Username'=>'administrator',
                'Password'=>md5('admin'),
                'Active'=>1,
                'status'=>1
            );
            $this->db->insert('user',$user);
            $user_id = $this->db->insert_id();
        }
        $user_role = array(
            'user_id'=>$user_id,
            'role_id'=>$role_id
        );
        $this->db->insert('user_role',$user_role);
        echo "done";
    } 
}