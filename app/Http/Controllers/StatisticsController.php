<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $stats = DB::select(
            '
            SELECT
                state,
                SUM(TYPE=0) AS sum_type_unkown,
                SUM(TYPE=1) AS sum_type_desktop,
                SUM(TYPE=2) AS sum_type_laptop,
                SUM(TYPE=3) AS sum_type_tablet,
                SUM(TYPE=4) AS sum_type_small_form_factor,
                COUNT(*) AS sum_total
            FROM computers
            WHERE team_id=?
            GROUP BY state;',
            [$user->currentTeam->id]
        );

        $totals = array();
        $totals['type_unkown'] = 0;
        $totals['type_desktop'] = 0;
        $totals['type_laptop'] = 0;
        $totals['type_tablet'] = 0;
        $totals['type_small_form_factor'] = 0;
        $totals['all'] = 0;

        foreach ($stats as $s) {
            $totals['type_unkown'] += $s->sum_type_unkown;
            $totals['type_desktop'] += $s->sum_type_desktop;
            $totals['type_laptop'] += $s->sum_type_laptop;
            $totals['type_tablet'] += $s->sum_type_tablet;
            $totals['type_small_form_factor'] += $s->sum_type_small_form_factor;
            $totals['all'] += $s->sum_total;
        }

        $deliverable_stats = DB::select("
            SELECT
                CONCAT(IF(has_webcam,'has_webcam','needs_webcam'),'_',IF(has_wlan,'has_wlan','needs_wlan')) AS state,
                SUM(TYPE=0) AS sum_type_unkown,
                SUM(TYPE=1) AS sum_type_desktop,
                SUM(TYPE=2) AS sum_type_laptop,
                SUM(TYPE=3) AS sum_type_tablet,
                SUM(TYPE=4) AS sum_type_small_form_factor,
                COUNT(*) AS sum_total
            FROM computers
            WHERE team_id = 5 AND state = 'refurbished'
            GROUP BY has_webcam, has_wlan");

        $deliverable_totals = array();
        $deliverable_totals['type_unkown'] = 0;
        $deliverable_totals['type_desktop'] = 0;
        $deliverable_totals['type_laptop'] = 0;
        $deliverable_totals['type_tablet'] = 0;
        $deliverable_totals['type_small_form_factor'] = 0;
        $deliverable_totals['all'] = 0;

        foreach ($deliverable_stats as $s) {
            $deliverable_totals['type_unkown'] += $s->sum_type_unkown;
            $deliverable_totals['type_desktop'] += $s->sum_type_desktop;
            $deliverable_totals['type_laptop'] += $s->sum_type_laptop;
            $deliverable_totals['type_tablet'] += $s->sum_type_tablet;
            $deliverable_totals['type_small_form_factor'] += $s->sum_type_small_form_factor;
            $deliverable_totals['all'] += $s->sum_total;
        }

        return view('statistics.index')
            ->with('stats', $stats)
            ->with('totals', $totals)
            ->with('deliverable_stats', $deliverable_stats)
            ->with('deliverable_totals', $deliverable_totals);
    }
}
