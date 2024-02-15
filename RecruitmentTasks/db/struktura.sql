-- Loterie
create table `lotteries` (
	-- Id
	`id` int unsigned not null,
	-- Nazwa loterii
	`name` varchar(255) not null,
	-- Cena za los
	`ticket_price` decimal(12, 2) not null,
	-- Wysokość nagrody pieniężnej
	`prize` decimal(12, 2) not null,
	primary key (`id`)
);

-- Losowania
create table `draws` (
        -- Id
	`id` int unsigned not null,
	-- Id loterii
	`lottery_id` int unsigned not null,
	-- Data losowania
	`draw_date` timestamp not null,
	-- Wygrany numer
	`won_number` int,
	primary key (`id`),
	constraint `draws_lottery_id`
		foreign key (`lottery_id`)
		references `lotteries` (`id`)
		on delete cascade on update cascade
);

-- Losy zakupione przez uzytkownikow
create table `tickets` (
        -- Id
	`id` int unsigned not null,
        -- Id losowania
	`draw_id` int unsigned not null,
	-- Data zakupu losu
	`bought_date` timestamp not null,
	-- Wytypowany numer
	`number` int unsigned not null,
	primary key (`id`),
	constraint `tickets_draw_id`
		foreign key (`draw_id`)
		references `draws` (`id`)
		on delete cascade on update cascade
);