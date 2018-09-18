<div class="demo-container">
  @foreach ($organizations as $organization)
    <div class="col-md-4" style="padding: 0;">
        <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
          <div class="mdl-card__title">
            @if($organization->logo!='')
                <img src="{{$organization->logo}}" class="img-responsive center" style="height: 50px;">
            @endif
          </div>
          <div class="mdl-card__actions mdl-card--border">
            <div class="organization_div">
            <a href="/organization_{{$organization->organizations_id}}" class="organization_title">{{str_limit($organization->name, 40)}}</a>
            </div>
            <a target="_blank" class="link-website" @if($organization->website!='') href="http://{{$organization->website}}" @endif>
              Website<i class="fa fa-fw fa-external-link"></i></a>
            <div style="padding-top: 5px;">
              <?php 
                $tag_names = explode(',', $organization->tag_names);
                ?>
              @foreach($tag_names as $tag_name)
                @if($tag_name!='')
                  <span class="badge bg-green">
                    {{$tag_name}}</span>
                @endif
              @endforeach
            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>