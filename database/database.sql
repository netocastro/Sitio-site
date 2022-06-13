drop table if exists `feed_purchases_historic`;
drop table if exists `food_stock`;
drop table if exists `daily_food`;
drop table if exists `pigs`;
drop table if exists `breeds`;
drop table if exists `foods`;
drop table if exists `users`;

create table `users`(
    `id` INTEGER AUTO_INCREMENT, -- identificador
    `name` VARCHAR(100) NOT NULL, -- nome
    `nick` VARCHAR(16) NOT NULL unique, -- apelido
    `email` VARCHAR(50) NOT NULL unique, -- email
    `cpf` CHAR(14) NOT NULL unique, -- cpf
    `password` VARCHAR(64) NOT NULL, -- senha
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`name`, `nick`, `cpf`, `email`, `password`) VALUES 
('admin', 'Admin', '000.000.000-01', 'admin@admin.com', '$2y$10$wCZUom//y63jA9hF0aUBEeOAYwP/LqSgFGgmI3d7vV/.kpmbKWjmS'),
('Maria', 'Mariazinha', '000.000.000-02','maria@maria.com', '$2y$10$wCZUom//y63jA9hF0aUBEeOAYwP/LqSgFGgmI3d7vV/.kpmbKWjmS'),
('Joao', 'Joaozinho', '000.000.000-03','joao@joao.com', '$2y$10$wCZUom//y63jA9hF0aUBEeOAYwP/LqSgFGgmI3d7vV/.kpmbKWjmS');

create table `breeds`( -- bread == raça 
    `id` integer auto_increment,
    `name` varchar(30) not null, -- nome
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
    `name` CHAR(2) not null, -- id do usuario 
    `user_id` integer not null, -- id do usuario 
    `breed_id` integer not null, -- id da raça 
    `birthday` date not null, -- nascimento 
    `slaughter_day` date not null, -- dia do abate 
    `serrated_teeth` boolean default false not null, -- verifica se os dentes estão serrados 
    `vaccination` boolean default false not null, -- verifica se o porco foi vacinado 
    `starting_weight` float(8,3) not null, -- peso inicial em kg 
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

alter table `pigs` add foreign key (breed_id) references breeds(id) on delete cascade;
alter table `pigs` add foreign key (user_id) references users(id) on delete cascade;

INSERT INTO `pigs` (user_id, name, breed_id, birthday, slaughter_day, serrated_teeth, vaccination,  starting_weight) VALUES 
('1', 'A1', '1', '2022-05-01', '2023-01-10', true, false, 5.250),
('1', 'A2', '2', '2022-05-01', '2023-02-10', false, false, 6.500),
('1', 'A3', '30', '2022-05-01', '2023-02-10', true, true, 7.200),
('2', 'B1', '32', '2022-05-01', '2023-02-10', true, true, 6.500),
('2', 'B2', '31', '2022-06-02', '2023-03-10', true, false, 5.200);

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
('1', 'Farelo de milho'), ('1', 'Farelo de trigo'), ('1', 'Farelo de soja'), ('2', 'Soro'),
('2', 'nucleo');

create table `daily_food`( -- comida diária
    `id` integer auto_increment,
    `user_id` integer not null, -- id do usuario 
    `date` date not null, -- data que ele comeu
    `food_id` integer not null, -- qual o alimento
    `amount` float(7,3) not null, -- peso em kg que o porco comeu
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

alter table `daily_food` add foreign key (food_id) references foods(id) on delete cascade;
alter table `daily_food` add foreign key (user_id) references users(id) on delete cascade;

INSERT INTO `daily_food` (user_id, food_id, date, amount) VALUES 
('1', '1', '2022-05-01', 2.000),
('1', '2', '2022-05-01', 1.50),
('1', '2', '2022-05-21', 3.000),
('2', '3', '2022-05-20', 4.000),
('2', '3', '2022-05-01', 5.000),
('2', '4', '2022-05-01', 5.600),
('3', '3', '2022-06-02', 6.000);

create table `food_stock`( -- alimentção comprada pelo dono dos porcos
    `id` integer auto_increment,
    `user_id` integer not null, -- id do usuario 
    `food_id` integer not null, -- qual o alimento
    `amount` float(8,3) not null, -- quantidade em estoque
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

alter table `food_stock` add foreign key (user_id) references users(id) on delete cascade;
alter table `food_stock` add foreign key (food_id) references foods(id) on delete cascade;

INSERT INTO `food_stock` (user_id, food_id, amount) VALUES 
('1', '1', 100.000), 
('1', '2', 100.000), 
('1', '3', 100.000),
('2', '1', 100.000), 
('2', '1', 100.000);

create table `feed_purchases_historic`( -- alimentção comprada pelo dono dos porcos historico e compras
    `id` integer auto_increment,
    `user_id` integer not null, -- id do usuario 
    `food_id` integer not null, -- qual o alimento
    `date` date not null, -- data de compra da ração
    `amount` float(7,3) not null, -- quantidade comprada
    `price` float(8,2) not null, -- valo gasto nessa compra
    `created_at` timestamp default CURRENT_TIMESTAMP,
    `updated_at` timestamp default CURRENT_TIMESTAMP,

    primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

alter table `feed_purchases_historic` add foreign key (user_id) references users(id) on delete cascade;
alter table `feed_purchases_historic` add foreign key (food_id) references foods(id) on delete cascade;

INSERT INTO `feed_purchases_historic` (user_id, food_id, date, amount, price) VALUES 
('1', '1', '2022-05-10', 50.000, 500.00),('1', '1', '2022-05-10', 35.000, 350.00), ('1', '2', '2022-05-10', 12.000, 120.00), 
('2', '3', '2022-05-12', 45.000, 450.00), ('2', '3', '2022-05-13', 28.000, 280.00);

-- talvez criar uma tabela com preços, pode ser preço por kilo, pço por porco
-- ou qualquer coisa assim
