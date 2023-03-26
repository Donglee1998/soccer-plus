<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RegistrationRepositoryInterface;
use App\Services\QueryService;
use Illuminate\Http\Request;
use DB;

class RegistrationRepository extends BaseRepository implements RegistrationRepositoryInterface
{
    public function model()
    {
        return \App\Models\Registration::class;
    }

    public function querylist(Request $request)
    {
        $limit  = config('constants.limit');
        $builder = $this->model->select('registrations.id', 'registrations.corp_name', 'registrations.name', 'registrations.updated_at', 'teams.id as team_id');
        $builder = $builder->leftJoin('teams', function($join){
            $join->on('teams.id', '=', DB::raw("(SELECT min(id) from teams WHERE teams.created_by = registrations.id and teams.is_home = 1 and deleted_at is NULL)"));
        });
        if ($request->search) {
            $builder = $builder->where('registrations.name', 'LIKE', '%'. $request->search . '%')
            ->orWhere('corp_name', 'LIKE', '%'. $request->search . '%')
            ->orWhere('pic_name', 'LIKE', '%'. $request->search . '%');
        }
        $builder = $builder->orderBy('registrations.id', 'desc');
        return $builder->paginate($limit);
    }

    public function getWebLogin($username = '')
    {
        $builder = $this->model->select('id', 'email', 'username', 'password', 'name', '.type');
        $builder = $builder->where('contract_status', config('constants.contract_status.key.contract'));
        $builder = $builder->where('username', $username);
        return $builder->first();
    }

    public function findByEmail($email)
    {
        $builder = $this->model->select('id', 'email', 'username');
        $builder = $builder->where('email', $email);
        return $builder->first();
    }

     public function getAppLogin($username = '')
    {
        $builder = $this->model->select('registrations.id', 'registrations.email', 'username', 'password', 'registrations.name', 'registrations.type', 'teams.id as team_id');
        $builder = $builder->leftJoin('teams', function($join){
            $join->on('registrations.id', '=', 'teams.created_by')
                 ->where('teams.is_home', '=', config('constants.is_home'));
        });
        $builder = $builder->where('contract_status', config('constants.contract_status.key.contract'));
        $builder = $builder->where('username', $username);
        return $builder->first();
    }
}
