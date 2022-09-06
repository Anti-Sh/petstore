function switchScreen(elID){ // Изменение отображение форм авторизации и регистрации
    let reg = document.getElementById("reg__page"); // окно регистрации
    let auth = document.getElementById("auth__page"); // окно авторизации
    if(elID == 0){ 
        auth.classList.add("hide"); // Скрыть авторизацию
        reg.classList.remove("hide"); // Показать регистрацию
    }
    else{
        reg.classList.add("hide"); // Скрыть регистрацию
        auth.classList.remove("hide") // Показать авторизацию
    }
}
function openProfile(){ // Открытие окна профиля
    let profile = document.getElementById("profile_div"); // блок профиля
    let nav_item = document.getElementById("prof__outer"); // блок пункта меню
    nav_item.classList.add("active"); // добавление класса пункту меню
    profile.classList.remove("hide"); // удаление класса блоку профиля
}
function closeProfile(){ // Скрытие окна профиля
    let profile = document.getElementById("profile_div"); // блок профиля
    let nav_item = document.getElementById("prof__outer"); // блок пункта меню
    nav_item.classList.remove("active"); // удаление класса пункту меню
    profile.classList.add("hide"); // добавление класса блоку профиля
}
if(el = document.getElementById("profile_text")){ // Проверка на существование блока профиля
    el.addEventListener("click", function(e){ // добавление слушателя событий
        e.preventDefault(); // отключение действия "по умолчанию"
        openProfile(); // вызов функции "открытие профиля"
    });
}
