function checkvowel() {
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
    if (/[0-9]/.test(input)) {
        errordiv.innerHTML = "Number are not allowed";
        return;
    }
    let words = input.split(" ").filter(word => word !== "");
    if (words.length > 1) {
        errordiv.innerHTML = "Please enter only one word";
        return;
    }
    const vowel = ["a", "e", "i", "o", "u"];
    // const vowel=["aeiou"]
    let vowelcount = 0
    let vowellist = []

    for (let char of input.toLowerCase()) {
        if (vowel.includes(char)) {
            vowelcount++;
            vowellist.push(char);
        }
    }
    if (!vowelcount) {
        resultdiv.innerHTML = " <b> No Vowel(s) in a sentence : </b> " + input;
    } else {
        resultdiv.innerHTML = "<b> Vowel(s) in a sentence :</b> " + vowellist.join(",");
    }

}

function resetform() {
    document.getElementById("user-input").value = "";
    document.getElementById("error").innerHTML = "";
    document.getElementById("result-msg").innerHTML = "";


}