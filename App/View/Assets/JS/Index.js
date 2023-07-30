function iniciar_video()
{

    document.getElementById("video-button").style.display = "none";

    document.getElementById("video").style.display = "flex";

    document.getElementById("skip-video-button").style.display = "flex";

    document.getElementById("video").play();

    setTimeout(() => {

        setTimeout(() => {

            carregar_pagina_inicial();

        }, Math.floor((document.getElementById("video").duration * 1000) + 1000));

    }, 1000);

    // Tempo manual: 95000.

}

function carregar_pagina_inicial(video)
{

    if(video != null)
    {

        video.pause();

    }

    document.getElementById("video-box").style.display = "none";

    document.getElementById("skip-video-button").style.display = "none";
    
    document.getElementById("link-box").style.display = "flex";

}