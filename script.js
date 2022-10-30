function login()
{
    let log = $('#login').val()
    let pas = $('#passw').val()

    $.get('auth.php', {login: log, password: pas}, function(data) {
        let otvet = JSON.parse(data)
        //если произошла ошибка
        if ('error' in otvet) {
            alert(otvet['error']['text'])
        }
        else if ('user' in otvet) {
            window.location.href = "index.php";
        }
        else {
            alert('непредвидинная ошибка')
            console.log(data)
        }
    })
}

function register()
{
    let log = $('#login').val()
    let pas = $('#passw').val()

    $.get('reg.php', {login: log, password: pas}, function(data) {
        let otvet = JSON.parse(data)
        //если произошла ошибка
        if ('error' in otvet) {
            alert(otvet['error']['text'])
        }
        else if ('user' in otvet) {
            alert('вы успешно авторизовались')
        }
        else {
            alert('непредвидинная ошибка')
            console.log(data)
        }
    })
}

function setShop()
{
    let _idTovara = $('#idtovar').val()
    let _count = $('#count').val()
    
    $.get('shop.php', {id_tovara: _idTovara, count: _count}, function(data) {
        let otvet = JSON.parse(data)
        if ('error' in otvet) {
            alert(otvet['error']['text'])
        }
        else if ('response' in otvet) {
            alert('OK')
        }
        else {
            alert('непредвидинная ошибка')
            console.log(data)
        }
    })
}
