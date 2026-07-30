@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/payment.css') }}">

<section class="payment-section">
    <div class="payment-container">
        <div class="payment-card">
            
            <div class="payment-card-header">
                <h2 class="payment-title">Pembayaran Donasi</h2>
                <p class="payment-subtitle">Segera selesaikan donasi Anda untuk mendukung program kami</p>
            </div>

            @if($errors->any())
                <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: var(--radius-sm); margin-bottom: 20px; font-size: 0.9rem; font-weight: 500;">
                    ✗ {{ $errors->first() }}
                </div>
            @endif

            <div class="payment-details">
                <div class="detail-row">
                    <span>ID Transaksi</span>
                    <span>#DON-{{ str_pad($donasi->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="detail-row">
                    <span>Tanggal Pembuatan</span>
                    <span>{{ $donasi->created_at->format('d M Y - H:i') }} WIB</span>
                </div>
                <div class="detail-row">
                    <span>Status Verifikasi</span>
                    <span><span class="badge-pending">Menunggu Bukti Transfer</span></span>
                </div>

                <div class="amount-display">
                    Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                </div>
            </div>

            @php
                $paymentMethod = 'bank_transfer';
                if (Str::contains(strtoupper($donasi->deskripsi), 'QRIS')) {
                    $paymentMethod = 'qris';
                } elseif (Str::contains(strtoupper($donasi->deskripsi), 'E_WALLET') || Str::contains(strtoupper($donasi->deskripsi), 'E-WALLET')) {
                    $paymentMethod = 'e_wallet';
                }
            @endphp

            @if($paymentMethod === 'qris')
                <div class="instruction-box">
                    <h4>📱 Pembayaran dengan QRIS</h4>
                    <p>Silakan scan QR code resmi Yayasan Guna Widya Paramesthi di bawah ini menggunakan aplikasi mobile banking Anda atau e-wallet (GoPay, OVO, DANA, LinkAja, ShopeePay):</p>
                    
                    <div class="qris-box">
                        <div class="qris-header">QRIS PAY</div>
                        <img src="{{ asset('images/' . \App\Models\Setting::get('pay_qris_qr', 'qris_qr.png')) }}" alt="QRIS QR Code" class="qris-img">
                        <p style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; margin: 5px 0 0 0;">NMID: ID1020304050607</p>
                        <p style="font-size: 0.85rem; color: var(--text-primary); font-weight: 700; margin: 2px 0 0 0;">YAYASAN GUNA WIDYA PARAMESTHI</p>
                    </div>
                </div>
            @elseif($paymentMethod === 'bank_transfer')
                <div class="instruction-box">
                    <h4>🏦 Pembayaran dengan Transfer Bank</h4>
                    <p>Silakan pilih salah satu bank resmi milik yayasan di bawah ini untuk melihat nomor rekening transfer:</p>
                    
                    <!-- Bank Selector Tabs -->
                    <div class="payment-selector-grid">
                        <div class="payment-selector-item active" data-provider="bca" onclick="selectProvider('bank', 'bca')">Bank BCA</div>
                        <div class="payment-selector-item" data-provider="mandiri" onclick="selectProvider('bank', 'mandiri')">Bank Mandiri</div>
                        <div class="payment-selector-item" data-provider="bni" onclick="selectProvider('bank', 'bni')">Bank BNI</div>
                        <div class="payment-selector-item" data-provider="bri" onclick="selectProvider('bank', 'bri')">Bank BRI</div>
                    </div>

                    <!-- Dynamic Bank Details Cards -->
                    @php
                        $bca_num = \App\Models\Setting::get('pay_bank_bca', '123-456-7890');
                        $mandiri_num = \App\Models\Setting::get('pay_bank_mandiri', '987-654-3210');
                        $bni_num = \App\Models\Setting::get('pay_bank_bni', '555-666-7777');
                        $bri_num = \App\Models\Setting::get('pay_bank_bri', '888-999-1111');
                    @endphp
                    <div id="bank-details-bca" class="payment-details-card provider-details">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Bank Transfer - BCA</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-bca">{{ $bca_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $bca_num }}', this)">Salin</button>
                        </div>
                    </div>

                    <div id="bank-details-mandiri" class="payment-details-card provider-details" style="display: none;">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Bank Transfer - Mandiri</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-mandiri">{{ $mandiri_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $mandiri_num }}', this)">Salin</button>
                        </div>
                    </div>

                    <div id="bank-details-bni" class="payment-details-card provider-details" style="display: none;">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Bank Transfer - BNI</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-bni">{{ $bni_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $bni_num }}', this)">Salin</button>
                        </div>
                    </div>

                    <div id="bank-details-bri" class="payment-details-card provider-details" style="display: none;">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Bank Transfer - BRI</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-bri">{{ $bri_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $bri_num }}', this)">Salin</button>
                        </div>
                    </div>
                </div>
            @elseif($paymentMethod === 'e_wallet')
                <div class="instruction-box">
                    <h4>💳 Pembayaran dengan E-Wallet</h4>
                    <p>Silakan pilih salah satu opsi e-wallet resmi milik yayasan di bawah ini untuk melihat nomor akun tujuan:</p>
                    
                    <!-- E-Wallet Selector Tabs -->
                    <div class="payment-selector-grid">
                        <div class="payment-selector-item active" data-provider="gopay" onclick="selectProvider('ewallet', 'gopay')">GoPay</div>
                        <div class="payment-selector-item" data-provider="ovo" onclick="selectProvider('ewallet', 'ovo')">OVO</div>
                        <div class="payment-selector-item" data-provider="dana" onclick="selectProvider('ewallet', 'dana')">DANA</div>
                        <div class="payment-selector-item" data-provider="linkaja" onclick="selectProvider('ewallet', 'linkaja')">LinkAja</div>
                    </div>

                    <!-- Dynamic E-Wallet Details Cards -->
                    @php
                        $gopay_num = \App\Models\Setting::get('pay_ewallet_gopay', '087865309966');
                        $ovo_num = \App\Models\Setting::get('pay_ewallet_ovo', '087865309966');
                        $dana_num = \App\Models\Setting::get('pay_ewallet_dana', '087865309966');
                        $linkaja_num = \App\Models\Setting::get('pay_ewallet_linkaja', '087865309966');
                    @endphp
                    <div id="ewallet-details-gopay" class="payment-details-card provider-details">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">E-Wallet - GoPay</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-gopay">{{ $gopay_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $gopay_num }}', this)">Salin</button>
                        </div>
                    </div>

                    <div id="ewallet-details-ovo" class="payment-details-card provider-details" style="display: none;">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">E-Wallet - OVO</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-ovo">{{ $ovo_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $ovo_num }}', this)">Salin</button>
                        </div>
                    </div>

                    <div id="ewallet-details-dana" class="payment-details-card provider-details" style="display: none;">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">E-Wallet - DANA</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-dana">{{ $dana_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $dana_num }}', this)">Salin</button>
                        </div>
                    </div>

                    <div id="ewallet-details-linkaja" class="payment-details-card provider-details" style="display: none;">
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">E-Wallet - LinkAja</div>
                        <div class="payment-details-row">
                            <div>
                                <span class="payment-number-text" id="num-linkaja">{{ $linkaja_num }}</span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 3px;">a/n Yayasan Guna Widya Paramesthi</div>
                            </div>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $linkaja_num }}', this)">Salin</button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Upload Form -->
            <form action="{{ route('donasi.payment.upload', $donasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Hidden inputs to submit chosen provider -->
                @if($paymentMethod === 'qris')
                    <input type="hidden" name="payment_provider" value="QRIS">
                @elseif($paymentMethod === 'bank_transfer')
                    <input type="hidden" id="selected_payment_provider" name="payment_provider" value="BCA">
                @elseif($paymentMethod === 'e_wallet')
                    <input type="hidden" id="selected_payment_provider" name="payment_provider" value="GOPAY">
                @endif

                <div class="upload-form-group">
                    <label class="upload-label">Unggah Bukti Transfer / Bukti Scan</label>
                    <div class="custom-file-upload" onclick="document.getElementById('bukti_transfer_input').click()">
                        <span id="upload-placeholder-text" style="display: inline-flex; align-items: center; gap: 8px; justify-content: center; width: 100%;">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                            Klik di sini untuk memilih foto bukti transfer
                        </span>
                        <input type="file" id="bukti_transfer_input" name="bukti_transfer" accept="image/*" style="display: none;" onchange="fileSelected(this)" required>
                    </div>
                </div>

                <button type="submit" class="upload-btn-submit">Konfirmasi & Kirim Bukti</button>
            </form>

            <div style="text-align: center; margin-top: 20px; display: flex; flex-direction: column; gap: 12px; align-items: center; justify-content: center;">
                <a href="{{ route('home') }}" style="color: var(--text-muted); font-size: 0.9rem; text-decoration: none; font-weight: 500;">Nanti Saja / Kembali ke Beranda</a>
                
                <form id="cancel-donation-form" action="{{ route('donasi.payment.cancel', $donasi->id) }}" method="POST">
                    @csrf
                    <button type="button" onclick="showCancelConfirmation(document.getElementById('cancel-donation-form'))" style="background: none; border: none; color: #ef4444; font-size: 0.85rem; font-weight: 600; cursor: pointer; text-decoration: underline; font-family: inherit; padding: 5px; display: inline-flex; align-items: center; gap: 6px; justify-content: center;">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                        </svg>
                        Batalkan Permohonan Donasi Ini
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<script>
    function fileSelected(input) {
        const placeholder = document.getElementById('upload-placeholder-text');
        if (input.files && input.files[0]) {
            placeholder.innerText = '✓ Terpilih: ' + input.files[0].name;
            placeholder.style.color = 'var(--success)';
            placeholder.style.fontWeight = '600';
        }
    }

    function selectProvider(type, provider) {
        // Toggle active selector styling
        document.querySelectorAll('.payment-selector-item').forEach(item => {
            item.classList.remove('active');
        });
        const activeItem = document.querySelector(`.payment-selector-item[data-provider="${provider}"]`);
        if (activeItem) activeItem.classList.add('active');

        // Toggle active detail cards
        document.querySelectorAll('.provider-details').forEach(card => {
            card.style.display = 'none';
        });
        const activeCard = document.getElementById(`${type}-details-${provider}`);
        if (activeCard) activeCard.style.display = 'block';

        // Set hidden input value
        const hiddenInput = document.getElementById('selected_payment_provider');
        if (hiddenInput) {
            hiddenInput.value = provider.toUpperCase();
        }
    }

    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btn.innerText;
            btn.innerText = 'Copied! ✓';
            btn.style.background = 'var(--success, #059669)';
            setTimeout(() => {
                btn.innerText = originalText;
                btn.style.background = '';
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    }
</script>

@endsection
