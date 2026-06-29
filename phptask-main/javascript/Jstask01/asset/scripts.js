function findwords() {
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
    let regex = /[^a-zA-Z  $]/
    if (regex.test(input)) {
        errordiv.innerHTML = "Special Character(s) not allowed";
        return;
    }
    let words = input.split(" ").filter(word => word !== "");
    if (words.length <= 1) {
        errordiv.innerHTML = "Please enter a sentence which has more than one word";
        return;
    }
    //logic  
    let smallest = words[0];
    let largest = words[0];
    let samelength = true;
    for (let i = 1; i < words.length; i++) {
        if (words[i].length < smallest.length) {
            smallest = words[i];
        }
        if (words[i].length > largest.length) {
            largest = words[i];
        }
        if (words[i].length !== words[0].length) {
            samelength = false;
        }
    }
    if (samelength) {
        errordiv.innerHTML = "All words are equal in length";
        return;
    }
    resultdiv.innerHTML = " <b>Smallest word : </b> " + smallest +"<br>"+ " <b> Largest word : </b> " + largest ;
    alert(
        " Smallest : " + smallest + "\n" + " Largest : " + largest
    );
}
function resetform(){
    document.getElementById("user-input").value = "";
    document.getElementById("error").innerHTML = "";
    document.getElementById("result-msg").innerHTML="";
}