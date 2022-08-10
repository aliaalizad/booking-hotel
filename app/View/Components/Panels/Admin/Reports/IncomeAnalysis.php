<?php

namespace App\View\Components\Panels\Admin\Reports;

use Illuminate\View\Component;

class IncomeAnalysis extends Component
{
    public $total_income;
    public $this_month_income;
    public $this_week_income;
    public $today_income;
    public $monthly_income_change_percentage;
    public $weekly_income_change_percentage;
    public $daily_income_change_percentage;
    public $avg_daily_income;
    public $max_daily_income;
    public $avg_monthly_income;
    public $max_monthly_income;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->total_income = $data['total_income'];
        $this->this_month_income = $data['this_month_income'];
        $this->this_week_income = $data['this_week_income'];
        $this->today_income = $data['today_income'];
        $this->monthly_income_change_percentage = $data['monthly_income_change_percentage'];
        $this->weekly_income_change_percentage = $data['weekly_income_change_percentage'];
        $this->daily_income_change_percentage = $data['daily_income_change_percentage'];
        $this->avg_daily_income = $data['avg_daily_income'];
        $this->max_daily_income = $data['max_daily_income'];
        $this->avg_monthly_income = $data['avg_monthly_income'];
        $this->max_monthly_income = $data['max_monthly_income'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.panels.admin.reports.income-analysis');
    }
}
