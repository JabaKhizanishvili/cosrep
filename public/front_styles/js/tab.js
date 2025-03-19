
function togglePassword(element) {
    let passwordField = document.getElementById(element.getAttribute("data-target"));
    let eyeIcon = element.querySelector("i");

    if (passwordField.type === "password") {
        passwordField.type = "text"; // პაროლის ჩვენება
        eyeIcon.classList.remove("bi-eye-fill");
        eyeIcon.classList.add("bi-eye-slash-fill");
    } else {
        passwordField.type = "password"; // პაროლის დამალვა
        eyeIcon.classList.remove("bi-eye-slash-fill");
        eyeIcon.classList.add("bi-eye-fill");

    }
}
