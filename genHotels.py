#!/bin/python
places = [
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

for i in range(1, len(places) + 10):
    print("insert into hotels(address, numberOfPlaces, pricePerNight) values('{}', '{}', '{}');".format(
                random.choice(places), random.randint(1,5) * 10, random.randint(3, 10) * 10
                ));
