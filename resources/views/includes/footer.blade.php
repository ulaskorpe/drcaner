<footer class="bg-black pt-3 pb-5">


    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3 justify-content-between">
            <div class="col d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start gap-3 text-white fs-sm">
                
                <span>® {{ now()->year }} Dr. Caner Kaçmaz.<br>All Rights Reserved.</span>
                <span>Web Design<br>by ProjeMED</span>
                
            </div>
            <div class="col align-items-center">
                <img loading="lazy" src="/media/2025/6/2/logo-full.png" alt="Dr. Caner Kaçmaz" width="409" height="127" class="img-fluid mx-auto mb-3">
                <x-social-media-accounts :classes="'justify-content-center'"/>
            </div>
            <div class="col d-flex flex-column align-items-lg-end text-center text-lg-end gap-2">
                <span class="lead text-gray-500">{{ $settings->contact['phone'] }}</span>
                <span class="text-white fs-sm">{!! $settings->contact['address'] !!}</span>
            </div>
        </div>
    </div>

</footer>