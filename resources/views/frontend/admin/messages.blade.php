@extends('frontend.admin.master')

@section('topbar-header', 'Mesajlar')
@section('topbar-icon', 'fas fa-envelope')
@section('messages-sit', 'active')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($messages->count())
        <table class="table table-hover align-middle">
            <thead class="table-secondary">
                <tr>
                    <th class="text-center rounded-top-start" style="border-top-left-radius: 0.5rem;">Ad</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Konu</th>
                    <th class="text-center">Mesaj</th>
                    <th class="text-center">Tarih</th>
                    <th class="text-center rounded-top-start" style="border-top-right-radius: 0.5rem;">Detay</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr id="message-row-{{ $message->id }}" @if($message->status === 'active') class="table-warning" @endif>
                        <td class="text-center">{{ $message->name }}</td>
                        <td class="text-center">{{ $message->email }}</td>
                        <td class="text-center">{{ Str::limit($message->subject, 30) }}</td>
                        <td style="width: 25%;" class="text-center">"{{ Str::limit($message->message, 80) }}"</td>
                        <td style="width: 10%;" class="text-center">
                            <span class="badge bg-light text-dark border">
                                <i class="far fa-calendar me-1"></i>
                                {{ $message->created_at->format('d.m.Y H:i') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-success view-message-btn"
                                    data-id="{{ $message->id }}"
                                    data-name="{{ $message->name }}"
                                    data-email="{{ $message->email }}"
                                    data-subject="{{ $message->subject }}"
                                    data-message="{{ $message->message }}"
                                    data-status="{{ $message->status }}">
                                <i class="fas fa-external-link"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end text-muted mt-2 small">
            *Bu sayfada son 30 günün mesajları listelenmektedir.
        </div>

        <div class="mt-3">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>

    @else
        <div class="text-center p-5">
            <i class="fas fa-envelope fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">Henüz hiç mesaj atılmamış.</h5>
            <p class="text-muted">İletişim formundan gelen mesajlar burada görünecektir.</p>
        </div>
    @endif
</div>

<!-- Mesaj Detayları Modalı -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel"><i class="fas fa-envelope-open" style="margin-right: 10px;"></i> Mesaj Detayı</h5>
            </div>
            <div class="modal-body">
                <p><strong>Gönderen:</strong> <span id="modalName"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>Konu:</strong> <span id="modalSubject"></span></p>
                <hr>
                <p id="modalMessage" class="fs-6"></p>
                <input type="hidden" id="modalMessageId">
                <input type="hidden" id="modalMessageStatus">
            </div>
            <div class="modal-footer">
                <button type="button" id="markReadBtn" class="btn btn-outline-success">
                    <i class="fas fa-check me-1"></i> Okundu Olarak İşaretle
                </button>
                <button type="button" id="markUnreadBtn" class="btn btn-outline-warning">
                    <i class="fas fa-undo me-1"></i> Okunmadı Olarak İşaretle
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        const modalName = document.getElementById('modalName');
        const modalEmail = document.getElementById('modalEmail');
        const modalSubject = document.getElementById('modalSubject');
        const modalMessage = document.getElementById('modalMessage');
        const modalMessageId = document.getElementById('modalMessageId');
        const modalMessageStatus = document.getElementById('modalMessageStatus');
        const markReadBtn = document.getElementById('markReadBtn');
        const markUnreadBtn = document.getElementById('markUnreadBtn');

        document.querySelectorAll('.view-message-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const status = this.dataset.status;

                modalName.textContent = this.dataset.name;
                modalEmail.textContent = this.dataset.email;
                modalSubject.textContent = this.dataset.subject;
                modalMessage.textContent = this.dataset.message;
                modalMessageId.value = id;
                modalMessageStatus.value = status;

                updateButtonStates(status);

                messageModal.show();
            });
        });

        markReadBtn.addEventListener('click', function () {
            const messageId = modalMessageId.value;
            updateMessageStatus(messageId, 'mark-read');
        });

        markUnreadBtn.addEventListener('click', function () {
            const messageId = modalMessageId.value;
            updateMessageStatus(messageId, 'mark-unread');
        });

        function updateMessageStatus(messageId, action) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            console.log('Updating message:', messageId, 'Action:', action);

            fetch(`/dashboard/messages/${messageId}/${action}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    const row = document.getElementById(`message-row-${messageId}`);
                    const viewBtn = row.querySelector('.view-message-btn');

                    if (action === 'mark-read') {
                        row.classList.remove('table-warning');
                        viewBtn.dataset.status = 'passive';
                        modalMessageStatus.value = 'passive';

                        updateButtonStates('passive');
                    } else {
                        row.classList.add('table-warning');
                        viewBtn.dataset.status = 'active';
                        modalMessageStatus.value = 'active';

                        updateButtonStates('active');
                    }

                    showAlert(data.message, 'success');
                }
            })
            .catch(error => {
                console.error('Hata:', error);
                showAlert('Bir hata oluştu. Lütfen tekrar deneyin.', 'danger');
            });
        }

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                ${message}
            `;

            const container = document.querySelector('.container');
            container.insertBefore(alertDiv, container.firstChild);

            setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => alertDiv.remove(), 150);
            }, 3000);
        }

        function updateButtonStates(status) {
            if (status === 'active') {
                markReadBtn.disabled = false;
                markReadBtn.classList.remove('btn-outline-success');
                markReadBtn.classList.add('btn-success');

                markUnreadBtn.disabled = true;
                markUnreadBtn.classList.remove('btn-warning');
                markUnreadBtn.classList.add('btn-outline-warning');
            } else {
                markReadBtn.disabled = true;
                markReadBtn.classList.remove('btn-success');
                markReadBtn.classList.add('btn-outline-success');

                markUnreadBtn.disabled = false;
                markUnreadBtn.classList.remove('btn-outline-warning');
                markUnreadBtn.classList.add('btn-warning');
            }
        }
    });
</script>

@endsection
