let userstatus = document.getElementById('userstatus')
let hashSec = document.getElementById('cHash')
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
        hashSec.setAttribute("style", "display:none;")

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


const showTransDetailsPopup = (data) => {
    const popup = document.querySelector('.trans-details-popup');
    const overlay = document.querySelector('.popup-overlay');
    popup.style.display = 'block';
    overlay.style.display = 'block';

    const editWithdrawalInput = document.querySelectorAll('.editWithdrawalInput')
    editWithdrawalInput[0].value = data.ID !== undefined ? data.ID : ''
    editWithdrawalInput[1].value = data.Amount !== undefined ? data.Amount : ''
    editWithdrawalInput[2].value = data.Address !== undefined ? data.Address : ''
    editWithdrawalInput[3].value = data.Email !== undefined ? data.Email : ''
    editWithdrawalInput[4].value = data.Grid !== undefined ? data.Grid : ''
    editWithdrawalInput[5].value = data.Crypto !== undefined ? data.Crypto : ''
    editWithdrawalInput[6].value = data.Date !== undefined ? data.Date : ''
    editWithdrawalInput[7].value = data.Status !== undefined ? data.Status : ''
    editWithdrawalInput[8].value = data.Hash !== undefined ? data.Hash : ''
}



