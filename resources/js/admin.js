document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleButton');
    const editForm = document.getElementById('editForm');
    
    toggleButton.addEventListener('click', function() {
        // Toggle visibility dari form dengan mengubah kelas 'hidden'
        editForm.classList.toggle('hidden');
    });
});