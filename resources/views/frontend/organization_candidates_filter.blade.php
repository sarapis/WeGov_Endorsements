<div class="">
    @foreach ($candidates as $candidate)
    <div class="col-sm-4 col-md-4 col-xs-6">
        <div class="org_inner_right">
            <h5 class="org_title">
                <a href="/candidates/{{$candidate->recordid}}">{{str_limit($candidate->name, 40)}}</a>
            </h5>
            <div class="box-body">
                <p style="font-size: 12px;"><i class="fas fa-calendar-alt"></i> Election Year:  {{$candidate->election_year}}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
            