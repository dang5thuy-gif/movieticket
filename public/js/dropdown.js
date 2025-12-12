function toggleDropdown(id) {
    let menu = document.getElementById(id);
    let arrow = document.getElementById(id + "_arrow");

    menu.classList.toggle("d-none");
    arrow.classList.toggle("dropdown-open-arrow");
}

// Click ra ngoài → đóng dropdown
document.addEventListener("click", function(event) {
    document.querySelectorAll(".dropdown-menu-custom").forEach(menu => {
        if (!menu.parentElement.contains(event.target)) {
            menu.classList.add("d-none");

            let arrow = document.getElementById(menu.id + "_arrow");
            if (arrow) arrow.classList.remove("dropdown-open-arrow");
        }
    });
});


function toggleRap(id) {
    let box = document.getElementById(id);
    let arrow = document.querySelector('.rap-arrow-' + id);

    box.classList.toggle('d-none');
    arrow.classList.toggle('dropdown-open-arrow');
}

