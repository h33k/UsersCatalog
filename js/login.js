webix.ui({
    container: "container",
    rows: [
        {gravity: 1},
        {
            cols: [
                {gravity: 1},
                {
                    view: "form",
                    id: "loginForm",
                    width: 345,
                    elements: [
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
                            margin: 10,
                            cols: [
                                {
                                    view: "button",
                                    value: "Войти",
                                    css: "webix_primary",
                                    width: 150,
                                    click: function () {
                                        let formValues = $$('loginForm').getValues();

                                        webix.ajax().post("/private/auth.php", JSON.stringify({
                                            login: formValues.login,
                                            password: formValues.password
                                        }), {
                                            headers: {
                                                "Content-Type": "application/json"
                                            }
                                        }).then(response => {
                                            const data = response.json(); // сразу получаем объект а не промис
                                            console.log(data);
                                            if (data.success) {
                                                if (data.role === 'admin') {
                                                    window.location.href = '../index.php';
                                                } else {
                                                    window.location.href = '../public/user_profile.php';
                                                }
                                            } else {
                                                webix.message("Не удалось войти: " + data.message);
                                            }
                                        }).catch(error => {
                                            console.error("Error during AJAX request:", error);
                                            webix.message("An error occurred. Please try again.");
                                        });
                                    }
                                },
                                {
                                    view: "button",
                                    value: "Очистить",
                                    width: 150,
                                    click: function () {
                                        $$("loginForm").clear();
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
