document.getElementById("registrationForm").addEventListener("submit", function (event) {
    event.preventDefault();


    // Age Validation
    let age_field = document.getElementById("age");

    let age = Number(age_field.value);
    let name = document.getElementById("name")
    let email = document.getElementById("email")
    let phone = document.getElementById("phone")
    let month = document.getElementById("month")
    let batch = document.getElementById("batch")
    let agreement = document.getElementById("agreement")

    if (age < 18 || age > 65 || isNaN(age)) {
        age_field.setCustomValidity("Only age between 18-65 are allowed");
        age_field.reportValidity();
        return;
    }


    let data = {
        name: name.value,
        email: email.value,
        age: age,
        phone: phone.value,
        month: formatMonthYear(month.value),
        batch: batch.value,
        agreement: agreement.checked
    };

    fetch("http://localhost/flexmoney-yoga-admission/api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: data.message,
                });

                name.value = ""
                email.value = ""
                age_field.value = ""
                phone.value = ""
                batch.value = ""
                month.value = ""
                agreement.checked = false
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: data.message,
                });
            }
        })
        .catch(error => console.error("Error:", error));
});


document.getElementById("age").addEventListener("input", function () {
    this.setCustomValidity("");
});

// Set current year and month
let today = new Date();
let currentMonth = today.toISOString().slice(0, 7); // Format: YYYY-MM
document.getElementById("month").setAttribute("min", currentMonth);

function formatMonthYear(dateString) {
    let date = new Date(dateString + "-01"); // Append "-01" to avoid timezone issues
    let options = { year: "numeric", month: "long" };
    return date.toLocaleDateString("en-US", options);
}

// View Guidelines
document.querySelector(".checkbox_div a").addEventListener('click', (e) => {
    let guidelines = document.querySelector(".enrollment-guidelines");
    // console.log(guidelines);
    guidelines.style.display = (guidelines.style.display === "none") ? "block" : "none";
})

// Close Giodeline Tab
document.querySelector(".enrollment-guidelines span").addEventListener('click', (e) => {
    let guidelines = document.querySelector(".enrollment-guidelines");
    guidelines.style.display = "none";
})