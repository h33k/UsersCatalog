Install
- Configure .env file to connect to db
- Run this sql command
  ```
  CREATE TABLE users (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    login VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    password VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    role VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    access TINYINT(1) DEFAULT 1,
    PRIMARY KEY (id)
  );
  ```
- Seed users table with this command:
```
INSERT INTO users (name, login, password, role, access)
VALUES
  ('Maxim Maximovich Ivanov', 'maxim', '123456', 'admin', 1),
  ('Alexey Alexeyevich Smirnov', 'alexey2', '123456', 'user', 1),
  ('Dmitry Dmitrievich Kuznetsov', 'dmitriy3', '123456', 'user', 1),
  ('Sergey Sergeyevich Popov', 'sergey4', '123456', 'user', 1),
  ('Nikolay Nikolaevich Vasilyev', 'nikolay5', '123456', 'user', 1),
  ('Alexander Alexandrovich Petrov', 'alexandr6', '123456', 'user', 1),
  ('Mikhail Mikhailovich Sokolov', 'mikhail7', '123456', 'user', 1),
  ('Andrey Andreyevich Mikhaylov', 'andrey8', '123456', 'user', 1),
  ('Ivan Ivanovich Novikov', 'ivan9', '123456', 'user', 1),
  ('Artem Artemovich Fyodorov', 'artem10', '123456', 'user', 1),
  ('Vladimir Vladimirovich Morozov', 'vladimir11', '123456', 'user', 1),
  ('Roman Romanovich Volkov', 'roman12', '123456', 'user', 1),
  ('Evgeniy Evgenyevich Alekseyev', 'evgeniy13', '123456', 'user', 1),
  ('Pavel Pavlovich Lebedev', 'pavel14', '123456', 'user', 1),
  ('Konstantin Konstantinovich Semyonov', 'konstantin15', '123456', 'user', 1),
  ('Viktor Viktorovich Yegorov', 'viktor16', '123456', 'user', 1),
  ('Denis Denisovich Ilyin', 'denis17', '123456', 'user', 1),
  ('Oleg Olegovich Zaytsev', 'oleg18', '123456', 'user', 1),
  ('Vyacheslav Vyacheslavovich Pavlov', 'vyacheslav19', '123456', 'user', 1),
  ('Vasiliy Vasilyevich Sergeyev', 'vasiliy20', '123456', 'user', 1),
  ('Maxim Maximovich Stepanov', 'maxim21', '123456', 'user', 1),
  ('Igor Igorevich Nikolaev', 'igor22', '123456', 'user', 1),
  ('Artemiy Artemyevich Orlov', 'artemiy23', '123456', 'user', 1),
  ('Stanislav Stanislavovich Afanasyev', 'stanislav24', '123456', 'user', 1),
  ('Anatoliy Anatolyevich Frolov', 'anatoliy25', '123456', 'user', 1),
  ('Grigoriy Grigorievich Schmidt', 'grigoriy26', '123456', 'user', 1),
  ('Boris Borisovich Belyaev', 'boris27', '123456', 'user', 1),
  ('Gleb Glebovich Tarasov', 'gleb28', '123456', 'user', 1),
  ('Anton Antonovich Bobrov', 'anton29', '123456', 'user', 1),
  ('Vitaliy Vitalievich Solovyov', 'vitaliy30', '123456', 'user', 1),
  ('Arkadiy Arkadyevich Karpov', 'arkadiy31', '123456', 'user', 1),
  ('Dmitry Dmitrievich Vorobyov', 'dmitriy32', '123456', 'user', 1),
  ('Alexander Alexandrovich Kiselev', 'alexandr33', '123456', 'user', 1),
  ('Yuriy Yuryevich Makarov', 'yuriy34', '123456', 'user', 1),
  ('Roman Romanovich Andreyev', 'roman35', '123456', 'user', 1),
  ('Alexey Alexeyevich Kovalyov', 'alexey36', '123456', 'user', 1),
  ('Kirill Kirillovich Ivanov', 'kirill37', '123456', 'user', 1),
  ('Valeriy Valeryevich Sobolev', 'valeriy38', '123456', 'user', 1),
  ('Nikolay Nikolaevich Krylov', 'nikolay39', '123456', 'user', 1),
  ('Grigoriy Grigorievich Grigoryev', 'grigoriy40', '123456', 'user', 1),
  ('Mikhail Mikhailovich Titov', 'mikhail41', '123456', 'user', 1),
  ('Pavel Pavlovich Lazarev', 'pavel42', '123456', 'user', 1),
  ('Artem Artemovich Medvedev', 'artem43', '123456', 'user', 1),
  ('Ilya Ilyich Chernov', 'ilya44', '123456', 'user', 1),
  ('Oleg Olegovich Solovyov', 'oleg45', '123456', 'user', 1),
  ('Andrey Andreyevich Polyakov', 'andrey46', '123456', 'user', 1),
  ('Evgeniy Evgenyevich Zaytsev', 'evgeniy47', '123456', 'user', 1),
  ('Dmitry Dmitrievich Vasilyev', 'dmitriy48', '123456', 'user', 1),
  ('Arkadiy Arkadyevich Petrov', 'arkadiy49', '123456', 'user', 1),
  ('Konstantin Konstantinovich Fyodorov', 'konstantin50', '123456', 'user', 1);
  ```
