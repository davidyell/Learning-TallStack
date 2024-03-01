# T20 Cricket Tall Stack

An example application to learn the tall stack using MongoDB.

This project uses Laravel, Tailwind, Livewire and MongoDB

## Database

You will need to download the T20 match data from https://cricsheet.org/ you'll need the [T20 internationals data](https://cricsheet.org/downloads/t20s_json.zip) 
and extract it into the `database/source_data/icc_mens_t20_world_cup_json` folder for the seeder to read into the database.

## Requirements

- Docker
- PHP 8.3

## Install

* Check out the repo
* `./vendor/bin/sail up -d`
* Visit http://localhost/games
