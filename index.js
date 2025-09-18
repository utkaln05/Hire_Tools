const btn = document.querySelector(".registrationbtn");
btn.addEventListener("click", () => {
    const name = document.querySelector(".name").value;
    const email = document.querySelector(".email").value;
    const password = document.querySelector(".password").value;
    const cpassword = document.querySelector(".cpassword").value;
    
    if (name === "" || email === "" || password === "" || cpassword === "") {
        alert("Please fill all the fields");
        return;
    }
    
    if (password !== cpassword) {
        alert("Passwords do not match");
        return;
    }
    
    alert("Registration successful");
    // window.location.href = "index.html";
});
// const ppp = document.getElementsByClassName("progress");
