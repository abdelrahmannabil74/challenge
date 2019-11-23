<?php


namespace App\Filters;


class UserFilters
{

    public function filter($users,$filters)
    {
       $users = array_filter($users,function ($user) use ($filters)
       {
           if(isset($filters['currency']) && !$this->filterByCurrency($filters['currency'],$user['currency']))
               return false;
           if(isset($filters['status']) && !$this->filterByStatus($filters['status'],$user['status']))
               return false;
           if(isset($filters['balance_min']) && isset($filters['balance_max']) && !$this->filterByBalance($filters['balance_min'],$filters['balance_max'],$user['balance']))
               return false;
           return true;
       });

        return array_values($users);
    }


    public function filterByCurrency($currency,$filter)
    {
        return ($currency == $filter);
    }

    public function filterByStatus($status,$filter)
    {
        return ($status == $filter);
    }

    public function filterByBalance($min,$max,$balance)
    {
        return ($min <= $balance && $max >= $balance);
    }
}
