import "./bootstrap";

window.addEventListener("alert", (event) => {
    Swal.fire({
        toast: true,
        icon: event.detail.type,
        title: event.detail.message ?? "",
        position: "top-end",
        width: 500,
        timer: 2000,
        timerProgressBar: true,
        showCloseButton: true,
        showConfirmButton: false,
    });
});
