let otpInputAdminSetting = document.getElementById("otpInputAdminSetting");
let appSettingInput = document.getElementById("appSetting");
let popupModal = document.getElementsByClassName("popupModal")[0];
let popupModal2 = document.getElementsByClassName("popupModal")[1];
let popupModalAppSetting = document.getElementsByClassName("popupModal")[1];
const loader = document.getElementById("activeLoader");
let path = "";
let submitData;
let AppSettingFormData = new FormData()
// submit app setting
document.getElementById("appsettingForm").addEventListener("submit", (event) => {
    event.preventDefault();

    loader.setAttribute("style", "display:flex;");
    const submitpath = "../Admin Settings/AppSettings.php";

    fetch("../EmailSender/index.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Or response.text() for plain text
        })
        .then((data) => {
            // Handle the data
            const formData = new FormData(event.target);
            loader.setAttribute("style", "display:none;");
            if (data.status === "success") {
                toastr.success("Send OTP to admin ");
                popupModalAppSetting.setAttribute("style", "display:flex;")
                path = submitpath;
                formData.forEach((value, key) => {
                    AppSettingFormData.append(key, value);
                });
                submitAppSetting();
            } else {
                toastr.error("Please Try again");
            }
        })
        .catch((error) => {
            loader.setAttribute("style", "display:none;");
            console.log(error);
        });
});

// submit social media links
document.getElementById("socialMediaForm").addEventListener("submit", (e) => {
    e.preventDefault();
    const loader = document.getElementById("activeLoader");
    loader.setAttribute("style", "display:flex;");
    const submitpath = "../Admin Settings/SocialMedia.php";

    fetch("../EmailSender/index.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Or response.text() for plain text
        })
        .then((data) => {
            // Handle the data
            loader.setAttribute("style", "display:none;");
            if (data.status === "success") {
                toastr.success("Send OTP to admin ");
                popupModal.setAttribute("style", "display:flex;")
                const formData = new FormData(e.target);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                path = submitpath
                submitData = data
                modalConfirm();
            } else {
                toastr.error("Please Try again");
            }
        })
        .catch((error) => {
            loader.setAttribute("style", "display:none;");
            console.log(error);
        });
});
// operation Submit
document.getElementById("operationSubmit").addEventListener("submit", (e) => {
    e.preventDefault();
    const loader = document.getElementById("activeLoader");
    loader.setAttribute("style", "display:flex;");
    const submitpath = "../Admin Settings/Oparations.php";

    fetch("../EmailSender/index.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Or response.text() for plain text
        })
        .then((data) => {
            // Handle the data
            loader.setAttribute("style", "display:none;");
            if (data.status === "success") {
                toastr.success("Send OTP to admin ");
                popupModal.setAttribute("style", "display:flex;")
                const formData = new FormData(e.target);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                path = submitpath
                submitData = data
                modalConfirm();
            } else {
                toastr.error("Please Try again");
            }
        })
        .catch((error) => {
            loader.setAttribute("style", "display:none;");
            console.log(error);
        });
});


// User Profile Details Update
document.getElementById("walletSubmit").addEventListener("submit", (e) => {
    e.preventDefault();
    const loader = document.getElementById("activeLoader");
    loader.setAttribute("style", "display:flex;");
    const submitpath = "../Admin Settings/WalletSetting.php";

    fetch("../EmailSender/index.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Or response.text() for plain text
        })
        .then((data) => {
            // Handle the data
            loader.setAttribute("style", "display:none;");
            if (data.status === "success") {
                toastr.success("Send OTP to admin ");
                popupModal.setAttribute("style", "display:flex;")
                const formData = new FormData(e.target);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                path = submitpath
                submitData = data
                modalConfirm();
            } else {
                toastr.error("Please Try again");
            }
        })
        .catch((error) => {
            loader.setAttribute("style", "display:none;");
            console.log(error);
        });
});

// Wallet Setting
document.getElementById("profileUpdate").addEventListener("submit", (e) => {
    e.preventDefault();
    const loader = document.getElementById("activeLoader");
    loader.setAttribute("style", "display:flex;");
    const submitpath = "../Admin Settings/ProfileUpdate.php";

    fetch("../EmailSender/index.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Or response.text() for plain text
        })
        .then((data) => {
            // Handle the data
            loader.setAttribute("style", "display:none;");
            if (data.status === "success") {
                toastr.success("Send OTP to admin ");
                popupModal.setAttribute("style", "display:flex;")
                const formData = new FormData(e.target);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                path = submitpath
                submitData = data
                modalConfirm();
            } else {
                toastr.error("Please Try again");
            }
        })
        .catch((error) => {
            loader.setAttribute("style", "display:none;");
            console.log(error);
        });
});

//Refferal Setting 

document.getElementById("refferalSetting").addEventListener("submit", (e) => {
    e.preventDefault();
    const loader = document.getElementById("activeLoader");
    loader.setAttribute("style", "display:flex;");
    const submitpath = "../Admin Settings/Reffer.php";

    fetch("../EmailSender/index.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Or response.text() for plain text
        })
        .then((data) => {
            // Handle the data
            loader.setAttribute("style", "display:none;");
            if (data.status === "success") {
                toastr.success("Send OTP to admin ");
                popupModal.setAttribute("style", "display:flex;")
                const formData = new FormData(e.target);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                path = submitpath
                submitData = data
                modalConfirm();
            } else {
                toastr.error("Please Try again");
            }
        })
        .catch((error) => {
            loader.setAttribute("style", "display:none;");
            console.log(error);
        });
});


const modalConfirm = () => {
    const outputData = { ...submitData, otp: otpInputAdminSetting.value }

    if (outputData.otp !== "" && outputData !== "" && path !== "") {
        submitSetting(path, outputData)
    } else {
        console.log("blank");
    }
}
const submitAppSetting = () => {
    if (appSettingInput.value !== "") {

        loader.setAttribute("style", "display:flex;");
        AppSettingFormData.append("otp", appSettingInput.value)
        fetch(path, {
            method: 'POST',
            body: AppSettingFormData
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const contentType = response.headers.get("Content-Type");
                if (contentType && contentType.includes("application/json")) {
                    return response.json();
                } else {
                    return response.text();
                }
            })
            .then((result) => {

                loader.removeAttribute("style");
                if (JSON.parse(result).status == "success") {
                    toastr.success("App Setting Updated");
                    popupModalAppSetting.removeAttribute("style")
                    appSettingInput.value = ""
                    path = "";
                } else {
                    toastr.error("Please try again later");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                toastr.error("Internal Server Error");

            });
    } else {
        console.log("appppppp")
    }





}

const submitSetting = (submitpath, data) => {
    loader.setAttribute("style", "display:flex;")
    fetch(submitpath, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            const contentType = response.headers.get("Content-Type");
            if (contentType && contentType.includes("application/json")) {
                return response.json();
            } else {
                return response.text();
            }
        })
        .then((result) => {
            popupModalAppSetting.removeAttribute("style")
            if (JSON.parse(result).status == "success") {
                toastr.success("App Setting Updated");
                loader.removeAttribute("style")
                otpInputAdminSetting.value = ""
                path = "";
                submitData = "";
            } else {
                toastr.error("Please try again later");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            toastr.error("Internal Server Error");

        });
}

const modalCloser = () => {
    popupModal.removeAttribute("style");
    popupModal2.removeAttribute("style");
}
let viewPassword = document.getElementById("viewPassword");
let updatepassword = document.getElementById("updatepassword");
viewPassword.addEventListener("change", (e) => {
    if (e.target.checked) {
        updatepassword.type = "text"
    } else {
        updatepassword.type = "password"
    }
})