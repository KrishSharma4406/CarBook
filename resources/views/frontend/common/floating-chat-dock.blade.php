<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.fcd-dock {
    position: fixed;
    bottom: 0;
    right: 100px;
    z-index: 99990;
    width: 340px;
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    transition: width 0.3s cubic-bezier(.4,0,.2,1);
}

.fcd-header {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    color: #fff;
    padding: 10px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    border-radius: 10px 10px 0 0;
    user-select: none;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
    transition: background 0.25s;
}

.fcd-header:hover {
    background: linear-gradient(135deg, #1f1f38 0%, #1b2a4a 100%);
}

.fcd-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.fcd-header-avatar {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #1089ff, #43b0ff);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(16,137,255,0.35);
}

.fcd-header-title {
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.fcd-header-right {
    display: flex;
    align-items: center;
    gap: 6px;
}

.fcd-badge {
    background: linear-gradient(135deg, #ff4757, #ff6b81);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    min-width: 20px;
    height: 20px;
    border-radius: 10px;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 0 6px;
    box-shadow: 0 2px 6px rgba(255,71,87,0.4);
    animation: fcdPulse 2s infinite;
}

.fcd-badge.show { display: flex; }

@keyframes fcdPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.fcd-header-btn {
    background: rgba(255,255,255,0.1);
    border: none;
    color: #fff;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 13px;
    transition: background 0.15s, transform 0.15s;
    padding: 0;
}

.fcd-header-btn:hover {
    background: rgba(255,255,255,0.2);
    transform: scale(1.1);
}

.fcd-chevron {
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
    font-size: 12px;
}

.fcd-dock.expanded .fcd-chevron {
    transform: rotate(180deg);
}

/* ── Expanded Body ── */
.fcd-body {
    background: #fff;
    height: 0;
    overflow: hidden;
    transition: height 0.35s cubic-bezier(.4,0,.2,1);
    box-shadow: -4px 0 20px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
}

.fcd-dock.expanded .fcd-body {
    height: 52vh;
    min-height: 440px;
    max-height: 620px;
}

/* ── View Container (inbox / chat) ── */
.fcd-view {
    display: none;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
}

.fcd-view.active {
    display: flex;
}

/* ── INBOX VIEW ── */
.fcd-search-wrap {
    padding: 10px 14px;
    border-bottom: 1px solid #eef0f2;
    background: #fafbfc;
}

.fcd-search {
    display: flex;
    align-items: center;
    background: #f0f2f5;
    border-radius: 20px;
    padding: 7px 14px;
    gap: 8px;
    transition: box-shadow 0.2s, background 0.2s;
}

.fcd-search:focus-within {
    background: #fff;
    box-shadow: 0 0 0 2px rgba(16,137,255,0.2);
}

.fcd-search i { color: #a0aec0; font-size: 13px; }

.fcd-search input {
    border: none;
    outline: none;
    background: transparent;
    font-size: 13px;
    width: 100%;
    font-family: inherit;
    color: #1a1a2e;
}

.fcd-search input::placeholder { color: #a0aec0; }

.fcd-conv-list {
    flex: 1;
    overflow-y: auto;
    overscroll-behavior: contain;
}

.fcd-conv-list::-webkit-scrollbar { width: 4px; }
.fcd-conv-list::-webkit-scrollbar-thumb {
    background: #d0d5dd;
    border-radius: 4px;
}

.fcd-conv-item {
    display: flex;
    align-items: center;
    padding: 12px 14px;
    cursor: pointer;
    transition: background 0.15s;
    border-bottom: 1px solid #f5f5f5;
    gap: 10px;
    text-decoration: none !important;
    color: inherit !important;
}

.fcd-conv-item:hover {
    background: #f4f7fb;
}

.fcd-conv-item.has-unread {
    background: #f0f6ff;
}

.fcd-conv-item.has-unread:hover {
    background: #e4efff;
}

.fcd-conv-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1089ff, #43b0ff);
    color: #fff;
    font-weight: 700;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
}

.fcd-conv-avatar .fcd-online-dot {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    background: #2ed573;
    border: 2px solid #fff;
    border-radius: 50%;
}

.fcd-conv-info {
    flex: 1;
    min-width: 0;
}

.fcd-conv-name {
    font-size: 13px;
    font-weight: 600;
    color: #1a1a2e;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 2px;
}

.fcd-conv-snippet {
    font-size: 11.5px;
    color: #6c757d;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.fcd-conv-item.has-unread .fcd-conv-snippet {
    color: #1a1a2e;
    font-weight: 600;
}

.fcd-conv-meta {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    flex-shrink: 0;
}

.fcd-conv-time {
    font-size: 10.5px;
    color: #a0aec0;
}

.fcd-conv-unread-badge {
    background: linear-gradient(135deg, #1089ff, #43b0ff);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 5px;
}

.fcd-empty-inbox {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 20px;
    text-align: center;
}

.fcd-empty-inbox i {
    font-size: 42px;
    color: #d0d5dd;
    margin-bottom: 12px;
}

.fcd-empty-inbox p {
    color: #6c757d;
    font-size: 13px;
    margin: 0;
}

/* ── CHAT VIEW ── */
.fcd-chat-bar {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    background: #fafbfc;
    border-bottom: 1px solid #eef0f2;
    gap: 10px;
}

.fcd-back-btn {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 16px;
    cursor: pointer;
    padding: 4px 6px;
    border-radius: 6px;
    transition: background 0.15s, color 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.fcd-back-btn:hover {
    background: #eef0f2;
    color: #1a1a2e;
}

.fcd-chat-bar-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1089ff, #43b0ff);
    color: #fff;
    font-weight: 700;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.fcd-chat-bar-info {
    flex: 1;
    min-width: 0;
}

.fcd-chat-bar-name {
    font-size: 13px;
    font-weight: 600;
    color: #1a1a2e;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.fcd-chat-bar-route {
    font-size: 10.5px;
    color: #6c757d;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.fcd-fullscreen-btn {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 14px;
    cursor: pointer;
    padding: 4px 6px;
    border-radius: 6px;
    transition: background 0.15s, color 0.15s;
    text-decoration: none !important;
}

.fcd-fullscreen-btn:hover {
    background: #eef0f2;
    color: #1089ff;
}

/* ── Messages Thread ── */
.fcd-messages {
    flex: 1;
    overflow-y: auto;
    padding: 14px 12px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    background: #f8f9fb;
    overscroll-behavior: contain;
}

.fcd-messages::-webkit-scrollbar { width: 4px; }
.fcd-messages::-webkit-scrollbar-thumb {
    background: #d0d5dd;
    border-radius: 4px;
}

.fcd-date-sep {
    text-align: center;
    margin: 8px 0;
}

.fcd-date-sep span {
    background: #e4e8ee;
    color: #5a6375;
    font-size: 10px;
    font-weight: 600;
    padding: 3px 12px;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.fcd-msg {
    max-width: 78%;
    display: flex;
    flex-direction: column;
}

.fcd-msg.sent {
    align-self: flex-end;
    align-items: flex-end;
}

.fcd-msg.received {
    align-self: flex-start;
    align-items: flex-start;
}

.fcd-msg-bubble {
    padding: 8px 14px;
    border-radius: 16px;
    font-size: 13px;
    line-height: 1.4;
    word-break: break-word;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
}

.fcd-msg.sent .fcd-msg-bubble {
    background: linear-gradient(135deg, #1089ff, #2d9cff);
    color: #fff;
    border-bottom-right-radius: 4px;
}

.fcd-msg.received .fcd-msg-bubble {
    background: #fff;
    color: #1a1a2e;
    border: 1px solid #eef0f2;
    border-bottom-left-radius: 4px;
}

.fcd-msg-time {
    font-size: 10px;
    color: #a0aec0;
    margin-top: 3px;
    display: flex;
    align-items: center;
    gap: 3px;
}

.fcd-msg.sent .fcd-msg-time { color: rgba(16,137,255,0.5); }

.fcd-msg-attach-img {
    max-height: 160px;
    border-radius: 10px;
    margin-bottom: 4px;
    cursor: pointer;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
}

.fcd-msg-attach-file {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0,0,0,0.05);
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 12px;
    margin-bottom: 4px;
    text-decoration: none !important;
    color: inherit !important;
}

.fcd-msg.sent .fcd-msg-attach-file {
    background: rgba(255,255,255,0.15);
    color: #fff !important;
}

/* ── Input Area ── */
.fcd-input-area {
    border-top: 1px solid #eef0f2;
    background: #fff;
    flex-shrink: 0;
}

.fcd-upload-bar {
    display: none;
    padding: 8px 12px;
    background: #f8f9fb;
    border-bottom: 1px solid #eef0f2;
    align-items: center;
    gap: 10px;
}

.fcd-upload-bar.show { display: flex; }

.fcd-upload-bar-thumb {
    width: 36px;
    height: 36px;
    border-radius: 6px;
    object-fit: cover;
    border: 1px solid #dee2e6;
}

.fcd-upload-bar-name {
    flex: 1;
    font-size: 12px;
    font-weight: 600;
    color: #343a40;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    min-width: 0;
}

.fcd-upload-bar-remove {
    background: #fee;
    color: #dc3545;
    border: none;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 12px;
    flex-shrink: 0;
}

.fcd-input-row {
    display: flex;
    align-items: flex-end;
    padding: 8px 10px;
    gap: 6px;
}

.fcd-input-btn {
    background: none;
    border: none;
    color: #6c757d;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 15px;
    transition: color 0.15s, background 0.15s;
    flex-shrink: 0;
    padding: 0;
}

.fcd-input-btn:hover {
    color: #1089ff;
    background: #f0f6ff;
}

.fcd-input-row textarea {
    flex: 1;
    border: 1px solid #dee2e6;
    border-radius: 18px;
    padding: 7px 14px;
    font-size: 13px;
    resize: none;
    outline: none;
    max-height: 80px;
    font-family: inherit;
    transition: border-color 0.2s;
    line-height: 1.4;
    min-height: 34px;
}

.fcd-input-row textarea:focus {
    border-color: #1089ff;
    box-shadow: 0 0 0 2px rgba(16,137,255,0.1);
}

.fcd-send-btn {
    background: linear-gradient(135deg, #1089ff, #2d9cff);
    color: #fff;
    border: none;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    transition: transform 0.15s, box-shadow 0.15s;
    padding: 0;
    font-size: 14px;
}

.fcd-send-btn:hover {
    transform: scale(1.08);
    box-shadow: 0 3px 10px rgba(16,137,255,0.35);
}

.fcd-send-btn:active { transform: scale(0.95); }

/* ── Emoji Picker ── */
.fcd-emoji-picker {
    position: absolute;
    bottom: 52px;
    left: 10px;
    background: #fff;
    border: 1px solid #eef0f2;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    display: none;
    width: 250px;
    z-index: 10;
}

.fcd-emoji-picker.show { display: block; }

.fcd-emoji-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 2px;
    max-height: 150px;
    overflow-y: auto;
}

.fcd-emoji-item {
    border: none;
    background: none;
    font-size: 18px;
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: background 0.1s;
    text-align: center;
}

.fcd-emoji-item:hover { background: #f0f2f5; }

/* ── Loading spinner ── */
.fcd-loading {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
}

.fcd-spinner {
    width: 28px;
    height: 28px;
    border: 3px solid #eef0f2;
    border-top-color: #1089ff;
    border-radius: 50%;
    animation: fcdSpin 0.7s linear infinite;
}

@keyframes fcdSpin {
    to { transform: rotate(360deg); }
}

/* ── Responsive ── */
@media (max-width: 480px) {
    .fcd-dock {
        right: 0;
        width: 100%;
        max-width: 100%;
    }
    .fcd-dock.expanded .fcd-body {
        height: 60vh;
        max-height: none;
    }
    .fcd-header {
        border-radius: 0;
    }
}
</style>

<div class="fcd-dock" id="fcdDock">
    {{-- Collapsed Header Bar --}}
    <div class="fcd-header" id="fcdHeader" onclick="fcdToggle()">
        <div class="fcd-header-left">
            <div class="fcd-header-avatar">
                <i class="fa fa-comments"></i>
            </div>
            <span class="fcd-header-title">Messaging</span>
            <span class="fcd-badge" id="fcdBadge"></span>
        </div>
        <div class="fcd-header-right">
            <a href="{{ route('chat.index') }}" class="fcd-header-btn" onclick="event.stopPropagation()" title="Open full chat">
                <i class="fa fa-external-link"></i>
            </a>
            <span class="fcd-chevron" id="fcdChevron">
                <i class="fa fa-chevron-up"></i>
            </span>
        </div>
    </div>

    {{-- Expandable Body --}}
    <div class="fcd-body" id="fcdBody">

        {{-- INBOX VIEW --}}
        <div class="fcd-view active" id="fcdInboxView">
            <div class="fcd-search-wrap">
                <div class="fcd-search">
                    <i class="fa fa-search"></i>
                    <input type="text" id="fcdSearchInput" placeholder="Search messages..." autocomplete="off">
                </div>
            </div>
            <div class="fcd-conv-list" id="fcdConvList">
                <div class="fcd-loading" id="fcdInboxLoading">
                    <div class="fcd-spinner"></div>
                </div>
            </div>
        </div>

        {{-- CHAT VIEW --}}
        <div class="fcd-view" id="fcdChatView">
            <div class="fcd-chat-bar">
                <button class="fcd-back-btn" onclick="fcdBackToInbox()" title="Back">
                    <i class="fa fa-arrow-left"></i>
                </button>
                <div class="fcd-chat-bar-avatar" id="fcdChatAvatar"></div>
                <div class="fcd-chat-bar-info">
                    <div class="fcd-chat-bar-name" id="fcdChatName"></div>
                    <div class="fcd-chat-bar-route" id="fcdChatRoute"></div>
                </div>
                <a href="#" class="fcd-fullscreen-btn" id="fcdFullLink" title="Open full view">
                    <i class="fa fa-expand"></i>
                </a>
            </div>

            <div class="fcd-messages" id="fcdMessages">
                <div class="fcd-loading" id="fcdChatLoading">
                    <div class="fcd-spinner"></div>
                </div>
            </div>

            <div class="fcd-input-area" style="position:relative;">
                {{-- Upload Preview --}}
                <div class="fcd-upload-bar" id="fcdUploadBar">
                    <div id="fcdUploadThumb"></div>
                    <span class="fcd-upload-bar-name" id="fcdUploadName"></span>
                    <button class="fcd-upload-bar-remove" onclick="fcdCancelUpload()" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                {{-- Input Row --}}
                <div class="fcd-input-row">
                    <button class="fcd-input-btn" onclick="fcdToggleEmoji()" title="Emoji">
                        <i class="fa fa-smile-o"></i>
                    </button>
                    <button class="fcd-input-btn" onclick="document.getElementById('fcdFileInput').click()" title="Attach file">
                        <i class="fa fa-paperclip"></i>
                    </button>
                    <textarea id="fcdMsgInput" placeholder="Write a message..." rows="1" maxlength="5000"></textarea>
                    <button class="fcd-send-btn" onclick="fcdSendMessage()" title="Send">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </div>

                {{-- Emoji Picker --}}
                <div class="fcd-emoji-picker" id="fcdEmojiPicker">
                    <div class="fcd-emoji-grid" id="fcdEmojiGrid"></div>
                </div>
            </div>

            <input type="file" id="fcdFileInput" style="display:none" onchange="fcdHandleFile(this)">
        </div>

    </div>
</div>

<script>
(function() {
    'use strict';

    /* ─── State ─── */
    let fcdExpanded = false;
    let fcdCurrentConvId = null;
    let fcdLastMsgId = 0;
    let fcdPollTimer = null;
    let fcdUnreadPollTimer = null;
    let fcdPendingFile = null;
    let fcdSending = false;
    let fcdConversationsCache = [];
    const FCD_POLL_MS = 3000;
    const FCD_UNREAD_POLL_MS = 15000;
    const CURRENT_USER_ID = {{ Auth::id() }};

    function csrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    function escapeHtml(text) {
        const d = document.createElement('div');
        d.textContent = text;
        return d.innerHTML;
    }

    /* ─── Toggle Dock ─── */
    window.fcdToggle = function() {
        const dock = document.getElementById('fcdDock');
        fcdExpanded = !fcdExpanded;
        if (fcdExpanded) {
            dock.classList.add('expanded');
            loadInbox();
            startUnreadPolling();
        } else {
            dock.classList.remove('expanded');
            stopChatPolling();
        }
    };

    /* ─── Load Inbox (Conversations List) ─── */
    function loadInbox() {
        const list = document.getElementById('fcdConvList');
        const loading = document.getElementById('fcdInboxLoading');
        if (loading) loading.style.display = 'flex';

        fetch('/chat/search?q=', {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (loading) loading.style.display = 'none';
            fcdConversationsCache = data.conversations || [];
            renderConvList(fcdConversationsCache);
        })
        .catch(() => {
            if (loading) loading.style.display = 'none';
            list.innerHTML = '<div class="fcd-empty-inbox"><i class="fa fa-exclamation-circle"></i><p>Could not load conversations</p></div>';
        });
    }

    function renderConvList(convs) {
        const list = document.getElementById('fcdConvList');
        if (!convs || convs.length === 0) {
            list.innerHTML = '<div class="fcd-empty-inbox"><i class="fa fa-comments-o"></i><p>No conversations yet.<br>Book or offer a ride to start chatting!</p></div>';
            return;
        }

        let html = '';
        convs.forEach(c => {
            const otherUser = c.other_user;
            const initial = otherUser?.name ? otherUser.name.charAt(0).toUpperCase() : '?';
            const name = escapeHtml(otherUser?.name || 'Unknown');
            const latestMsg = c.latest_message;
            let snippet = 'No messages yet';
            let timeStr = '';
            if (latestMsg) {
                if (latestMsg.attachment_path && !latestMsg.message) {
                    snippet = '📎 ' + escapeHtml(latestMsg.attachment_name || 'Attachment');
                } else if (latestMsg.message) {
                    snippet = escapeHtml(latestMsg.message.length > 35 ? latestMsg.message.substring(0, 35) + '...' : latestMsg.message);
                }
                if (latestMsg.created_at) {
                    const d = new Date(latestMsg.created_at);
                    const now = new Date();
                    if (d.toDateString() === now.toDateString()) {
                        timeStr = d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    } else {
                        timeStr = d.toLocaleDateString([], { month: 'short', day: 'numeric' });
                    }
                }
            }

            const unread = c.unread_count || 0;
            const hasUnread = unread > 0;

            html += `
                <div class="fcd-conv-item ${hasUnread ? 'has-unread' : ''}" onclick="fcdOpenConversation(${c.id}, '${initial}', '${escapeHtml(otherUser?.name || '')}', '${escapeHtml((c.ride?.pickup_location || '') + ' → ' + (c.ride?.destination || ''))}')">
                    <div class="fcd-conv-avatar">${initial}</div>
                    <div class="fcd-conv-info">
                        <div class="fcd-conv-name">${name}</div>
                        <div class="fcd-conv-snippet">${snippet}</div>
                    </div>
                    <div class="fcd-conv-meta">
                        <span class="fcd-conv-time">${timeStr}</span>
                        ${hasUnread ? `<span class="fcd-conv-unread-badge">${unread}</span>` : ''}
                    </div>
                </div>`;
        });
        list.innerHTML = html;
    }

    /* ─── Search Filter ─── */
    const searchInput = document.getElementById('fcdSearchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            if (!q) {
                renderConvList(fcdConversationsCache);
                return;
            }
            const filtered = fcdConversationsCache.filter(c => {
                const name = (c.other_user?.name || '').toLowerCase();
                const route = ((c.ride?.pickup_location || '') + ' ' + (c.ride?.destination || '')).toLowerCase();
                return name.includes(q) || route.includes(q);
            });
            renderConvList(filtered);
        });
    }

    /* ─── Open Conversation ─── */
    window.fcdOpenConversation = function(convId, initial, name, route) {
        fcdCurrentConvId = convId;
        fcdLastMsgId = 0;
        stopChatPolling();

        // Update chat bar
        document.getElementById('fcdChatAvatar').textContent = initial;
        document.getElementById('fcdChatName').textContent = name;
        document.getElementById('fcdChatRoute').textContent = route;
        document.getElementById('fcdFullLink').href = '/chat/' + convId;

        // Switch views
        document.getElementById('fcdInboxView').classList.remove('active');
        document.getElementById('fcdChatView').classList.add('active');

        // Clear & show loading
        const msgBox = document.getElementById('fcdMessages');
        msgBox.innerHTML = '<div class="fcd-loading"><div class="fcd-spinner"></div></div>';

        // Fetch messages
        fetch('/chat/' + convId + '/messages', {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken() }
        })
        .then(r => r.json())
        .then(data => {
            msgBox.innerHTML = '';
            if (data.messages && data.messages.length > 0) {
                let lastDate = '';
                data.messages.forEach(msg => {
                    if (msg.date && msg.date !== lastDate) {
                        msgBox.innerHTML += `<div class="fcd-date-sep"><span>${escapeHtml(msg.date)}</span></div>`;
                        lastDate = msg.date;
                    }
                    appendFcdMessage(msg);
                    if (msg.id > fcdLastMsgId) fcdLastMsgId = msg.id;
                });
            } else {
                msgBox.innerHTML = '<div class="fcd-empty-inbox"><i class="fa fa-comment-o"></i><p>No messages yet. Say hello!</p></div>';
            }
            scrollFcdToBottom();
            startChatPolling();
            markConvAsRead(convId);
        })
        .catch(() => {
            msgBox.innerHTML = '<div class="fcd-empty-inbox"><i class="fa fa-exclamation-circle"></i><p>Could not load messages</p></div>';
        });

        // Focus input
        setTimeout(() => document.getElementById('fcdMsgInput')?.focus(), 200);
    };

    /* ─── Back to Inbox ─── */
    window.fcdBackToInbox = function() {
        stopChatPolling();
        fcdCurrentConvId = null;
        document.getElementById('fcdChatView').classList.remove('active');
        document.getElementById('fcdInboxView').classList.add('active');
        loadInbox();
    };

    /* ─── Append Message to Thread ─── */
    function appendFcdMessage(msg) {
        const msgBox = document.getElementById('fcdMessages');
        if (!msgBox) return;
        if (msgBox.querySelector(`[data-fcd-id="${msg.id}"]`)) return;

        const isSent = msg.sender_id === CURRENT_USER_ID;
        const wrapper = document.createElement('div');
        wrapper.className = `fcd-msg ${isSent ? 'sent' : 'received'}`;
        wrapper.dataset.fcdId = msg.id;

        let attachHtml = '';
        if (msg.attachment_path) {
            if (msg.is_image) {
                attachHtml = `<img src="${msg.attachment_path}" class="fcd-msg-attach-img" onclick="window.open(this.src,'_blank')">`;
            } else {
                attachHtml = `<a href="${msg.attachment_path}" target="_blank" class="fcd-msg-attach-file" download><i class="fa fa-file-o"></i> ${escapeHtml(msg.attachment_name || 'File')}</a>`;
            }
        }

        const tickHtml = isSent
            ? `<i class="fa fa-check${msg.is_read ? '-circle text-primary' : ' text-muted'}" style="font-size:10px;"></i>`
            : '';

        wrapper.innerHTML = `
            <div class="fcd-msg-bubble">
                ${attachHtml}
                ${msg.message ? `<div>${escapeHtml(msg.message)}</div>` : ''}
            </div>
            <div class="fcd-msg-time">
                ${escapeHtml(msg.time || '')}
                ${tickHtml}
            </div>`;

        msgBox.appendChild(wrapper);
    }

    function scrollFcdToBottom() {
        const el = document.getElementById('fcdMessages');
        if (el) el.scrollTop = el.scrollHeight;
    }

    /* ─── Send Message ─── */
    window.fcdSendMessage = function() {
        if (fcdSending || !fcdCurrentConvId) return;

        const input = document.getElementById('fcdMsgInput');
        const text = input.value.trim();
        const file = fcdPendingFile;

        if (!text && !file) return;

        fcdSending = true;

        const fd = new FormData();
        if (text) fd.append('message', text);
        if (file) fd.append('attachment', file);
        fd.append('_token', csrfToken());

        input.value = '';
        input.style.height = 'auto';
        fcdPendingFile = null;
        fcdHideUpload();

        fetch('/chat/' + fcdCurrentConvId + '/send', {
            method: 'POST',
            body: fd,
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                appendFcdMessage(data.message);
                fcdLastMsgId = data.message.id;
                scrollFcdToBottom();
            }
        })
        .catch(() => {})
        .finally(() => {
            fcdSending = false;
            input.focus();
        });
    };

    /* ─── Polling (Active Conversation) ─── */
    function startChatPolling() {
        stopChatPolling();
        if (!fcdCurrentConvId) return;
        fcdPollTimer = setInterval(() => {
            fetch('/chat/' + fcdCurrentConvId + '/messages?after=' + fcdLastMsgId + '&check_read=1', {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken() }
            })
            .then(r => r.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    let hasNew = false;
                    data.messages.forEach(msg => {
                        if (msg.id > fcdLastMsgId) {
                            appendFcdMessage(msg);
                            fcdLastMsgId = msg.id;
                            hasNew = true;
                        }
                    });
                    if (hasNew) {
                        const el = document.getElementById('fcdMessages');
                        if (el && (el.scrollHeight - el.scrollTop - el.clientHeight < 120)) {
                            scrollFcdToBottom();
                        }
                        markConvAsRead(fcdCurrentConvId);
                    }
                }
                // Update read ticks
                if (data.read_updates && data.read_updates.length > 0) {
                    data.read_updates.forEach(id => {
                        const el = document.querySelector(`[data-fcd-id="${id}"] .fa-check`);
                        if (el) {
                            el.className = 'fa fa-check-circle text-primary';
                            el.style.fontSize = '10px';
                        }
                    });
                }
            })
            .catch(() => {});
        }, FCD_POLL_MS);
    }

    function stopChatPolling() {
        if (fcdPollTimer) { clearInterval(fcdPollTimer); fcdPollTimer = null; }
    }

    /* ─── Unread Badge Polling ─── */
    function startUnreadPolling() {
        updateUnreadBadge();
        if (fcdUnreadPollTimer) clearInterval(fcdUnreadPollTimer);
        fcdUnreadPollTimer = setInterval(updateUnreadBadge, FCD_UNREAD_POLL_MS);
    }

    function updateUnreadBadge() {
        fetch('/chat/unread-count', {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken() }
        })
        .then(r => r.json())
        .then(data => {
            const badge = document.getElementById('fcdBadge');
            if (!badge) return;
            if (data.count > 0) {
                badge.textContent = data.count > 99 ? '99+' : data.count;
                badge.classList.add('show');
            } else {
                badge.classList.remove('show');
            }
        })
        .catch(() => {});
    }

    function markConvAsRead(convId) {
        fetch('/chat/' + convId + '/read', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken(), 'Content-Type': 'application/json' }
        }).catch(() => {});
    }

    /* ─── File Upload ─── */
    window.fcdHandleFile = function(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB');
                input.value = '';
                return;
            }
            fcdPendingFile = file;
            fcdShowUpload(file);
        }
    };

    function fcdShowUpload(file) {
        const bar = document.getElementById('fcdUploadBar');
        const thumb = document.getElementById('fcdUploadThumb');
        const name = document.getElementById('fcdUploadName');
        if (!bar) return;

        name.textContent = file.name;

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => { thumb.innerHTML = `<img src="${e.target.result}" class="fcd-upload-bar-thumb">`; };
            reader.readAsDataURL(file);
        } else {
            thumb.innerHTML = '<i class="fa fa-file-o" style="font-size:20px;color:#6c757d;"></i>';
        }

        bar.classList.add('show');
    }

    function fcdHideUpload() {
        const bar = document.getElementById('fcdUploadBar');
        if (bar) bar.classList.remove('show');
        const fi = document.getElementById('fcdFileInput');
        if (fi) fi.value = '';
    }

    window.fcdCancelUpload = function() {
        fcdPendingFile = null;
        fcdHideUpload();
    };

    /* ─── Emoji ─── */
    window.fcdToggleEmoji = function() {
        const picker = document.getElementById('fcdEmojiPicker');
        if (!picker) return;
        picker.classList.toggle('show');
        if (picker.classList.contains('show') && picker.children[0]?.children.length === 0) {
            populateFcdEmojis();
        }
    };

    function populateFcdEmojis() {
        const grid = document.getElementById('fcdEmojiGrid');
        if (!grid) return;
        const emojis = ['😀','😃','😄','😁','😅','😂','🤣','😊','😇','🙂','😉','😍','🥰','😘','😋','😎','🤗','🤩','🥳','😏','👍','👏','🙌','🤝','❤️','🔥','✨','💯','🚗','🚕','🏎️','📍','🗺️','✈️','🎉','💬','👋','🤔','😮','👌'];
        grid.innerHTML = emojis.map(e => `<button class="fcd-emoji-item" onclick="fcdInsertEmoji('${e}')" type="button">${e}</button>`).join('');
    }

    window.fcdInsertEmoji = function(emoji) {
        const input = document.getElementById('fcdMsgInput');
        if (!input) return;
        const s = input.selectionStart;
        const e = input.selectionEnd;
        input.value = input.value.substring(0, s) + emoji + input.value.substring(e);
        input.selectionStart = input.selectionEnd = s + emoji.length;
        input.focus();
        document.getElementById('fcdEmojiPicker')?.classList.remove('show');
    };

    /* ─── Textarea auto-resize + Enter key ─── */
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('fcdMsgInput');
        if (input) {
            input.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 80) + 'px';
            });
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    fcdSendMessage();
                }
            });
        }

        // Start unread polling immediately on page load
        startUnreadPolling();
    });

    /* ─── Close emoji on outside click ─── */
    document.addEventListener('click', function(e) {
        const picker = document.getElementById('fcdEmojiPicker');
        if (picker && picker.classList.contains('show') && !picker.contains(e.target) && !e.target.closest('.fcd-input-btn')) {
            picker.classList.remove('show');
        }
    });

    /* ─── Cleanup ─── */
    window.addEventListener('beforeunload', function() {
        stopChatPolling();
        if (fcdUnreadPollTimer) clearInterval(fcdUnreadPollTimer);
    });
})();
</script>
