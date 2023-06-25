var quantidade_vezes_clicada = 0;

function iniciar_video()
{

    quantidade_vezes_clicada++;

    if(quantidade_vezes_clicada == 1)
    {

        document.getElementById("video-button").style.display = "none";

        document.getElementById("video-box").innerHTML = '<video height="100%" width="100%" autoplay> <source src="./Assets/Videos/Video.mp4" type="video/mp4"> </video>'
    
        setTimeout(() => {
    
            document.getElementById("video-box").style.display = "none";
        
            document.getElementById("link-box").style.display = "flex";
        
        }, 92000);
    
    }

}