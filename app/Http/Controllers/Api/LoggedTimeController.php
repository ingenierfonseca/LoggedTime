<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoggedTimeSessionResource;
use App\LoggedTimeUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoggedTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date ='2022-05-02';
        $from = Carbon::createFromFormat('Y-m-d', $date);
        $from->hour(0);
        $from->minute(0);
        $from->seconds(0);

        $to = Carbon::createFromFormat('Y-m-d', $date);
        $to->hour(23);
        $to->minute(59);
        $to->seconds(59);

        if ($request->has('date')) {
            $date = $request->input('date');
            $from = Carbon::createFromFormat('Y-m-d', $date);
            $from->hour(0);
            $from->minute(0);
            $from->seconds(0);

            $to = Carbon::createFromFormat('Y-m-d', $date);
            $to->hour(23);
            $to->minute(59);
            $to->seconds(59);
        }

        $name = '';
        if ($request->has('name')) {
            $name = $request->input('name');
        }

        $data = User::with(['sessions' => function($query) use ($from, $to) {
            $query
            ->whereBetween('last_active', [$from, $to])->orderBy('last_active', 'desc');
        }])
        ->where('name', 'like', '%' . $name . '%')->orWhere('name', 'like', '%' . $name . '%')->orderBy('name', 'desc')
        ->get();

        return LoggedTimeSessionResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
