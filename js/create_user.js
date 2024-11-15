webix.ui({
    container: "container",
    rows: [
        {gravity: 1},
        {
            cols: [
                {gravity: 1},
                {
                    view: "form",
                    id: "userForm",
                    width: 450,
                    elements: [
                        {
                            view: "text",
                            label: "ФИО",
                            name: "name",
                            labelPosition: "top",
                            placeholder: "Введите ФИО"
                        },
                        {
                            view: "text",
                            label: "Логин",
                            name: "login",
                            labelPosition: "top",
                            placeholder: "Введите логин"
                        },
                        {
                            view: "text",
                            label: "Пароль",
                            name: "password",
                            type: "password",
                            labelPosition: "top",
                            placeholder: "Введите пароль"
                        },
                        {
                            view: "radio",
                            label: "Роль",
                            name: "role",
                            options: [
                                {id: "user", value: "Пользователь"},
                                {id: "admin", value: "Админ"}
                            ]
                        },
                        {
                            margin: 10,
                            cols: [
                                {
                                    view: "button",
                                    value: "Создать",
                                    css: "webix_primary",
                                    width: 200,
                                    click: function () {
                                        let formValues = $$('userForm').getValues();

                                        webix.ajax().post("/private/create_user.php", JSON.stringify(formValues), {
                                            headers: {
                                                "Content-Type": "application/json"
                                            }
                                        }).then(response => {
                                            const data = response.json();
                                            if (data.success) {
                                                webix.message("Пользователь успешно создан");
                                                setTimeout(function () {
                                                    window.location.href = '../index.php';
                                                }, 1000);
                                            } else {
                                                webix.message("Ошибка: " + data.message);
                                            }
                                        }).catch(error => {
                                            console.error("Ошибка при запросе:", error);
                                            webix.message("Произошла ошибка. Попробуйте позже.");
                                        });
                                    }
                                },
                                {
                                    view: "button",
                                    value: "Очистить",
                                    width: 200,
                                    click: function () {
                                        $$("userForm").clear();
                                    }
                                }
                            ]
                        }
                    ],
                    elementsConfig: {
                        labelWidth: 100
                    }
                },
                {gravity: 1}
            ]
        },
        {gravity: 1}
    ]
});
