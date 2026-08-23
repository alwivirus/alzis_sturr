<!-- ==========================================================================
     ALzis Interactive Assistant Chatbot Widget (Theme-Aware & Responsive)
     ========================================================================== -->
<div id="alzis-chatbot-container" style="position: fixed; z-index: 9990; bottom: 24px; right: 24px; font-family: var(--font-sans);">
    
    <!-- 1. Floating Speech Bubble Greeting (Dismissible) -->
    <div id="chatbot-greeting-bubble" style="display: none; position: absolute; bottom: 70px; right: 0; width: 230px; background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; padding: 12px 14px; box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 20px var(--primary-glow); transform-origin: bottom right; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); animation: botFloat 3s ease-in-out infinite;">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 1.1rem;">👋</span>
                <div>
                    <div style="font-size: 0.72rem; font-weight: 800; color: var(--primary); text-transform: uppercase;">ALzis Assistant</div>
                    <div style="font-size: 0.8rem; color: #fff; font-weight: 600; line-height: 1.25; margin-top: 2px;">Halo! Ada yang bisa saya bantu?</div>
                </div>
            </div>
            <button type="button" onclick="dismissChatbotGreeting(event)" style="border: none; background: transparent; color: var(--text-dim); cursor: pointer; padding: 2px; line-height: 1; font-size: 1.1rem;" title="Tutup">
                &times;
            </button>
        </div>
        <div style="margin-top: 8px; text-align: right;">
            <button type="button" onclick="openChatbotWindow()" style="background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary-border); border-radius: 6px; font-size: 0.72rem; font-weight: 700; padding: 3px 8px; cursor: pointer;">
                Chat Sekarang &rarr;
            </button>
        </div>
        <!-- Little tail triangle -->
        <div style="position: absolute; bottom: -7px; right: 22px; width: 12px; height: 12px; background: var(--bg-card); border-right: 1px solid var(--border); border-bottom: 1px solid var(--border); transform: rotate(45deg);"></div>
    </div>

    <!-- 2. Floating Avatar Trigger Button -->
    <button id="chatbot-trigger-btn" type="button" onclick="toggleChatbotWindow()" style="width: 54px; height: 54px; border-radius: 50%; background: var(--primary-gradient); border: 2px solid rgba(255,255,255,0.2); box-shadow: 0 6px 25px rgba(0,0,0,0.5), 0 0 25px var(--primary-glow); cursor: pointer; display: flex; align-items: center; justify-content: center; position: relative; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);">
        <!-- Bot Icon / Active State Icon -->
        <span id="chatbot-icon-closed" style="display: flex; align-items: center; justify-content: center;">
            <svg style="width: 26px; height: 26px; color: #050811;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 8V4H8"></path>
                <rect width="16" height="12" x="4" y="8" rx="2"></rect>
                <path d="M2 14h2"></path>
                <path d="M20 14h2"></path>
                <path d="M15 13v2"></path>
                <path d="M9 13v2"></path>
            </svg>
        </span>
        <span id="chatbot-icon-open" style="display: none; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; color: #050811; line-height: 1;">
            &times;
        </span>
        <!-- Online Green Pulse Dot -->
        <span style="position: absolute; top: 1px; right: 1px; width: 12px; height: 12px; border-radius: 50%; background: #10b981; border: 2px solid var(--bg-body); box-shadow: 0 0 8px #10b981;"></span>
    </button>

    <!-- 3. Interactive Chatbot Modal Window -->
    <div id="chatbot-window" style="display: none; position: absolute; bottom: 70px; right: 0; width: 350px; max-width: calc(100vw - 32px); height: 480px; max-height: calc(100vh - 120px); background: var(--bg-card); border: 1px solid var(--border); border-radius: 18px; box-shadow: 0 15px 40px rgba(0,0,0,0.65), 0 0 30px var(--primary-glow); overflow: hidden; flex-direction: column; z-index: 10000; animation: botPopUp 0.25s cubic-bezier(0.16, 1, 0.3, 1);">
        
        <!-- Window Header -->
        <div style="background: linear-gradient(135deg, var(--bg-surface-elevated) 0%, var(--bg-surface) 100%); padding: 14px 16px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; box-shadow: 0 0 10px var(--primary-glow); flex-shrink: 0;">
                    <svg style="width: 20px; height: 20px; color: #050811;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M12 8V4H8"></path>
                        <rect width="16" height="12" x="4" y="8" rx="2"></rect>
                        <path d="M2 14h2"></path>
                        <path d="M20 14h2"></path>
                        <path d="M15 13v2"></path>
                        <path d="M9 13v2"></path>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.92rem; font-weight: 800; color: #fff; display: flex; align-items: center; gap: 6px;">
                        ALzis AI Bot
                        <span style="font-size: 0.62rem; padding: 1px 6px; background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 4px; font-weight: 700;">ONLINE</span>
                    </div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">Asisten Virtual ALZIS STORE</div>
                </div>
            </div>
            
            <div style="display: flex; align-items: center; gap: 4px;">
                <button type="button" onclick="resetChatbotHistory()" style="border: none; background: rgba(255,255,255,0.06); color: var(--text-muted); width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer;" title="Reset Percakapan">
                    <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
                </button>
                <button type="button" onclick="toggleChatbotWindow()" style="border: none; background: rgba(255,255,255,0.06); color: var(--text-muted); width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1.1rem; line-height: 1;" title="Tutup Chat">
                    &times;
                </button>
            </div>
        </div>

        <!-- Messages Body -->
        <div id="chatbot-messages-container" style="flex: 1; overflow-y: auto; padding: 14px; display: flex; flex-direction: column; gap: 10px; background: var(--bg-surface); scroll-behavior: smooth;">
            
            <!-- Bot Welcome Bubble -->
            <div class="bot-msg-wrapper" style="display: flex; gap: 8px; align-items: flex-start; max-width: 88%;">
                <div style="width: 26px; height: 26px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                    <svg style="width: 14px; height: 14px; color: #050811;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="16" height="12" x="4" y="8" rx="2"></rect></svg>
                </div>
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px 12px 12px 2px; padding: 10px 12px; color: var(--text-main); font-size: 0.82rem; line-height: 1.45; box-shadow: 0 2px 8px rgba(0,0,0,0.25);">
                    Halo! Selamat datang di <strong>ALZIS STORE</strong> 🎮✨<br>
                    Ada yang bisa saya bantu hari ini?
                </div>
            </div>

            <!-- Quick Suggestion Action Chips -->
            <div id="chatbot-quick-chips" style="display: flex; flex-wrap: wrap; gap: 6px; margin: 4px 0 6px 34px;">
                <button type="button" onclick="sendChatbotQuickPrompt('Cek Stok Akun Game')" class="bot-quick-chip">
                    🎮 Cek Stok Akun
                </button>
                <button type="button" onclick="sendChatbotQuickPrompt('Info Garansi Anti Hackback')" class="bot-quick-chip">
                    🛡️ Info Garansi
                </button>
                <button type="button" onclick="sendChatbotQuickPrompt('Cara Beli & Rekber Admin')" class="bot-quick-chip">
                    ⚡ Cara Beli
                </button>
                <button type="button" onclick="sendChatbotQuickPrompt('Hubungi Admin WhatsApp')" class="bot-quick-chip">
                    💬 Chat Admin WA
                </button>
            </div>

        </div>

        <!-- Typing Indicator (Hidden by Default) -->
        <div id="chatbot-typing-indicator" style="display: none; padding: 6px 14px; background: var(--bg-surface); align-items: center; gap: 8px; font-size: 0.74rem; color: var(--text-muted);">
            <div style="display: flex; gap: 4px; align-items: center;">
                <span class="bot-typing-dot"></span>
                <span class="bot-typing-dot" style="animation-delay: 0.2s;"></span>
                <span class="bot-typing-dot" style="animation-delay: 0.4s;"></span>
            </div>
            <span>ALzis Bot sedang mengetik...</span>
        </div>

        <!-- Window Input Bar -->
        <form id="chatbot-input-form" onsubmit="handleChatbotSubmit(event)" style="background: var(--bg-card); border-top: 1px solid var(--border); padding: 10px 12px; display: flex; align-items: center; gap: 8px;">
            <input type="text" id="chatbot-input-field" placeholder="Ketik pesan Anda di sini..." autocomplete="off" style="flex: 1; min-width: 0; background: var(--bg-surface); border: 1px solid var(--border); border-radius: 20px; padding: 8px 14px; color: #fff; font-size: 0.82rem; outline: none; transition: border-color 0.2s;">
            <button type="submit" id="chatbot-send-btn" style="width: 36px; height: 36px; border-radius: 50%; background: var(--primary-gradient); border: none; color: #050811; display: flex; align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0; transition: transform 0.2s;">
                <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </button>
        </form>

    </div>
