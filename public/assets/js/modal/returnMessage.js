const ReturnMessage  = {
    success:(message)=>{
        hide_overlay()
        show_success(message)
        setTimeout(() => {
            window.location.href = window.location.href
        },1000)
    },
    error: (message)=>{
        show_error(message)
        hide_overlay()
    }
}


const scrollScreen = {
    enable : ()=>{
        document.documentElement.style.overflow = 'unset';
        document.body.scroll = "yes";
    },
    disable : ()=>{
        document.documentElement.style.overflow = 'hidden';
        document.body.scroll = "unset";
    }
}
