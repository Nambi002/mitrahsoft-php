
function findLargest(num1, num2) {
    if (num1 > num2) {
        return num1;
    } else {
        return num2;
    }
}
function validateAndFind() {
    let input = document.getElementById("user-input").value;
    let errorDiv = document.getElementById("error");
    let resultDiv = document.getElementById("result-msg");

    errorDiv.innerHTML = "";
    resultDiv.innerHTML = "";

    // Remove spaces
    input = input.replace(/\s+/g, "");

    // Empty check
    if (input === "") {
        errorDiv.innerHTML = "Please enter a number";
        return;
    }

    // Allow only digits, comma, dot and minus
    if (/[^0-9.,-]/.test(input)) {
        errorDiv.innerHTML = "Special Character(s) and letter(s) not allowed";
        return;
    }


    let parts = input.split(",");

    if (parts.length !== 2) {
        errorDiv.innerHTML = "Please enter exactly two numbers separated by comma";
        return;
    }

    // Regex for negative & decimal numbers
    let numberRegex = /^-?\d+(\.\d+)?$/;

    if (!numberRegex.test(parts[0]) || !numberRegex.test(parts[1])) {
        errorDiv.innerHTML = "Invalid number format";
        return;
    }

    let num1 = parseFloat(parts[0]);
    let num2 = parseFloat(parts[1]);

    // Same number check
    if (num1 === num2) {
        errorDiv.innerHTML = "both numbers are same";
        return;
    }

    let largest = findLargest(num1, num2);
    resultDiv.innerHTML = "Largest Number is: " + largest;
}

function resetform() {
    document.getElementById("user-input").value = "";
    document.getElementById("error").innerHTML = "";
    document.getElementById("result-msg").innerHTML = "";
}

