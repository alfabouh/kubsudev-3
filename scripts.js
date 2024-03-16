
document.addEventListener("DOMContentLoaded", function () {
    var button = document.getElementById("sendbutton");
    button.addEventListener("click", (e) => {
        e.preventDefault();
        if (document.getElementById("check").checked === false) {
            alert('Ознакомьтесь с контрактом');
            return;
        }
        console.log('success');
        send_post();
    });
});

function containsOnlySpacesAndLetters(str) {
    return /^[а-яА-Яa-zA-Z\s]+$/.test(str);
}

function containsOnlyInts(str) {
    return /^\d+$/.test(str);
}

async function send_post() {
    var xhr = new XMLHttpRequest();

    var nameInput = document.getElementById("name");
    var mobileInput = document.getElementById("mobile");
    var mailInput = document.getElementById("mail");
    var bdateInput = document.getElementById("bdate");
    var langSelect = document.getElementById("lang");
    var ml = document.getElementById("ml");
    var fml = document.getElementById("fml");
    var bioTextarea = document.getElementById("bio");

    var nameValue = nameInput.value;
    var mobileValue = mobileInput.value;
    var mailValue = mailInput.value;
    var bdateValue = bdateInput.value;
    var bioValue = bioTextarea.value;
    var langSelectedOptions = Array.from(langSelect.selectedOptions).map(option => option.value);

    var req = '';
    req += 'name=' + nameValue + '&';
    req += 'mobile=' + mobileValue + '&';
    req += 'mail=' + mailValue + '&';
    req += 'bdate=' + bdateValue + '&';
    req += 'bio=' + bioValue + '&';
    req += 'gen=' + (ml.checked ? 'M' : fml.checked ? 'F' : '') + '&';
    req += 'lang=' + langSelectedOptions + '&';

    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(req);

    xhr.onload = () => {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
            alert('Успешно отправлена форма!')
        } else {
            console.log(xhr.responseText);
            alert(xhr.responseText);
            console.log('Request failed.  Returned status of ' + xhr.status);
        }    
    }
}