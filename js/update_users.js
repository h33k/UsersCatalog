// получение данных внутри url
const params = new URLSearchParams(window.location.search);
const logins = params.get("logins")?.split(";");

if (logins) {
    webix.ajax().get(`../private/get_users.php?logins=${logins.join(";")}`).then(response => {
        const users = response.json();

        const userForms = users.map(user => ({
            view: "form",
            id: `form_${user.login}`,
            width: 450,
            elements: [
                {view: "text", label: "ФИО", name: "name", labelPosition: "top", value: user.name},
                {view: "text", label: "Логин", name: "login", labelPosition: "top", value: user.login, readonly: true},
                {view: "text", label: "Пароль", name: "password", labelPosition: "top", value: user.password},
                {
                    view: "radio", label: "Роль", name: "role", options: [
                        {id: "user", value: "Пользователь"},
                        {id: "admin", value: "Админ"}
                    ], value: user.role
                }
            ],
            elementsConfig: {labelWidth: 100}
        }));

        webix.ui({
            container: "container",
            rows: [
                {gravity: 1},
                {cols: [{gravity: 1}, {rows: userForms}, {gravity: 1}]},
                {gravity: 1},
                {
                    cols: [
                        {gravity: 1},
                        {
                            view: "button",
                            value: "Обновить все данные",
                            css: "webix_primary",
                            width: 450,
                            click: function () {
                                const updatedUsers = users.map(user => $$(`form_${user.login}`).getValues());

                                webix.ajax().post(`/private/update_users.php`, JSON.stringify(updatedUsers), {
                                    headers: {"Content-Type": "application/json"}
                                }).then(response => {
                                    const data = response.json();
                                    webix.message(data.success ? "Все пользователи обновлены" : `Ошибка: ${data.message}`);
                                    if (data.success) {
                                        setTimeout(function () {
                                            window.location.href = '../index.php';
                                        }, 1000);
                                    }
                                }).catch(error => {
                                    console.error("Ошибка при запросе:", error);
                                    webix.message("Произошла ошибка. Попробуйте позже.");
                                });
                            }
                        },
                        {gravity: 1}
                    ]
                },
                {gravity: 1}
            ]
        });
    }).catch(error => {
        console.error("Ошибка при получении данных пользователей:", error);
    });
} else {
    webix.message("Не указаны логины пользователей.");
}
