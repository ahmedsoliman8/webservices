<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Order;




class CatController extends Controller
{

    public  function getServicesByCatId($cat_id,$length=null)
    {
        $cat = Cat::findOrfail($cat_id);
        if ($cat) {
            $query = DB::table('services');
            $query->join('users', 'users.id', '=', 'services.user_id');
            $query->leftJoin('votes', 'services.id', '=', 'votes.services_id');
            $query->select('services.id', 'services.name', 'services.image', 'services.price', DB::raw('SUM(votes.vote) as vote_sum'),
                DB::raw('users.name as username'), DB::raw('users.id as user_id'), DB::raw('COUNT(votes.id)as vote_count'));
            $query->groupBy('services.id');
            $query->where('services.status', 1);
            $query->where('services.cat_id', $cat_id);
            $query->orderBy('vote_sum', 'desc');



            if ($length == null) {
                //Cats
                $cats = Cat::where('id', '!=', $cat_id)->get();
                    //MostViewed
                    $mostViewedSideBar = Service::join('users', 'users.id', '=', 'services.user_id')
                        ->leftJoin('views', 'services.id', '=', 'views.service_id')
                        ->select('services.id', 'services.name', DB::raw('COUNT(views.id) as view_count'))
                        ->groupBy('services.id')
                        ->where('services.status', 1)
                        ->where('services.cat_id', $cat->id)
                        ->orderBy('view_count', 'desc')
                        ->limit(6)
                        ->get();

                $sideBarSection3= Service::leftJoin('orders','services.id' , '=', 'orders.services_id')
                    ->select('services.id', 'services.name', DB::raw('COUNT(orders.id) as orders_count'))
                    ->groupBy('services.id')
                    ->where('services.status', 1)
                    ->where('services.cat_id', $cat->id)
                    ->having('orders_count','>',0)
                    ->orderBy('orders_count', 'desc')
                    ->limit(6)
                    ->get();


                ///append to user orders
                $guest = Auth::guest();
                if (!$guest) {
                    $user = Auth::user();
                    $orderCat = Order::join('services', 'orders.services_id', '=', 'services.id')
                        ->where('user_order', $user->id)
                        ->pluck('services.cat_id')->all();

                    $sideBarSection2 = Service::join('users', 'users.id', '=', 'services.user_id')
                        ->select('services.id', 'services.name')
                        ->where('services.status', 1)
                        ->whereIn('services.cat_id', $orderCat)
                        ->inRandomOrder()
                        ->limit(6)
                        ->get();
                } else {
                    $sideBarSection2 = null;
                    $mostViewedSideBar=null;
                    $sideBarSection3=null;


                }
                $query->limit(env('limit'));
                $services = $query->get();
                $array = [
                    'services' => $services,
                    'cat' => $cat,
                    'mostViewedSideBar' => $mostViewedSideBar,
                    'sideBarSection2' => $sideBarSection2,
                    'cats' => $cats,
                    'sideBarSection3' =>  $sideBarSection3
                ];
                return $array;

            } else {

                $query->offset($length)->limit(env('limit'));
                $services = $query->get();
                return $services;
            }



        }

    }
}
