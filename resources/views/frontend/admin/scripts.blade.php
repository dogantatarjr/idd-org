<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar toggle functionality
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // Menu item active state
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function(e) {
            if (!this.hasAttribute('data-bs-toggle')) {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');

        if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });
</script>

<script>

    function showUserDetails(id, name, email, role, created, status) {
        console.log('Function called:', id, name, email);

        document.getElementById('modal-user-id').textContent = id;
        document.getElementById('modal-user-name').textContent = name;
        document.getElementById('modal-user-email').textContent = email;
        document.getElementById('modal-user-role').textContent = role;
        document.getElementById('modal-user-created').textContent = created;
        document.getElementById('modal-user-status').textContent = status;

        $('#userDetailsModal').modal('show');
    }

    function closeUserDetails() {
        $('#userDetailsModal').modal('hide');
    }

    function showUserEdit(id, name, email, role, status) {
        console.log('Edit Function called:', id, name, email);

        document.getElementById('edit-user-id').value = id;
        document.getElementById('edit-user-name').value = name;
        document.getElementById('edit-user-email').value = email;
        document.getElementById('edit-user-role').value = role.toLowerCase();
        document.getElementById('edit-user-status').value = status.toLowerCase();

        document.getElementById('userEditForm').action = '/dashboard/users/' + id;

        $('#userEditModal').modal('show');
    }

    function closeUserEdit() {
        $('#userEditModal').modal('hide');
    }

</script>
