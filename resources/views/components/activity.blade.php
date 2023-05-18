<div class="card mb-4">
    <h5 class="card-header">{{ $title }}</h5>
    <div class="card-body">
      <ul class="timeline">
        @foreach ($actions as $action)
            <x-activity-action :action="$action" />
        @endforeach
        <li class="timeline-end-indicator">
          <i class="bx bx-check-circle"></i>
        </li>
      </ul>
    </div>
</div>