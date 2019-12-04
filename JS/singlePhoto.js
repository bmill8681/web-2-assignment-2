document.addEventListener('DOMContentLoaded' , function(){
        document.querySelector(".picDetail").style.display = "none";
            document.querySelector(".picMap").style.display = "none";
    
    //Clicking the Description Button
    document.querySelector('.tab1').addEventListener('click', function () 
        {
         
            document.querySelector(".picDescription1").style.display = "block";
            document.querySelector(".picDetail").style.display = "none";
            document.querySelector(".picMap").style.display = "none";
            
         

        });
    
    //Clicking the detail button 
     document.querySelector('.details').addEventListener('click', function () 
        {
         
            document.querySelector(".picDescription1").style.display = "none";
            document.querySelector(".picDetail").style.display = "block";
         document.querySelector(".picMap").style.display = "none";
         

        });
    
    //clicking the map button
     document.querySelector('.tab3').addEventListener('click', function () 
        {
         
            document.querySelector(".picDescription1").style.display = "none";
            document.querySelector(".picDetail").style.display = "none";
            document.querySelector(".picMap").style.display = "block";
         

        });
    
});

 
