
    const fileInput = document.getElementById('file-upload');
    const fileNameDisplay = document.getElementById('file-name');

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name; // Display selected file name
        } else {
            fileNameDisplay.textContent = "No file chosen"; // Reset message if no file is selected
        }
    });

   
