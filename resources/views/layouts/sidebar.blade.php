
<div id="sidebar-wrapper" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"data-position="right" class="navbar-default navbar-static-side1" style="padding-top: 8px;">
   
        <form action="/find" method="POST" class="hidden-sm hidden-xs" style="display: block !important; padding-bottom: 30px;padding: 5px; ">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-icon right text-white"><a href=""><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control text-black" name="find"/></div>
        </form>

        <div class="btn-group" style="margin-top: 40px; width: 100%;padding: 5px; ">
            <label class="col-md-12 control-label" style="padding-left: 5px;">Service Category</label>
            <button type="button" class="btn btn-default" style="width: 88%;overflow: hidden;">{{$filter[1]}}</button>
            <button type="button" data-toggle="dropdown" data-delay="1000" data-close-others="true" class="btn btn-primary dropdown-toggle"><i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu scrollable-menu">
                @foreach($servicetypes as $service)
                <li><a href="/category_{{$service->taxonomy_id}}">{{$service->name}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="btn-group" style="margin-top: 40px;width: 100%;padding: 3px;">
            <label class="col-md-12 control-label" style="padding-left: 5px;">Organization Category</label>
            <button type="button" class="btn btn-default" style="width: 88%;overflow: hidden;">{{$filter[0]}}</button>
            <button type="button" data-toggle="dropdown" data-delay="1000" data-close-others="true" class="btn btn-primary dropdown-toggle"><i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu scrollable-menu" style="min-width: 250px;">
                @foreach($organizationtypes as $organization)
                <li><a href="/organizationcategory_{{$organization->type}}">{{$organization->type}}</a></li>
                @endforeach
            </ul>
        </div>
        
        <div class="btn-group" style="margin-top: 40px; width: 100%;padding: 3px;">
            <label class="col-md-12 control-label" style="padding-left: 0;">Project Category</label>
            <button type="button" class="btn btn-default" style="width: 88%;overflow: hidden;">{{$filter[2]}}</button>
            <button type="button" data-toggle="dropdown" data-delay="1000" data-close-others="true" class="btn btn-primary dropdown-toggle"><i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu scrollable-menu" style="min-width: 250px;">
                @foreach($projecttypes as $project)
                <li><a href="/projectcategory_{{$project->project_type}}">{{$project->project_type}}</a></li>
                @endforeach
            </ul>
        </div>
</div>
