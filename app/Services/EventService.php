<?php

namespace App\Services;
use DB;
use Carbon\Carbon;
use App\User;
use App\Smslogs;
use App\UserEvents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Database\Query\Builder;

class EventService{

    protected $EventService = null;
    

    public function getEvents(Request $request, $count ='20')
    {
        $user = \Auth::user();
        $pageEvents = $request->get('page') ? $request->get('page') : 1;
        $q = trim($request->get('search'));
        $filter = (object)[];
        //DB::enableQueryLog();
        $data = UserEvents::select(DB::raw('user_events.*'))
            //->where('user_events.status','0')
            ->when($q, function ($query) use ($q,$request) {
                return $query->where(function ($query) use ($q,$request) {
                    /** @var Builder $query */
                    $preparedQ = '%' .$q. '%';
                    $num = 0;
                    foreach (
                        [
                            'user_events.event_name',
                            'user_events.vanue_name',
                            'user_events.description',
                            'user_events.location',
                            'user_events.country',
                            'user_events.status',
                            'user_events.event_rating',
                        ] AS $field
                    ) {
                        if ($num) {
                            $query = $query->orWhere($field, 'LIKE', $preparedQ);
                        } else {
                            $query = $query->where($field, 'LIKE', $preparedQ);
                        }
                        $num++;
                    }

                    return $query;
                });
            });


        if($request->get('toDate') && $request->get('toDate') != ""){

            $data->where(DB::raw('DATE(user_events.created_at)'),'<=',$request->get('toDate'));
        }
        if($request->get('fromDate') && $request->get('fromDate') != ""){

            $data->where(DB::raw('DATE(user_events.created_at)'),'>=',$request->get('fromDate'));
        }

        $EventsLogs = $data->orderBy('user_events.created_at','DESC')->paginate($count, ['*'], 'page', $pageEvents);
        $links = $EventsLogs->appends(Input::except('page'))->links();
        $filter->search = $request->get('search');
        $filter->created_at = $request->get('created_at');
        //dd(DB::getQueryLog());exit;
        return compact('EventsLogs', 'links', 'filter');
    }


    // api part-----------------------
    public function getChatMessageApi(Request $request, $count ='20')
    {
        $user = \Auth::user();
        $pageSmslogs = $request->get('page') ? $request->get('page') : 1;
        $q = trim($request->get('search'));
        $filter = (object)[];
        //DB::enableQueryLog();
        $data = Smslogs::select(DB::raw('sms_logs.*'))
            ->where('sms_logs.channel_id',$request->channel_id)
            ->when($q, function ($query) use ($q,$request) {
                return $query->where(function ($query) use ($q,$request) {
                    /** @var Builder $query */
                    $preparedQ = '%' .$q. '%';
                    $num = 0;
                    foreach (
                        [
                            'sms_logs.user_id',
                            'sms_logs.channel_id',
                            'sms_logs.msg_body',
                        
                        ] AS $field
                    ) {
                        if ($num) {
                            $query = $query->orWhere($field, 'LIKE', $preparedQ);
                        } else {
                            $query = $query->where($field, 'LIKE', $preparedQ);
                        }
                        $num++;
                    }

                    return $query;
                });
            });


        if($request->get('toDate') && $request->get('toDate') != ""){

            $data->where(DB::raw('DATE(sms_logs.created_at)'),'<=',$request->get('toDate'));
        }
        if($request->get('fromDate') && $request->get('fromDate') != ""){

            $data->where(DB::raw('DATE(sms_logs.created_at)'),'>=',$request->get('fromDate'));
        }

        $Smslogs = $data->orderBy('sms_logs.created_at','DESC')->paginate($count, ['*'], 'page', $pageSmslogs);
        $links = $Smslogs->appends(Input::except('page'))->links();
        $filter->search = $request->get('search');
        $filter->created_at = $request->get('created_at');
        //dd(DB::getQueryLog());exit;
        return compact('Smslogs');
    }

}
