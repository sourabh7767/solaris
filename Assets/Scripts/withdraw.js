let userstatus = document.getElementById('userstatus')
let hashSec = document.getElementById('hashSec')
let hash = document.getElementById('hash')
let withdrawalSubmmitBtn = document.getElementById('withdrawalSubmmitBtn')
let prevChange = userstatus.value
let hashStatus = false;
userstatus.addEventListener("change", (e) => {
    if (e.target.value !== "Completado" && e.target.value !== prevChange) {
        hashSec.setAttribute("style", "display:none;")

        withdrawalSubmmitBtn.disabled = false

    } else if (e.target.value === prevChange) {
        withdrawalSubmmitBtn.disabled = true

    } else {
        hashSec.removeAttribute("style")
        hashStatus = true
        withdrawalSubmmitBtn.disabled = false
    }
   

})

window.addEventListener("load", () => {
    if (userstatus.value !== "Completado") {
        hashSec.setAttribute("style", "display:none;")
    } else {
        hashSec.removeAttribute("style")
    }

})