function process(action) {
    let input = document.getElementById("user-input").value;
    let errorDiv = document.getElementById("error-msg");
    let outputbox = document.getElementById("result-msg");

    errorDiv.innerHTML = "";
    outputbox.innerHTML = "";

    // Empty field validation
    if (!input) {
        errorDiv.innerHTML = "Please enter a number";
        return;
    }


    // Special character validation (except comma & space)
    if (/[^0-9.,-]/.test(input)) {
        errorDiv.innerHTML = "Special Character(s) and letter(s) not allowed";
        return;
    }


    //  input
    input = input
        .replace(/\s+/g, "")
        .replace(/,+/g, ",")
        .replace(/^,|,$/g, "");

    let numbers = input.split(",").filter(num => num !== "");

    // Remove empty values
    numbers = numbers.filter(num => num !== "");

    // Single number validation
    if (numbers.length < 2) {
        errorDiv.innerHTML = "Input should be in 1,2,3,4 format";
        return;
    }

    // Convert to numbers
    numbers = numbers.map(Number);

    let result;

    if (action === "add") {
        result = numbers.reduce((a, b) => a + b, 0);
    } else {
        result = numbers.reduce((a, b) => a * b, 1);
    }

    outputbox.value = result;
}
function resetform() {
    document.getElementById("user-input").value = "";
    document.getElementById("error-msg").innerHTML = "";
    document.getElementById("result-msg").value = "";
}