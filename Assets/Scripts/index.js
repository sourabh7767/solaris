const ToasterCloser = () => {
    document.getElementsByClassName("toastModal")[0].classList.add("closeModal")
    document.getElementsByClassName("closeModal")[0].classList.remove("toastModal")
}


setTimeout(() => {
    document.getElementsByClassName("toastModal")[0].classList.add("closeModal")
    document.getElementsByClassName("closeModal")[0].classList.remove("toastModal")

}, 2000);



