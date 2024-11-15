webix.ui({
    container: "layout_div",
    id: "layout",
    minHeight: 800,
    rows: [
        {
            view: "toolbar",
            height: 40,
            elements: [
                {
                    view: "template",
                    template: "Текущий администратор: <b>"+document.getElementById('layout_div').dataset.adminName+"</b>",
                    borderless: true,
                    css: "left_aligned",
                    height: 20,
                    align: "middle"
                },
                {
                    view: "button",
                    value: "Создать пользователя",
                    width: 220,
                    css: "webix_standart",
                    align: "right",
                    click: function () {
                        window.location.href = '../public/create_user.php';
                    }
                },
                {
                    view: "button",
                    value: "Выйти",
                    width: 100,
                    css: "webix_standart",
                    align: "right",
                    click: function () {
                        window.location.href = '../public/logout.php';
                    }
                }
            ]
        },

        {
            view: "form",
            rows: [
                {
                    view: "text",
                    id: "searchField",
                    labelPosition: "top",
                    placeholder: "Введите имя для поиска",
                    fullwidth: true,
                    css: "webix_search_field",
                    on: {
                        onTimedKeyPress: function () {
                            var searchValue = $$("searchField").getValue().toLowerCase();
                            var userTable = $$("userTable");

                            // фильтрация с проверкой на null или undefined
                            userTable.filter(function (obj) {
                                return obj.name && obj.name.toLowerCase().indexOf(searchValue) !== -1;
                            });
                        }
                    }
                }
            ],
            css: "webix_search_container"
        },
        {
            view: "datatable",
            css: "webix_data_border webix_header_border",
            id: "userTable",
            rowHeight: 50,
            columns: [
                { id: "checkbox", header: "", template: "{common.checkbox()}", width: 40, resize: true },
                { id: "name", header: "ФИО", fillspace: true, resize: true },
                { id: "login", header: "Логин", fillspace: true, resize: true },
                { id: "password", header: "Пароль", fillspace: true, resize: true },
                { id: "role", header: "Роль", fillspace: true, resize: true },
                {
                    id: "access",
                    header: "Доступ",
                    fillspace: true,
                    template: function(obj) {
                        return obj.access === 1 ? "Есть" : "Заблокирован";
                    },
                    resize: true
                },
            ],
            url: "../private/get_users.php", // загрузка данных с сервера
            pager: {
                container: 'pager',
                size: 12,
                group: 5,
                autoWidth: true,
                template: '{common.first()}{common.prev()}{common.pages()}{common.next()}{common.last()}',
                on: {
                    onItemClick: function() {
                        let table = $$("userTable");
                        let checkedRows = table.find({ "checkbox": true });
                        checkedRows.forEach(function(item) {
                            table.updateItem(item.id, { checkbox: false });
                        });
                    }
                }
            },
            scroll: false,
            resizeColumn: true
        },
        {
            cols: [
                {
                    view: "pager",
                    id: "pager",
                },
                {
                    view: "button",
                    value: "Изменить данные",
                    width: 200,
                    css: "webix_primary",
                    click: function () {
                        // выбор по отмеченным чекбоксам и сбор их логинов для изменения данных
                        let userTable = $$("userTable");
                        let checkedRows = userTable.find({ "checkbox": true });

                        let logins = checkedRows.map(function(row) {
                            return row.login;
                        });

                        let queryString = logins.map(encodeURIComponent).join(';');

                        window.location.href = `../public/update_users.php?logins=${queryString}&mode=1`;
                    }
                },
                {
                    view: "button",
                    value: "Изменить доступ",
                    width: 200,
                    css: "webix_danger",
                    click: function () {
                        // выбор по отмеченным чекбоксам и сбор их логинов для изменения доступа
                        let userTable = $$("userTable");
                        let checkedRows = userTable.find({ "checkbox": true });

                        let logins = checkedRows.map(function(row) {
                            return row.login;
                        });

                        let queryString = logins.map(encodeURIComponent).join(';');

                        let url = `../private/update_users.php?logins=${queryString}&mode=2`;

                        fetch(url, { method: 'GET' })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    webix.message({ type: "success", text: data.message });

                                    // обновление значений access в таблице
                                    checkedRows.forEach(function(row) {
                                        let currentAccess = row.access;
                                        let newAccess = currentAccess ? 0 : 1;
                                        userTable.updateItem(row.id, { access: newAccess });
                                        userTable.updateItem(row.id, { checkbox: false });
                                    });
                                } else {
                                    webix.message({ type: "error", text: data.message });
                                }
                            })
                            .catch(error => {
                                console.error('Ошибка:', error);
                                webix.message({ type: "error", text: "Произошла ошибка при обновлении пользователей." });
                            });
                    }

                }
            ],
            align: "right"
        }
    ],
}).show();
