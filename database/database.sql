drop table if exists `daily_food`;
drop table if exists `pigs`;
drop table if exists `breeds`;
drop table if exists `foods`;
drop table if exists `users`;

create table `users`(
    `id` INTEGER AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL, -- nome
    `nick` VARCHAR(16) NOT NULL unique, -- apelido
    `email` VARCHAR(50) NOT NULL unique, -- email
    `cpf` CHAR(14) NOT NULL unique, -- cpf
    `password` VARCHAR(64) NOT NULL, -- senha
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
);

INSERT INTO `users` (`name`, `nick`, `cpf`, `email`, `password`) VALUES 
('Maria', 'Mariazinha', '000.000.000-01','maria@maria.com', '$2y$10$wCZUom//y63jA9hF0aUBEeOAYwP/LqSgFGgmI3d7vV/.kpmbKWjmS'),
('Joao', 'Joaozinho', '000.000.000-02','joao@joao.com', '$2y$10$wCZUom//y63jA9hF0aUBEeOAYwP/LqSgFGgmI3d7vV/.kpmbKWjmS'),
('souadmin', 'Admin', '000.000.000-03', 'souadmin@souadmin.com', '$2y$10$wCZUom//y63jA9hF0aUBEeOAYwP/LqSgFGgmI3d7vV/.kpmbKWjmS');

create table `breeds`( -- bread == raça 
    `id` integer auto_increment,
    `name` varchar(30) not null, -- nome
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
);

INSERT INTO `breeds` (name) VALUES 
('Aksai Black Pied'), ('American Yorkshire'), ('Angeln Saddleback'), ('Appalachian English'),
('Arapawa Island'), ('Auckland'), ('Australian Yorkshire'), ('Babi Kampung'), ('Ba Xuyen'),
('Bantu'), ('Basque'), ('Bazna'), ('Beijing Black'), ('Belarus Black Pied'), ('Belgian Landrace'),
('Bengali Brown Shannaj'), ('Bentheim Black Pied'), ('Berkshire'), ('Bísaro'), ('Bangur pig'),
('Black Slavonian'), ('Black Canarian Pig'), ('Breitovo'), ('British Landrace'), ('British Lop'),
('British Saddleback'), ('Bulgarian White'), ('Cantonese'), ('Celtic pig Galícia'), ('Chato Murciano'),
('Chester White'), ('Chiangmai Blackpig aka MooDum Chiangmai'), ('Choctaw Hog'), ('Creole Pig'),
('Cumberland Pig (Extinto)'), ('Czech Improved White'), ('Danish Landrace Dinamarca'),
('Danish Protest Pig'), ('Dermantsi Pied'), ('Li Yan Pig'), ('Dharane Kalo sungur Dharan'),
('Dutch Landrace pig'), ('East Balkan pig'), ('Essex'), ('Estonian Bacon'), ('Fengjing pig'),
('Finnish Landrance'), ('Forest Mountain'), ('French Landrace'), ('Gascon'), ('German Landrace'),
('Gloucestershire Old Spot'), ('Göttingen minipig'), ('Landrace'), ('Large White'), ('Duroc Jersey'),
('Pietrain'), ('Hampshire'), ('Canastrão (Zabumba, Cabano)'), ('Canastra (Meia-perna, Moxom)'),
('Piau'), ('Caruncho'), ('Moura'), ('Nilo Canastra'), ('Casco-de-burro'), ('Monteiro'), ('Pereira');

create table `pigs`(
    `id` integer auto_increment,
    `user_id` integer not null, -- id do usuario 
    `breed_id` integer not null, -- id da raça 
    `birthday` date not null, -- nascimento 
    `slaughter_day` date, -- dia do abate 
    `starting_weight` float(8,2) not null, -- peso inicial em kg 
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
);

alter table `pigs` add foreign key (breed_id) references breeds(id) on delete cascade;
alter table `pigs` add foreign key (user_id) references users(id) on delete cascade;

INSERT INTO `pigs` (user_id, breed_id, birthday, slaughter_day, starting_weight) VALUES 
('1','1', '2022-05-01', '2023-01-10', 5.25),
('1','2', '2022-05-01', '2023-02-10', 6.50),
('2','30', '2022-05-01', '2023-02-10', 7.20),
('2','32', '2022-05-01', '2023-02-10', 6.50),
('2','31', '2022-06-02', '2023-03-10', 5.20);

create table `foods`(
    `id` integer auto_increment,
    `user_id` integer not null, -- id do usuario 
    `name` varchar(50) not null, -- nome
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
);

alter table `foods` add foreign key (user_id) references users(id) on delete cascade;

INSERT INTO `foods` (user_id, name) VALUES 
('2', 'Farelo de milho'), ('2', 'Farelo de trigo'), ('2', 'Farelo de soja'), ('2', 'Soro'),
('2', 'nucleo');

create table `daily_food`( -- comida diária
    `id` integer auto_increment,
    `pig_id` integer not null, -- id do porco
    `date` date not null, -- data que ele comeu
    `food_id` integer not null, -- qual o alimento
    `amount` float(8,2) not null, -- peso em kg que o porco comeu
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
);

alter table `daily_food` add foreign key (pig_id) references pigs(id) on delete cascade;
alter table `daily_food` add foreign key (food_id) references foods(id) on delete cascade;

INSERT INTO `daily_food` (pig_id, food_id, date, amount) VALUES 
('1','1','2022-05-01', 2),
('1','1','2022-05-02', 1.5),
('2','2','2022-05-21', 3),
('2','2','2022-05-20', 4),
('3','1','2022-05-01', 5),
('4','1','2022-05-01', 5.6),
('3','2','2022-06-02', 6);

-- talvez criar uma tabela com preços, pode ser preço por kilo, pço por porco
-- ou qualquer coisa assim
