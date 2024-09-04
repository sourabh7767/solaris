let popupModal = document.getElementsByClassName("popupModal")[0]
let userEmail = "";
let redirectElm;
const modalCloser = () => {
    popupModal.removeAttribute("style");
}


const UserDeleteBtn = (elm, email) => {
    popupModal.setAttribute("style", "display:flex;")
    userEmail = email
    redirectElm = elm
}

const modalConfirm = () => {
    window.location.href = `../Editable Utils/DeleteUser.php?user=${userEmail}`
    console.log(redirectElm, userEmail)
    popupModal.removeAttribute("style");

}