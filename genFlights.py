#!/bin/python
destinations = [
"Albania Tirana",
"Andora Andora",
"Armenia Erewań",
"Austria Wiedeń",
"Azerbejdżan Baku",
"Belgia Bruksela",
"Białoruś Mińsk",
"Bośnia i Hercegowina Sarajewo",
"Bułgaria Sofia",
"Chorwacja Zagrzeb",
"Cpr Nikozja",
"Czechy Praga",
"Dania Kopenhaga",
"Estonia Tallin",
"Finlandia Helsinki"
]
import random

for i in range(1, 12):
    print("insert into flights(price, date, destination, numberOfPlaces) values('{}', '{}-{:02d}-{:02d}', '{}', '{}');".format(
                random.randint(1, 10) * 150,
                random.randint(2016, 2017), random.randint(1,12), random.randint(1,30),
                random.choice(destinations),
                random.randint(2,5) * 15
                ));
