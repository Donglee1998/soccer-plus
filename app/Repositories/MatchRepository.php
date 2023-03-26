<?php

namespace App\Repositories;
use App\Models\Lineup;
use App\Models\Stat;

class MatchRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\Tournament::class;
    }

    public function getList($condition = [], $columns = ['*'])
    {
        $builder = $this->model;
        $builder = $builder->select($columns);

        $builder = $builder->where('created_by', $condition['created_by']);

        $builder = $builder->when(!empty($condition['keyword']), function ($query) use ($condition) {
            $query = $query->where(function ($query2) use ($condition) {
                $query2->whereHas('team1', function ($query1) use ($condition) {
                    $query1->where('name', 'LIKE', "%{$condition['keyword']}%");
                })->orWhereHas('team2', function ($query1) use ($condition) {
                    $query1->where('name', 'LIKE', "%{$condition['keyword']}%");
                });
            });
        });

        $builder = $builder->when(!empty($condition['type_match']), function ($query) use ($condition) {
            $query->where('type', $condition['type_match']);
        });

        $builder = $builder->when((!empty($condition['start_date_match'])), function ($query) use ($condition) {
            $query->whereDate('start_date', '>=', $condition['start_date_match']);
        });

        $builder = $builder->when((!empty($condition['end_date_match'])), function ($query) use ($condition) {
            $query->whereDate('start_date', '<=', $condition['end_date_match']);
        });

        $builder = $builder->with([
            'team1' => function ($query) {
                $query->select('id', 'name', 'is_home', 'color_home', 'color_guest');
            },
            'team2' => function ($query) {
                $query->select('id', 'name', 'is_home', 'color_home', 'color_guest');
            }
        ]);

        $builder = $builder->orderBy('id', 'desc')->paginate(config('constants.limit'));

        return $builder;
    }

    public function getDetail($id)
    {
        $builder = $this->model;
        $builder = $builder->where('created_by', auth('web')->user()->id);
        return $builder->find($id);
    }

    public function findByIdWithRelationship($id)
    {
        $builder = $this->model;
        $builder = $builder->with([
            'team1' => function ($query) {
                $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
            },
            'team2' => function ($query) {
                $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
            },
        ]);

        return $builder->find($id);
    }

    public function findById($id)
    {
        $builder = $this->model;
        $builder = $builder->where('created_by', auth('api')->user()->id);
        return $builder->find($id);
    }

    public function getMatchStat($conditions, $id_team_home)
    {
        $builder = $this->model;

        $builder = $builder->where(function ($query) use ($conditions, $id_team_home) {
            $query = $query->where(function ($query1) use ($conditions, $id_team_home) {
                $query1 = $query1->where(function ($query2) use ($conditions, $id_team_home) {
                    $query2->where('team_id1', $id_team_home)
                      ->where('team_id2', $conditions['team'])
                      ->where('start_date', '>=', date("Y-m-d", strtotime($conditions['date_from'])))
                      ->where('start_date', '<=', date("Y-m-d", strtotime($conditions['date_to'])));
                });
            })->orWhere(function ($query1) use ($conditions, $id_team_home) {
                $query1 = $query1->where(function ($query2) use ($conditions, $id_team_home) {
                    $query2->where('team_id1', $conditions['team'])
                      ->where('team_id2', $id_team_home)
                      ->where('start_date', '>=', date("Y-m-d", strtotime($conditions['date_from'])))
                      ->where('start_date', '<=', date("Y-m-d", strtotime($conditions['date_to'])));
                });
            });
        });

        if ($conditions['type'] != 0) {
            $builder = $builder->where('type', $conditions['type']);
        }

        $builder = $builder->with([
            'team1' => function ($query) {
                $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
            },
            'team2' => function ($query) {
                $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
            },
        ]);

        return $builder;
    }

    public function getCommonInfo($match_id)
    {
        $match = $this->model->with([
            'team1' => function ($query) {
                $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
            },
            'team2' => function ($query) {
                $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
            },
            'lineup1',
            'lineup2',
        ])->find($match_id);

        $stats = Stat::select(
                'stats.id',
                'stats.member_id',
                'stats.action_id',
                'stats.result',
                'stats.created_at_round',
                'stats.member_anonymous_id',
                'members.first_name',
                'members.last_name',
                'members.team_id'
            )
            ->leftJoin('members', 'members.id', '=', 'stats.member_id')
            ->where('match_id', $match_id)->orderBy('timer_at')->get();

        $pd_options = (object) [];
        $pd_actions = config('constants.pbpv.pd_actions');
        foreach ($stats as $stat) {
            $round = $stat->created_at_round;
            if (!isset($pd_options->{$round})) {
                $pd_options->{$round} = (object) [
                    'members' => [],
                    'actions' => [],
                    'member_stats' => (object) [],
                    'action_stats' => (object) [],
                ];
            }

            if ($stat->member_id || $stat->member_anonymous_id) {
                $member_id = $stat->member_anonymous_id ? '?' : $stat->member_id;
                if (!isset($pd_options->{$round}->member_stats->{$member_id})) {
                    $pd_options->{$round}->member_stats->{$member_id} = [];
                    $pd_options->{$round}->members[] = (object) [
                        'id' => $member_id,
                        'value' => $member_id == '?' ? '?' : "$stat->first_name $stat->last_name",
                    ];
                }
                $pd_options->{$round}->member_stats->{$member_id}[] = $stat->id;
            }

            if (in_array($stat->action_id, $pd_actions)) {
                if (!isset($pd_options->{$round}->action_stats->{$stat->action_id})) {
                    $pd_options->{$round}->action_stats->{$stat->action_id} = [];
                    $pd_options->{$round}->actions[] = (object) [
                        'id' => $stat->action_id,
                        'value' => get_action_name_by_id($stat->action_id),
                    ];
                }
                $pd_options->{$round}->action_stats->{$stat->action_id}[] = $stat->id;
            }

            if (in_array($stat->action_id, array_merge(config('constants.pbpv.goal_actions'), ['40'])) && $stat->result == 1) {
                $goal = null;
                $receive_point = (object) config('constants.pbpv.receive_point');
                $lost_point = (object) config('constants.pbpv.lost_point');

                if ($match->team2->is_home) {
                    if ($stat->member_anonymous_id == -1) {
                        $goal = $lost_point;
                    } else if ($stat->member_anonymous_id == -2) {
                        $goal = $receive_point;
                    } else if ($stat->team_id == $match->team1->id) {
                        $goal = $lost_point;
                    } else if ($stat->team_id == $match->team2->id) {
                        $goal = $receive_point;
                    }
                } else {
                    if ($stat->member_anonymous_id == -1) {
                        $goal = $receive_point;
                    } else if ($stat->member_anonymous_id == -2) {
                        $goal = $lost_point;
                    } else if ($stat->team_id == $match->team1->id) {
                        $goal = $receive_point;
                    } else if ($stat->team_id == $match->team2->id) {
                        $goal = $lost_point;
                    }
                }

                if ($goal) {
                    if (!isset($pd_options->{$round}->action_stats->{$goal->id})) {
                        $pd_options->{$round}->action_stats->{$goal->id} = [];
                        $pd_options->{$round}->actions[] = (object) [
                            'id' => $goal->id,
                            'value' => $goal->name,
                        ];
                    }
                    $pd_options->{$round}->action_stats->{$goal->id}[] = $stat->id;
                }
            }
        }

        foreach ($pd_options as $round => &$val) {
            usort($val->actions, function($a, $b) use ($pd_actions) {
                return array_search($a->id, $pd_actions) - array_search($b->id, $pd_actions); 
            });
        }

        return (object) [
            'match' => $match,
            'stat_score' => $match->statScore(),
            'stat_goals' => $match->statGoal(),
            'pd_options' => $pd_options,
        ];
    }

    public function getListSync($condition = [])
    {
        $builder = $this->model;
        $builder = $builder->select('id', 'match_id');
        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        if (@$condition['uuid']) {
            $builder = $builder->where('uuid', $condition['uuid']);
        }
        if (@$condition['match_id']) {
            $builder = $builder->where('match_id', $condition['match_id']);
        }
        $builder = $builder->pluck('id', 'match_id')->toArray();
        return $builder;
    }

    public function deleteMatch($condition = [])
    {
        $builder = $this->model;

        if (!empty($condition['array_id_match']) && !empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by'])->whereIn('id', $condition['array_id_match'])->delete();
        }

        return true;
    }

    public function getListMatchByAuth($auth_id)
    {
        return $this->model->where('created_by', $auth_id);
    }
}
