{{-- Floating AI Chat Widget (Ollama) --}}
<style>
/* ── Floating Button ── */
.ai-fab {
    position: fixed;
    bottom: 56px;
    right: 28px;
    z-index: 99999;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #1089ff;
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 16px rgba(16, 137, 255, 0.4);
    transition: transform 0.2s, box-shadow 0.2s;
    font-size: 24px;
}

.ai-fab:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 24px rgba(16, 137, 255, 0.5);
}

.ai-fab .ai-fab-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
}

.ai-fab-label {
    position: fixed;
    bottom: 120px;
    right: 28px;
    z-index: 99998;
    background: #343a40;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 8px;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    pointer-events: none;
    opacity: 1;
    transition: opacity 0.3s;
}

.ai-fab-label::after {
    content: '';
    position: absolute;
    bottom: -6px;
    right: 20px;
    width: 12px;
    height: 12px;
    background: #343a40;
    transform: rotate(45deg);
}

/* ── Chat Window ── */
.ai-chat-window {
    position: fixed;
    bottom: 124px;
    right: 28px;
    z-index: 99999;
    width: 380px;
    max-width: calc(100vw - 32px);
    height: 520px;
    max-height: calc(100vh - 140px);
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.18);
    display: none;
    flex-direction: column;
    overflow: hidden;
    animation: aiSlideUp 0.25s ease;
}

.ai-chat-window.open {
    display: flex;
}

