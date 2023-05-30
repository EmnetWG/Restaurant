

const x = document.querySelector(".nav-list");
  const y = document.querySelector(".nav-toggler");
  y.addEventListener("click", () =>{
     x.classList.toggle("active");
    y.classList.toggle("active");

  });
  
    
  const prev = document.querySelector(".prev");
  const next = document.querySelector(".next");
  const carousel = document.querySelector(".carousel-container");
  const track = document.querySelector(".track");
  const cardCont = document.querySelector(".card-container");
  let card = document.getElementsByClassName("card");
  let width = carousel.offsetWidth;
  let index = 1;
  let i=0;
  
  prev.addEventListener("click", function () {
    

    cardCont.prepend(card[card.length-1]);
    
  
    
  });
  next.addEventListener("click", function () {
    
      cardCont.append(card[0]);
      
    
    
  });
  
  

  

  
  
  