</div>

<style>
@keyframes botFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
}
@keyframes botPopUp {
    from { opacity: 0; transform: scale(0.9) translateY(20px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
@keyframes botDotPulse {
    0%, 100% { opacity: 0.3; transform: scale(0.8); }
    50% { opacity: 1; transform: scale(1.2); }
}
.bot-typing-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--primary);
    display: inline-block;
    animation: botDotPulse 1.2s infinite ease-in-out;
}
.bot-quick-chip {
    background: var(--primary-light);
    color: var(--primary);
    border: 1px solid var(--primary-border);
    border-radius: 999px;
    padding: 4px 10px;
    font-size: 0.72rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}
.bot-quick-chip:hover {
    background: var(--primary);
    color: #050811;
    transform: translateY(-1px);
}
@media (max-width: 768px) {
    #alzis-chatbot-container {
        bottom: 74px !important;
        right: 14px !important;
    }
    #chatbot-window {
        bottom: 64px !important;
        right: -4px !important;
        width: calc(100vw - 20px) !important;
        height: 420px !important;
    }
}
</style>

<script>
    // Bad Words / Dirty Words List to Automatically Censor
    const BOT_CENSORED_WORDS = [
        'anjing', 'babi', 'kontol', 'memek', 'pantek', 'bangsat', 'bajingan', 'tolol', 'goblok', 
        'idiot', 'bego', 'ngentot', 'asu', 'pepek', 'itil', 'titit', 'jembut', 'lonte', 'perek', 
        'kampret', 'peler', 'tetek', 'toket', 'fuck', 'bitch', 'asshole', 'dick', 'pussy'
    ];

    // Show initial speech bubble greeting after 3 seconds if not dismissed
    document.addEventListener('DOMContentLoaded', function() {
        const dismissed = sessionStorage.getItem('alzis_bot_greeting_dismissed');
        if (!dismissed) {
            setTimeout(() => {
                const bubble = document.getElementById('chatbot-greeting-bubble');
                const win = document.getElementById('chatbot-window');
                if (bubble && (!win || win.style.display === 'none')) {
                    bubble.style.display = 'block';
                }
            }, 3000);
        }
    });

    function dismissChatbotGreeting(e) {
        if (e) e.stopPropagation();
        const bubble = document.getElementById('chatbot-greeting-bubble');
        if (bubble) bubble.style.display = 'none';
        sessionStorage.setItem('alzis_bot_greeting_dismissed', 'true');
    }

    function toggleChatbotWindow() {
        const win = document.getElementById('chatbot-window');
        const bubble = document.getElementById('chatbot-greeting-bubble');
        const iconClosed = document.getElementById('chatbot-icon-closed');
        const iconOpen = document.getElementById('chatbot-icon-open');

        if (win.style.display === 'none' || win.style.display === '') {
            win.style.display = 'flex';
            if (bubble) bubble.style.display = 'none';
            if (iconClosed) iconClosed.style.display = 'none';
            if (iconOpen) iconOpen.style.display = 'flex';
            const input = document.getElementById('chatbot-input-field');
            if (input) setTimeout(() => input.focus(), 150);
        } else {
            win.style.display = 'none';
            if (iconClosed) iconClosed.style.display = 'flex';
            if (iconOpen) iconOpen.style.display = 'none';
        }
    }

    function openChatbotWindow() {
        const win = document.getElementById('chatbot-window');
        if (win && win.style.display !== 'flex') {
            toggleChatbotWindow();
        }
    }

    function sendChatbotQuickPrompt(text) {
        const input = document.getElementById('chatbot-input-field');
        if (input) {
            input.value = text;
            handleChatbotSubmit(new Event('submit'));
        }
    }

    function filterBadWords(text) {
        let isToxic = false;
        let filteredText = text;
        
        BOT_CENSORED_WORDS.forEach(word => {
            const regex = new RegExp(`\\b${word}\\b`, 'gi');
            if (regex.test(filteredText)) {
                isToxic = true;
                filteredText = filteredText.replace(regex, '***');
            }
        });

        return { isToxic, filteredText };
    }

    function appendUserMessage(text) {
        const container = document.getElementById('chatbot-messages-container');
        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        
        const wrapper = document.createElement('div');
        wrapper.style.cssText = 'display: flex; justify-content: flex-end; margin-left: auto; max-width: 85%;';
        wrapper.innerHTML = `
            <div style="background: var(--primary-gradient); color: #050811; border-radius: 12px 12px 2px 12px; padding: 8px 12px; font-size: 0.82rem; font-weight: 600; line-height: 1.4; word-break: break-word; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                ${escapeHtml(text)}
                <div style="font-size: 0.62rem; color: rgba(5,8,17,0.7); text-align: right; margin-top: 2px;">${time}</div>
            </div>
        `;
        container.appendChild(wrapper);
        container.scrollTop = container.scrollHeight;
    }

    function appendBotMessage(htmlContent) {
        const container = document.getElementById('chatbot-messages-container');
        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        const wrapper = document.createElement('div');
        wrapper.style.cssText = 'display: flex; gap: 8px; align-items: flex-start; max-width: 88%;';
        wrapper.innerHTML = `
            <div style="width: 26px; height: 26px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                <svg style="width: 14px; height: 14px; color: #050811;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="16" height="12" x="4" y="8" rx="2"></rect></svg>
            </div>
            <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px 12px 12px 2px; padding: 10px 12px; color: var(--text-main); font-size: 0.82rem; line-height: 1.45; box-shadow: 0 2px 8px rgba(0,0,0,0.25);">
                ${htmlContent}
                <div style="font-size: 0.62rem; color: var(--text-dim); text-align: right; margin-top: 4px;">${time}</div>
            </div>
        `;
        container.appendChild(wrapper);
        container.scrollTop = container.scrollHeight;
    }

    function escapeHtml(str) {
        return str.replace(/[&<>'"]/g, tag => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            "'": '&#39;',
            '"': '&quot;'
        }[tag] || tag));
    }

    function handleChatbotSubmit(e) {
        if (e) e.preventDefault();
        const input = document.getElementById('chatbot-input-field');
        if (!input) return;

        const rawText = input.value.trim();
        if (!rawText) return;

        input.value = '';

        // 1. Check for bad/toxic words
        const { isToxic, filteredText } = filterBadWords(rawText);
        appendUserMessage(filteredText);

        // Show typing indicator
        const typing = document.getElementById('chatbot-typing-indicator');
        if (typing) typing.style.display = 'flex';

        setTimeout(() => {
            if (typing) typing.style.display = 'none';
            processBotResponse(rawText.toLowerCase(), isToxic);
        }, 550);
    }

    function processBotResponse(query, isToxic) {
        // Toxic / Dirty Word Response
        if (isToxic) {
            appendBotMessage(`
                ⚠️ <strong>Peringatan Sopan Santun:</strong><br>
                Pesan Anda mengandung kata yang tidak pantas dan otomatis tersensor. Mohon gunakan bahasa yang ramah ya kak 🙏<br><br>
                Ada yang bisa kami bantu seputar akun game atau cara pembelian di ALZIS STORE?
            `);
            return;
        }

        // Stock / Account Search Query
        if (query.includes('stok') || query.includes('ready') || query.includes('akun') || query.includes('katalog') || 
            query.includes('ff') || query.includes('free fire') || query.includes('ml') || query.includes('mobile legends') || 
            query.includes('genshin') || query.includes('pubg') || query.includes('valorant') || query.includes('beli') || 
            query.includes('harga') || query.includes('sultan')) {
            
            let gameName = 'Game Pilihan Anda';
            let targetUrl = '{{ route('catalog') }}';
            
            if (query.includes('free fire') || query.includes('ff')) {
                gameName = 'Free Fire';
                targetUrl = '{{ route('catalog') }}?q=Free+Fire';
            } else if (query.includes('mobile legends') || query.includes('ml')) {
                gameName = 'Mobile Legends';
                targetUrl = '{{ route('catalog') }}?q=Mobile+Legends';
            } else if (query.includes('genshin')) {
                gameName = 'Genshin Impact';
                targetUrl = '{{ route('catalog') }}?q=Genshin';
            } else if (query.includes('pubg')) {
                gameName = 'PUBG Mobile';
                targetUrl = '{{ route('catalog') }}?q=PUBG';
            } else if (query.includes('valorant')) {
                gameName = 'Valorant';
                targetUrl = '{{ route('catalog') }}?q=Valorant';
            }

            appendBotMessage(`
                🎮 <strong>Stok Akun Siap Transaksi!</strong><br>
                Kami menyediakan puluhan stok akun sultan bergaransi 100% Anti-HB siap kirim data instan.<br><br>
                <div style="margin-top: 6px;">
                    <a href="${targetUrl}" class="btn btn-primary btn-sm" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; font-size: 0.78rem; text-decoration: none; border-radius: 6px;">
                        <span>🚀 Lihat Katalog ${gameName}</span>
                    </a>
                </div>
            `);
            return;
        }

        // Warranty / Rekber / Anti-Hackback Query
        if (query.includes('garansi') || query.includes('aman') || query.includes('hackback') || query.includes('hb') || 
            query.includes('rekber') || query.includes('midman') || query.includes('penipuan') || query.includes('rip')) {
            appendBotMessage(`
                🛡️ <strong>Jaminan Garansi 100% Anti Hackback!</strong><br>
                Semua transaksi akun game di ALZIS STORE dipandu langsung oleh Rekber / Midman Admin Utama Toko resmi. Data akun bersih (all unbind) dan bergaransi penuh seumur hidup.<br><br>
                <a href="{{ route('terms') }}" style="color: var(--primary); text-decoration: underline; font-weight: 700;">Pelajari Ketentuan Garansi &rarr;</a>
            `);
            return;
        }

        // WhatsApp Admin / CS Query
        if (query.includes('admin') || query.includes('owner') || query.includes('wa') || query.includes('whatsapp') || 
            query.includes('cs') || query.includes('kontak') || query.includes('bantuan') || query.includes('nomor')) {
            appendBotMessage(`
                💬 <strong>Hubungi Admin Utama:</strong><br>
                Butuh panduan langsung atau negosiasi? Anda bisa chat Admin Utama kami via WhatsApp resmi:<br><br>
                <a href="{{ route('contact') }}" target="_blank" class="btn btn-whatsapp btn-sm" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; font-size: 0.78rem; border-radius: 6px; text-decoration: none;">
                    <span>📲 Hubungi WhatsApp Admin</span>
                </a>
            `);
            return;
        }

        // How to buy / Order Flow Query
        if (query.includes('cara') || query.includes('order') || query.includes('proses') || query.includes('pembayaran') || query.includes('bayar')) {
            appendBotMessage(`
                ⚡ <strong>Cara Pembelian Mudah & Cepat:</strong><br>
                1. Pilih akun yang Anda sukai di menu <strong>Katalog</strong>.<br>
                2. Klik tombol <strong>Beli via Rekber Admin</strong>.<br>
                3. Kirim format ke WhatsApp Admin untuk proses serah terima data 5 menit selesai! 🚀
            `);
            return;
        }

        // Greeting / Default Fallback
        appendBotMessage(`
            Terima kasih atas pertanyaannya! 😊<br>
            Untuk membantu Anda lebih cepat, silakan pilih topik yang Anda butuhkan di bawah ini:<br><br>
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <a href="{{ route('catalog') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">• 🎮 Jelajahi Semua Katalog Akun</a>
                <a href="{{ route('terms') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">• 🛡️ Syarat Garansi & Anti-HB</a>
                <a href="{{ route('contact') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">• 💬 Kontak WhatsApp Customer Service</a>
            </div>
        `);
    }

    function resetChatbotHistory() {
        const container = document.getElementById('chatbot-messages-container');
        if (container) {
            container.innerHTML = `
                <div class="bot-msg-wrapper" style="display: flex; gap: 8px; align-items: flex-start; max-width: 88%;">
                    <div style="width: 26px; height: 26px; border-radius: 50%; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                        <svg style="width: 14px; height: 14px; color: #050811;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="16" height="12" x="4" y="8" rx="2"></rect></svg>
                    </div>
                    <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px 12px 12px 2px; padding: 10px 12px; color: var(--text-main); font-size: 0.82rem; line-height: 1.45; box-shadow: 0 2px 8px rgba(0,0,0,0.25);">
                        Halo! Percakapan telah direset 🎮 Ada yang bisa saya bantu?
                    </div>
                </div>
                <div id="chatbot-quick-chips" style="display: flex; flex-wrap: wrap; gap: 6px; margin: 4px 0 6px 34px;">
                    <button type="button" onclick="sendChatbotQuickPrompt('Cek Stok Akun Game')" class="bot-quick-chip">🎮 Cek Stok Akun</button>
                    <button type="button" onclick="sendChatbotQuickPrompt('Info Garansi Anti Hackback')" class="bot-quick-chip">🛡️ Info Garansi</button>
                    <button type="button" onclick="sendChatbotQuickPrompt('Cara Beli & Rekber Admin')" class="bot-quick-chip">⚡ Cara Beli</button>
                </div>
            `;
        }
    }
</script>
