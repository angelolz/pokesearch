CREATE DATABASE PokeSearch;
USE PokeSearch;

/*
	- This table is where information of registered users will be stored.
*/
CREATE TABLE Users (
	user_id int NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL UNIQUE,
    username varchar(30) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
    PRIMARY KEY (user_id)
);

/*
	- This table is where information of a team created by a user will be stored.
    - The owner column will be referencing the user_id of the user that created the team.
*/
CREATE TABLE Team (
	team_id int NOT NULL AUTO_INCREMENT,
	owner int NOT NULL,
    team_name varchar(20) NOT NULL,
    PRIMARY KEY (team_id),
    FOREIGN KEY (owner) REFERENCES Users(user_id)
);

/*
	- This table holds information of what Pokemon are in a user's team.
    - The team_id column helps link to what team a pokemon belongs to.
    - The moveset_id column helps create a link to the Moves table so
    it can associate what moveset this certain pokemon has.
*/
CREATE TABLE Pokemon (
	pokemon_name VARCHAR(15) NOT NULL,
    team_id int NOT NULL,
    item_held VARCHAR (20),
    ability VARCHAR(20),
    moveset_id int,
    FOREIGN KEY (team_id) REFERENCES Team(team_id)
);

/*
	- This table holds information of what moveset a pokemon in a team has.
    - There must be at least 1 move in a moveset.
*/
CREATE TABLE Moves (
	moveset_id int AUTO_INCREMENT,
    move1 VARCHAR(25) NOT NULL,
    move2 VARCHAR(25),
    move3 VARCHAR(25),
    move4 VARCHAR(25),
    PRIMARY KEY (moveset_id)
);
