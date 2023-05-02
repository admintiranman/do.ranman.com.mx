<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\vOrganization;
use Illuminate\Support\Facades\DB;

class Organization
{
    protected $data;
    protected $root;
    protected $control_id;

    public function __construct($user_id = 1, $control_id)
    {
        $this->data = [];
        $this->root = User::find($user_id);
        $this->control_id = $control_id;
    }

    public function chart_data()
    {
        $this->chart_data_recursive($this->root);
        if (count($this->data) > 0) {
            $this->data[0]->reporta = null; // el primero se marca como null
            $this->data[0]->color = "#d0cece";
        }
        return $this->data;
    }

    protected function chart_data_recursive(User $current)
    {
        $this->data[] = $this->get_info_user($current->id);
        foreach ($current->team()->get() as $u) {
            $this->chart_data_recursive($u);
        }
    }

    protected function get_info_user($id)
    {
        return DB::select("select * from [fn_UserEvaluation](:control_id) where [user_id] = :user_id", [":control_id" => $this->control_id, ":user_id" => $id])[0];        
        // return vOrganization::where('user_id', $id)->first();        
    }


    public static function bi_9box($user_id = 1)
    {
        $user = User::find($user_id);
        $data = [];
        self::bi_9box_recursive($user, $data);
        return array_slice($data, 1);
    }

    protected static function bi_9box_recursive(User $user, &$data)
    {
        $data[] = $user->name;
        foreach ($user->profile->team()->get() as $p) {
            self::bi_9box_recursive($p->user, $data);
        }
    }
    
}