@keyframes aiSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ── Header ── */
.ai-chat-head {
    background: #1089ff;
    color: #fff;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}

.ai-chat-head-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.ai-chat-head-avatar {
    width: 36px;
    height: 36px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.ai-chat-head h6 {
    margin: 0;
    font-weight: 700;
    font-size: 15px;
}

.ai-chat-head small {
    font-size: 11px;
    opacity: 0.8;
}

.ai-chat-close {
    background: rgba(255,255,255,0.2);
    border: none;
    color: #fff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.15s;
}

.ai-chat-close:hover {
    background: rgba(255,255,255,0.35);
}

/* ── Messages Area ── */
.ai-chat-body {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #f8f9fa;
}

.ai-msg {
    max-width: 85%;
    padding: 10px 14px;
    border-radius: 14px;
    font-size: 14px;
    line-height: 1.45;
    word-break: break-word;
    white-space: pre-wrap;
}

.ai-msg.bot {
    align-self: flex-start;
    background: #fff;
    color: #1a1a2e;
    border: 1px solid #dee2e6;
    border-bottom-left-radius: 4px;
}

.ai-msg.user {
    align-self: flex-end;
    background: #1089ff;
    color: #fff;
    border-bottom-right-radius: 4px;
}

.ai-msg.typing {
    align-self: flex-start;
    background: #fff;
    color: #6c757d;
    border: 1px solid #dee2e6;
    border-bottom-left-radius: 4px;
    font-style: italic;
    font-size: 13px;
}

/* ── Input Area ── */
.ai-chat-footer {
    border-top: 1px solid #dee2e6;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    background: #fff;
}

.ai-chat-footer input {
    flex: 1;
    border: 1px solid #ced4da;
    border-radius: 22px;
    padding: 9px 16px;
    font-size: 14px;
    outline: none;
    font-family: inherit;
    transition: border-color 0.2s;
}

.ai-chat-footer input:focus {
    border-color: #1089ff;
    box-shadow: 0 0 0 3px rgba(16, 137, 255, 0.1);
}

.ai-chat-send {
    background: #1089ff;
    color: #fff;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    transition: background 0.15s;
    font-size: 16px;
}

.ai-chat-send:hover {
    background: #0b6fdb;
}

.ai-chat-send:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ── Powered By ── */
.ai-powered {
    text-align: center;
    font-size: 10px;
    color: #adb5bd;
    padding: 4px 0 8px;
    background: #fff;
}

/* ── Mobile ── */
@media (max-width: 480px) {
    .ai-chat-window {
        right: 8px;
        bottom: 80px;
        width: calc(100vw - 16px);
        height: calc(100vh - 120px);
    }
    .ai-fab { bottom: 52px; right: 16px; }
    .ai-fab-label { bottom: 116px; right: 16px; }
}
</style>

{{-- Floating Label --}}
<div class="ai-fab-label" id="aiFabLabel">Ask AI</div>

{{-- Floating Action Button --}}
<button class="ai-fab" id="aiFab" onclick="toggleAiChat()" title="Ask AI">
    <span id="aiFabIcon">AI</span>
</button>

{{-- Chat Window --}}
<div class="ai-chat-window" id="aiChatWindow">

    {{-- Header --}}
    <div class="ai-chat-head">
        <div class="ai-chat-head-info">
            <div class="ai-chat-head-avatar">AI</div>
            <div>
                <h6>CarBook AI</h6>
                <small>Powered by Ollama</small>
            </div>
        </div>
        <button class="ai-chat-close" onclick="toggleAiChat()" title="Close">✕</button>
    </div>

    {{-- Messages --}}
    <div class="ai-chat-body" id="aiChatBody"></div>

    {{-- Powered By --}}
    <div class="ai-powered">Powered by Ollama • AI responses may not always be accurate</div>

    {{-- Input --}}
    <div class="ai-chat-footer">
        <input type="text" id="aiInput" placeholder="Type your question..." autocomplete="off" maxlength="2000">
        <button class="ai-chat-send" id="aiSendBtn" onclick="sendAiMessage()" title="Send">
            ➤
        </button>
    </div>

</div>

<script>
(function() {
    'use strict';

    let aiChatOpen = false;
    let aiHistory = [];
    let aiSending = false;

    // Hide label after 5 seconds
    setTimeout(function() {
        const label = document.getElementById('aiFabLabel');
        if (label && !aiChatOpen) {
            label.style.opacity = '0';
            setTimeout(() => { label.style.display = 'none'; }, 300);
        }
    }, 5000);

    // Toggle Chat
    window.toggleAiChat = function() {
        const win = document.getElementById('aiChatWindow');
        const label = document.getElementById('aiFabLabel');
        const fabIcon = document.getElementById('aiFabIcon');

        aiChatOpen = !aiChatOpen;

        if (aiChatOpen) {
            win.classList.add('open');
            fabIcon.textContent = '✕';
            if (label) { label.style.opacity = '0'; label.style.display = 'none'; }
            document.getElementById('aiInput')?.focus();

            // Generate initial live greeting from Ollama if empty
            if (aiHistory.length === 0 && !aiSending) {
                fetchOllamaGreeting();
            }
        } else {
            win.classList.remove('open');
            fabIcon.textContent = 'AI';
        }
    };

    // Send Message
    window.sendAiMessage = function() {
        if (aiSending) return;

        const input = document.getElementById('aiInput');
        const body = document.getElementById('aiChatBody');
        const sendBtn = document.getElementById('aiSendBtn');
        const text = input.value.trim();

        if (!text) return;

        // Add user message
        const userEl = document.createElement('div');
        userEl.className = 'ai-msg user';
        userEl.textContent = text;
        body.appendChild(userEl);

        // Add to history
        aiHistory.push({ role: 'user', content: text });

        input.value = '';
        scrollAiToBottom();

        // Show typing indicator
        const typingEl = document.createElement('div');
        typingEl.className = 'ai-msg typing';
        typingEl.id = 'aiTyping';
        typingEl.innerHTML = '<span>●</span> <span>●</span> <span>●</span> Thinking...';
        body.appendChild(typingEl);
        scrollAiToBottom();

        aiSending = true;
        sendBtn.disabled = true;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        fetch('/ai/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                message: text,
                history: aiHistory.slice(-10)
            })
        })
        .then(r => r.json())
        .then(data => {
            // Remove typing indicator
            const typing = document.getElementById('aiTyping');
            if (typing) typing.remove();

            if (data.reply) {
                const botEl = document.createElement('div');
                botEl.className = 'ai-msg bot';
                botEl.textContent = data.reply;
                body.appendChild(botEl);
                if (data.success) {
                    aiHistory.push({ role: 'assistant', content: data.reply });
                }
            }

            scrollAiToBottom();
        })
        .catch(() => {
            document.getElementById('aiTyping')?.remove();
            scrollAiToBottom();
        })
        .finally(() => {
            aiSending = false;
            sendBtn.disabled = false;
            input.focus();
        });
    };

    function fetchOllamaGreeting() {
        const body = document.getElementById('aiChatBody');
        if (!body) return;

        const typingEl = document.createElement('div');
        typingEl.className = 'ai-msg typing';
        typingEl.id = 'aiTyping';
        typingEl.innerHTML = '<span>●</span> <span>●</span> <span>●</span> Connecting...';
        body.appendChild(typingEl);

        aiSending = true;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        fetch('/ai/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                message: 'Hello! Introduce yourself briefly in 1-2 friendly sentences as CarBook AI assistant and ask how you can help.',
                history: []
            })
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('aiTyping')?.remove();
            if (data.reply) {
                const botEl = document.createElement('div');
                botEl.className = 'ai-msg bot';
                botEl.textContent = data.reply;
                body.appendChild(botEl);
                aiHistory.push({ role: 'assistant', content: data.reply });
            }
            scrollAiToBottom();
        })
        .catch(() => {
            document.getElementById('aiTyping')?.remove();
        })
        .finally(() => {
            aiSending = false;
        });
    }

    function scrollAiToBottom() {
        const body = document.getElementById('aiChatBody');
        if (body) body.scrollTop = body.scrollHeight;
    }

    // Enter key to send
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('aiInput');
        if (input) {
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendAiMessage();
                }
            });
        }
    });
})();
</script>
