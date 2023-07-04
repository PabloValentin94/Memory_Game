function iniciar_video()
{

    document.getElementById("video-button").style.display = "none";

    document.getElementById("video-box").innerHTML = '<video height="100%" width="100%" autoplay> <source src="/View/Assets/Videos/Video.mp4" type="video/mp4"> </video>'

    setTimeout(() => {

        document.getElementById("video-box").style.display = "none";
    
        document.getElementById("link-box").style.display = "flex";
    
    }, 95000);

}