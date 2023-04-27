@php
$uid = uniqid();
@endphp

<div class="modal fade modal-{{ $uid }}" {{$attributes}} aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-{{$size}}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="{{ $saveBtnType?? 'button' }}" form="{{ $saveBtnForm }}" class="btn btn-primary">{{ $saveBtnText?? 'Save changes' }}</button>
            </div>
        </div>
    </div>
</div>

@if ($show)
<script>
    window.addEventListener('load', () => {
        $('.modal-{{ $uid }}').modal('show');
    });
</script>
@endif