if(window.Notification && Notification.permission !== "denied")
{
    Notification.requestPermissio(function(status)
    {
        let n = new Notification
        (
            'Notificação',
            {
                body:'Realizando teste de notificação para o usuario',
                icon:''
            }
        )
        let m = new Notification
        (
            'Sessao',
            {
            body:'A seesao foi inicializada',
            icon:''
            }
        )
    })
}
