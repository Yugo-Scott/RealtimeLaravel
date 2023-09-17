import './bootstrap';

Echo.private("notifications").listen("UserSessionChanged", (e) => {
    //e contains information that are being sent when the user session changes
    console.log(e);
    console.log(e.message);
    console.log(e.type);
    const notificationElement = document.getElementById("notification");
    console.log(notificationElement);

    notificationElement.innerHTML = e.message;

    notificationElement.classList.remove("invisible");
    notificationElement.classList.remove("alert-success");
    notificationElement.classList.remove("alert-danger");

    notificationElement.classList.add(`alert-${e.type}`);
});