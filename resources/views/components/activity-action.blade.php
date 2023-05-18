<li class="timeline-item timeline-item-transparent">
    <span class="timeline-point timeline-point-primary"></span>
    <div class="timeline-event">
    <div class="timeline-header mb-1">
        <h6 class="mb-0">{!! $action->log_name !== 'default'? $action->log_name: $action->description !!}</h6>
        <small class="text-muted">{{ $action->created_at->diffForHumans() }}</small>
    </div>
    @if ($action->log_name !== 'default')
    <p class="mb-2">{!! $action->description !!}</p>
    @endif
    <div class="d-flex">
        <a href="javascript:void(0)" class="me-3">
        <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/misc/pdf.png" alt="PDF image" width="15" class="me-2">
        <span class="fw-bold text-body">invoices.pdf</span>
        </a>
    </div>
    </div>
</li>