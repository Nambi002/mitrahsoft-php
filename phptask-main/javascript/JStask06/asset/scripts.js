function checkAll() {
    let boxes = document.querySelectorAll(".cb");
    for (let i = 0; i < boxes.length; i++) {
        boxes[i].checked = true;
    }
}

function unCheckAll() {
    let boxes = document.querySelectorAll(".cb");
    for (let i = 0; i < boxes.length; i++) {
        boxes[i].checked = false;
    }
}

function toggleCheck() {
    let boxes = document.querySelectorAll(".cb");
    for (let i = 0; i < boxes.length; i++) {
        boxes[i].checked = !boxes[i].checked;
    }
}