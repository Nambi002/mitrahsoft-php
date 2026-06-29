function checkreverse() {
    let input = document.getElementById("user-input").value;
    let errordiv = document.getElementById("error");
    let resultdiv = document.getElementById("result-msg");

    errordiv.innerHTML = "";
    resultdiv.inner = "";

    input = input.trim();
    // empty checks 
    if (!input) {
        errordiv.innerHTML = "Please enter a sentence";
        return;
    }
    //special characters
    let regex = /[^a-zA-Z 0-9$]/
    if (regex.test(input)) {
        errordiv.innerHTML = "Special Character(s) not allowed";
        return;
    }
    //Number are not allowed
    if (/[0-9]/.test(input)) {
        errordiv.innerHTML = "Number are not allowed";
        return;
    }
    let words = input.split(" ").filter(word => word !== "");
    //only one word
    if (words.length > 1) {
        errordiv.innerHTML = "Please enter only one word";
        return;
    }
    //Please enter more than one character
    if (input.length <= 1) {
        errordiv.innerHTML = "Please enter more than one character";
        return;
    }
    //logic
    let a = input.split("").reverse().join("");
    resultdiv.innerHTML = "<b>Reverse string : </b> " + a;

}
function resetform() {
    document.getElementById("user-input").value = "";
    document.getElementById("error").innerHTML = "";
    document.getElementById("result-msg").innerHTML = "";
}