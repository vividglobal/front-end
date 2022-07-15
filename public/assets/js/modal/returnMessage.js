const ReturnMessage  = {
    success:(message)=>{
        show_success(message)
        hide_overlay()
        window.location.href = window.location.href
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
