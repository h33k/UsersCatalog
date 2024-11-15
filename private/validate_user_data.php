<?php
function validate_user_data($user)
{
    if (empty($user->name) || empty($user->login) || empty($user->password) || empty($user->role)) {
        return [
            'success' => false,
            'message' => 'Поля должны быть заполнены для каждого пользователя.'
        ];
    }

    if (preg_match('/\s/', $user->login) || preg_match('/\s/', $user->password)) {
        return [
            'success' => false,
            'message' => 'Поля логина и пароля не должны содержать пробелов.'
        ];
    }

    if (strlen($user->name) > 32) {
        return [
            'success' => false,
            'message' => 'ФИО пользователя слишком длинное.'
        ];
    }

    if (strlen($user->password) < 6) {
        return [
            'success' => false,
            'message' => 'Пароль слишком короткий.'
        ];
    }

    if ($user->role !== 'admin' && $user->role !== 'user') {
        return [
            'success' => false,
            'message' => 'Неверное значение роли.'
        ];
    }

    // если все проверки пройдены
    return null;
}