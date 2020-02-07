    document.addEventListener("DOMContentLoaded", function(event) {
        let navTop = document.querySelector("#nav-top");
        let navTopLabel = document.querySelectorAll(".nav-top label");
        let navTopPhone = document.querySelectorAll(".nav-top p span");
        console.log(navTopLabel, navTopPhone);
        let navBot = document.querySelector(".nav-bot");
        let nav = document.querySelector("nav");
        function scrollBot() {
            navTop.style.height = "0px";
            navTop.style.marginBottom = "0px";
            navTop.style.marginTop = "0px";
            navBot.style.marginTop = "15px";
            navBot.style.marginBottom = "10px";
            navBot.style.backgroundColor = "transparent";
            nav.style.backgroundColor = "white";
            nav.classList.add("shadow");
        }
        function scrollTop(position) {
            navTop.style.height = "40px";
            navTop.style.marginTop = "15px";
            if (position > 10) {
                nav.style.backgroundColor = "white";
                for (let i = 0; i < navTopLabel.length; i++) {
                    navTopLabel[i].style.color = "black";
                }
                for (let i = 0; i < navTopPhone.length; i++) {
                    navTopPhone[i].style.color = "black";
                }
            } else {
                nav.style.backgroundColor = "transparent";
                nav.classList.remove("shadow");
                navBot.style.marginBottom = "0px";
                for (let i = 0; i < navTopLabel.length; i++) {
                    navTopLabel[i].style.color = "white";
                }
                for (let i = 0; i < navTopPhone.length; i++) {
                    navTopPhone[i].style.color = "white";
                }
            }
        }
        window.addEventListener("scroll", function(e) {
            if (this.oldScroll > this.scrollY) {
                scrollTop(this.scrollY);
            } else {
                scrollBot();
            }
            this.oldScroll = this.scrollY;
        },
            {passive: true}
        );
    });
