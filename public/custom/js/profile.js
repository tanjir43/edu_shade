function openFullImage() {
    var imgSrc = document.getElementById("profilePreview").src;
    document.getElementById("fullImage").src = imgSrc;
    document.getElementById("fullImageModal").style.display = "flex";
}

function closeFullImage() {
    document.getElementById("fullImageModal").style.display = "none";
}

function previewProfileImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById("profilePreview");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
