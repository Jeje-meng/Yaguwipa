<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Guna Widya Paramesthi</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')

    <main class="main-content">
        @yield('content')
    </main>

    <!-- ==========================================
         FOOTER REVISI: COMPACT & MARQUEE ANIMATION
         ========================================== -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                
                <!-- Kolom 1: Informasi & Media Sosial -->
                <div class="footer-column info-col">
                    <h3>YAYASAN<br>GUNA WIDYA PARAMESTI</h3>
                    <div class="contact-details">
                        <p>Alamat : {{ \App\Models\Setting::get('contact_alamat', 'Jln. Ganetri IV No. 4 DPS 80237 Bali') }}</p>
                        <p>No Telepon : {{ \App\Models\Setting::get('contact_telp', '(+62) 87865309966') }}</p>
                        <p>Email : {{ \App\Models\Setting::get('contact_email', 'info@yaguwipa.org') }}</p>
                    </div>
                    <div class="social-wrapper">
                        <h4>FOLLOW US :</h4>
                        <div class="social-icons">
                            <!-- Instagram -->
                            <a href="{{ \App\Models\Setting::get('contact_ig', 'https://www.instagram.com/') }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                            <!-- Facebook -->
                            <a href="{{ \App\Models\Setting::get('contact_fb', 'https://www.facebook.com/') }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2: Site Map -->
                <div class="footer-column sitemap-col">
                    <h3>SITE MAP</h3>
                    <ul>
                        <li><a href="{{ route('home') }}#tentang_kami">&gt; TENTANG KAMI</a></li>
                        <li><a href="{{ route('home') }}#lembaga_terkait">&gt; PARTNER</a></li>
                        <li><a href="{{ route('gallery') }}">&gt; GALERI</a></li>
                        <li><a href="#">&gt; BERITA</a></li>
                        <li><a href="#">&gt; AGENDA</a></li>
                        <li><a href="#">&gt; DONASI</a></li>
                        <li><a href="#">&gt; MASUK</a></li>
                        <li><a href="#">&gt; DAFTAR</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Google Maps -->
                <div class="footer-column maps-col">
                    <div class="map-container">
                        <iframe 
                            src="{{ \App\Models\Setting::get('contact_map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.5663737526715!2d115.23466189999999!3d-8.6375376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f6479f6e6ab%3A0x63cd2e0c034ec6b4!2sJl.%20Ganetri%20IV%2C%20Tonja%2C%20Kec.%20Denpasar%20Utara%2C%20Kota%20Denpasar%2C%20Bali%2080235!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid') }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>

        <!-- Teks Berjalan Efek Marquee Moderen (Sudah Dikecilkan) -->
        <div class="marquee-wrapper">
            <div class="marquee-content">
                <span>YAGUWIPA.ORG</span>
                <span>YAGUWIPA.ORG</span>
                <span>YAGUWIPA.ORG</span>
                <span>YAGUWIPA.ORG</span>
                <span>YAGUWIPA.ORG</span>
                <span>YAGUWIPA.ORG</span>
                <span>YAGUWIPA.ORG</span>
                <span>YAGUWIPA.ORG</span>
            </div>
        </div>
    </footer>
    <!-- Entrance Animations Trigger Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    } else {
                        entry.target.classList.remove('animated');
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: '0px 0px -20px 0px'
            });
            
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>
    <!-- Custom Confirmation Modal -->
    <div id="custom-confirm-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); z-index: 99999; align-items: center; justify-content: center;">
        <div style="background: #ffffff; padding: 35px 30px; border-radius: 20px; max-width: 420px; width: 90%; text-align: center; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); animation: modalScaleIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);">
            <div style="margin-bottom: 15px; display: inline-block; line-height: 1; color: #f59e0b;">
                <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block; margin: 0 auto;">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <h4 style="margin: 0 0 10px 0; font-size: 1.3rem; font-weight: 800; color: #1e293b; font-family: system-ui, -apple-system, sans-serif;">Batalkan Donasi</h4>
            <p style="margin: 0 0 25px 0; font-size: 0.95rem; color: #64748b; line-height: 1.6; font-family: system-ui, -apple-system, sans-serif;">Apakah Anda yakin ingin membatalkan permohonan donasi ini?</p>
            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="button" id="confirm-cancel-btn" style="background: #ef4444; color: #ffffff; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.2s ease; font-family: inherit; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">Ya, Batalkan</button>
                <button type="button" id="confirm-close-btn" style="background: #f1f5f9; color: #475569; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.2s ease; font-family: inherit;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Tidak, Kembali</button>
            </div>
        </div>
    </div>

    <style>
    @keyframes modalScaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    </style>

    <script>
        let formToSubmitOnConfirm = null;
        
        function showCancelConfirmation(formElement) {
            formToSubmitOnConfirm = formElement;
            const modal = document.getElementById('custom-confirm-modal');
            modal.style.display = 'flex';
        }

        document.getElementById('confirm-cancel-btn').addEventListener('click', function() {
            if (formToSubmitOnConfirm) {
                formToSubmitOnConfirm.submit();
            }
        });

        document.getElementById('confirm-close-btn').addEventListener('click', function() {
            document.getElementById('custom-confirm-modal').style.display = 'none';
            formToSubmitOnConfirm = null;
        });

        // Close modal when clicking outside content area
        document.getElementById('custom-confirm-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
                formToSubmitOnConfirm = null;
            }
        });
    </script>

    <!-- Floating Language Selector Widget -->
    <div class="floating-lang-selector" style="position: fixed; bottom: 25px; right: 25px; z-index: 999999; width: 190px;">
        <div class="lang-select-wrapper" style="position: relative; display: flex; align-items: center; background: #ffffff; border: 1px solid #e2e8f0; padding: 10px 15px; padding-right: 30px; border-radius: 30px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); transition: all 0.3s ease; cursor: pointer; color: #1e293b; width: 100%; box-sizing: border-box; height: 42px;">
            <span style="display: inline-flex; align-items: center; justify-content: center; margin-right: 6px; pointer-events: none; flex-shrink: 0; color: #4f46e5;">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
            </span>
            <span id="active-lang-text" style="font-size: 13.5px; font-weight: 700; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%; pointer-events: none; padding-right: 5px;">Bahasa Indonesia</span>
            <select id="google_translate_select" onchange="translateLanguage(this.value)" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 10;">
                <option value="id">Bahasa Indonesia</option>
                <option value="en">English (Inggris)</option>
                <option value="ja">日本語 (Jepang)</option>
                <option value="zh-CN">简体中文 (Tionghoa)</option>
                <option value="ar">العربية (Arab)</option>
                <option value="fr">Français (Prancis)</option>
                <option value="de">Deutsch (Jerman)</option>
                <option value="ko">한국어 (Korea)</option>
                <option value="es">Español (Spanyol)</option>
                <option value="it">Italiano (Italia)</option>
                <option value="ru">Русский (Rusia)</option>
                <option value="pt">Português (Portugis)</option>
                <option value="nl">Nederlands (Belanda)</option>
                <option value="tr">Türkçe (Turki)</option>
                <option value="vi">Tiếng Việt (Vietnam)</option>
                <option value="th">ไทย (Thailand)</option>
                <option value="ms">Bahasa Melayu (Melayu)</option>
                <option value="hi">हिन्दी (Hindi)</option>
                <option value="tl">Tagalog (Filipina)</option>
                <option value="la">Latin (Latin)</option>
                <option value="el">Ελληνικά (Yunani)</option>
                <option value="sv">Svenska (Swedia)</option>
                <option value="pl">Polski (Polandia)</option>
                <option value="uk">Українська (Ukraina)</option>
                <option value="da">Dansk (Denmark)</option>
                <option value="fi">Suomi (Finlandia)</option>
                <option value="no">Norsk (Norwegia)</option>
                <option value="ro">Română (Rumania)</option>
                <option value="cs">Čeština (Ceko)</option>
                <option value="hu">Magyar (Hungaria)</option>
                <option value="sk">Slovenčina (Slovakia)</option>
                <option value="hr">Hrvatski (Kroasia)</option>
                <option value="bg">Български (Bulgaria)</option>
                <option value="ca">Català (Katalan)</option>
                <option value="he">עברית (Ibrani)</option>
                <option value="fa">فارسی (Persia)</option>
                <option value="af">Afrikaans</option>
                <option value="sq">Shqip (Albania)</option>
                <option value="am">አማርኛ (Amharik)</option>
                <option value="hy">Հայերեն (Armenia)</option>
                <option value="az">Azərbaycanca (Azerbaijan)</option>
                <option value="eu">Euskara (Basuki)</option>
                <option value="be">Беларуская (Belarusia)</option>
                <option value="bn">বাংলা (Bengali)</option>
                <option value="bs">Bosanski (Bosnia)</option>
                <option value="my">မြန်မာ (Myanmar)</option>
                <option value="ceb">Cebuano</option>
                <option value="ny">Chichewa</option>
                <option value="co">Corsu (Korsika)</option>
                <option value="cy">Cymraeg (Wales)</option>
                <option value="eo">Esperanto</option>
                <option value="et">Eesti (Estonia)</option>
                <option value="fy">Frysk (Frisia)</option>
                <option value="gl">Galego (Galisia)</option>
                <option value="ka">ქართული (Georgia)</option>
                <option value="gu">ગુજરાતી</option>
                <option value="ht">Kreyòl Ayisyen (Kreol Haiti)</option>
                <option value="ha">Hausa</option>
                <option value="haw">Ōlelo Hawaiʻi (Hawaii)</option>
                <option value="hmn">Hmong</option>
                <option value="ig">Igbo</option>
                <option value="is">Íslenska (Islandia)</option>
                <option value="jw">Basa Jawa (Jawa)</option>
                <option value="su">Basa Sunda (Sunda)</option>
                <option value="kn">ಕನ್ನಡ</option>
                <option value="kk">Қазақ (Kazakh)</option>
                <option value="km">ខ្មែរ (Kamboja)</option>
                <option value="ku">Kurdî (Kurdi)</option>
                <option value="ky">Кыргызча (Kirgiz)</option>
                <option value="lo">ລາව (Laos)</option>
                <option value="lv">Latviešu (Latvia)</option>
                <option value="lt">Lietuvių (Lituania)</option>
                <option value="lb">Lëtzebuergesch (Luksemburg)</option>
                <option value="mk">Македонски (Makedonia)</option>
                <option value="mg">Malagasy (Madagaskar)</option>
                <option value="ml">മലയാളം</option>
                <option value="mt">Malti (Malta)</option>
                <option value="mi">Māori</option>
                <option value="mr">मराठी</option>
                <option value="mn">Монгол (Mongolia)</option>
                <option value="ne">नेपाली (Nepal)</option>
                <option value="or">ଓଡ଼ିଆ (Oriya)</option>
                <option value="ps">پښتو</option>
                <option value="pa">ਪੰਜਾਬੀ (Penjabi)</option>
                <option value="sm">Gagana Samoa (Samoa)</option>
                <option value="gd">Gàidhlig (Gaelik)</option>
                <option value="sr">Српски (Serbia)</option>
                <option value="st">Sesotho</option>
                <option value="sn">Chishona</option>
                <option value="sd">سنڌي</option>
                <option value="si">සිංහල (Sinhala)</option>
                <option value="sl">Slovenščina (Slovenia)</option>
                <option value="so">Soomaali (Somalia)</option>
                <option value="sw">Kiswahili (Swahili)</option>
                <option value="tg">Тоҷикӣ (Tajik)</option>
                <option value="ta">தமிழ்</option>
                <option value="te">తెలుగు</option>
                <option value="ur">اردو</option>
                <option value="uz">Oʻzbekcha (Uzbek)</option>
                <option value="xh">IsiXhosa</option>
                <option value="yi">ייִדיש</option>
                <option value="yo">Yorùbá</option>
                <option value="zu">isiZulu</option>
            </select>
            <span style="position: absolute; right: 15px; font-size: 0.6rem; color: #64748b; pointer-events: none; opacity: 0.8; top: 50%; transform: translateY(-50%); z-index: 1;">▼</span>
        </div>
    </div>

    <!-- Google Translate Integration Components -->
    <div id="google_translate_element" style="display: none;"></div>
    
    <style>
        /* Hide Google Translate original top bar banner and frame */
        .goog-te-banner-frame, .goog-te-banner, .goog-te-menu-frame, .goog-te-menu {
            display: none !important;
        }
        body {
            top: 0px !important;
            position: static !important;
        }
        .skiptranslate {
            display: none !important;
        }
        iframe.goog-te-banner-frame {
            display: none !important;
        }
        .goog-te-gadget {
            display: none !important;
        }

        /* Responsive Floating Translation Selector override */
        @media (max-width: 480px) {
            .floating-lang-selector {
                bottom: 15px !important;
                right: 15px !important;
                width: 150px !important;
            }
            .lang-select-wrapper {
                padding: 6px 10px !important;
                padding-right: 25px !important;
                height: 34px !important;
                border-radius: 20px !important;
            }
            #active-lang-text {
                font-size: 11.5px !important;
            }
            .floating-lang-selector span:first-child {
                font-size: 1rem !important;
                margin-right: 4px !important;
            }
            .floating-lang-selector span:last-child {
                right: 10px !important;
                font-size: 0.5rem !important;
            }
        }
    </style>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
        
        function translateLanguage(langCode) {
            // Delete existing googtrans cookies
            document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=" + location.hostname;
            document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=." + location.hostname.split('.').slice(-2).join('.');

            if (langCode !== 'id') {
                // Set new googtrans cookies for path/domain resolution
                const cookieValue = "/id/" + langCode;
                document.cookie = "googtrans=" + cookieValue + "; path=/;";
                document.cookie = "googtrans=" + cookieValue + "; path=/; domain=" + location.hostname;
                document.cookie = "googtrans=" + cookieValue + "; path=/; domain=." + location.hostname.split('.').slice(-2).join('.');
            }
            
            // Reload page to apply google translate change immediately
            location.reload();
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const getCookie = (name) => {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            };
            
            const googtrans = getCookie('googtrans');
            const select = document.getElementById('google_translate_select');
            const activeText = document.getElementById('active-lang-text');
            if (select) {
                if (googtrans) {
                    const parts = googtrans.split('/');
                    const activeLang = parts[parts.length - 1];
                    select.value = activeLang;
                } else {
                    select.value = 'id';
                }
                
                // Update visible text
                if (activeText && select.options[select.selectedIndex]) {
                    activeText.innerText = select.options[select.selectedIndex].text;
                }
            }
        });
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>