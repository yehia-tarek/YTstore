<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Artisan;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
            ->select(
                DB::raw("COUNT(*) as count"),
                DB::raw("DAYNAME(created_at) as day_name"),
                DB::raw("DAY(created_at) as day")
            )
            ->where('created_at', '>=', Carbon::today()->subDays(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        $array[] = ['Name', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }

        return view('backend.index')->with('users', json_encode($array));
    }

    public function changePassword()
    {
        return view('backend.layouts.changePassword');
    }
    public function changPasswordStore(Request $request)
    {
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('admin')->with('success', 'Password successfully changed');
    }

    // Pie chart
    public function userPieChart(Request $request)
    {
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        $array[] = ['Name', 'Number'];

        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }

        return view('backend.index')->with('course', json_encode($array));
    }

    // public function activity(){
    //     return Activity::all();
    //     $activity= Activity::all();
    //     return view('backend.layouts.activity')->with('activities',$activity);
    // }

    public function storageLink()
    {
        // check if the storage folder already linked;
        if (File::exists(public_path('storage'))) {
            // removed the existing symbolic link
            File::delete(public_path('storage'));

            //Regenerate the storage link folder
            try {
                Artisan::call('storage:link');
                request()->session()->flash('success', 'Successfully storage linked.');
                return redirect()->back();
            } catch (\Exception $exception) {
                request()->session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        } else {
            try {
                Artisan::call('storage:link');
                request()->session()->flash('success', 'Successfully storage linked.');
                return redirect()->back();
            } catch (\Exception $exception) {
                request()->session()->flash('error', $exception->getMessage());
                return redirect()->back();
            }
        }
    }
}
