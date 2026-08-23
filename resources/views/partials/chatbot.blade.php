<!-- ==========================================================================
     ALzis Interactive Assistant Chatbot Widget (Theme-Aware & Responsive)
     ========================================================================== -->
<div id="alzis-chatbot-container" style="position: fixed; z-index: 9990; bottom: 24px; right: 24px; font-family: var(--font-sans);">
    
    <!-- 1. Floating Speech Bubble Greeting (Dismissible) -->
    <div id="chatbot-greeting-bubble" style="display: none; position: absolute; bottom: 70px; right: 0; width: 240px; background: var(--bg-card); border: 1px solid var(--border); border-radius: 16px; padding: 12px 14px; box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 20px var(--primary-glow); transform-origin: bottom right; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); animation: botFloat 3s ease-in-out infinite;">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 34px; height: 34px; flex-shrink: 0;">
                    <!-- Cute 3D Cyber Bot SVG -->
                    <svg viewBox="0 0 100 100" style="width: 100%; height: 100%; filter: drop-shadow(0 2px 6px rgba(0,0,0,0.4));">
                        <circle cx="50" cy="8" r="4.5" fill="var(--primary)"/>
                        <path d="M 50 18 L 50 10" stroke="var(--primary)" stroke-width="3.5" stroke-linecap="round"/>
                        <path d="M 18 52 A 32 32 0 0 1 82 52" fill="none" stroke="#334155" stroke-width="5" stroke-linecap="round"/>
                        <rect x="22" y="24" width="56" height="52" rx="18" fill="#0f172a" stroke="var(--border)" stroke-width="1.5"/>
                        <path d="M 50 27 L 56 32 L 54 40 L 50 43 L 46 40 L 44 32 Z" fill="var(--primary)"/>
                        <path d="M 50.5 31 L 48 35 L 50.5 35 L 49.5 39 L 53 34.5 L 50.5 34.5 Z" fill="#0b1329"/>
                        <rect x="28" y="44" width="44" height="24" rx="9" fill="#030712" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                        <path d="M 36 54 Q 40 50 44 54 Q 40 58 36 54 Z" fill="var(--primary)"/>
                        <path d="M 56 54 Q 60 50 64 54 Q 60 58 56 54 Z" fill="var(--primary)"/>
                        <rect x="14" y="43" width="9" height="20" rx="4" fill="#1e293b"/>
                        <circle cx="18" cy="53" r="3" fill="var(--primary)"/>
                        <rect x="77" y="43" width="9" height="20" rx="4" fill="#1e293b"/>
                        <circle cx="82" cy="53" r="3" fill="var(--primary)"/>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.72rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px;">ALzis AI Bot</div>
                    <div style="font-size: 0.8rem; color: #fff; font-weight: 600; line-height: 1.25; margin-top: 2px;">Halo! Ada yang bisa saya bantu?</div>
                </div>
            </div>
            <button type="button" onclick="dismissChatbotGreeting(event)" style="border: none; background: transparent; color: var(--text-dim); cursor: pointer; padding: 2px; line-height: 1; font-size: 1.2rem;" title="Tutup">
                &times;
            </button>
        </div>
        <div style="margin-top: 10px; text-align: right;">
            <button type="button" onclick="openChatbotWindow()" style="background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary-border); border-radius: 8px; font-size: 0.74rem; font-weight: 800; padding: 4px 10px; cursor: pointer; transition: all 0.2s;">
                Chat Sekarang &rarr;
            </button>
        </div>
        <!-- Little tail triangle -->
        <div style="position: absolute; bottom: -7px; right: 22px; width: 12px; height: 12px; background: var(--bg-card); border-right: 1px solid var(--border); border-bottom: 1px solid var(--border); transform: rotate(45deg);"></div>
    </div>

    <!-- 2. Floating Avatar Trigger Button -->
    <button id="chatbot-trigger-btn" type="button" onclick="toggleChatbotWindow()" style="width: 58px; height: 58px; border-radius: 50%; background: linear-gradient(145deg, var(--bg-surface-elevated), var(--bg-card)); border: 2px solid var(--primary-border); box-shadow: 0 8px 30px rgba(0,0,0,0.6), 0 0 25px var(--primary-glow); cursor: pointer; display: flex; align-items: center; justify-content: center; position: relative; transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1); padding: 5px;">
        <!-- Bot Robot Avatar Closed State -->
        <span id="chatbot-icon-closed" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
            <svg viewBox="0 0 100 100" style="width: 44px; height: 44px; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.6));">
                <!-- Antenna -->
                <circle cx="50" cy="8" r="4.5" fill="var(--primary)"/>
                <path d="M 50 18 L 50 10" stroke="var(--primary)" stroke-width="3.5" stroke-linecap="round"/>
                <!-- Headset Band -->
                <path d="M 18 52 A 32 32 0 0 1 82 52" fill="none" stroke="#475569" stroke-width="5.5" stroke-linecap="round"/>
                <path d="M 23 45 A 28 28 0 0 1 77 45" fill="none" stroke="var(--primary)" stroke-width="2.5" stroke-linecap="round"/>
                <!-- Robot Head Base -->
                <rect x="22" y="23" width="56" height="54" rx="18" fill="#0f172a" stroke="rgba(255,255,255,0.18)" stroke-width="1.8"/>
                <!-- ALZIS Crest Shield on Forehead -->
                <path d="M 50 26 L 57 32 L 55 41 L 50 44 L 45 41 L 43 32 Z" fill="var(--primary)"/>
                <path d="M 50 29 L 54 33 L 52.5 39 L 50 41 L 47.5 39 L 46 33 Z" fill="#0b1329"/>
                <path d="M 51 31 L 48 35.5 L 50.5 35.5 L 49 40 L 53 35 L 50.5 35 Z" fill="var(--primary)"/>
                <!-- Cyber Visor -->
                <rect x="27" y="45" width="46" height="24" rx="9" fill="#020617" stroke="var(--border)" stroke-width="1.2"/>
                <rect x="29" y="46" width="42" height="3" rx="1.5" fill="rgba(255,255,255,0.2)"/>
                <!-- Glowing LED Eyes -->
                <path d="M 35 54 Q 40 49 45 54 Q 40 59 35 54 Z" fill="var(--primary)"/>
                <circle cx="40" cy="54" r="1.5" fill="#fff"/>
                <path d="M 55 54 Q 60 49 65 54 Q 60 59 55 54 Z" fill="var(--primary)"/>
                <circle cx="60" cy="54" r="1.5" fill="#fff"/>
                <!-- Earcups -->
                <rect x="13" y="42" width="10" height="22" rx="4" fill="#1e293b" stroke="rgba(255,255,255,0.15)" stroke-width="1"/>
                <circle cx="18" cy="53" r="3.5" fill="var(--primary)"/>
                <rect x="77" y="42" width="10" height="22" rx="4" fill="#1e293b" stroke="rgba(255,255,255,0.15)" stroke-width="1"/>
                <circle cx="82" cy="53" r="3.5" fill="var(--primary)"/>
                <!-- Mic -->
                <path d="M 79 61 Q 77 74 64 74" fill="none" stroke="#475569" stroke-width="2.5" stroke-linecap="round"/>
                <circle cx="62" cy="74" r="3" fill="var(--primary)"/>
            </svg>
        </span>
        <!-- Close State Icon -->
        <span id="chatbot-icon-open" style="display: none; align-items: center; justify-content: center; font-size: 1.6rem; font-weight: 800; color: var(--primary); line-height: 1;">
            &times;
        </span>
        <!-- Online Green Pulse Dot -->
        <span style="position: absolute; top: 1px; right: 1px; width: 13px; height: 13px; border-radius: 50%; background: #10b981; border: 2.5px solid var(--bg-body); box-shadow: 0 0 10px #10b981;"></span>
    </button>

    <!-- 3. Interactive Chatbot Modal Window -->
    <div id="chatbot-window" style="display: none; position: absolute; bottom: 74px; right: 0; width: 350px; max-width: calc(100vw - 32px); height: 490px; max-height: calc(100vh - 120px); background: var(--bg-card); border: 1px solid var(--border); border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.65), 0 0 30px var(--primary-glow); overflow: hidden; flex-direction: column; z-index: 10000; animation: botPopUp 0.25s cubic-bezier(0.16, 1, 0.3, 1);">
        
        <!-- Window Header -->
        <div style="background: linear-gradient(135deg, var(--bg-surface-elevated) 0%, var(--bg-surface) 100%); padding: 12px 16px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 38px; height: 38px; border-radius: 50%; background: var(--bg-card); border: 1.5px solid var(--primary-border); display: flex; align-items: center; justify-content: center; box-shadow: 0 0 12px var(--primary-glow); flex-shrink: 0; padding: 2px;">
                    <svg viewBox="0 0 100 100" style="width: 100%; height: 100%;">
                        <circle cx="50" cy="8" r="4.5" fill="var(--primary)"/>
                        <path d="M 50 18 L 50 10" stroke="var(--primary)" stroke-width="3.5" stroke-linecap="round"/>
                        <path d="M 18 52 A 32 32 0 0 1 82 52" fill="none" stroke="#475569" stroke-width="5.5" stroke-linecap="round"/>
                        <rect x="22" y="23" width="56" height="54" rx="18" fill="#0f172a" stroke="rgba(255,255,255,0.18)" stroke-width="1.8"/>
                        <path d="M 50 26 L 57 32 L 55 41 L 50 44 L 45 41 L 43 32 Z" fill="var(--primary)"/>
                        <path d="M 50 29 L 54 33 L 52.5 39 L 50 41 L 47.5 39 L 46 33 Z" fill="#0b1329"/>
                        <path d="M 51 31 L 48 35.5 L 50.5 35.5 L 49 40 L 53 35 L 50.5 35 Z" fill="var(--primary)"/>
                        <rect x="27" y="45" width="46" height="24" rx="9" fill="#020617" stroke="var(--border)" stroke-width="1.2"/>
                        <path d="M 35 54 Q 40 49 45 54 Q 40 59 35 54 Z" fill="var(--primary)"/>
                        <circle cx="40" cy="54" r="1.5" fill="#fff"/>
                        <path d="M 55 54 Q 60 49 65 54 Q 60 59 55 54 Z" fill="var(--primary)"/>
                        <circle cx="60" cy="54" r="1.5" fill="#fff"/>
                        <rect x="13" y="42" width="10" height="22" rx="4" fill="#1e293b"/>
                        <circle cx="18" cy="53" r="3.5" fill="var(--primary)"/>
                        <rect x="77" y="42" width="10" height="22" rx="4" fill="#1e293b"/>
                        <circle cx="82" cy="53" r="3.5" fill="var(--primary)"/>
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
                <button type="button" onclick="toggleChatbotWindow()" style="border: none; background: rgba(255,255,255,0.06); color: var(--text-muted); width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1.2rem; line-height: 1;" title="Tutup Chat">
                    &times;
                </button>
            </div>
        </div>

        <!-- Messages Body -->
        <div id="chatbot-messages-container" style="flex: 1; overflow-y: auto; padding: 14px; display: flex; flex-direction: column; gap: 10px; background: var(--bg-surface); scroll-behavior: smooth;">
            
            <!-- Bot Welcome Bubble -->
            <div class="bot-msg-wrapper" style="display: flex; gap: 8px; align-items: flex-start; max-width: 88%;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--bg-card); border: 1px solid var(--primary-border); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; padding: 2px;">
                    <svg viewBox="0 0 100 100" style="width: 100%; height: 100%;">
                        <circle cx="50" cy="8" r="4.5" fill="var(--primary)"/>
                        <path d="M 50 18 L 50 10" stroke="var(--primary)" stroke-width="3.5" stroke-linecap="round"/>
                        <rect x="22" y="24" width="56" height="52" rx="18" fill="#0f172a" stroke="var(--border)" stroke-width="1.5"/>
                        <path d="M 50 27 L 56 32 L 54 40 L 50 43 L 46 40 L 44 32 Z" fill="var(--primary)"/>
                        <rect x="28" y="44" width="44" height="24" rx="9" fill="#030712"/>
                        <path d="M 36 54 Q 40 50 44 54 Q 40 58 36 54 Z" fill="var(--primary)"/>
                        <path d="M 56 54 Q 60 50 64 54 Q 60 58 56 54 Z" fill="var(--primary)"/>
                    </svg>
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
            <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--bg-card); border: 1px solid var(--primary-border); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; padding: 2px;">
                <svg viewBox="0 0 100 100" style="width: 100%; height: 100%;">
                    <circle cx="50" cy="8" r="4.5" fill="var(--primary)"/>
                    <path d="M 50 18 L 50 10" stroke="var(--primary)" stroke-width="3.5" stroke-linecap="round"/>
                    <rect x="22" y="24" width="56" height="52" rx="18" fill="#0f172a" stroke="var(--border)" stroke-width="1.5"/>
                    <path d="M 50 27 L 56 32 L 54 40 L 50 43 L 46 40 L 44 32 Z" fill="var(--primary)"/>
                    <rect x="28" y="44" width="44" height="24" rx="9" fill="#030712"/>
                    <path d="M 36 54 Q 40 50 44 54 Q 40 58 36 54 Z" fill="var(--primary)"/>
                    <path d="M 56 54 Q 60 50 64 54 Q 60 58 56 54 Z" fill="var(--primary)"/>
                </svg>
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
        // 1. Toxic / Dirty Word Detection
        if (isToxic) {
            appendBotMessage(`
                ⚠️ <strong>Peringatan Sopan Santun:</strong><br>
                Pesan Anda mengandung kata yang tidak pantas dan otomatis tersensor. Mohon gunakan bahasa yang ramah ya kak 🙏<br><br>
                Ada yang bisa kami bantu seputar akun game atau panduan pembelian di ALZIS STORE?
            `);
            return;
        }

        // 2. Cara Beli / Alur Pembayaran / How to Buy (Must be checked before single word 'beli')
        if (query.includes('cara beli') || query.includes('cara order') || query.includes('cara pesan') || 
            query.includes('langkah') || query.includes('gimana cara') || query.includes('bagaimana cara') || 
            query.includes('alur') || query.includes('prosedur') || query.includes('cara transaksi') ||
            query.includes('cara bayar')) {
            
            appendBotMessage(`
                ⚡ <strong>Panduan 3 Langkah Mudah Pembelian:</strong><br>
                1. <strong>Pilih Akun</strong> yang Anda inginkan di halaman <a href="{{ route('catalog') }}" style="color: var(--primary); font-weight: 700;">Katalog Akun</a>.<br>
                2. <strong>Klik Tombol Beli via Rekber</strong> pada detail akun untuk terhubung ke WhatsApp Admin Toko.<br>
                3. <strong>Admin Memandu Transaksi:</strong> Lakukan pembayaran aman, admin mengamankan & menyerahkan data akun (5 menit selesai)! 🚀<br><br>
                <a href="{{ route('how.to.buy') }}" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 4px; padding: 5px 10px; font-size: 0.76rem; border-radius: 6px;">
                    <span>📖 Baca Panduan Lengkap</span>
                </a>
            `);
            return;
        }

        // 3. Garansi, Keamanan & Rekber / Midman Anti-Rip
        if (query.includes('garansi') || query.includes('anti hb') || query.includes('hackback') || 
            query.includes('rekber') || query.includes('midman') || query.includes('anti rip') || 
            query.includes('aman ga') || query.includes('apakah aman') || query.includes('penipuan') || query.includes('rip')) {
            
            appendBotMessage(`
                🛡️ <strong>Jaminan Keamanan & Garansi Anti-HB:</strong><br>
                • <strong>Garansi 100% Anti-Hackback:</strong> Semua akun dicek kebersihannya (All Unbind/Data Polos) sebelum dijual.<br>
                • <strong>Rekber Resmi Admin Utama:</strong> Transaksi dana & serah terima data wajib melalui Admin Utama Toko sehingga 0% risiko penipuan.<br>
                • <strong>Klaim Mudah:</strong> Jika ada kendala akun, admin siap membantu hingga tuntas.<br><br>
                <a href="{{ route('how.to.buy') }}" style="color: var(--primary); font-weight: 700; text-decoration: underline;">Detail Ketentuan Garansi Toko &rarr;</a>
            `);
            return;
        }

        // 4. Metode Pembayaran (Payment Methods)
        if (query.includes('metode') || query.includes('bayar') || query.includes('qris') || query.includes('dana') || 
            query.includes('gopay') || query.includes('ovo') || query.includes('shopeepay') || query.includes('transfer') || 
            query.includes('bank') || query.includes('bca') || query.includes('bri') || query.includes('mandiri')) {
            
            appendBotMessage(`
                💳 <strong>Metode Pembayaran Resmi ALZIS STORE:</strong><br>
                Kami menerima berbagai metode pembayaran instan & otomatis:<br>
                • 📱 <strong>QRIS All Payment:</strong> DANA, OVO, GoPay, ShopeePay, LinkAja.<br>
                • 🏦 <strong>Transfer Bank:</strong> BCA, BRI, Mandiri, BNI, Seabank, Jago.<br>
                • ⚡ <strong>Proses:</strong> Konfirmasi pembayaran otomatis via WhatsApp Admin.
            `);
            return;
        }

        // 5. Hubungi Admin / CS / WhatsApp
        if (query.includes('admin') || query.includes('owner') || query.includes('wa') || query.includes('whatsapp') || 
            query.includes('cs') || query.includes('kontak') || query.includes('hubungi') || query.includes('nomor')) {
            
            appendBotMessage(`
                💬 <strong>Customer Service & Admin Resmi:</strong><br>
                Admin kami siap melayani tanya jawab, negosiasi, dan rekber transaksi akun game Anda.<br><br>
                <a href="{{ route('contact') }}" target="_blank" class="btn btn-whatsapp btn-sm" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; text-decoration: none; color: #fff;">
                    <span>📲 Chat WhatsApp Admin Toko</span>
                </a>
            `);
            return;
        }

        // 6. Mitra Partner / Mau Jual Akun
        if (query.includes('partner') || query.includes('mitra') || query.includes('jual akun') || 
            query.includes('titip jual') || query.includes('daftar partner') || query.includes('post akun')) {
            
            appendBotMessage(`
                🤝 <strong>Program Mitra Partner ALZIS STORE:</strong><br>
                Mau posting & jual stok akun game Anda sendiri di website kami?<br>
                • Daftarkan akun Anda dan hubungi Owner untuk aktivasi role <strong>Mitra Partner</strong>.<br>
                • Partner memiliki <strong>Panel Khusus</strong> untuk post akun, pasang foto & deskripsi, serta nomor kontak penjual!<br><br>
                <a href="{{ route('contact') }}" style="color: var(--primary); font-weight: 700;">Hubungi Owner untuk Daftar Partner &rarr;</a>
            `);
            return;
        }

        // 7. Cek Stok & Katalog Game Spesifik (Only when actually searching for stock)
        if (query.includes('stok') || query.includes('katalog') || query.includes('ready') || 
            query.includes('ff') || query.includes('free fire') || query.includes('ml') || 
            query.includes('mobile legends') || query.includes('genshin') || query.includes('pubg') || 
            query.includes('valorant') || query.includes('hok') || query.includes('honor of kings') ||
            query.includes('roblox') || query.includes('sultan') || query.includes('spek')) {
            
            let gameTitle = 'Semua Game';
            let targetUrl = '{{ route('catalog') }}';
            
            if (query.includes('free fire') || query.includes('ff')) {
                gameTitle = 'Free Fire';
                targetUrl = '{{ route('catalog') }}?q=Free+Fire';
            } else if (query.includes('mobile legends') || query.includes('ml')) {
                gameTitle = 'Mobile Legends';
                targetUrl = '{{ route('catalog') }}?q=Mobile+Legends';
            } else if (query.includes('genshin')) {
                gameTitle = 'Genshin Impact';
                targetUrl = '{{ route('catalog') }}?q=Genshin';
            } else if (query.includes('pubg')) {
                gameTitle = 'PUBG Mobile';
                targetUrl = '{{ route('catalog') }}?q=PUBG';
            } else if (query.includes('valorant')) {
                gameTitle = 'Valorant';
                targetUrl = '{{ route('catalog') }}?q=Valorant';
            } else if (query.includes('hok') || query.includes('honor of kings')) {
                gameTitle = 'Honor of Kings';
                targetUrl = '{{ route('catalog') }}?q=Honor+of+Kings';
            }

            appendBotMessage(`
                🎮 <strong>Katalog Stok Akun ${gameTitle}:</strong><br>
                Stok akun ready dan siap transaksi dipandu Admin Rekber Resmi.<br><br>
                <a href="${targetUrl}" class="btn btn-primary btn-sm" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; font-size: 0.78rem; text-decoration: none; border-radius: 6px;">
                    <span>🚀 Buka Stok Akun ${gameTitle}</span>
                </a>
            `);
            return;
        }

        // 8. Sapaan & Salam (Greetings)
        if (query.includes('halo') || query.includes('hai') || query.includes('hello') || query.includes('p') || 
            query.includes('pagi') || query.includes('siang') || query.includes('malam') || query.includes('sore') || 
            query.includes('assalamualaikum') || query.includes('tes') || query.includes('test')) {
            
            appendBotMessage(`
                Halo kak! Selamat datang di <strong>ALZIS STORE</strong> 😊🎮<br>
                Ada yang bisa kami bantu? Anda bisa tanyakan seputar stok akun game, cara order, garansi anti-HB, atau chat admin langsung.
            `);
            return;
        }

        // 9. Ucapan Terima Kasih
        if (query.includes('terima kasih') || query.includes('makasih') || query.includes('tq') || 
            query.includes('thanks') || query.includes('mantap') || query.includes('oke') || query.includes('siap')) {
            
            appendBotMessage(`
                Sama-sama kak! Senang bisa membantu Anda di ALZIS STORE ✨<br>
                Selamat berbelanja dan semoga menemukan akun game idaman Anda! 🎮🚀
            `);
            return;
        }

        // 10. Fallback Menu Terstruktur
        appendBotMessage(`
            Saya mengerti pertanyaan Anda. Untuk membantu menemukan info yang tepat, silakan pilih salah satu opsi berikut:<br><br>
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <a href="{{ route('catalog') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">• 🎮 Lihat Katalog Stok Akun Ready</a>
                <a href="{{ route('how.to.buy') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">• ⚡ Panduan Cara Beli & Info Garansi</a>
                <a href="{{ route('contact') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">• 📲 Chat Customer Service WhatsApp</a>
            </div>
        `);
    }

    function resetChatbotHistory() {
        const container = document.getElementById('chatbot-messages-container');
        if (container) {
            container.innerHTML = `
                <div class="bot-msg-wrapper" style="display: flex; gap: 8px; align-items: flex-start; max-width: 88%;">
                    <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--bg-card); border: 1px solid var(--primary-border); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; padding: 2px;">
                        <svg viewBox="0 0 100 100" style="width: 100%; height: 100%;">
                            <circle cx="50" cy="8" r="4.5" fill="var(--primary)"/>
                            <path d="M 50 18 L 50 10" stroke="var(--primary)" stroke-width="3.5" stroke-linecap="round"/>
                            <rect x="22" y="24" width="56" height="52" rx="18" fill="#0f172a" stroke="var(--border)" stroke-width="1.5"/>
                            <path d="M 50 27 L 56 32 L 54 40 L 50 43 L 46 40 L 44 32 Z" fill="var(--primary)"/>
                            <rect x="28" y="44" width="44" height="24" rx="9" fill="#030712"/>
                            <path d="M 36 54 Q 40 50 44 54 Q 40 58 36 54 Z" fill="var(--primary)"/>
                            <path d="M 56 54 Q 60 50 64 54 Q 60 58 56 54 Z" fill="var(--primary)"/>
                        </svg>
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
