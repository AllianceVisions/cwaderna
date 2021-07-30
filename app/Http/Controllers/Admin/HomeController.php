<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request; 
use Alert;

class HomeController
{
    public function index(Request $request)
    { 
        
        $month_bar = date("m",strtotime('now'));
        $year_bar = date("Y",strtotime('now'));
        
        
        if($request->has('month_bar')){
            $month_bar = $request->month_bar;
        }
        
        if($request->has('year_bar')){
            $year_bar = $request->year_bar;
        } 

        $settings1 = [
            'chart_title'           => 'Events',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Event',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format'     => 'd-m-Y H:i:s',
            'date_format_filter_days'   => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-8',
            'entries_number'        => '5',
            'range_date_start'          => $year_bar.'/'.$month_bar.'/1 00:00:00',
            'range_date_end'            => $year_bar.'/'.$month_bar.'/31 23:59:59',
            'continuous_time'           => 'd-m-Y H:i:s',
            'translation_key'       => 'event',
        ];

        $chart1 = new LaravelChart($settings1);

        return view('admin.dashboard',compact('chart1','year_bar','month_bar'));
    }
}