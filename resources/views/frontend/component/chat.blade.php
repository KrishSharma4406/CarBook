{{-- CarBook Theme — Enhanced Native Chat Component --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.carbook-chat-card {
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08) !important;
}

.carbook-chat-sidebar {
    border-right: 1px solid #e9ecef;
    background: #ffffff;
}

.carbook-sidebar-header {
    background: #01d28e;
    color: #ffffff;
    padding: 16px 20px;
}

.carbook-search-box {
    background: #f8f9fa;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    transition: all 0.2s;
}

.carbook-search-box:focus-within {
    border-color: #01d28e;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(1, 210, 142, 0.15);
}

.carbook-search-box input {
    border: none;
    outline: none;
    background: transparent;
    width: 100%;
    font-size: 13px;
    margin-left: 8px;
    color: #2d3748;
}

.carbook-conv-list {
    height: 520px;
    max-height: 520px;
    overflow-y: auto;
}

.carbook-conv-item {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none !important;
    color: #333;
    transition: all 0.15s ease;
}

.carbook-conv-item:hover {
    background: #f8fafc;
    color: #333;
}

.carbook-conv-item.active {
    background: #e6f9f3;
    border-left: 4px solid #01d28e;
}

.carbook-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #01d28e, #00b87c);
    color: #fff;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
    box-shadow: 0 2px 6px rgba(1, 210, 142, 0.3);
}

.carbook-conv-details {
    flex: 1;
    margin-left: 12px;
    min-width: 0;
}

.carbook-conv-name {
    font-weight: 600;
    font-size: 14px;
    color: #1a202c;
    margin-bottom: 2px;
}

.carbook-conv-msg {
    font-size: 12px;
    color: #718096;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.carbook-chat-main {
    display: flex;
    flex-direction: column;
    height: 600px;
    background: #f8fafc;
}

.carbook-chat-header {
    background: #ffffff;
    padding: 14px 20px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.carbook-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: #f1f5f9;
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
    padding: 10px 16px;
    border-radius: 16px;
    font-size: 14px;
    line-height: 1.45;
    position: relative;
    word-break: break-word;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}

.carbook-msg-wrapper.sent .carbook-msg-bubble {
    background: #01d28e;
    color: #ffffff;
    border-bottom-right-radius: 3px;
}

.carbook-msg-wrapper.received .carbook-msg-bubble {
    background: #ffffff;
    color: #1a202c;
    border: 1px solid #e2e8f0;
    border-bottom-left-radius: 3px;
}

.carbook-msg-meta {
    font-size: 11px;
    margin-top: 4px;
    color: #a0aec0;
    display: flex;
    align-items: center;
    gap: 4px;
}

.carbook-msg-wrapper.sent .carbook-msg-meta {
    color: rgba(255,255,255,0.85);
}

.carbook-date-sep {
    text-align: center;
    margin: 14px 0;
}

.carbook-date-sep span {
    background: #e2e8f0;
    color: #4a5568;
    font-size: 11px;
    padding: 4px 14px;
    border-radius: 12px;
    font-weight: 600;
}

/* Input Footer */
.carbook-chat-footer {
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    position: relative;
}

/* Attachment Preview Bar */
.upload-preview-bar {
    display: none;
    padding: 10px 16px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    align-items: center;
    gap: 12px;
}

.upload-preview-bar.show {
    display: flex;
}

.upload-preview-thumb {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    object-fit: cover;
    border: 1px solid #cbd5e1;
}

.upload-preview-info {
    flex: 1;
    min-width: 0;
}

.upload-preview-filename {
    font-size: 13px;
    font-weight: 600;
    color: #334155;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.upload-preview-remove {
    background: #fee2e2;
    color: #ef4444;
    border: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.15s;
}

.upload-preview-remove:hover {
    background: #fca5a5;
}

