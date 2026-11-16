// script.js
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    fileInput.addEventListener('change', function() {
        const fileName = this.value.split('\\').pop();
        alert('Selected file: ' + fileName);
    });
});
