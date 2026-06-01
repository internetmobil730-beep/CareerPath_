@foreach($universities as $uni)
    <div class="card mb-5 shadow-sm border-1 rounded-3" style="border-color: #fcece8;">
        <div class="card-body p-5">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h2 class="card-title font-weight-bold" style="color: #1a7a7a;">{{ $uni->name_tr }}</h2>
                <span class="badge px-3 py-2 rounded-pill bg-primary">Üniversite</span>
            </div>
            <hr class="my-4">
            
            <div class="mb-4">
                <h5 class="text-dark font-weight-bold mb-2">Hakkında:</h5>
                <p class="card-text text-muted" style="font-size: 1.05rem; line-height: 1.7;">
                    {{ Str::limit($uni->description_tr, 250) }}
                </p>
            </div>

            <div class="row bg-light p-3 rounded mb-4 mx-0" style="font-size: 0.95rem;">
                <div class="col-sm-6 mb-2 mb-sm-0">
                    <strong>İlçe / Konum:</strong> <span class="text-secondary">{{ $uni->district }} ({{ $uni->side }})</span>
                </div>
                <div class="col-sm-6">
                    <strong>Tür:</strong> <span class="text-secondary">Vakıf</span>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('university.details', $uni->id) }}" class="btn px-4 py-2 font-weight-bold rounded-3" style="background-color: #ffcc00; color: #000; border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    Detayları Gör
                </a>
            </div>
        </div>
    </div>
@endforeach