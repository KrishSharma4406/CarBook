{{-- CarBook Theme — Chat Component --}}
<style>
.carbook-chat-card {
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
}

.carbook-chat-sidebar {
    border-right: 1px solid #e9ecef;
    background: #ffffff;
}

.carbook-sidebar-header {
    background: #01d28e;
    color: #ffffff;
    padding: 16px;
}

.carbook-search-box {
    background: #ffffff;
    border: 1px solid #ced4da;
    border-radius: 20px;
    padding: 6px 14px;
    display: flex;
    align-items: center;
}

.carbook-search-box input {
    border: none;
    outline: none;
    background: transparent;
    width: 100%;
    font-size: 13px;
    margin-left: 8px;
}

.carbook-conv-list {
    max-height: 520px;
    overflow-y: auto;
}

.carbook-conv-item {
    display: flex;
    align-items: center;
    padding: 14px 16px;
    border-bottom: 1px solid #f1f3f5;
    text-decoration: none !important;
    color: #333;
    transition: background 0.15s;
}

.carbook-conv-item:hover {
    background: #f8f9fa;
    color: #333;
}

.carbook-conv-item.active {
    background: #e8f9f3;
    border-left: 4px solid #01d28e;
}

.carbook-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #01d28e;
    color: #fff;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.carbook-conv-details {
    flex: 1;
    margin-left: 12px;
    min-width: 0;
}

.carbook-conv-name {
    font-weight: 600;
    font-size: 14px;
    color: #2c3e50;
    margin-bottom: 2px;
}

.carbook-conv-msg {
    font-size: 12px;
    color: #6c757d;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.carbook-chat-main {
    display: flex;
    flex-direction: column;
    height: 600px;
    background: #f8f9fa;
}

.carbook-chat-header {
    background: #ffffff;
    padding: 14px 20px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.carbook-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #f4f6f8;
}

.carbook-msg-wrapper {
    display: flex;
    flex-direction: column;
    max-width: 70%;
}

.carbook-msg-wrapper.sent {
    align-self: flex-end;
    align-items: flex-end;
}

.carbook-msg-wrapper.received {
    align-self: flex-start;
    align-items: flex-start;
}

.carbook-msg-bubble {
    padding: 10px 14px;
    border-radius: 14px;
    font-size: 14px;
    line-height: 1.4;
    position: relative;
    word-break: break-word;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}

.carbook-msg-wrapper.sent .carbook-msg-bubble {
    background: #01d28e;
    color: #ffffff;
    border-bottom-right-radius: 2px;
}

.carbook-msg-wrapper.received .carbook-msg-bubble {
    background: #ffffff;
    color: #2c3e50;
    border: 1px solid #e9ecef;
    border-bottom-left-radius: 2px;
}

.carbook-msg-meta {
    font-size: 11px;
    margin-top: 4px;
    color: #8c98a4;
    display: flex;
    align-items: center;
    gap: 4px;
}

.carbook-msg-wrapper.sent .carbook-msg-meta {
    color: rgba(255,255,255,0.8);
}

.carbook-date-sep {
    text-align: center;
    margin: 12px 0;
}

.carbook-date-sep span {
    background: #e9ecef;
    color: #6c757d;
    font-size: 11px;
    padding: 4px 12px;
    border-radius: 12px;
    font-weight: 500;
}

.carbook-chat-input {
    background: #ffffff;
    padding: 12px 16px;
    border-top: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    gap: 10px;
}

.carbook-chat-input textarea {
    border: 1px solid #ced4da;
    border-radius: 20px;
    padding: 8px 16px;
    font-size: 14px;
    resize: none;
    outline: none;
    flex: 1;
    max-height: 100px;
}

.carbook-chat-input textarea:focus {
    border-color: #01d28e;
}

.carbook-btn-icon {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 20px;
    cursor: pointer;
    padding: 6px;
    border-radius: 50%;
    transition: color 0.15s;
}

.carbook-btn-icon:hover {
    color: #01d28e;
}

.carbook-send-btn {
    background: #01d28e;
    color: #fff;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.15s;
    flex-shrink: 0;
}

.carbook-send-btn:hover {
    background: #01b87c;
}

.carbook-empty-state {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    padding: 40px;
    text-align: center;
}

