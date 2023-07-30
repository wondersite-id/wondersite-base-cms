@if ($activities)
    <div class="card-body">
        <div class="collapse" id="collapse-border-bottom">
        </div>
        <div class="accordion accordion-header-border-bottom" id="accordion-activity-log">
            @foreach($activities as $index => $activity) 
            <div class="card">
                <div class="card-header" id="heading-activity-{{ $index }}">
                    <h2 class="mb-0">
                        <button class="btn btn-link {{ $index > 0 ? 'collapsed': '' }}" type="button" data-toggle="collapse" data-target="#collapse-part-{{ $index }}" aria-expanded="false" aria-controls="collapse-part-{{ $index }}">
                        <b>{{ ($activity->causer ? $activity->causer->name : "System" . " ") . " " . $activity->description . " this data" }}</b> ({{ $model->created_at->diffForHumans() }})
                        </button>
                    </h2>
                </div>
                <div id="collapse-part-{{ $index }}" class="collapse {{ $index == 0 ? 'show': '' }}" aria-labelledby="heading-activity-{{ $index }}" data-parent="#accordion-activity-log" style="">
                    <div class="card-body">
                        <p id="activity">
                            <b>Causer:</b>
                            @if ($activity->causer)
                                @if (Auth::user()->isAdmin())
                                <a href="{{ route($activity->causer->isAdmin() ? "administrators.show":"customers.show", $activity->causer->id) }}">{{ $activity->causer->name }} - {{ $activity->causer->email }}</a> <i>{{ $activity->causer->id == Auth::user()->id ? "(It's you)" : "" }}</i>
                                @else
                                {{ $activity->causer->name }} - {{ $activity->causer->email }}<i>{{ $activity->causer->id == Auth::user()->id ? "(It's you)" : "" }}</i>    
                                
                                @endif
                            @else
                            System  
                            @endif
                            <br>
                        </p>
                        <p id="date">
                            <b>Timestamp:</b> {{ $model->created_at }}
                        </p>
                        <p id="old">
                            <b>Old Changes Data:</b>
                            @if (isset($activity->properties["old"]))
                            <ul class="list-group">
                                @foreach ($activity->properties["old"] as $column => $value)
                                <li class="list-group-item list-group-item-danger">
                                    @if ($column == "password")
                                    {{ ucwords($column) }} : *********
                                    @else
                                    {{ ucwords($column) }} : {{ strip_tags($value) }}
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @else
                            -
                            @endif
                        </p>
                        <p id="new">
                            <b>New Changes Data:</b>
                            <ul class="list-group">
                                @foreach ($activity->properties["attributes"] as $column => $value)
                                <li class="list-group-item list-group-item-success">
                                    @if ($column == "password")
                                    {{ ucwords($column) }} : *********
                                    @else
                                    {{ ucwords($column) }} : {{ strip_tags($value) }}
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
    <div class="card-footer">
    {{ ($activities->links()) }}
    </div>
@endif