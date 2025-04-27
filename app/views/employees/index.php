<?php
/**
 * Employee index view
 */
?>

<div class="page-header">
    <h1>Manajemen Karyawan</h1>
    <p>Kelola daftar karyawan yang dapat ditemui pengunjung.</p>
    <a href="/employees/add" class="button"><i class="fas fa-plus"></i> Tambah Karyawan</a>
</div>

<?php if(isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success_message']; ?>
        <?php unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error_message']; ?>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2>Daftar Karyawan</h2>
        <div class="card-tools">
            <div class="search-box">
                <input type="text" id="employeeSearch" placeholder="Cari karyawan...">
                <i class="fas fa-search"></i>
            </div>
            <div class="filter-box">
                <select id="departmentFilter">
                    <option value="">Semua Departemen</option>
                    <option value="IT">IT</option>
                    <option value="HR">HR</option>
                    <option value="Finance">Finance</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Operations">Operations</option>
                    <option value="Sales">Sales</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="data-table" id="employeesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($employees)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data karyawan</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($employees as $employee): ?>
                            <tr>
                                <td><?= $employee['id']; ?></td>
                                <td><?= htmlspecialchars($employee['name']); ?></td>
                                <td><?= htmlspecialchars($employee['department']); ?></td>
                                <td>
                                    <span class="badge <?= $employee['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                        <?= $employee['is_active'] ? 'Aktif' : 'Non-aktif'; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/employees/edit/<?= $employee['id']; ?>" class="btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn-action btn-toggle-status" 
                                           data-id="<?= $employee['id']; ?>" 
                                           data-status="<?= $employee['is_active']; ?>"
                                           title="<?= $employee['is_active'] ? 'Non-aktifkan' : 'Aktifkan'; ?>">
                                            <i class="fas <?= $employee['is_active'] ? 'fa-toggle-on' : 'fa-toggle-off'; ?>"></i>
                                        </a>
                                        <a href="#" class="btn-action btn-delete" data-id="<?= $employee['id']; ?>" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus karyawan ini?</p>
        <div class="modal-actions">
            <form id="deleteForm" method="POST">
                <button type="submit" class="button button-danger">Hapus</button>
                <button type="button" class="button button-cancel" id="cancelDelete">Batal</button>
            </form>
        </div>
    </div>
</div>

<!-- Status Toggle Confirmation Modal -->
<div class="modal" id="toggleStatusModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Konfirmasi Perubahan Status</h2>
        <p id="toggleStatusMessage"></p>
        <div class="modal-actions">
            <a href="#" id="confirmToggleStatus" class="button">Konfirmasi</a>
            <button type="button" class="button button-cancel" id="cancelToggleStatus">Batal</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('employeeSearch');
    searchInput.addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        filterEmployees();
    });
    
    // Department filter
    const departmentFilter = document.getElementById('departmentFilter');
    departmentFilter.addEventListener('change', function() {
        filterEmployees();
    });
    
    function filterEmployees() {
        const searchText = searchInput.value.toLowerCase();
        const department = departmentFilter.value;
        const rows = document.querySelectorAll('#employeesTable tbody tr');
        
        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const dept = row.cells[2].textContent;
            
            const nameMatch = name.includes(searchText);
            const deptMatch = department === '' || dept === department;
            
            if (nameMatch && deptMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // Delete employee functionality
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const closeDeleteModal = deleteModal.querySelector('.close');
    const cancelDelete = document.getElementById('cancelDelete');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const employeeId = this.getAttribute('data-id');
            deleteForm.action = `/employees/delete/${employeeId}`;
            deleteModal.style.display = 'block';
        });
    });
    
    closeDeleteModal.addEventListener('click', function() {
        deleteModal.style.display = 'none';
    });
    
    cancelDelete.addEventListener('click', function() {
        deleteModal.style.display = 'none';
    });
    
    // Toggle status functionality
    const toggleButtons = document.querySelectorAll('.btn-toggle-status');
    const toggleModal = document.getElementById('toggleStatusModal');
    const toggleMessage = document.getElementById('toggleStatusMessage');
    const confirmToggle = document.getElementById('confirmToggleStatus');
    const closeToggleModal = toggleModal.querySelector('.close');
    const cancelToggle = document.getElementById('cancelToggleStatus');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const employeeId = this.getAttribute('data-id');
            const currentStatus = parseInt(this.getAttribute('data-status'));
            const newStatus = currentStatus ? 0 : 1;
            const statusText = newStatus ? 'aktif' : 'non-aktif';
            
            toggleMessage.textContent = `Apakah Anda yakin ingin mengubah status karyawan menjadi ${statusText}?`;
            confirmToggle.href = `/employees/toggle-status/${employeeId}`;
            toggleModal.style.display = 'block';
        });
    });
    
    closeToggleModal.addEventListener('click', function() {
        toggleModal.style.display = 'none';
    });
    
    cancelToggle.addEventListener('click', function() {
        toggleModal.style.display = 'none';
    });
    
    // Close modals when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.style.display = 'none';
        }
        if (e.target === toggleModal) {
            toggleModal.style.display = 'none';
        }
    });
});
</script>