.carbook-chat-input {
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.carbook-chat-input textarea {
    border: 1px solid #cbd5e1;
    border-radius: 22px;
    padding: 9px 18px;
    font-size: 14px;
    resize: none;
    outline: none;
    flex: 1;
    max-height: 100px;
    font-family: inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.carbook-chat-input textarea:focus {
    border-color: #01d28e;
    box-shadow: 0 0 0 3px rgba(1, 210, 142, 0.15);
}

.carbook-btn-icon {
    background: none;
    border: none;
    color: #64748b;
    width: 38px;
    height: 38px;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s ease;
    padding: 0;
    flex-shrink: 0;
}

.carbook-btn-icon:hover {
    color: #01d28e;
    background: #f1f5f9;
}

.carbook-send-btn {
    background: #01d28e;
    color: #ffffff;
    border: none;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    flex-shrink: 0;
    box-shadow: 0 3px 10px rgba(1, 210, 142, 0.35);
    padding: 0;
}

.carbook-send-btn:hover {
    background: #00b87c;
    transform: scale(1.05);
    box-shadow: 0 5px 14px rgba(1, 210, 142, 0.45);
}

.carbook-send-btn:active {
    transform: scale(0.95);
}

.carbook-empty-state {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #64748b;
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
    left: 16px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    display: none;
    width: 290px;
    z-index: 100;
}

.carbook-emoji-picker.show { display: block; }

.carbook-emoji-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
    max-height: 190px;
    overflow-y: auto;
}

.carbook-emoji-btn {
    border: none;
    background: none;
    font-size: 20px;
    cursor: pointer;
    padding: 6px;
    border-radius: 6px;
    transition: background 0.1s;
}

.carbook-emoji-btn:hover { background: #f1f5f9; }

/* Drag & Drop Overlay */
.chat-drag-overlay {
    position: absolute;
    inset: 0;
    background: rgba(1, 210, 142, 0.1);
    border: 2px dashed #01d28e;
    border-radius: 8px;
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 50;
    pointer-events: none;
}

.chat-drag-overlay.active {
    display: flex;
}

.chat-drag-message {
    background: #fff;
    padding: 14px 24px;
    border-radius: 24px;
    font-weight: 600;
    color: #01d28e;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}

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
                        <h5 class="m-0 text-white font-weight-bold d-flex align-items-center">
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
                        
                        {{-- Drag Overlay --}}
                        <div class="chat-drag-overlay" id="dragOverlay">
                            <div class="chat-drag-message">
                                <i class="fa fa-cloud-upload mr-2"></i> Drop file to attach
                            </div>
                        </div>

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
                                                             class="img-fluid rounded shadow-sm" style="max-height: 220px; cursor: pointer;"
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

                            {{-- Footer Input Area --}}
                            <div class="carbook-chat-footer">
                                
                                {{-- Upload Preview Bar --}}
                                <div class="upload-preview-bar" id="uploadPreviewBar">
                                    <div id="uploadPreviewThumbContainer"></div>
                                    <div class="upload-preview-info">
                                        <div class="upload-preview-filename" id="uploadPreviewName">file.png</div>
                                    </div>
                                    <button type="button" class="upload-preview-remove" onclick="cancelUpload()" title="Remove file">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>

                                {{-- Input Row --}}
                                <div class="carbook-chat-input">
                                    <button type="button" class="carbook-btn-icon" id="emojiBtn" onclick="toggleEmojiPicker()" title="Emoji">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                    </button>

                                    <button type="button" class="carbook-btn-icon" onclick="document.getElementById('fileInput').click()" title="Attach File">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                    </button>

                                    <textarea id="messageInput" placeholder="Write a message..." rows="1" maxlength="5000"></textarea>

                                    <button type="button" class="carbook-send-btn" id="sendBtn" onclick="sendMessage()" title="Send">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Emoji Picker --}}
                                <div class="carbook-emoji-picker" id="emojiPicker">
                                    <div class="carbook-emoji-grid" id="emojiGrid"></div>
                                </div>
                            </div>

                            <input type="file" id="fileInput" class="d-none" onchange="handleFileSelect(this)">

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
    <button class="dropdown-item" onclick="copyMessage()"><i class="fa fa-copy mr-2"></i> Copy text</button>
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
    let pollTimer = null;
    let contextMenuMsgId = null;
    let pendingFile = null;
    let lastMessageId = 0;

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    function getChatMessagesEl() {
        return document.getElementById('chatMessages');
    }

    function getMessageInputEl() {
        return document.getElementById('messageInput');
    }

    function getConversationId() {
        return getChatMessagesEl()?.dataset?.conversation || null;
    }

    function getCurrentUserId() {
        return parseInt(getChatMessagesEl()?.dataset?.user || '0');
    }

    // Initialize page
    function initChat() {
        const chatBox = getChatMessagesEl();
        const convId = getConversationId();

        if (chatBox && convId) {
            const msgs = chatBox.querySelectorAll('.carbook-msg-wrapper');
            if (msgs.length > 0) {
                lastMessageId = parseInt(msgs[msgs.length - 1].dataset.msgId) || 0;
            }

            scrollToBottom();
            startPolling();
            markAsRead();
            populateEmojis();
            setupDragAndDrop();
        }

        const input = getMessageInputEl();
        if (input) {
            input.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
        }

        const sendBtn = document.getElementById('sendBtn');
        if (sendBtn) {
            sendBtn.addEventListener('click', function(e) {
                e.preventDefault();
                sendMessage();
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initChat);
    } else {
        initChat();
    }

    // Search Conversation
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

    // Outside click handlers
    document.addEventListener('click', function(e) {
        const cm = document.getElementById('contextMenu');
        if (cm && !cm.contains(e.target)) cm.style.display = 'none';
        const ep = document.getElementById('emojiPicker');
        if (ep && !ep.contains(e.target) && e.target.id !== 'emojiBtn' && !e.target.closest('#emojiBtn')) {
            ep.classList.remove('show');
        }
    });

    // Send Message
    window.sendMessage = function() {
        const input = getMessageInputEl();
        const convId = getConversationId();
        const token = getCsrfToken();

        if (!input || !convId) return;

        const text = input.value.trim();
        const fileInput = document.getElementById('fileInput');
        const file = pendingFile || (fileInput?.files?.[0] || null);

        if (!text && !file) return;

        const formData = new FormData();
        if (text) formData.append('message', text);
        if (file) formData.append('attachment', file);
        formData.append('_token', token);

        input.value = '';
        input.style.height = 'auto';
        pendingFile = null;
        hideUploadPreview();
        if (fileInput) fileInput.value = '';

        fetch('/chat/' + convId + '/send', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                appendMessage(data.message);
                lastMessageId = data.message.id;
                scrollToBottom();
            } else {
                console.error('Failed to send:', data);
            }
        })
        .catch(err => console.error('Send error:', err));
    };

    function appendMessage(msg) {
        const chatBox = getChatMessagesEl();
        if (!chatBox) return;
        if (chatBox.querySelector(`[data-msg-id="${msg.id}"]`)) return;

        const currentUserId = getCurrentUserId();

        const lastDateSep = chatBox.querySelectorAll('.carbook-date-sep span');
        const lastDate = lastDateSep.length > 0 ? lastDateSep[lastDateSep.length - 1].textContent : '';
        if (msg.date && msg.date !== lastDate) {
            const dateSep = document.createElement('div');
            dateSep.className = 'carbook-date-sep';
            dateSep.innerHTML = `<span>${msg.date}</span>`;
            chatBox.appendChild(dateSep);
        }

        const wrapper = document.createElement('div');
        wrapper.className = `carbook-msg-wrapper ${msg.sender_id === currentUserId ? 'sent' : 'received'}`;
        wrapper.dataset.msgId = msg.id;
        wrapper.setAttribute('oncontextmenu', `showContextMenu(event, ${msg.id})`);

        let attachmentHtml = '';
        if (msg.attachment_path) {
            if (msg.is_image) {
                attachmentHtml = `<div class="mb-2"><img src="${msg.attachment_path}" class="img-fluid rounded shadow-sm" style="max-height:220px; cursor:pointer;" onclick="openLightbox(this.src)"></div>`;
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

        chatBox.appendChild(wrapper);
    }

    function startPolling() {
        const convId = getConversationId();
        const token = getCsrfToken();
        if (!convId) return;

        pollTimer = setInterval(() => {
            fetch('/chat/' + convId + '/messages?after=' + lastMessageId + '&check_read=1', {
                headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                const chatBox = getChatMessagesEl();
                if (data.messages && data.messages.length > 0) {
                    let hasNew = false;
                    data.messages.forEach(msg => {
                        if (msg.id > lastMessageId) {
                            appendMessage(msg);
                            lastMessageId = msg.id;
                            hasNew = true;
                        }
                    });

                    if (hasNew && chatBox) {
                        const isNearBottom = chatBox.scrollHeight - chatBox.scrollTop - chatBox.clientHeight < 150;
                        if (isNearBottom) scrollToBottom();
                        markAsRead();
                    }
                }

                if (data.read_updates && data.read_updates.length > 0 && chatBox) {
                    data.read_updates.forEach(id => {
                        const msgEl = chatBox.querySelector(`[data-msg-id="${id}"] .fa-check-circle`);
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
        const convId = getConversationId();
        const token = getCsrfToken();
        if (!convId) return;
        fetch('/chat/' + convId + '/read', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': token, 'Content-Type': 'application/json' }
        }).catch(() => {});
    }

    window.scrollToBottom = function() {
        const chatBox = getChatMessagesEl();
        if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
    };

    // File Selection & Upload Preview
    window.handleFileSelect = function(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB');
                input.value = '';
                return;
            }
            pendingFile = file;
            showUploadPreview(file);
        }
    };

    function showUploadPreview(file) {
        const bar = document.getElementById('uploadPreviewBar');
        const thumbContainer = document.getElementById('uploadPreviewThumbContainer');
        const nameEl = document.getElementById('uploadPreviewName');
        if (!bar || !nameEl) return;

        nameEl.textContent = file.name;

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                thumbContainer.innerHTML = `<img src="${e.target.result}" class="upload-preview-thumb">`;
            };
            reader.readAsDataURL(file);
        } else {
            thumbContainer.innerHTML = `<div class="btn btn-sm btn-light border"><i class="fa fa-file-text-o text-primary"></i></div>`;
        }

        bar.classList.add('show');
    }

    window.cancelUpload = function() {
        pendingFile = null;
        hideUploadPreview();
        const fileInput = document.getElementById('fileInput');
        if (fileInput) fileInput.value = '';
    };

    function hideUploadPreview() {
        const bar = document.getElementById('uploadPreviewBar');
        if (bar) bar.classList.remove('show');
    }

    // Drag and Drop
    function setupDragAndDrop() {
        const main = document.getElementById('chatMain');
        const overlay = document.getElementById('dragOverlay');
        if (!main || !overlay) return;

        let dragCounter = 0;
        main.addEventListener('dragenter', function(e) { e.preventDefault(); dragCounter++; overlay.classList.add('active'); });
        main.addEventListener('dragleave', function(e) { e.preventDefault(); dragCounter--; if (dragCounter <= 0) { overlay.classList.remove('active'); dragCounter = 0; } });
        main.addEventListener('dragover', function(e) { e.preventDefault(); });
        main.addEventListener('drop', function(e) {
            e.preventDefault();
            overlay.classList.remove('active');
            dragCounter = 0;
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                const file = e.dataTransfer.files[0];
                if (file.size > 10 * 1024 * 1024) { alert('File size must be less than 10MB'); return; }
                pendingFile = file;
                showUploadPreview(file);
            }
        });
    }

    // Emoji Picker
    function populateEmojis() {
        const grid = document.getElementById('emojiGrid');
        if (!grid) return;
        const emojis = ['😀','😃','😄','😁','😅','😂','😊','😇','😍','🥰','😘','😋','😎','🥳','🤩','👍','👏','🙌','🤝','❤️','🔥','✨','🚗','🚕','📍'];
        grid.innerHTML = emojis.map(e => `<button class="carbook-emoji-btn" onclick="insertEmoji('${e}')" type="button">${e}</button>`).join('');
    }

    window.toggleEmojiPicker = function() {
        document.getElementById('emojiPicker')?.classList.toggle('show');
    };

    window.insertEmoji = function(emoji) {
        const input = getMessageInputEl();
        if (!input) return;
        const start = input.selectionStart;
        const end = input.selectionEnd;
        input.value = input.value.substring(0, start) + emoji + input.value.substring(end);
        input.selectionStart = input.selectionEnd = start + emoji.length;
        input.focus();
    };

    // Context Menu
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
        const chatBox = getChatMessagesEl();
        const msgEl = chatBox?.querySelector(`[data-msg-id="${contextMenuMsgId}"] .carbook-msg-bubble`);
        if (msgEl) navigator.clipboard.writeText(msgEl.textContent.trim()).catch(() => {});
        document.getElementById('contextMenu').style.display = 'none';
    };

    window.deleteMessage = function() {
        if (!contextMenuMsgId) return;
        const msgId = contextMenuMsgId;
        const token = getCsrfToken();
        const chatBox = getChatMessagesEl();
        document.getElementById('contextMenu').style.display = 'none';
        if (!confirm('Delete this message for you?')) return;

        fetch('/chat/message/' + msgId, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': token, 'Content-Type': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success && chatBox) {
                const el = chatBox.querySelector(`[data-msg-id="${msgId}"]`);
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
