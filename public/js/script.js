// $(window).scroll(function () {
//     $('nav').toggleClass('shadow-sm', $(this).scrollTop() > 10);
// });

// $('.toast').toast({})

// Image preview when create/update
function previewImg(whatFor) {
    const image = document.querySelector('#inputImage') ? document.querySelector('#inputImage') : document.querySelector('#editImage');
    const imagePreview = document.querySelector('.img-preview');

    if (whatFor != 'editProfile') {
        imagePreview.classList.add = 'd-block';

    }

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = (oFREvent) => {
        imagePreview.src = oFREvent.target.result;
    }
}

// Edit the book
function edit(Btn) {
    let thisBtn = document.getElementById(Btn);
    let options = document.getElementsByClassName("edit-option");
    let animate = document.getElementsByClassName("shake-constant");
    // change the edit button
    if (thisBtn.classList.contains("btn-dark")) {
        thisBtn.classList.replace("btn-dark", "btn-outline-dark");
        thisBtn.innerHTML = "Edit";
    } else {
        thisBtn.classList.replace("btn-outline-dark", "btn-dark");
        thisBtn.innerHTML = "Cancel";
    }

    separateClass(options);
    separateClass(animate);

}

function separateClass(array) {
    for (let i = 0; i < array.length; i++) {
        className = array[i];
        showClass(className);
    }
}

function showClass(className) {
    if (className.classList.contains("shake-constant")) {
        if (className.classList.contains("shake-little")) {
            className.classList.remove("shake-little");
        } else {
            className.classList.add("shake-little");
        }
    }

    if (className.classList.contains("edit-option")) {
        if (className.classList.contains("d-none")) {
            className.classList.remove("d-none")
        } else {
            className.classList.add("d-none");
        }
    }
}