.carbook-empty-state i {
    font-size: 64px;
    color: #01d28e;
    margin-bottom: 16px;
    opacity: 0.6;
}

/* Emoji Grid */
.carbook-emoji-picker {
    position: absolute;
    bottom: 70px;
    left: 20px;
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    display: none;
    width: 280px;
    z-index: 100;
}

.carbook-emoji-picker.show { display: block; }

.carbook-emoji-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
    max-height: 180px;
    overflow-y: auto;
}

.carbook-emoji-btn {
    border: none;
    background: none;
    font-size: 20px;
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
}

.carbook-emoji-btn:hover { background: #f8f9fa; }

@media (max-width: 767.98px) {
    .carbook-chat-sidebar.hidden-mobile { display: none; }
}
</style>

{{-- Hero Section --}}
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('UI/images/bg_3.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end" style="height: 280px;">
            <div class="col-md-9 pb-5">
                <h1 class="mb-3 bread text-white">My Messages</h1>
            </div>
        </div>
    </div>
</section>

{{-- Main Section --}}
<section class="ftco-section bg-light py-5">
    <div class="container">
        <div class="card shadow border-0 carbook-chat-card">
            <div class="row no-gutters">
                
                {{-- Sidebar --}}
                <div class="col-md-4 carbook-chat-sidebar {{ isset($conversation) ? 'hidden-mobile' : '' }}" id="chatSidebar">
                    <div class="carbook-sidebar-header">
                        <h5 class="m-0 text-white font-weight-bold">
                            <i class="fa fa-comments mr-2"></i> Conversations
                        </h5>
                    </div>

                    <div class="p-3 border-bottom bg-light">
                        <div class="carbook-search-box">
                            <i class="fa fa-search text-muted"></i>
                            <input type="text" id="conversationSearch" placeholder="Search conversation...">
                        </div>
                    </div>

                    <div class="carbook-conv-list" id="conversationList">
                        @if(isset($conversations) && $conversations->count() > 0)
                            @foreach($conversations as $conv)
                                <a href="{{ route('chat.show', $conv->id) }}"
                                   class="carbook-conv-item {{ isset($conversation) && $conversation->id === $conv->id ? 'active' : '' }}">
                                    <div class="carbook-avatar">
                                        {{ strtoupper(substr($conv->other_user->name, 0, 1)) }}
                                    </div>
                                    <div class="carbook-conv-details">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="carbook-conv-name">{{ $conv->other_user->name }}</span>
                                            <small class="text-muted">
                                                @if($conv->latestMessage)
                                                    {{ $conv->latestMessage->created_at->format('h:i A') }}
                                                @endif
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="carbook-conv-msg">
                                                @if($conv->latestMessage)
                                                    @if($conv->latestMessage->hasAttachment())
                                                        <i class="fa fa-paperclip mr-1"></i> {{ $conv->latestMessage->attachment_name ?? 'Attachment' }}
                                                    @else
                                                        {{ Str::limit($conv->latestMessage->message, 30) }}
                                                    @endif
                                                @else
                                                    <span class="text-muted italic">No messages yet</span>
                                                @endif
                                            </span>
                                            @if($conv->unread_count > 0)
                                                <span class="badge badge-success badge-pill">{{ $conv->unread_count }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="p-4 text-center text-muted">
                                <i class="fa fa-comments-o fa-2x mb-2 d-block text-muted"></i>
                                <p class="mb-1 font-weight-bold">No Conversations</p>
                                <small>Book or offer a ride to start chatting</small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Chat Main Box --}}
                <div class="col-md-8">
                    <div class="carbook-chat-main" id="chatMain" style="position: relative;">
                        @if(isset($conversation) && isset($messages))
                            {{-- Header --}}
                            <div class="carbook-chat-header">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-light d-md-none mr-2" onclick="showSidebar()">
                                        <i class="fa fa-arrow-left"></i>
                                    </button>
                                    <div class="carbook-avatar mr-3">
                                        {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="m-0 font-weight-bold text-dark">{{ $otherUser->name }}</h6>
                                        <small class="text-muted">
                                            <i class="fa fa-map-marker text-success mr-1"></i>
                                            {{ $conversation->ride->pickup_location }} &rarr; {{ $conversation->ride->destination }}
                                        </small>
                                    </div>
                                </div>
                                <span class="badge badge-light border px-3 py-2 text-dark font-weight-normal">
                                    <i class="fa fa-car text-success mr-1"></i>
                                    {{ \Carbon\Carbon::parse($conversation->ride->travel_date)->format('d M Y') }}
                                </span>
                            </div>

                            {{-- Messages --}}
                            <div class="carbook-chat-messages" id="chatMessages"
                                 data-conversation="{{ $conversation->id }}"
                                 data-user="{{ Auth::id() }}">

                                @php $lastDate = null; @endphp
                                @foreach($messages as $msg)
                                    @if($msg->formattedDate() !== $lastDate)
                                        <div class="carbook-date-sep">
                                            <span>{{ $msg->formattedDate() }}</span>
                                        </div>
                                        @php $lastDate = $msg->formattedDate(); @endphp
                                    @endif

                                    <div class="carbook-msg-wrapper {{ $msg->sender_id === Auth::id() ? 'sent' : 'received' }}"
                                         data-msg-id="{{ $msg->id }}"
                                         oncontextmenu="showContextMenu(event, {{ $msg->id }})">
                                        <div class="carbook-msg-bubble">
                                            @if($msg->hasAttachment())
                                                <div class="mb-2">
                                                    @if($msg->isImage())
                                                        <img src="{{ asset($msg->attachment_path) }}"
                                                             class="img-fluid rounded" style="max-height: 200px; cursor: pointer;"
                                                             onclick="openLightbox(this.src)">
                                                    @else
                                                        <a href="{{ asset($msg->attachment_path) }}" target="_blank" class="btn btn-sm btn-light border text-dark" download>
                                                            <i class="fa fa-file-text-o mr-1"></i> {{ $msg->attachment_name }} <i class="fa fa-download ml-2 text-muted"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif

                                            @if($msg->message)
                                                <div>{{ $msg->message }}</div>
                                            @endif

                                            <div class="carbook-msg-meta">
                                                <span>{{ $msg->formattedTime() }}</span>
                                                @if($msg->sender_id === Auth::id())
                                                    <i class="fa fa-check-circle {{ $msg->is_read ? 'text-primary' : 'text-white-50' }}"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="typing-indicator" id="typingIndicator" style="display:none;">
                                    <small class="text-muted"><i class="fa fa-circle-o-notch fa-spin mr-1"></i> Typing...</small>
                                </div>
                            </div>

                            {{-- Input --}}
                            <div class="carbook-chat-input">
                                <button class="carbook-btn-icon" id="emojiBtn" onclick="toggleEmojiPicker()" title="Emoji">
                                    <i class="fa fa-smile-o"></i>
                                </button>
                                <button class="carbook-btn-icon" onclick="document.getElementById('fileInput').click()" title="Attach File">
                                    <i class="fa fa-paperclip"></i>
                                </button>

                                <textarea id="messageInput" placeholder="Write a message..." rows="1" maxlength="5000"></textarea>

                                <button class="carbook-send-btn" id="sendBtn" onclick="sendMessage()" title="Send">
                                    <i class="fa fa-paper-plane"></i>
                                </button>
                            </div>

                            <input type="file" id="fileInput" class="d-none" onchange="handleFileSelect(this)">

                            {{-- Emoji Picker --}}
                            <div class="carbook-emoji-picker" id="emojiPicker">
                                <div class="carbook-emoji-grid" id="emojiGrid"></div>
                            </div>

                        @else
                            <div class="carbook-empty-state">
                                <i class="fa fa-comments"></i>
                                <h4 class="font-weight-bold text-dark">Your Messages</h4>
                                <p class="text-muted mb-0">Select a conversation from the list or start a new chat from your bookings.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- Context Menu --}}
