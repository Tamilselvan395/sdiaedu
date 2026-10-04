@if(!empty($globalSettings['google_tag_manager_id']))
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $globalSettings['google_tag_manager_id'] }}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@endif

@if(session('tracking_lead'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.dispatchEvent === 'function') {
            window.dispatchEvent(new CustomEvent('lead_generated', {
                detail: {!! json_encode(session('tracking_lead')) !!}
            }));
        }
    });
</script>
@endif
