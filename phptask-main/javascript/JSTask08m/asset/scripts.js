function replaceElement() {

    let arrayInput = document.getElementById("user-input-one").value;
    let positionInput = document.getElementById("user-input-two").value;
    let newElement = document.getElementById("user-input-three").value;

    let arrayerror = document.getElementById("arrayerror");
    let positionerror = document.getElementById("positionerror");
    let elementerror = document.getElementById("elementerror");
    let resultDiv = document.getElementById("result-msg");

    arrayerror.innerHTML = "";
    positionerror.innerHTML = "";
    elementerror.innerHTML = "";
    resultDiv.innerHTML = "";

    /*  EMPTY VALIDATION */
    if (!arrayInput.trim()) {
        arrayerror.innerHTML = "Please enter a sentence";
    } else if (/[^a-zA-Z,\s]/.test(arrayInput)) {
        arrayerror.innerHTML = "Special Character(s) and numbers not allowed";
        return;
    }
    arrayInput = arrayInput
        .replace(/\s+/g, "")    // remove spaces
        .replace(/,+/g, ",")    // multiple commas → single
        .replace(/^,|,$/g, ""); // trim commas

    let arr = arrayInput.split(",");

    // Remove empty values
    arr = arr.filter(item => item !== "");

    if (arr.length < 2) {
        arrayerror.innerHTML = "Input should be in A,B,C,D format";
        return;
    }

    if (!positionInput.trim()) {
        positionerror.innerHTML = "Please enter a Number";
    } else if (!/^\d+$/.test(positionInput)) {
        positionerror.innerHTML = "positive number only allowed";
        return;
    }

    if (!newElement.trim()) {
        elementerror.innerHTML = "Please enter a sentence";
    } else if (/[^a-zA-Z,\s]/.test(newElement)) {
        elementerror.innerHTML = "Special Character(s) and numbers not allowed";
        return;
    }

    let position = parseInt(positionInput);

    if (position > arr.length) {
        positionerror.innerHTML = "Enter position between 1 to " + arr.length;
        return;
    }
    /* ---------- REPLACE ELEMENT ---------- */
    arr[position - 1] = newElement;

    resultDiv.innerHTML = "Updated Array: " + arr.join(",");
}
function resetform() {
    document.getElementById("user-input-one").value = "";
    document.getElementById("user-input-two").value = "";
    document.getElementById("user-input-three").value = "";
    document.getElementById("arrayerror").innerHTML = "";
    document.getElementById("positionerror").innerHTML = "";
    document.getElementById("elementerror").innerHTML = "";
    document.getElementById("result-msg").innerHTML = "";
}