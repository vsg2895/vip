<!-- Tab Content -->
<div class="tab-content mt-2" id="walletTabContent">
    @if(\Request::segment(4) == NULL || \Request::segment(4) == 'main')
        <!-- Wallet Page -->
        <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main">
            @include('account.wallet.main')
        </div>
    @else
        <!-- Wallet Page -->
        <div class="tab-pane fade" id="main" role="tabpanel" aria-labelledby="main-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'payments')
        <!-- Payments Page -->
        <div class="tab-pane fade show active" id="payments" role="tabpanel" aria-labelledby="payments">
            @include('account.wallet.payments')
        </div>
    @else
        <!-- Payments Page -->
        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif

    @if(\Request::segment(4) == 'operations')
        <!-- Operations Page -->
        <div class="tab-pane fade show active" id="operations" role="tabpanel" aria-labelledby="operations">
            @include('account.wallet.operations')
        </div>
    @else
        <!-- Operations Page -->
        <div class="tab-pane fade" id="operations" role="tabpanel" aria-labelledby="operations-tab">
            <!-- Loading Gif -->
            <div class="spinner-border mt-5 d-block mx-auto" role="status">
                <span class="sr-only">{{ translating('loading') }}...</span>
            </div>
        </div>
    @endif
</div>
