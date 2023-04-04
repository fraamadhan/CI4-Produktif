const btnUpdate = document.getElementById("update");
const divContent = document.getElementById("content");
const divUpdate = document.getElementById("updateSection");

btnUpdate.addEventListener("click", function(){
    let editData = btnUpdate.parentElement;
    if(divUpdate.style.display === "none"){
        divUpdate.style.display = "contents";
        divContent.style.display = "none";
    }
    else{
        divUpdate.style.display = "none"
        divContent.style.display = "contents"
    }
})

