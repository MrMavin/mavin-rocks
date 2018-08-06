<div class="column is-12-mobile is-6-tablet is-4-desktop is-3-fullhd">
    <div class="card">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <i class="fa-4x fa-fw {{ $set['icon'] }}"></i>
                </div>
                <div class="media-content">
                    <p class="title">{{ $set['title'] }}</p>
                    <ul>
                        @foreach(explode(',', $set['skills']) as $skill)
                            <li>{!! printSkillLevel($skill) !!}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>