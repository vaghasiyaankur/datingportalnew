<?php

namespace App\Http\Controllers\Backend;

use App\Models\StatusReport;
use App\Models\PromotionReport;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;


class StatusController extends Controller
{

    /**
     * Show the list of all statuses which are reported by users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportedStatusesList()
    {
        $all_statuses = StatusReport::all();
        $statuses = $all_statuses->filter(function ($status) {
            return $status->notify == 'new';
        });

        return view('cbs.backend.report', compact('all_statuses', 'statuses'));
    }

    /**
     * Show the list of all promotion which are reported by users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportedPromotionList()
    {
        $all_promotions = PromotionReport::all();
        $promotions = $all_promotions->filter(function ($promotion) {
            return $promotion->notify == 'new';
        });

        return view('cbs.backend.promotionreport', compact('all_promotions', 'promotions'));
    }

    /**
     * Remove Report for status.
     *
     * @return route reported-status.index | successmessage
     */
    public function statusdestroy($id)
    {
        StatusReport::find($id)->delete();
        return redirect()->route('reported-status.index')
                        ->with('success','Status Report deleted successfully');
    }

    /**
     * Remove Report for promotions.
     *
     * @return route reported-promotion.index | successmessage
     */
    public function promotiondestroy($id)
    {
        PromotionReport::find($id)->delete();
        return redirect()->route('reported-promotion.index')
                        ->with('success','Promotion Report deleted successfully');
    }
}
