<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use DateTime;
use Illuminate\Http\Request;

class ManageReportController extends Controller
{
    public function reportView()
    {

        return view('admin.report.view');
    }

    public function searchDate(Request $request)
    {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');

        $payment = Payment::where('order_date', $formatDate)->latest()->get();
        return view('admin.report.date', compact('payment', 'formatDate'));
    }

    public function searchMonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year_name;

        $payment = Payment::where('order_month', $month)->where('order_year', $year)->latest()->get();

        return view('admin.report.month', compact('payment', 'month', 'year'));
    }

    public function searchYear(Request $request)
    {
        $year = $request->year;

        $payment = Payment::where('order_year', $year)->latest()->get();

        return view('admin.report.year', compact('payment', 'year'));
    }
}
