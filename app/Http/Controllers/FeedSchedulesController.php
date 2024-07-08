<?php

namespace App\Http\Controllers;

use App\Models\FeedSchedules;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreFeedSchedulesRequest;
use App\Http\Requests\UpdateFeedSchedulesRequest;

class FeedSchedulesController extends Controller
{
    public function index()
    {
        $feedSchedules = FeedSchedules::all();
        return view('admin.feedSchedules.index', compact('feedSchedules'));
    }

    public function edit($id)
    {
        $feedSchedules = FeedSchedules::findOrFail($id);

        // dd($feedSchedules);
        return view('admin.feedSchedules.edit', compact('feedSchedules'));
    }


    public function update($id)
{
    $feedSchedules = FeedSchedules::findOrFail($id);

    $time1 = explode(':', request('time1'));
    $time2 = explode(':', request('time2'));
    $time3 = explode(':', request('time3'));

    $feedSchedules->jam1 = $time1[0];
    $feedSchedules->menit1 = $time1[1];

    $feedSchedules->jam2 = $time2[0];
    $feedSchedules->menit2 = $time2[1];

    $feedSchedules->jam3 = $time3[0];
    $feedSchedules->menit3 = $time3[1];

    $feedSchedules->save();

    return redirect()->route('feedSchedules.index')->with('success', 'Feed Schedule updated successfully');
}

}
