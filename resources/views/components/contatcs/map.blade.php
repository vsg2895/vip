 <!-- Map Section -->
 <div class="col-lg-6 col-12 pl-lg-2 bg-white rounded">
    @if(isset($site_data['map']) && $site_data['map'] != null)
        {!! $site_data['map'] !!}
    @endif
</div>