<div id="contextMenu" class="dropdown-menu shadow" style="display:none; position:fixed; z-index:10000;">
    <button class="dropdown-item" onclick="copyMessage()"><i class="fa fa-copy mr-2"></i> Copy</button>
    <button class="dropdown-item text-danger" onclick="deleteMessage()"><i class="fa fa-trash mr-2"></i> Delete for me</button>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="modal fade" tabindex="-1" onclick="closeLightbox()">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 text-center">
            <img id="lightboxImg" src="" class="img-fluid rounded mx-auto" style="max-height: 85vh;">
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    const POLL_INTERVAL = 3000;
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content;
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const conversationId = chatMessages?.dataset?.conversation;
    const currentUserId = parseInt(chatMessages?.dataset?.user);
    let lastMessageId = 0;
    let pollTimer = null;
    let contextMenuMsgId = null;
    let pendingFile = null;

    if (chatMessages && conversationId) {
        const msgs = chatMessages.querySelectorAll('.carbook-msg-wrapper');
        if (msgs.length > 0) {
            lastMessageId = parseInt(msgs[msgs.length - 1].dataset.msgId) || 0;
        }

        scrollToBottom();
        startPolling();
        markAsRead();
        populateEmojis();
    }

    if (messageInput) {
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });

        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    const searchInput = document.getElementById('conversationSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.carbook-conv-item');
            items.forEach(item => {
                const name = item.querySelector('.carbook-conv-name')?.textContent.toLowerCase() || '';
                const msg = item.querySelector('.carbook-conv-msg')?.textContent.toLowerCase() || '';
                item.style.display = (name.includes(q) || msg.includes(q)) ? 'flex' : 'none';
            });
        });
    }

    document.addEventListener('click', function(e) {
        const cm = document.getElementById('contextMenu');
        if (cm && !cm.contains(e.target)) cm.style.display = 'none';
        const ep = document.getElementById('emojiPicker');
        if (ep && !ep.contains(e.target) && e.target.id !== 'emojiBtn' && !e.target.closest('#emojiBtn')) {
            ep.classList.remove('show');
        }
    });

    window.sendMessage = function() {
        if (!messageInput || !conversationId) return;

        const text = messageInput.value.trim();
        const fileInput = document.getElementById('fileInput');
        const file = pendingFile || (fileInput?.files?.[0] || null);

        if (!text && !file) return;

        const formData = new FormData();
        if (text) formData.append('message', text);
        if (file) formData.append('attachment', file);
        formData.append('_token', CSRF_TOKEN);

        messageInput.value = '';
        messageInput.style.height = 'auto';
        pendingFile = null;
        if (fileInput) fileInput.value = '';

        fetch(`/chat/${conversationId}/send`, {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                appendMessage(data.message, true);
                lastMessageId = data.message.id;
                scrollToBottom();
            }
        })
        .catch(err => console.error('Send error:', err));
    };

    function appendMessage(msg, isSent) {
        if (!chatMessages) return;
        if (chatMessages.querySelector(`[data-msg-id="${msg.id}"]`)) return;

        const lastDateSep = chatMessages.querySelectorAll('.carbook-date-sep span');
        const lastDate = lastDateSep.length > 0 ? lastDateSep[lastDateSep.length - 1].textContent : '';
        if (msg.date !== lastDate) {
            const dateSep = document.createElement('div');
            dateSep.className = 'carbook-date-sep';
            dateSep.innerHTML = `<span>${msg.date}</span>`;
            chatMessages.appendChild(dateSep);
        }

        const wrapper = document.createElement('div');
        wrapper.className = `carbook-msg-wrapper ${msg.sender_id === currentUserId ? 'sent' : 'received'}`;
        wrapper.dataset.msgId = msg.id;
        wrapper.setAttribute('oncontextmenu', `showContextMenu(event, ${msg.id})`);

        let attachmentHtml = '';
        if (msg.attachment_path) {
            if (msg.is_image) {
                attachmentHtml = `<div class="mb-2"><img src="${msg.attachment_path}" class="img-fluid rounded" style="max-height:200px; cursor:pointer;" onclick="openLightbox(this.src)"></div>`;
            } else {
                attachmentHtml = `<div class="mb-2"><a href="${msg.attachment_path}" target="_blank" class="btn btn-sm btn-light border text-dark" download><i class="fa fa-file-text-o mr-1"></i> ${msg.attachment_name || 'File'} <i class="fa fa-download ml-2 text-muted"></i></a></div>`;
            }
        }

        const tickHtml = msg.sender_id === currentUserId
            ? `<i class="fa fa-check-circle ${msg.is_read ? 'text-primary' : 'text-white-50'}"></i>`
            : '';

        wrapper.innerHTML = `
            <div class="carbook-msg-bubble">
                ${attachmentHtml}
                ${msg.message ? `<div>${escapeHtml(msg.message)}</div>` : ''}
                <div class="carbook-msg-meta">
                    <span>${msg.time}</span>
                    ${tickHtml}
                </div>
            </div>`;

        chatMessages.appendChild(wrapper);
    }

    function startPolling() {
        if (!conversationId) return;

        pollTimer = setInterval(() => {
            fetch(`/chat/${conversationId}/messages?after=${lastMessageId}&check_read=1`, {
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    let hasNew = false;
                    data.messages.forEach(msg => {
                        if (msg.id > lastMessageId) {
                            appendMessage(msg);
                            lastMessageId = msg.id;
                            hasNew = true;
                        }
                    });

                    if (hasNew) {
                        const isNearBottom = chatMessages.scrollHeight - chatMessages.scrollTop - chatMessages.clientHeight < 150;
                        if (isNearBottom) scrollToBottom();
                        markAsRead();
                    }
                }

                if (data.read_updates && data.read_updates.length > 0) {
                    data.read_updates.forEach(id => {
                        const msgEl = chatMessages.querySelector(`[data-msg-id="${id}"] .fa-check-circle`);
                        if (msgEl) {
                            msgEl.classList.remove('text-white-50');
                            msgEl.classList.add('text-primary');
                        }
                    });
                }
            })
            .catch(() => {});
        }, POLL_INTERVAL);
    }

    function markAsRead() {
        if (!conversationId) return;
        fetch(`/chat/${conversationId}/read`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json' }
        }).catch(() => {});
    }

    window.scrollToBottom = function() {
        if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;
    };

    window.handleFileSelect = function(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 10 * 1024 * 1024) { alert('File size must be less than 10MB'); input.value = ''; return; }
            pendingFile = file;
            sendMessage();
        }
    };

    function populateEmojis() {
        const grid = document.getElementById('emojiGrid');
        if (!grid) return;
        const emojis = ['😀','😃','😄','😁','😅','😂','😊','😇','😍','🥰','😘','😋','😎','👍','👋','❤️','🚗','✨'];
        grid.innerHTML = emojis.map(e => `<button class="carbook-emoji-btn" onclick="insertEmoji('${e}')" type="button">${e}</button>`).join('');
    }

    window.toggleEmojiPicker = function() {
        document.getElementById('emojiPicker')?.classList.toggle('show');
    };

    window.insertEmoji = function(emoji) {
        if (!messageInput) return;
        const start = messageInput.selectionStart;
        const end = messageInput.selectionEnd;
        messageInput.value = messageInput.value.substring(0, start) + emoji + messageInput.value.substring(end);
        messageInput.selectionStart = messageInput.selectionEnd = start + emoji.length;
        messageInput.focus();
    };

    window.showContextMenu = function(e, msgId) {
        e.preventDefault();
        contextMenuMsgId = msgId;
        const cm = document.getElementById('contextMenu');
        if (!cm) return;
        cm.style.left = Math.min(e.clientX, window.innerWidth - 160) + 'px';
        cm.style.top = Math.min(e.clientY, window.innerHeight - 80) + 'px';
        cm.style.display = 'block';
    };

    window.copyMessage = function() {
        if (!contextMenuMsgId) return;
        const msgEl = chatMessages.querySelector(`[data-msg-id="${contextMenuMsgId}"] .carbook-msg-bubble`);
        if (msgEl) navigator.clipboard.writeText(msgEl.textContent.trim()).catch(() => {});
        document.getElementById('contextMenu').style.display = 'none';
    };

    window.deleteMessage = function() {
        if (!contextMenuMsgId) return;
        const msgId = contextMenuMsgId;
        document.getElementById('contextMenu').style.display = 'none';
        if (!confirm('Delete this message for you?')) return;

        fetch(`/chat/message/${msgId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const el = chatMessages.querySelector(`[data-msg-id="${msgId}"]`);
                if (el) el.remove();
            }
        });
    };

    window.openLightbox = function(src) {
        const img = document.getElementById('lightboxImg');
        if (img) img.src = src;
        $('#lightbox').modal('show');
    };

    window.closeLightbox = function() {
        $('#lightbox').modal('hide');
    };

    window.showSidebar = function() {
        document.getElementById('chatSidebar')?.classList.remove('hidden-mobile');
    };

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    window.addEventListener('beforeunload', function() {
        if (pollTimer) clearInterval(pollTimer);
    });
})();
</script>
