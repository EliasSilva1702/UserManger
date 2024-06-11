const antBtns = document.querySelectorAll(".btn-prev"); //*Obtenemos todos los ID de los botones anterior
const nextBtns = document.querySelectorAll(".btn-next"); //*Obtenemos todos los ID de los botones siguiente 
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault(); // Evita la recarga de la página
        formStepsNum++;
        updateFormSteps();
        updateProgressbar();
    });
});

antBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault(); // Evita la recarga de la página
        formStepsNum--;
        updateFormSteps();
        updateProgressbar();
    });
});


function updateFormSteps() {

    formSteps.forEach(formStep => {
        formStep.classList.contains("form-step-active") &&
        formStep.classList.remove("form-step-active");
    });

    formSteps[formStepsNum].classList.add("form-step-active");
}

function updateProgressbar() {
progressSteps.forEach((progressSteps, idx) => {
    if(idx < formStepsNum + 1) {
        progressSteps.classList.add("progress-step-active");
    }else {
        progressSteps.classList.remove("progress-step-active");
    }

});

const progressActive = document.querySelectorAll(".progress-step-active");

progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";

}