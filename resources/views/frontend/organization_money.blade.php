@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-right hidden-xs">
              <p class="text-tages"> Tags: <?php 
                $tag_names = explode(',', $organization->tag_names);
                ?>
              @foreach($tag_names as $tag_name)
                @if($tag_name!='')
                  <span class="badge bg-green">
                    {{$tag_name}}</span>
                @endif
              @endforeach</p>
            </div>
            <div class="pull-right hidden-xs" style="padding-left: 20px;padding-right: 10px;">
              <p class="text-types"> Type: <span class="badge bg-blue">{{$organization->type}}</span></p>
            </div>
            <div class="pull-left">{{$organization->name}}</div>
            <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li style="width:216px;"><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li style="width:125px;"><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
            </ul>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="money">
                  <div class="row">
                        <div class="col-md-6">
                            <div class="box box-budget">
                                <h5 class="box-body-operating">Expense Budget: <span class="budget-span"> ${{number_format($expense_budget)}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-budget">
                                <h5 class="box-body-operating">Capital Budget: <span class="budget-span"> ${{number_format($capital_budget)}}</span></h5>
                            </div>
                        </div> 
                    </div>
                    <div class="box">
                        <table class="table">
                            <thead>
                            <tr class="info">
                                <th class="text-left" style="padding-left: 50px;">Budget</th>
                                <th class="text-right" style="padding-right: 50px;">Year 1</th>
                                <th class="text-right" style="padding-right: 50px;">Year 2</th>
                                <th class="text-right" style="padding-right: 50px;">Year 3</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($organization_expenses as $organizaiton_expense)
                                <tr>
                                    <td class="text-left"  style="padding-left: 50px;">{{$organizaiton_expense->line_number_description}}</td>
                                    <td class="text-right" style="padding-right: 50px;">${{number_format($organizaiton_expense->year1_forecast)}}</td>
                                    <td class="text-right" style="padding-right: 50px;">${{number_format($organizaiton_expense->year2_estimate)}}</td>
                                    <td class="text-right" style="padding-right: 50px;">${{number_format($organizaiton_expense->year3_estimate)}}</td>
                                </tr>
                                @endforeach
                                <tfoot class="budget-foot">
                                    <tr class="budget-tb">
                                        <td class="text-left" style="padding-left: 50px;"><b>Total Expense Budget</b></td>
                                        <td class="text-right" style="padding-right: 50px;"><b>${{number_format($expenses_sum->expenses_year1)}}</b></td>
                                        <td class="text-right" style="padding-right: 50px;"><b>${{number_format($expenses_sum->expenses_year2)}}</b></td>
                                        <td class="text-right" style="padding-right: 50px;"><b>${{number_format($expenses_sum->expenses_year3)}}<b></td>
                                    </tr>
                                    <tr class="budget-tb">
                                        <td class="text-left" style="padding-left: 50px;"><b>Total Capital Budget</b></td>
                                        <td class="text-right" colspan="3" style="padding-right: 50px;"><b>${!! $organization->total_project_cost !!}<b></td>
                                    </tr>
                                </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
